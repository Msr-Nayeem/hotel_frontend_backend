<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Customer;


class APICustomerController extends Controller
{

    public function getCustomer(){
 
        $customer = Customer::select('id', 'name','email')->where('status', 'active')->get();
        return $customer;
    }
}
