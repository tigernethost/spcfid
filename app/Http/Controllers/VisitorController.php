<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
class VisitorController extends Controller
{
    
    public function storeVisitor(Request $request)
    {
        // dd($request);
        $uniqid = uniqid();
        $image = base64_decode($request->image_file);
        $image_name = $request->rfid . "-" . $uniqid . ".jpg";
        $path = public_path() . "/images/visitor/" . $image_name;

        $member = new Member;
        $member->rfid = $request->rfid;
        $member->firstname = $request->firstname;
        $member->lastname = $request->lastname;
        $member->department_id = $request->department_id;
        $member->image = $image_name;
        $member->save();
        file_put_contents($path, $image);
    }    
}
