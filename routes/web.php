<?php
use App\Events\TriggerEvent;
// use App\Illuminate\Http
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
Route::get('/updateNow', 'WelcomeController@updateDB');


Route::get('chat', function(){
	return view('chat');
});

Route::get('alertbox', function () {
	return view('chat');
});

Route::get('jsonmember', 'JsonReaderController@make_json');

Route::get('trigger', function(){
	$rfid = request('rfid');
	$turnstile = request('turnstile');
	$in = request('in');

	if($rfid){
		event(new TriggerEvent($rfid,$turnstile,$in));
	}
	
});

Route::get('jsonreturn', "MemberCrudController@jsonreturn");
// Route::post('/', 'WelcomeController@validateRfid');


Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['admin'],
    'namespace' => 'Admin'
], function() {
	Route::get('ajax-department-options', 'TimelogCrudController@departmentOptions');
    // your CRUD resources and other admin routes here
    CRUD::resource('member', 'MemberCrudController');
    CRUD::resource('department', 'DepartmentCrudController');
    
    CRUD::resource('timelog', 'TimelogCrudController');
});

