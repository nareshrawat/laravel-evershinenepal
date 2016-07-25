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