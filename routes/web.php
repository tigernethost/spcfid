<?php
use App\Events\TriggerEvent;
use App\Events\CounterEvent;
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

Route::get('/', 'WelcomeController@index');
Route::post('/', 'WelcomeController@index');
Route::get('/updateNow', 'WelcomeController@updateDB');


Route::get('chat', function(){
	return view('chat');
});

Route::get('alertbox', function () {
	return view('chat');
});

Route::get('counterbox', function () {
	return view('counter');
});
Route::get('counter-client', function () {
	return view('counter-client');
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

Route::get('counter-event', function(){

	$counter = request("counter");

	if($counter){
		event(new CounterEvent($counter));

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
    CRUD::resource('counter', 'CounterCrudController');
    
    CRUD::resource('timelog', 'TimelogCrudController');
    CRUD::resource('counter_log', 'Counter_logCrudController');
    CRUD::resource('visitor', 'VisitorCrudController');
    CRUD::resource('employee', 'EmployeeCrudController');
    CRUD::resource('student', 'StudentCrudController');
});
	Route::post('visitor', 'VisitorController@storeVisitor');

