<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Token;
use App\Models\Customer;
use App\Models\Receiptionist;

class APIInfoController extends Controller
{
    public function profile(Request $req)
    {
        $table_name = $this->checkType($req->user_token);
        $user = Token::where('token_no', $req->user_token)->first();

        $res = DB::table($table_name)
            ->select('id','name', 'email', 'phone', 'dob', 'division', 'district', 'upazila')
            ->where('id', $user->user_id)->first();
        return $res;

        /*
        $profile = Admin::where('admins.id', $userId)
        ->join('cities', 'cities.id', '=', 'admins.city_id')
        ->join('districts', 'districts.id', '=', 'admins.district_id')
        ->join('areas', 'areas.id', '=', 'admins.area_id')->first();
        
        return $profile; */
    }

    public function checkType($token)
    {

        $check = substr($token, 15, 2);
        if ($check == "aD") {
            return "admins";
        } else if ($check == "cU") {
            return "customers";
        } else {
            return "receiptionists";
        }

    }
    public function getType(Request $req)
    {

        $check = substr($req->user_token, 15, 2);
        if ($check == "aD") {
            return "admin";
        } else if ($check == "cU") {
            return "customer";
        } else {
            return "receiptionist";
        }


    }

    public function getDetails(Request $req)
    {
        /*        
        $profile = Admin::where('admins.id', $req->user_id)->first();
        return $profile;
        */
        $res = DB::table($req->table)
            ->select('name', 'email', 'phone', 'dob', 'division', 'district', 'upazila')
            ->where('id', $req->user_id)->first();
        return $res;

    }

    public function getDivisions()
    {
        $res = DB::table("divisions")->get();
        return $res;
    }
    public function getDistricts(Request $req)
    {
        $res = DB::table("districts")->where("division_id", $req->belongs)->get();
        return $res;
    }
    public function getUpazilas(Request $req)
    {
        $res = DB::table("upazilas")->where("district_id", $req->belongs)->get();
        return $res;
    }

    public function changeStatus(Request $req)
    {
        $res = DB::table($req->table)->where("id", $req->idd)->first();
        if ($res && $res->status == "active") {
            $affected = DB::table($req->table)
                ->where('id', $req->idd)
                ->update(['status' => "block"]);
            if ($affected) {
                return DB::table($req->table)->select('id', 'name', 'email', 'phone', 'status')->get();
            } else {
                return "error";
            }
        } else if ($res && $res->status == "block") {
            $affected = DB::table($req->table)
                ->where('id', $req->idd)
                ->update(['status' => "active"]);
            if ($affected) {
                return DB::table($req->table)->select('id', 'name', 'email', 'phone', 'status')->get();
            } else {
                return "error";
            }
        } else {
            return "error";
        }
    }

    public function viewList(Request $req)
    {

        if (!empty($req->searchh)) {
            $customer = DB::table($req->table)->select('id', 'name', 'email', 'phone', 'status')
                ->Where('id', $req->searchh)
                ->orWhere('name', 'LIKE', '%' . $req->searchh . '%')
                ->orWhere('email', 'LIKE', '%' . $req->searchh . '%')
                ->get();
            return $customer;
        } else {
            return DB::table($req->table)->select('id', 'name', 'email', 'phone', 'status')->get();
        }

    }

    public function deleteUser(Request $req)
    {
        $res = DB::table($req->table)->where('id', $req->idd)->delete();
        if ($res) {
            return DB::table($req->table)->select('id', 'name', 'email', 'phone', 'status')->get();
        } else {
            return "error";
        }
    }
    //UPDATE
    public function userUpdate(Request $req)
    {
        $affected = DB::table($req->table)
            ->where('id', $req->user_id)
            ->update(['name' => $req->Name, 'email' => $req->Email, 'phone' => $req->Phone, 'dob' => $req->DOB]);
        if ($affected) {
            return "done";
        } else {
            return "error";
        }
    }

    public function changePassword(Request $req)
    {

        if ($req->table == "Admin") {
            $profile = Admin::where('email', $req->email)
                ->where('password', $req->current)
                ->first();
            if ($profile) {
                $profile->password = $req->newP;
                $profile->save();
                if ($profile) {
                    return "changed";
                } else {
                    return "failed";
                }
            } else {
                return "not matched";
            }
            

        } 
        else if ($req->table == "Customer") {
            $profile = Customer::where('email', $req->email)
                ->where('password', $req->current)
                ->first();
            if ($profile) {
                $profile->password = $req->newP;
                $profile->save();
                if ($profile) {
                    return "changed";
                } else {
                    return "failed";
                }
            } else {
                return "not matched";
            }
        } 
        else 
        {
            $profile = Receiptionist::where('email', $req->email)
                ->where('password', $req->current)
                ->first();
            if ($profile) {
                $profile->password = $req->newP;
                $profile->save();
                if ($profile) {
                    return "changed";
                } else {
                    return "failed";
                }
            } else {
                return "not matched";
            }
        }
    }

}