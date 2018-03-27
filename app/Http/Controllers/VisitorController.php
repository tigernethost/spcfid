<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class VisitorController extends Controller
{
    
    public function storeVisitor(Request $request)
    {
        
        $image = $request->image_file;
        $image = 'data:image/jpeg;base64,' . $image;
       
        $check = Member::where('rfid',$request->rfid)->get();
        if(count($check) < 1){
            $member = new Member;

            $member->rfid = $request->rfid;
            $member->member_id = 'Visitor';
            $member->firstname = $request->firstname;
            $member->lastname = $request->lastname;
            $member->department_id = $request->department_id;
            $member->image = $image;
            $member->save();

            Redis::set(ltrim($request->rfid, '0'),'is_out');

        }else {
            return redirect("/")->withErrors(['RFID IS USED!','Error Saving.']);
        }



        return redirect("/");
        
    }    
}
