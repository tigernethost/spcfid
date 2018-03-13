<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Models\Member;
use Carbon\Carbon;


class Timelog extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    //protected $table = 'timelogs';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['rfid','timein','timeout','turnstile','is_logged_in'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function members(){
        return $this->hasMany('App\Models\Member','rfid','rfid');
    }


    public function getFirstnameAttribute(){
        $member = Member::where('rfid',$this->rfid)->first();
        // dd($member);
        return $member['firstname'];
    }

    public function getLastnameAttribute(){
        $member = Member::where('rfid',$this->rfid)->first();
        // dd($member);
        return $member['lastname'];
    }

    public function getDateAttribute(){
        return $this->created_at->format('m-d-Y');
    }

    public function getCreatedAttribute(){
        return $this->created_at->format('m-d-Y');
    }

    public function getDepartmentIdAttribute(){
        $member = Member::where('rfid',$this->rfid)->first();
        return $member['department_id'];
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
