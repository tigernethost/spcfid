<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use File;
use Response;

class JsonReaderController extends Controller
{
    //

    public function make_json(){
    	$member = Member::all();

    	$arrayMember = [];

    	foreach($member as $row){
    		$raw = [
    			'rfid' => $row->rfid    
    		];
    		array_push($arrayMember, $raw);
    	}
    	$arrayMember = json_encode($arrayMember);
    	$filename = 'main.json';
    	File::put(public_path('/uploads/json/'.$filename),$arrayMember);
    	return "Success";
    }


}
