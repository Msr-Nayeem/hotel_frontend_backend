<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Student;
use App\Models\District;
use App\Models\City;
use App\Models\Area;
use App\Http\Controllers\CookieController;

class StudentController extends Controller
{
    
    public function dashboard(){
        return view('layouts.dash');
        
    }
    public function home(){
        $student = count(Student::where('utype', "admin")->get());
        $customer = count(Student::where('utype', "receptionist")->get());
        $guest = count(Student::where('utype', "user")->get());
        $info = ["total admin"=>$student, " total receptionist"=>$customer, "total guest"=> $guest];
        return view('pages.student.home', compact('info'));
    }
    public function booking(){
        
        $students = Student::select('id','name')->get();
        /* session()->put('log', $student->id); */
        return view('pages.customer.booking')->with('students', $students);
    }
    public function studentLogin(){ 
        return view('pages.student.loginn');
    }
    public function studentLoginCheck(Request $request){
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

        $student = Student::where('email', $email)->first();
        if($student){
            $student = Student::where('email', $email)
            ->where('password', $password)->first();
            if($student){
                $request->session()->put('id', $student->id);
                $request->session()->put('type', $student->utype);
                 if($request->session()->has('url')){
                     $url = $request->session()->get('url');
                     $request->session()->forget('url');
                     return redirect()->route($url);
                 }
                 return redirect()->route('home'); 
            }

            else{
                return redirect()->back()->withErrors(['Wrong Password !']);
            }
            
             
         }
         else{
              return redirect()->back()->withErrors(['User not found !']);
         } 
        
    }

    public function studentLogout(){
        session()->flush();
        return redirect()->route('loginn');
    }

    // ADD STUDENT
    public function createStudent(){
        $cities = City::select('city_name','id')->get();
        $data['cities'] = $cities;
        return view('pages.student.createNew', $data);
    }

    public function getDistrict(Request $request)
    {
        $district = District::where("belongs_city",$request->city_id)->get();
        
        if (count($district) > 0) {
            return response()->json($district);
        }
    }
    public function getArea(Request $request)
    {
        $area = Area::where("belongs_district",$request->district_id)->get();
        
        if (count($area) > 0) {
            return response()->json($area);
        }
    }
   

    public function createStudentSubmitted(Request $request){
       // $name = $request->name;
        // return $request;
        
        $validate = $request->validate([
            "name"=>"required",
            'dob'=>'required',
            'email'=>'required',
            'password'=>'required',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'city'=>'required|not_in:0',
            'district'=>'required|not_in:0',
            'area'=>'required|not_in:0'
            
        ],
         [
            'dob.required'=>"Select date of birth",
            'phone.required'=>"Phone Number needed",
            'password.required'=>"Password needed for login"
        
        ] 
         
        ); 
        
            $student = new Student();
            $student->utype = $request->utype;
            $student->name = $request->name;
            $student->email = $request->email;
            $student->password = $request->password;
            $student->phone = $request->phone;
            $student->dob = $request->dob;
            $student->country_id = $request->country;
            $student->city_id = $request->city;
            $student->district_id = $request->district;
            $student->area_id = $request->area; 
            $student->save();
    
            return redirect()->route('receptionistList');


    }
    // DONE ADDING


    // SHOW STUDENT
    public function studentList(Request $request){
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
            $student = Student::where("utype", "receptionist")->paginate(4);
        }
        else{
            $student = Student::where("utype", "receptionist")
            ->where("name",'LIKE', '%'.$request->search.'%')
            ->orWhere("email",'LIKE', '%'.$request->search.'%')
            ->orWhere("id",'LIKE', '%'.$request->search.'%')
            ->paginate(4);
        }
       
        return view('pages.student.studentList')->with('students', $student);
    }
    // DONE STUDENT LIST

    // EDIT STUDENT
    public function studentEdit(Request $request){
        
        $student = Student::where('id', $request->sid)->first();
        return view('pages.student.studentEdit')->with('student', $student);

    }
    public function studentEditSubmitted(Request $request){

         $validate = $request->validate([
             "name"=>"required|min:5",
             'dob'=>'required',
             'email'=>'email',
             'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/'
             
         ],
         [
             'name.required'=>"name here",
             'dob.required'=>"Select date of birth",
             'phone.required'=>"Phone Number"
         ]
         
         );
        
         $student = Student::where('id', $request->id)->first();
         $student->name = $request->name;
         $student->email = $request->email;
         $student->phone = $request->phone;
         $student->dob = $request->dob;
         $student->save(); 

         return redirect()->route('receptionistList'); 
        }
         // EDIT STUDENT DONE

        //Delete Student
        public function studentDelete(Request $request){
            $student = Student::where('id', $request->id)->first();
            $student->delete();
            return redirect()->route('receptionistList');
        }




        //Profile
        public function profile(){
            
            $student = Student::where('students.id', session()->get("id"))
            ->join('cities','cities.id', '=', 'students.city_id')
            ->join('districts','districts.id', '=', 'students.district_id')
            ->join('areas','areas.id', '=', 'students.area_id')
            ->first();
            return view('pages.student.profile')->with('student', $student);
    
        }
        public function details(Request $request){
            $student = Student::where('students.id', $request->id)
            ->join('cities','cities.id', '=', 'students.city_id')
            ->join('districts','districts.id', '=', 'students.district_id')
            ->join('areas','areas.id', '=', 'students.area_id')
            ->first();
            return view('pages.student.details')->with('student', $student);
    
        }

        public function profileEdit(Request $request){

            $student = Student::where('id', $request->sid)->first();
            return view('pages.student.profileEdit')->with('student', $student);
    
        }


        public function profileEditSubmitted(Request $request){
            
            
            $validate = $request->validate([
                "name"=>"required|min:5",
                'dob'=>'required',
                'email'=>'email',
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/'
            ],
            [
                'name.required'=>"name here",
                'dob.required'=>"Select date of birth",
                'phone.required'=>"Phone Number"
            ]
            
            );

            
           $student= Student::where('id',$request->id)->first();
            
            $student->name= $request->name;
            $student->email= $request->email;
            $student->phone= $request->phone;
            $student->dob= $request->dob;
            $student->save();
            return redirect()->route('profile'); 
           }




     public function changePassword(Request $request){
        $id = $request->id;
        $password = $request->password;
        $student = Student::where('id', $id)->first();
        $student->password = $request->password;
        $student->save();

        return redirect()->back()->with('passChanged','Password Changed Seccessfully');

    }


    //API
    public function APIList(){
        return Student :: select('name','id')->get();
    }

    public function APIpost(Request $req){
        /* $student = new Student();
        $student->name = $req->name;
        $student->price = $req->price;
        $student->image = $req->image;
        $student->save(); */
        return $req;
    }
    public function  apiLogin(Request $req){

        $user = Student::where('email',$req->email)->where('password',$req->password)->first();
        
        if($user){
            return $user;
        }
        return null;

    }
           
}
 