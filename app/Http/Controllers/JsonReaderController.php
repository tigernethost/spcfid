<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use File;
use Response;

class JsonReaderController extends Controller
{
    //
// {"is_in":"0","is_visitor":"0","is_admin":"0","is_allowed":"1","time_in":"05:00:00","time_out":"18:00:00"}

    public function make_json(){
    	$member = Member::all();

    	$arrayMember = [];

    	foreach($member as $row){
    		$raw = [
    			'rfid' => $row->rfid,
                'is_in' => "0",
                'is_visitor' => "0",
                'is_admin' => "0",
                'is_allowed' => "1",
                'time_in' => "5:00:00",
                'time_out' => "22:00:00",
    		];
    		array_push($arrayMember, $raw);
    	}
    	$arrayMember = json_encode($arrayMember);
    	$filename = 'main.json';
    	File::put(public_path('/uploads/json/'.$filename),$arrayMember);
    	return "Success";
    }


}
