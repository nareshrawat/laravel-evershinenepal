<?php

namespace App\Http\Controllers\Dashboard;

use App\Page;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Pages";

        //fetch all pages stored in db (those not deleted).
        $pagesNotDeleted = Page::all();
        $pagesNotDeletedCount = count($pagesNotDeleted);

        //fetch all including soft deleted pages
        $pagesAll = Page::withTrashed()->get();

        //fetch only trashed/deleted pages
        $pagesTrashed = Page::onlyTrashed()->get();
        $pagesTrashedCount = count($pagesTrashed);

        return view('dashboard.pages.index', compact(
                'title',
                'pagesNotDeleted',
                'pagesNotDeletedCount',
                'pagesAll',
                'pagesTrashedCount'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Page';
        $parents = array('0' => 'no-parent') + Page::lists('title', 'id')->toArray();
        return view('dashboard.pages.create')->with([
            'title' => $title,
            'parents' => $parents,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\PageRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Requests\PageRequest $request)
    {
        $page = new Page;
        $page->user_id = Auth::user()->id;
        $page->title = $request->title;
        $page->description = $request->description;
        $page->parent = $request->parent ? $request->parent : 0;
        //$page->order = $request->order;
        $page->active = $request->active == 1 ? 1 : 0;
        if ($page->save()) {
            return redirect()
                ->back()
                ->with('flash_message', 'Page Published');
        }
        return redirect()
            ->back()
            ->withErrors()
            ->withInput();
    }

    public function edit($id)
    {
        $title = 'Create Page';
        $page = Page::findOrFail($id);
        $parents = Page::lists('title', 'id');
        $parent = null;
        return view('dashboard.pages.edit')->with([
            'title' => $title,
            'page' => $page,
            'parent' => $parent,
            'parents' => $parents,
        ]);
    }

    public function update(Requests\PageRequest $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->user_id = Auth::user()->id;
        $page->title = $request->title;
        $page->description = $request->description;
        $page->parent = $request->parent;
//        $page->order = $request->order;
        $active = $request->active == 1 ? 1 : 0;
        $page->active = $active;
        if ($page->save()) {
            return redirect()
                ->back()
                ->with('flash_message', 'Page Successfully Updated');
        }
        return redirect()
            ->back()
            ->withErrors()
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        if ($page->delete()) {
            return redirect()
                ->back()
                ->with('flash_message', 'Page Moved to Trash');
        }
    }

    /**
     * Permanently delete the specified resource from storage
     * @param  int $id
     * @return [type]     [description]
     */
    public function forceDelete($id)
    {
        $page = Page::onlyTrashed()->find($id);
        if ($page) {
            $page->forceDelete();
            return redirect()->back()->with('success', 'Page Permanently Deleted');
        }
        return redirect()->back()->with('error', 'Something went wrong, please try again');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTrash()
    {
        $title = "Pages";

        //fetch all pages stored in db (those not deleted).
        $pagesNotDeleted = Page::all();
        $pagesNotDeletedCount = count($pagesNotDeleted);

        //fetch only trashed/deleted pages
        $pagesTrashed = Page::onlyTrashed()->get();
        $pagesTrashedCount = count($pagesTrashed);

        return view('dashboard.pages.trash', compact('title', 'pagesTrashed', 'pagesTrashedCount', 'pagesNotDeletedCount'));
    }

    /**
     * Restore Trashed Page
     * @param  int $id
     * @return [type]     [description]
     */
    public function restorePage($id)
    {
        $page = Page::withTrashed()->where('id', $id)->restore();
        if ($page) {
            return redirect()->back()->with('success', 'Page Successfully Restored');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');
    }

    /**
     * Update Page publish/unpublish
     * @param  $id
     * @return [type]     [description]
     */
    public function updatepublish($id, Request $request)
    {
        $active = $request->active;

        if ($active == 1) {
            $active = 0;
        } else {
            $active = 1;
        }

        $publish = Page::where('id', $id)->update(['active' => $active]);
        if ($publish) {
            return redirect()->back()->with('success', 'Page Successfully Updated');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');
    }

    /**
     * Generate PDF
     * * @return \Illuminate\Http\Response
     */
    public function generatepdf()
    {
        // $data = Page::all();
        // $date = date('Y-m-d');
        // $view =  \View::make('dashboard.pages.pdf', compact('data', 'date'))->render();
        // $pdf = \App::make('dompdf.wrapper');
        // $pdf->loadHTML($view);
        // return $pdf->stream();
    }
}
