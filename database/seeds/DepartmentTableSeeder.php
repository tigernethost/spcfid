<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::firstOrCreate([
            'description'      =>  'Elementary Department',
            'starttime'  =>  '06:00:00',
            'endtime'  =>  '17:30:00'
        ]

        );
    }
}
