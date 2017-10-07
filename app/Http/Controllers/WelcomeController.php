<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class WelcomeController extends Controller
{
    //

    public function index(Request $request){

    	if($request->input()){
    		// dd($request->input());
    		$rfid = $request->input('rfid');
    	}
    	else {
    		$rfid = 00001;
    	}

    	
	    	$member = Member::where('rfid','=',$rfid)->get();

	    	$data["member"] = $member;

	    	return view('welcome',$data);

    }

    public function checkRfid($rfid){
    	$member = Member::where('rfid','=',$rfid)->get();


    	$data["member"] = $member;

    	// dd($data);

    	return view('welcome',$data);
    }

    
}
