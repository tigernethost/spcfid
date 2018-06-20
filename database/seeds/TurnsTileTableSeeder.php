<?php

use Illuminate\Database\Seeder;
use App\Models\TurnsTile;

class TurnsTileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			TurnsTile::firstOrCreate(
	    	[
	            'name'      	=>  'Turnstile1',
	            'username'      =>  'Admin',
	            'password'  	=>  bcrypt('$ecurit1'),
	            'description'	=> 'This is Turnstile1',
	            'ipaddress'		=> '200.10.10.111'
	    	]);    	
	    	TurnsTile::firstOrCreate([
	            'name'      	=>  'Turnstile2',
	            'username'      =>  'Admin',
	            'password'  	=>  bcrypt('$ecurit1'),
	            'description'	=> 'This is Turnstile2',
	            'ipaddress'		=> '200.10.10.112'
	    	]);
	    	TurnsTile::firstOrCreate([
	            'name'      	=>  'Turnstile3',
	            'username'      =>  'Admin',
	            'password'  	=>  bcrypt('$ecurit1'),
	            'description'	=> 'This is Turnstile3',
	            'ipaddress'		=> '200.10.10.113'
	    	]);
	    	TurnsTile::firstOrCreate([
	            'name'      	=>  'Turnstile4',
	            'username'      =>  'Admin',
	            'password'  	=>  bcrypt('$ecurit1'),
	            'description'	=> 'This is Turnstile4',
	            'ipaddress'		=> '200.10.10.114'
	    	]);
	    	TurnsTile::firstOrCreate([
	            'name'      	=>  'Turnstile5',
	            'username'      =>  'Admin',
	            'password'  	=>  bcrypt('$ecurit1'),
	            'description'	=> 'This is Turnstile5',
	            'ipaddress'		=> '200.10.10.115'
	    	]);
	    	TurnsTile::firstOrCreate([
	            'name'      	=>  'Turnstile6',
	            'username'      =>  'Admin',
	            'password'  	=>  bcrypt('$ecurit1'),
	            'description'	=> 'This is Turnstile6',
	            'ipaddress'		=> '200.10.10.116'
	    	]);    	
    }
}
