<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;

class APIController extends CrudController
{
    public function getAllUsers () {
    	
    	// $contents = \SSH::into('turnstile')->getGateway();

    	// \SSH::into('turnstile')->run([
    	// 	// 'ls -l -a',
    	// 	'ping 200.10.10.111',
    	// ], function ($line) {
    	// 	dd($line);
    	// });

    	if(\Auth::check()) {
	    	$employees = \DB::table('employees')->select('id', 'member_id', 'firstname', 'middlename', 'lastname','extname', 'department_id');
	    	$employees->addSelect(\DB::raw("'employee' as user_type"));

	    	$students = \DB::table('students')->select('id', 'member_id', 'firstname', 'middlename', 'lastname', 'extname', 'department_id');
	    	$students->addSelect(\DB::raw("'student' as user_type"));

	    	$users = $employees->unionAll($students)->get();

	    	return \Response::json($users);
    	}

		// $contents = \SSH::run('turnstile3')->getGateway();
		// dd($contents);
    }
}
