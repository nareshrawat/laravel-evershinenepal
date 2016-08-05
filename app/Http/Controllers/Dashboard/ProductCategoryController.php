<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Product;
use App\ProductCategory;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $title = "Product Category";

            //fetch all productcategories stored in db (those not deleted).
            $productcategoriesNotDeleted = ProductCategory::all();
            $productcategoriesNotDeletedCount = count($productcategoriesNotDeleted);

            //fetch all including soft deleted productcategories
            $productcategoriesAll = ProductCategory::withTrashed()->get();

            //fetch only trashed/deleted productcategories
            $productcategoriesTrashed = ProductCategory::onlyTrashed()->get();
            $productcategoriesTrashedCount = count($productcategoriesTrashed);

            return view('dashboard.productcategories.index', compact(
                    'title',
                    'productcategoriesNotDeleted',
                    'productcategoriesNotDeletedCount',
                    'productcategoriesAll',
                    'productcategoriesTrashedCount'
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
            $title = 'Create Product Category';
            $parents = array('0' => 'no-parent') + ProductCategory::lists('title', 'id')->toArray();
            // $categoryList = ProductCategory::lists('title', 'id');
            // $currentCategories = null;
           
            return view('dashboard.productcategories.create')->with([
                'title' => $title,
                'parents' => $parents,
                // 'categoryList' => $categoryList,
                // 'currentCategories' => $currentCategories,

            ]);
        }


        /**
         * Store a newly created resource in storage.
         *
         * @param Requests\ProductCategoryRequest $request
         * @return $this|\Illuminate\Http\RedirectResponse
         */
        public function store(Requests\ProductCategoryRequest $request)
        {
            //dd($request->all());
            $productcat = new ProductCategory;
            $productcat->user_id = Auth::user()->id;
            $productcat->title = $request->title;
            $productcat->description = $request->description;
            $productcat->parent = $request->parent ? $request->parent : 0;
            //$productcat->order = $request->order;
            $productcat->active = $request->active == 1 ? 1 : 0;

            /*if ($request->file('image')) {

                //Upload New File
                $featured_image = $request->file('image');
                $filename = date('Y_m_d_h_i_s') . '_' . $featured_image->getClientOriginalName();
                $path = public_path('uploads/' . $filename);

                \Image::make($featured_image->getRealPath())->resize(600, 600)->save($path);
                $category->image = 'uploads/' . $filename;

            }*/

            if ($productcat->save()) {
                return redirect()
                    ->back()
                    ->with('flash_message', 'Product Category Published');
            }
            return redirect()
                ->back()
                ->withErrors()
                ->withInput();
        }


        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $title = "Edit Product Category";
            $productcat = ProductCategory::findOrFail($id);
            $categoryList = ProductCategory::lists('title', 'id');
            $currentCategories =[];
            // foreach ($productcat->categoryList as $cats) {
            //     $currentCategories = $cats->id;
            // }

            if (empty($currentCategories)) {
                $currentCategories = null;
            }

            return view('dashboard.productcategories.edit')->with([

                'title' => $title,
                'productcat' => $productcat,
                'categoryList' => $categoryList,
                'currentCategories' => $currentCategories,

                ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
                    $productcat = ProductCategory::findOrFail($id);
                    $productcat->user_id = Auth::user()->id;
                    $productcat->title = $request->title;
                    $productcat->description = $request->description;
                    $productcat->parent = $request->parent;
                //  $productcat->order = $request->order;
                    $active = $request->active == 1 ? 1 : 0;
                    $productcat->active = $active;

                    if ($request->file('image')) {

                        //Delete File
                        $filenameOld = $productcat->image;
                        $fullPath = public_path() . '/' . $filenameOld;
                        if (\File::exists($fullPath)) {
                            \File::delete($fullPath);
                        }
                        //Upload New File
                        $featured_image = $request->file('image');
                        $filename = date('Y_m_d_h_i_s') . '_' . $featured_image->getClientOriginalName();
                        $path = public_path('uploads/' . $filename);

                        \Image::make($featured_image->getRealPath())->resize(600, 600)->save($path);
                        $productcat->image = 'uploads/' . $filename;

                    }

                    if ($productcat->save()) {
                        // $product->productcategories()->sync($request->category);
                        return redirect()
                            ->back()
                            ->with('flash_message', 'Product Category Successfully Updated');
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
            $productcat = ProductCategory::findOrFail($id);
            if ($productcat->delete()) {
                return redirect()
                    ->back()
                    ->with('flash_message', 'Product Category Moved to Trash');
            }
        }

        /**
         * Permanently delete the specified resource from storage
         * @param  int $id
         * @return [type]     [description]
         */
        public function forceDelete($id)
        {
            $productcat = ProductCategory::onlyTrashed()->find($id);
            if ($productcat) {
                $productcat->forceDelete();
                return redirect()->back()->with('success', 'Product Category Permanently Deleted');
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
            $title = "Product Categories";

            //fetch all productcategories stored in db (those not deleted).
            $productcategoriesNotDeleted = ProductCategory::all();
            $productcategoriesNotDeletedCount = count($productcategoriesNotDeleted);

            //fetch only trashed/deleted productcategories
            $productcategoriesTrashed = ProductCategory::onlyTrashed()->get();
            $productcategoriesTrashedCount = count($productcategoriesTrashed);

            return view('dashboard.productcategories.trash', compact('title', 'productcategoriesTrashed', 'productcategoriesTrashedCount', 'productcategoriesNotDeletedCount'));
        }

        /**
         * Restore Trashed Product Category
         * @param  int $id
         * @return [type]     [description]
         */
        public function restoreProductCategory($id)
        {
            $productcat = ProductCategory::withTrashed()->where('id', $id)->restore();
            if ($productcat) {
                return redirect()->back()->with('success', 'ProductCategory Successfully Restored');
            }
            return redirect()->back()->with('error', 'Something Went Wrong');
        }

        /**
         * Update ProductCategory publish/unpublish
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

            $publish = ProductCategory::where('id', $id)->update(['active' => $active]);
            if ($publish) {
                return redirect()->back()->with('success', 'ProductCategory Successfully Updated');
            }
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
}
