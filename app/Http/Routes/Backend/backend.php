<?php
//Dashboard
Route::get('/', 'DashboardController@getDashboard')->name('dashboard');

/**
 * Pages
 */
Route::get('pages/trash', 'PageController@getTrash')->name('dashboard.pages.trash');
Route::put('pages/{pages}/restore', 'PageController@restorePage')->name('dashboard.pages.restore');
Route::delete('pages/forcetrash/{pages}', 'PageController@forceDelete')->name('dashboard.pages.forcetrash');
Route::get('pages/generatepdf', 'PageController@generatepdf')->name('dashboard.pages.generatepdf');
Route::put('pages/{pages}/updatepublish', 'PageController@updatepublish')->name('dashboard.pages.updatepublish');
Route::resource('pages', 'PageController');

/**
* Products
*/
Route::get('products/trash', 'ProductController@getTrash')->name('dashboard.products.trash');
Route::put('products/{products}/restore', 'ProductController@restoreProduct')->name('dashboard.products.restore');
Route::delete('products/forcetrash/{products}', 'ProductController@forceDelete')->name('dashboard.products.forcetrash');
Route::get('products/generatepdf', 'ProductController@generatepdf')->name('dashboard.products.generatepdf');
Route::put('products/{products}/updatepublish', 'ProductController@updatepublish')->name('dashboard.products.updatepublish');
Route::resource('products', 'ProductController');

/**
* Products Category
*/
Route::get('productcategories/trash', 'ProductCategoryController@getTrash')->name('dashboard.productcategories.trash');
Route::put('productcategories/{productcategories}/restore', 'ProductCategoryController@restoreProductCategory')->name('dashboard.productcategories.restore');
Route::delete('productcategories/forcetrash/{productcategories}', 'ProductCategoryController@forceDelete')->name('dashboard.productcategories.forcetrash');
Route::get('productcategories/generatepdf', 'ProductCategoryController@generatepdf')->name('dashboard.productcategories.generatepdf');
Route::put('productcategories/{productcategories}/updatepublish', 'ProductCategoryController@updatepublish')->name('dashboard.productcategories.updatepublish');
Route::resource('productcategories', 'ProductCategoryController');
