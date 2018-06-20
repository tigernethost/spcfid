<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;
use App\Models\TurnsTile;

class DashboardController extends CrudController
{   
    public $data = [];

    public function __construct()
    {
        $this->middleware('admin');

    }

    public function index () {
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['turnstiles'] = TurnsTile::get();

        return view('admin.dashboard', $this->data);
    }
}
