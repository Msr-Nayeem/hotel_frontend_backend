<?php

use App\Http\Controllers\APIAdminController;
use App\Http\Controllers\APIInfoController;
use App\Http\Controllers\APILoginController;
use App\Http\Controllers\APIReceiptionistController;
use App\Http\Controllers\APICustomerController;
use App\Http\Controllers\APIRoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAPIController;
use App\Http\Controllers\OtpController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/students/list',[LoginAPIController::class,'APIList'])->middleware('ApiAuth');
Route::post('/students/list',[LoginAPIController::class,'APIpost']);

Route::get('/country',[LoginAPIController::class,'country']);
  
//REGISTRATION
Route::post('/apiRegistration',[LoginAPIController::class,'apiRegistration']); 


//API_LOGIN
Route::post('/login',[APILoginController::class,'login']);
Route::post('/logout',[APILoginController::class,'logout']);

//ROOMS
Route::get('/rooms',[APIRoomController::class,'roomList']);
Route::get('/addRoom',[APIRoomController::class,'addRoom']);
Route::get('/deleteRoom',[APIRoomController::class,'deleteRoom']);


//BOOKING

Route::get('/getCustomer',[APICustomerController::class,'getCustomer']);

Route::get('/cancelBooking',[APIRoomController::class,'cancelBooking']);
Route::get('/makeBooking',[APIRoomController::class,'makeBooking']);

Route::get('/getRent',[APIRoomController::class,'getRent']);
Route::get('/getCetegory',[APIRoomController::class,'getCetegory']);
Route::get('/getRooms',[APIRoomController::class,'getRooms']);



//PROFILE
/* Route::get('/getId',[LoginAPIController::class,'getId']); */
Route::get('/getType',[APIInfoController::class,'getType']);
Route::get('/profile',[APIInfoController::class,'profile']);
Route::get('/getDetails',[APIInfoController::class,'getDetails']);
Route::get('/changePassword',[APIInfoController::class,'changePassword']);

//USER
Route::get('/viewList',[APIInfoController::class,'viewList']);
Route::get('/changeStatus',[APIInfoController::class,'changeStatus']);
Route::get('/deleteUser',[APIInfoController::class,'deleteUser']);
Route::post('/userUpdate',[APIInfoController::class,'userUpdate']);


//Reset Password
Route::get('/sendotp',[OtpController::class,'sendOtp']);
Route::get('/matchotp',[OtpController::class,'matchOtp']);
Route::get('/resetpassword',[OtpController::class,'resetPassword']);



//REG
Route::post('/registration',[APIAdminController::class,'registration']); 
Route::get('/getDivisions',[APIInfoController::class,'getDivisions']);
Route::get('/getDistricts',[APIInfoController::class,'getDistricts']);
Route::get('/getUpazilas',[APIInfoController::class,'getUpazilas']);



