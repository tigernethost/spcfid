<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class PrivateMessage extends Model
{
    //

    protected $fillable = ['sender_id', 'receiver_id','message','read'];

    protected $appends = ['sender', 'receiver'];


    public function getSenderAttribute($value) {

    	return User::where('id', $this->sender_id)->first();
    }
}
