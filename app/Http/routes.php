<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

/**
 * Frontend Routes
 */
Route::group(['namespace' => 'Frontend'], function () {

    require app_path('/Http/Routes/Frontend/frontend.php');

});

/**
 * Member Routes
 */

Route::group(['namespace' => 'Frontend\Member', 'middleware' => 'auth'], function () {
    require app_path('/Http/Routes/Frontend/Member/member.php');
});

/**
 * Dashboard Routes
 */
Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleware' => ['role:administrator|manager']], function () {

    require app_path('/Http/Routes/Backend/backend.php');

});