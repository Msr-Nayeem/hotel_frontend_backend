<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Receiptionist;
use App\Models\Token;

use DateTime;

class APILoginController extends Controller
{

    public function  login(Request $req){
        if($admin= Admin::where('email',$req->email)->first()){
            if($admin->password == $req->password){
                if($admin->status == "active"){
                    $tkn = $this->getToken("aD");
                    return  $this->setToken($tkn, $admin->id);
                }
                else{
                    return "block";
                }
            }
            else{
                return "error";
            }
            
        }
        else if($receiptionist= Receiptionist::where('email',$req->email)->first()){
            if($receiptionist->password == $req->password){
                if($receiptionist->status == "active"){
                    $tkn = $this->getToken("rE");
                    return  $this->setToken($tkn, $receiptionist->id);
                }
                else{
                    return "block";
                }
            }
            else{
                return "error";
            }
            
        }
        else if($customer= Customer::where('email',$req->email)->first()){
            if($customer->password == $req->password){
                if($customer->status == "active"){
                    $tkn = $this->getToken("cU");
                    return  $this->setToken($tkn, $customer->id);
                }
                else{
                    return "block";
                }
            }
            else{
                return "error";
            }
            
        }
        else{
            return "not found";
        }
        
    }
   
    
    
    //Logout
    
    public function  logout(Request $req){
    
        $token = Token::where('token_no',$req->token_no)->first();
        if($token){
            $token->logout_at =new DateTime();
            $token->save();
            return "done";
        }
        else{
            return "done";
        }
    
    }
    public function getToken($mid){
        $tkn = Str::random(30);
        $pre = substr($tkn, 0, 15);
        $post = substr($tkn, 15, 29);
        $token_no = $pre . $mid .$post;
        return $token_no;
    }
    public function setToken($token_no, $id){
        $token = new Token();
        $token->user_id = $id;
        $token->token_no = $token_no;
        $token->login_at = new DateTime();
        $token->save();  
        if($token){
            return $token->token_no;
        }
        else{
            return "error";
        }
    }

}
