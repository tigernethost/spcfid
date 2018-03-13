<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TimelogRequest as StoreRequest;
use App\Http\Requests\TimelogRequest as UpdateRequest;
use App\Models\Department;



class TimelogCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Timelog');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/timelog');
        $this->crud->setEntityNameStrings('timelog', 'timelogs');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        $this->crud->removeAllButtons();

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name' => 'firstname',
            'Label' => 'First Name'
        ]);
        //  $this->crud->addColumn([
        //     'name' => 'department_id',
        //     'Label' => 'Department ID'
        // ]);

        $this->crud->addColumn([
            'name' => 'lastname',
            'Label' => 'Last Name'
        ]);

        $this->crud->addColumn([
            'name' => 'date',
            'Label' => 'Date'
        ]);

        $this->crud->addFilter([ // daterange filter
           'type' => 'date_range',
           'name' => 'from_to',
           'label'=> 'Date Filtering'
         ],
         false,
         function($value) { // if the filter is active, apply these constraints
           $dates = json_decode($value);
           $from = $dates->from." 00:00:00";
           $to = $dates->to." 59:59:59";

           // $from = date_format($from,"Y-m-d H:i:s");
           // $to = date_format($to,"Y-m-d H:i:s");
           

           $this->crud->addClause('where', 'created_at', '>=', $from);
           $this->crud->addClause('where', 'created_at', '<=', $to);
         });

        // $this->crud->addFilter([ // select2 filter
        //   'name' => 'department_id',
        //   'type' => 'select2',
        //   'label'=> 'Department'
        // ],function(){
        //     return Department::all()->pluck('description', 'id')->toArray();
        // }
        // ,
        // function($value) { // if the filter is active
        //     $this->crud->addClause('where', 'department_id', $value);
        // })
        // ;

        // $this->crud->addFilter([ // date filter
        //   'type' => 'date',
        //   'name' => 'created',
        //   'label'=> 'Date'
        // ],
        // false,
        // function($value) { // if the filter is active, apply these constraints
        //     $value = date('m-d-Y', strtotime($value));
        //     // dd($value);
        //   $this->crud->addClause('where', 'created_at', '=', $value);
        // });
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        $this->crud->removeColumn('is_logged_in'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        $this->crud->denyAccess(['create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        $this->crud->enableExportButtons();

        $this->crud->addFilter([ // select2_multiple filter
          'name' => 'department_id',
          'type' => 'select2_multiple',
          'label'=> 'Department'
        ], function() { // the options that show up in the select2
            return Department::all()->pluck('description', 'id')->toArray();
        }, function($values) { // if the filter is active
            // dd($values);
            foreach (json_decode($values) as $key => $value) {

                $this->crud->query = $this->crud->query->whereHas('department', function ($query) use ($value) {
                    $query->where('department_id', $value);
                });
            }
        });

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'departments', function($query) {
        //     dd($query);
        //     // $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function departmentOptions(){
        
        $options = Department::get();
        return $options->pluck('description', 'id');
    }
}
