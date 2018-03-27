<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Timelog;

class WelcomeController extends Controller
{
    //

    public function index(Request $request){

        return view('welcome');

    }

    public function log($data){
    	if($data){
	    	$jsonResponse = json_decode($data);

	    	$member_id = $jsonResponse[0]->student_id;

	    	$isLoggedin = Timelog::where('is_logged_in','=',True)
	    					->where('member_id','=',$member_id)
	    					->get();
	    	;

	    	// dd($isLoggedin->count());

	    	if($isLoggedin->count() > 0){ 

	    		$this->callExitOn(1);

	    		Timelog::where('is_logged_in','=',True)
	    					->where('member_id','=',$member_id)
	    					->update([
	    						'is_logged_in' => False,
	    						'timeout' =>  now()	
	    						]);
	    		
		    	
	    	}
	    	else {

	    		// dd($isLoggedin);

	    		// $this->callEntranceOn(1);
	    		

				$log = new Timelog;

		    	$log->member_id = $member_id;
		    	$log->timein = now();
		    	$log->is_logged_in = True;

		    	$log->save();
                    
		    	$this->callEntranceOn(1);
	    		
	    	}
	    }

    }

    public function callEntranceOn($turnstile){
    	// $turnstile = 1;

    	$requestURL = "http://124.6.156.11/".$turnstile."/entrance/on";
    	
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $requestURL);
                // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                
                $response = curl_exec($ch);
                curl_close($ch);
              

              // dd($response);
    }

    public function callExitOn($turnstile){
    	// $turnstile = 1;

    	$requestURL = "http://124.6.156.11/".$turnstile."/exit/on";
    	
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $requestURL);
                // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
       
                
                $response = curl_exec($ch);
                curl_close($ch);
         

              // dd($response);
    }


    public function updateDB(){
    	$requestURL = "http://box104.datapacificcorp.com/Students.json.php?pw=p@$$1234";

    	$response = json_decode(file_get_contents($requestURL));
         
         // $profile = unserialize( $response );

        // dd($response);
        $fix = [];
        $mockRfid = 1;
        foreach ($response as $row) {
        	$normalize = [
        		'rfid' => $mockRfid,
        		'student_id' => $row->studentno,
        		'firstname' => $row->FirstName,
        		'middlename' => $row->MidName,
        		'lastname' => $row->LastName,
        		'image' => $row->IDPic
        	];

        	$mockRfid += 1;
        	// var_dump($row->FirstName);
        	array_push($fix, $normalize);
        }

        dd($fix);

    }

    public function makeJpg($url){
    	$url = "http://box104.datapacificcorp.com/CampusNet/pictures/011701404.jpg";
    	$im = @imagecreatefromjpeg($url);

	    /* See if it failed */
	    if(!$im)
	    {
	        /* Create a black image */
	        $im  = imagecreatetruecolor(150, 30);
	        $bgc = imagecolorallocate($im, 255, 255, 255);
	        $tc  = imagecolorallocate($im, 0, 0, 0);

	        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

	        /* Output an error message */
	        imagestring($im, 1, 5, 5, 'Error loading ' . $imgname, $tc);
	    }

	    return $im;
    }



    
}
