<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use DateTime;
use App\Models\Room;



class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(empty($request->search)){
            $room_datas = Room::paginate(5);
        }
        else{
            $room_datas = Room::where("cetegory",'LIKE', '%'.$request->search.'%')
            ->orWhere("status",'LIKE', '%'.$request->search.'%')
            ->orWhere("id",'LIKE', '%'.$request->search.'%')
            ->orWhere("rent_per_day",'LIKE', '%'.$request->search.'%')
            ->paginate(4);
        }
        
        return view('pages.customer.room', compact('room_datas'));
    }
    public function ApiList(){
        return Student::all();
    }
    public function getRoom(Request $request)
    {
        $room = Room :: where('cetegory', $request->cetegory)
        ->where('status', "available") 
        ->get();
        $total = count($room);
        if (count($room) > 0) {
            return response()->json($room);
        }
        
    }
    public function getRent(Request $request)
    {
        $rent = Room :: select('rent_per_day')
        ->where('id', $request->id)->get();
        
        return response()->json($rent);
        
    }
    public function makeAvailable(Request $request)
    {
        $room = Room :: where('id', $request->id)->first();
        $room->status = "available";
        $room->booked_for= NULL;
        $room->save();
        
        return redirect()->back()->withErrors(['Available Now!']);
        
    }

    public function newRoom()
    {
        return view('pages.customer.addRoom');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        
        $room = new Room();
        $room->cetegory = $request->cetegory;
        $room->rent_per_day = $request->rent;
        $room->save(); 
        return redirect()->back()->withErrors(['Room listed !']);
    }
    public function bookings(Request $request)
    {
        
        $validate = $request->validate([
            "customer_id" => "required|not_in:0",
            "room_id" => "required|not_in:0",
            "period" => "required",
            "cetegory" => "required|not_in:0",
            "rent_text" => "required|"

            
        ]
        ); 

         $room = Room::where('id', $request->room_id)->first();
         $room->status = "booked";
         $room->booked_for = $request->customer_id;
         $room->save();
         return redirect()->back()->withErrors(['Bookings Done !']);
    }

    public function guestList(Request $request){
        /* $student = array();
        for($i=1; $i<=10; $i++){
            $student = array(
                "name"=>"Student ".($i),
                "id"=>"sid".($i),
                "dob"=>"2000-".($i)."-01"
            );
            $students[] = (object)$student;
        } */

        if(empty($request->search)){
            $guest = Student::where("utype", "user")->paginate(4);
        }
        else{
            $guest = Student::where("utype", "user")
            ->where("name",'LIKE', '%'.$request->search.'%')
            ->orWhere("email",'LIKE', '%'.$request->search.'%')
            ->orWhere("id",'LIKE', '%'.$request->search.'%')
            ->paginate(4);
        }
        
        return view('pages.customer.guestList')->with('guest', $guest);
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
