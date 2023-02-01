<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Models\Admin;
use App\Http\Controllers\CookieController;

class LoginController extends Controller
{
    public function login(){ 
        return view('pages.admin.login');
    }
    public function loginCheck(Request $request){
        $email = $request->email;
        $p = $request->password;
        $password = $request->password;

        if( $request->input('remember') == 'remember'){
            cookie()->queue(cookie(name: 'email', value: $email, minutes: 60*7*24));
            cookie()->queue(cookie(name: 'password', value: $p, minutes: 60*7*24));    
        }
        else{
            cookie()->queue(cookie(name: 'email', value: '', minutes: -3600));
            cookie()->queue(cookie(name: 'password', value: '', minutes: -3600));  
        }

        $student = Admin::where('email', $email)->first();
        if($student){
            $student = Admin::where('email', $email)
            ->where('password', $password)->first();
            if($student){
                $request->session()->put('id', $student->id);
                 if($request->session()->has('url')){
                     $url = $request->session()->get('url');
                     $request->session()->forget('url');
                     return redirect()->route($url);
                 }
                 return redirect()->route('dashboard'); 
            }

            else{
                return redirect()->back()->withErrors(['Wrong Password !']);
            }
            
             
         }
         else{
              return redirect()->back()->withErrors(['User not found !']);
         } 
        
    }
    public function logout(){
        session()->flush();
        return redirect()->route('login');
    }
}
