<?php
namespace App\Http\Controllers;

use DatePeriod;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Admin;
use DateTime;

class LoginAPIController extends Controller
{

//Registration
    public function apiRegistration(Request $req){
        $admin = new Admin();
        $admin->name = $req->name;
        $admin->email = $req->email;
        $admin->phone = $req->phone;
        $admin->password = $req->password;
        $admin->dob = $req->dob;
        $admin->save(); 

        return "Registration success. Now back to Login";
    }
//    
 


//Practice
    public function APIpost(Request $req){
        $student = new Admin();
        $student->name = $req->name;
        $student->email = $req->email;
        $student->phone = $req->phone;
        $student->password = $req->password;
        $student->dob = new DateTime();
        $student->save();  
        


        return "Registration success"; 
    }

    public function APIList(){
        
        return Admin :: select('name','main_id', 'email')->get();
    }
    

}