<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ourteam{
    var $namee;
    var $address;
    function __construct($name,$address)
    {
        $this->namee=$name; 
        $this->address=$address;       
    }
}

class PagesController extends Controller
{
    
    public function profile()
    {
        $name = "Nayeem";
        $id = "18-38037-2";
        $info = array("Msr ", "Dinajpur");
        return view('profile')
        ->with('name', $name)
        ->with('id', $id)
        ->with('info', $info);
    }
    
    public function home(){
        $name="nayeem";
        $id="18-38037-2";
        $dept="cse";
        return view('home',[
            "name"=>$name,
            "id"=>$id,
            "dept"=>$dept
        ]);
    }
    public function contact(){
        $info = ["name"=>"nayeem", "Phone no"=>"+880177*******", "email"=>"msrn@gmail.com", "address"=>"dhaka"];
        return view('contact')
        ->with("info", $info);
    }
    public function service(){
        $Services = array("Web application", "Desktop application", "Portfolio", "Financial application");
        return view('service')->with('services', $Services);
    }
    public function about(){

        return view('about');
    }
    public function ourteam(){
        $tm1= new ourteam("nayeem","dinajpur");
        $tm2= new ourteam("msr", "dhaka");
        $tm3= new ourteam("shahidur", "dinajpur");
        $teams= array($tm1, $tm2, $tm3);
        return view('ourteam')
        ->with('teams', $teams);
    }

    public function basicHome(){
        return view('basicHome');
    }
}
