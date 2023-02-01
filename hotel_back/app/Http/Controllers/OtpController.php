<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Otp;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOtpRequest;
use App\Http\Requests\UpdateOtpRequest;

use Illuminate\Support\Str;
use DateTime;
class OtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//Send OTP
    public function sendOtp(Request $req){
        $valid = Admin::where('email', $req->email)->first();
        if($valid){
            $otp_no =  rand(100001,999999);
            $token_no = Str::random(32);
            $params = ["name" => $valid->name, "otp" => $otp_no, "token_no" => $token_no];
            $otp = new Otp();
            $otp->user_email = $req->email;
            $otp->otp_no = $otp_no;
            $otp->token_no = $token_no;
            $otp->updated_at = null;
            $otp->save();
            if($otp){
                return $params;
            }
            else{
                return "Failed to generate otp";
            }
            
        }
        else{
            return "not valid";
        }
        
    }

//MATCH OTP
    public function matchOtp(Request $req){
        $valid = Otp::where('otp_no',$req->otp_no)->where('token_no',$req->token_no)->where('updated_at', null)->first();
        if($valid){
            $valid->updated_at = new DateTime();
            $valid->save();
            return $valid->user_email;
        }
        else{
            return "wrong otp";
        }
    }

//Reset PASSWORD
    public function resetPassword(Request $req){
        $affected = DB::table('admins')
              ->where('email', $req->email)
              ->update(['password' => $req->pass]);
        if($affected){
            return "done";
        }
        else{
            return "failed";
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOtpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOtpRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Otp  $otp
     * @return \Illuminate\Http\Response
     */
    public function show(Otp $otp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Otp  $otp
     * @return \Illuminate\Http\Response
     */
    public function edit(Otp $otp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOtpRequest  $request
     * @param  \App\Models\Otp  $otp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOtpRequest $request, Otp $otp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Otp  $otp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Otp $otp)
    {
        //
    }
}
