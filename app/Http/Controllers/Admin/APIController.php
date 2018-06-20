<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;

class APIController extends CrudController
{
    public function getAllUsers () {

    	if(\Auth::check()) {
	    	$employees = \DB::table('employees')
	    		->select( \DB::raw(" id, member_id, firstname, middlename, lastname, extname, department_id,  'employee' as user_type ") );

	    	$visitors = \DB::table('visitors')
	    		->select( \DB::raw(" id, null, firstname, null, lastname, null, department_id, 'visitor' as user_type ") );

	    	$students = \DB::table('students')
	    		->select(\DB::raw(" id, member_id, firstname, middlename, lastname, extname, department_id,  'student' as user_type ") );

	    	$users = $employees->unionAll($students)->unionAll($visitors)->get();

	    	return \Response::json($users);
    	}

    }
}
