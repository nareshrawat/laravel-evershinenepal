<?php

namespace App\Http\Controllers\Dashboard;

use App\Kitchen;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class KitchenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$title = "Product";

        //fetch all kitchens stored in db (those not deleted).
        $kitchensNotDeleted = Kitchen::all();
        $kitchensNotDeletedCount = count($kitchensNotDeleted);

        //fetch all including soft deleted kitchens
        $kitchensAll = Kitchen::withTrashed()->get();

        //fetch only trashed/deleted kitchens
        $kitchensTrashed = Kitchen::onlyTrashed()->get();
        $kitchensTrashedCount = count($kitchensTrashed);

        return view('dashboard.kitchens.index', compact(
                'title',
                'kitchensNotDeleted',
                'kitchensNotDeletedCount',
                'kitchensAll',
                'kitchensTrashedCount'
            )
        );
        dd('$kitchensAll');*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$title = 'Create Product';
        $categoryList = Category::lists('title', 'id');
        $currentCategories = null;
        return view('dashboard.kitchens.create')->with([
            'title' => $title,
            'categoryList' => $categoryList,
            'currentCategories' => $currentCategories,
        ]);*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\KitchenRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Requests\KitchenRequest $request)
    {
       /* $kitchen = new Kitchen;
        $kitchen->user_id = Auth::user()->id;
        $kitchen->title = $request->title;
        $kitchen->description = $request->description;
        $kitchen->parent = $request->parent ? $request->parent : 0;
        //$kitchen->order = $request->order;
        $kitchen->active = $request->active == 1 ? 1 : 0;
        if ($kitchen->save()) {
            return redirect()
                ->back()
                ->with('flash_message', 'Product Published');
        }
        return redirect()
            ->back()
            ->withErrors()
            ->withInput();
    }

    public function edit($id)
    {
        $title = 'Create Product';
        $kitchen = Kitchen::findOrFail($id);
        $parents = Kitchen::lists('title', 'id');
        $parent = null;
        return view('dashboard.kitchens.edit')->with([
            'title' => $title,
            'kitchen' => $kitchen,
            'parent' => $parent,
            'parents' => $parents,
        ]);*/
    }

    public function update(Requests\KitchenRequest $request, $id)
    {
        /*$kitchen = Kitchen::findOrFail($id);
        $kitchen->user_id = Auth::user()->id;
        $kitchen->title = $request->title;
        $kitchen->description = $request->description;
        $kitchen->parent = $request->parent;
//        $kitchen->order = $request->order;
        $active = $request->active == 1 ? 1 : 0;
        $kitchen->active = $active;
        if ($kitchen->save()) {
            return redirect()
                ->back()
                ->with('flash_message', 'Product Successfully Updated');
        }
        return redirect()
            ->back()
            ->withErrors()
            ->withInput();*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$kitchen = Kitchen::findOrFail($id);
        if ($kitchen->delete()) {
            return redirect()
                ->back()
                ->with('flash_message', 'Product Moved to Trash');
        }*/
    }

    /**
     * Permanently delete the specified resource from storage
     * @param  int $id
     * @return [type]     [description]
     */
    public function forceDelete($id)
    {
        /*$kitchen = Kitchen::onlyTrashed()->find($id);
        if ($kitchen) {
            $kitchen->forceDelete();
            return redirect()->back()->with('success', 'Product Permanently Deleted');
        }
        return redirect()->back()->with('error', 'Something went wrong, please try again');*/
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTrash()
    {
        /*$title = "Kitchen Products";

        //fetch all kitchens stored in db (those not deleted).
        $kitchensNotDeleted = Kitchen::all();
        $kitchensNotDeletedCount = count($kitchensNotDeleted);

        //fetch only trashed/deleted kitchens
        $kitchensTrashed = Kitchen::onlyTrashed()->get();
        $kitchensTrashedCount = count($kitchensTrashed);

        return view('dashboard.kitchens.trash', compact('title', 'kitchensTrashed', 'kitchensTrashedCount', 'kitchensNotDeletedCount'));*/
    }

    /**
     * Restore Trashed Product
     * @param  int $id
     * @return [type]     [description]
     */
    public function restoreKitchen($id)
    {
        /*$kitchen = Kitchen::withTrashed()->where('id', $id)->restore();
        if ($kitchen) {
            return redirect()->back()->with('success', 'Product Successfully Restored');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');*/
    }

    /**
     * Update Kitchen publish/unpublish
     * @param  $id
     * @return [type]     [description]
     */
    public function updatepublish($id, Request $request)
    {
        /*$active = $request->active;

        if ($active == 1) {
            $active = 0;
        } else {
            $active = 1;
        }

        $publish = Kitchen::where('id', $id)->update(['active' => $active]);
        if ($publish) {
            return redirect()->back()->with('success', 'Product Successfully Updated');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');*/
    }

    /**
     * Generate PDF
     * * @return \Illuminate\Http\Response
     */
    public function generatepdf()
    {
        /*$data = Kitchen::all();
        $date = date('Y-m-d');
        $view =  \View::make('dashboard.kitchens.pdf', compact('data', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream();*/
    }
}
