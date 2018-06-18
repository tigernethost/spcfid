<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;

class APIController extends Controller
{
    public function getAllUsers () {

    	$employees = \DB::table('employees')->select('id', 'member_id', 'firstname', 'middlename', 'lastname','extname', 'department_id');
    	$employees->addSelect(\DB::raw("'employee' as user_type"));

    	$students = \DB::table('students')->select('id', 'member_id', 'firstname', 'middlename', 'lastname', 'extname', 'department_id');
    	$students->addSelect(\DB::raw("'student' as user_type"));

    	$users = $employees->unionAll($students)->get();

    	return \Response::json($users);
    }
}
