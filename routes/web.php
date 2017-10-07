<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/', 'WelcomeController@index');
Route::get('/', 'WelcomeController@index');
// Route::post('/', 'WelcomeController@validateRfid');


Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['admin'],
    'namespace' => 'Admin'
], function() {
    // your CRUD resources and other admin routes here
    CRUD::resource('member', 'MemberCrudController');
    CRUD::resource('department', 'DepartmentCrudController');
    Route::get('jsonreturn', "MemberCrudController@jsonreturn");
});

