<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Product;
use App\ProductCategory;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Product";

        //fetch all products stored in db (those not deleted).
        $productsNotDeleted = Product::all();
        $productsNotDeletedCount = count($productsNotDeleted);

        //fetch all including soft deleted products
        $productsAll = Product::withTrashed()->get();

        //fetch only trashed/deleted products
        $productsTrashed = Product::onlyTrashed()->get();
        $productsTrashedCount = count($productsTrashed);

        return view('dashboard.products.index', compact(
                'title',
                'productsNotDeleted',
                'productsNotDeletedCount',
                'productsAll',
                'productsTrashedCount'
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
        $title = 'Create Product';
        $categoryList = ProductCategory::lists('title', 'id');
        $currentCategories = null;
        return view('dashboard.products.create')->with([
            'title' => $title,
            'categoryList' => $categoryList,
            'currentCategories' => $currentCategories,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\ProductRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Requests\ProductRequest $request)
    {
        dd($request->all());
        $product = new Product;
        $product->user_id = Auth::user()->id;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        //$product->order = $request->order;
        $product->active = $request->active == 1 ? 1 : 0;
        if ($product->save()) {
            $product->productcategories()->attach($request->category);
        }
        return redirect()
            ->back()
            ->with('flash_message', 'Product Published');
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Product";
        $product = Product::findOrFail($id);
        $categoryList = ProductCategory::lists('title', 'id');
        $currentCategories =[];
        // foreach ($product->categoryList as $cats) {
        //     $currentCategories = $cats->id;
        // }

        if (empty($currentCategories)) {
            $currentCategories = null;
        }

        return view('dashboard.products.edit')->with([

            'title' => $title,
            'product' => $product,
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
                $product = Product::findOrFail($id);
                $product->user_id = Auth::user()->id;
                $product->title = $request->title;
                $product->description = $request->description;
                $product->regular_price = $request->regular_price;
                $product->sale_price = $request->sale_price;
            //  $product->order = $request->order;
                $active = $request->active == 1 ? 1 : 0;
                $product->active = $active;
                if ($product->save()) {
                    $product->productcategories()->sync($request->category);
                }
                    return redirect()
                        ->back()
                        ->with('flash_message', 'Product Successfully Updated');

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->delete()) {
            return redirect()
                ->back()
                ->with('flash_message', 'Product Moved to Trash');
        }
    }

    /**
     * Permanently delete the specified resource from storage
     * @param  int $id
     * @return [type]     [description]
     */
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->find($id);
        if ($product) {
            $product->forceDelete();
            return redirect()->back()->with('success', 'Product Permanently Deleted');
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
        $title = "Products";

        //fetch all products stored in db (those not deleted).
        $productsNotDeleted = Product::all();
        $productsNotDeletedCount = count($productsNotDeleted);

        //fetch only trashed/deleted products
        $productsTrashed = Product::onlyTrashed()->get();
        $productsTrashedCount = count($productsTrashed);

        return view('dashboard.products.trash', compact('title', 'productsTrashed', 'productsTrashedCount', 'productsNotDeletedCount'));
    }

    /**
     * Restore Trashed Product
     * @param  int $id
     * @return [type]     [description]
     */
    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->where('id', $id)->restore();
        if ($product) {
            return redirect()->back()->with('success', 'Product Successfully Restored');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');
    }

    /**
     * Update Product publish/unpublish
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

        $publish = Product::where('id', $id)->update(['active' => $active]);
        if ($publish) {
            return redirect()->back()->with('success', 'Product Successfully Updated');
        }
        return redirect()->back()->with('error', 'Something Went Wrong');
    }
}
