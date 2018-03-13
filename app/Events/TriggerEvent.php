<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Timelog;
use App\Models\Member;

class TriggerEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $rfid;
    public $turnstile;
    public $in;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($rfid,$turnstile,$in)
    {
        //
        // dd($in);
        $this->rfid = $rfid;
        $this->turnstile = $turnstile;
        $this->in = $in;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channelevent');
    }

    public function broadcastWith()
    {
        

        $member = Member::where('rfid', $this->rfid)->orderBy('id','desc')->first();

        // dd($member->timelog);
        $timelog = Timelog::with('members')->take(5)->where('rfid','!=',$this->rfid)->where('is_logged_in',1)->get();

        // dd($member);
        $is_logged_in = count($member->timelog) > 0 ? $member->timelog->is_logged_in : 0;

        $memberFixed = [];
        if(count($member) > 0){
            
                $arraymember = [
                    "id" => $member->id,
                    "rfid" => $member->rfid,
                    "member_id" => $member->member_id,
                    "firstname" => $member->firstname,
                    "middlename" => $member->middlename,
                    "lastname" => $member->lastname,
                    "department_id" => 1,
                    "status" => null,
                    "image" => $member->image,
                    "signature" => "",
                    "is_logged_in" => $is_logged_in,
                ];
                array_push($memberFixed, $arraymember);
            
        }
       
        if(!empty($timelog))
            foreach($timelog as $row) {
                 // dd($row->members[0]->rfid);
                $arraymembers = [
                    "id" => $row->id,
                    "rfid" => $row->members[0]->rfid,
                    "member_id" => $row->members[0]->member_id,
                    "firstname" => $row->members[0]->firstname,
                    "middlename" => $row->members[0]->middlename,
                    "lastname" => $row->members[0]->lastname,
                    "department_id" => 1,
                    "status" => null,
                    "image" => $member->image,
                    "signature" => "",
                    // "is_logged_in" => $members->timelog->is_logged_in,
                ];
                array_push($memberFixed, $arraymembers);
            }

        if($this->in == "1") {
            // dd("Helo timein");
            $this->login($this->rfid);    
        }
        
        if($this->in == "0") {

            $this->logout($this->rfid);    
        }
        
        

        // dd($memberFixed);
        return $memberFixed;
    }

    public function login($rfid){
        // var_dump($turnstile_no);
        
        $member = Member::where('rfid', $rfid)->first();

        // $timelog = Timelog::where('rfid',$rfid)->where('is_logged_in',1)->where('timein',now())->get();
        $is_logged_in = $member->timelog ? $member->timelog->is_logged_in : 0;
        if($is_logged_in == null){
            $timelog = new Timelog;

            $timelog->rfid = $member->rfid;
            $timelog->timein = now();
            $timelog->is_logged_in = True;
            // $timelog->turno

            $timelog->save();
        }
        
        
       
    }

    public function logout($rfid) {
        $member = Member::where('rfid', $rfid)->first();
        $id = Timelog::where('rfid',$rfid)->where('is_logged_in',1)->get();
    
        $timelog = Timelog::where('rfid',$rfid)->where('is_logged_in',1)->first();
        // dd($timelog);
        $is_logged_in = $timelog ? $timelog->is_logged_in : 0;

        // dd($is_logged_in);
        if($is_logged_in == 1){
            $timelog = Timelog::find($id[0]->id);

            $timelog->timeout = now();
            $timelog->is_logged_in = False;
            // $timelog->turno

            $timelog->update();

        }
        // dd($this->in);
    }
}
