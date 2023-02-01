<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Cetegory;

class APIRoomController extends Controller
{

    public function getRooms(Request $req){
        $freeRoom = Room::select('id','rent_per_day', 'cetegory')->where('cetegory', $req->inCetegory)->where('booked_for', null)
        ->get();
        return $freeRoom;  
    }
    public function getRent(Request $req){
        $rent = Room::select('rent_per_day')->where('id', $req->roomID)->first();
        return $rent->rent_per_day;
     
    }
    public function getCetegory(){
            $ctgry = Cetegory::get();
            return $ctgry;
     
    }

   
    public function makeBooking(Request $req){
        $roomm = Room::where('id', $req->room_id)->first();
        $roomm->booked_for = $req->customer_id;
        $roomm->status = "booked";
        $roomm->save();
       
        if($roomm){
            return "done";
        }
        else{
            return "error";
        }         
    }
    public function cancelBooking(Request $req){
        $roomm = Room::where('id', $req->id)->first();
        $roomm->booked_for = null;
        $roomm->status = "available";
        $roomm->save();
        return Room :: get();
    }

    public function roomList(Request $req){
        
        if(!empty($req->searchh)){
            $roomm = Room::where('cetegory','LIKE', '%' .$req->searchh.'%')
            ->orWhere('status','LIKE', '%' .$req->searchh.'%')
            ->orWhere('rent_per_day','LIKE', '%' .$req->searchh.'%')
            ->get();
            return $roomm;
            
        }
        else{
            return Room :: get();  
        }
        
    }


        public function addRoom(Request $req){
            $room = new Room();
            $room->cetegory = $req->cetegory;
            $room->rent_per_day = $req->rent;
            $room->save();
            if($room){
                return "success";
            }
            else{
                return "error";
            }
        }

        public function deleteRoom(Request $req){
            $roomm = Room::where('id', $req->id)->first();
            $roomm->delete();
    
            return Room :: get();
        }
}
