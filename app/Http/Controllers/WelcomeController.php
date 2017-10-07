<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Timelog;

class WelcomeController extends Controller
{
    //

    public function index(Request $request){

    	if($request->input()){
    		// dd($request->input());
    		$rfid = $request->input('rfid');
    		
    	
    

    	
	    	$member = Member::where('rfid','=',$rfid)->get();

	    	$data["member"] = $member;

	    
	    	$this->log($data["member"]);

	    	return view('welcome',$data);

	    }else {

	    	$member = Member::where('rfid','=',00001)->get();

	    	$data["member"] = $member;

	    	return view('welcome',$data);
	    }

    }

    public function log($data){
    	$jsonResponse = json_decode($data);

    	$member_id = $jsonResponse[0]->student_id;

    	$isLoggedin = Timelog::where('is_logged_in','=',True)
    					->where('member_id','=',$member_id)
    					->get();
    	;

    	// dd($isLoggedin->count());

    	if($isLoggedin->count() > 0){ 
    		Timelog::where('is_logged_in','=',True)
    					->where('member_id','=',$member_id)
    					->update([
    						'is_logged_in' => False,
    						'timeout' =>  now()	
    						]);

	    	
    	}
    	else {

    		// dd($isLoggedin);
			$log = new Timelog;

	    	$log->member_id = $member_id;
	    	$log->timein = now();
	    	$log->is_logged_in = True;

	    	$log->save();
    		
    	}

    }

    
}
