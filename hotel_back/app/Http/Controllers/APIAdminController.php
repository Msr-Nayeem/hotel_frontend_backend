<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Admin;

class APIAdminController extends Controller
{

    public function registration(Request $req){
        $admin = new Admin();
        $admin->name = $req->name;
        $admin->email = $req->email;
        $admin->phone = $req->phone;
        $admin->password = $req->password;
        $admin->dob = $req->dob;
        $admin->division = $req->division;
        $admin->district = $req->district;
        $admin->upazila = $req->upazila;
        $admin->save();
        if($admin){
            return "success";
        } 
        else{
            return "error";
        }

        
    }
}
