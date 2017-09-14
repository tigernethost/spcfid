<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name'      =>  'Admin',
            'email'  =>  'admin@spcf-id.com',
            'password'  =>  bcrypt('admin1234')
        ]);
    }
}
