<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;

class DashboardController extends CrudController
{   
    public $data = [];

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index () {
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title

        return view('admin.dashboard', $this->data);
    }
}
