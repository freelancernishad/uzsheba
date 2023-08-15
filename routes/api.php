<?php

use App\Models\Tender;
use App\Models\TenderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\blogController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SonodController;
use App\Http\Controllers\CharageController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TikaLogController;
use App\Http\Controllers\VisitorController;
use  App\Http\Controllers\api\authController;
use App\Http\Controllers\ActionLogController;
use App\Http\Controllers\AplicationController;
use App\Http\Controllers\countryApiController;
use App\Http\Controllers\HoldingtaxController;
use App\Http\Controllers\TenderListController;
use App\Http\Controllers\UniouninfoController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\HoldingBokeyaController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\SonodnamelistController;
use App\Http\Controllers\TenderFormBuyController;
use App\Http\Controllers\CitizenInformationController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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




Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [authController::class,'login']);
    Route::post('logout', [authController::class,'logout']);
    Route::post('refresh', [authController::class,'refresh']);
    Route::post('me', [authController::class,'login']);

});



// country api
Route::get('/getdivisions', [countryApiController::class,'getdivisions']);
Route::get('/getdistrict', [countryApiController::class,'getdistrict']);
Route::get('/getthana', [countryApiController::class,'getthana']);
Route::get('/getunioun', [countryApiController::class,'getunioun']);
Route::get('/gotoUnion', [countryApiController::class,'gotoUnion']);




Route::post('unionCreate', [UniouninfoController::class,'unionCreate']);



Route::post('register', [authController::class,'register']);
Route::get('get/roles',[authController::class,'getRoles']);

Route::get('set/notification',[NotificationsController::class,'notifications']);

Route::get('get/users/list',[RoleController::class,'index']);
Route::get('get/users/delete/{id}',[RoleController::class,'deleteuser']);

Route::get('update/users/{id}',[RoleController::class,'getuser']);
Route::post('update/users',[RoleController::class,'updateuser']);



Route::resources([
	'tikalog' => TikaLogController::class,
    'tender' => TenderListController::class,
	'tenderform' => TenderFormBuyController::class,
]);

Route::post('check/form_code', [TenderFormBuyController::class,'check_form_code']);


Route::post('tender/selection/{tender_id}', [TenderListController::class,'SeletionTender']);

Route::post('committe/update/{id}', function (Request $request,$id) {

    $committe1name = $request->committe1name;
    $committe1position = $request->committe1position;
    $commette1phone = $request->commette1phone;

    $committe2name = $request->committe2name;
    $committe2position = $request->committe2position;
    $commette2phone = $request->commette2phone;

    $committe3name = $request->committe3name;
    $committe3position = $request->committe3position;
    $commette3phone = $request->commette3phone;




    $updatedData = [
        'committe1name'=> $committe1name,
        'committe1position'=> $committe1position,
        'commette1phone'=> $commette1phone,
        'commette1pass'=> mt_rand(1000000, 9999999),
        'committe2name'=> $committe2name,
        'committe2position'=> $committe2position,
        'commette2phone'=> $commette2phone,
        'commette2pass'=> mt_rand(1000000, 9999999),
        'committe3name'=> $committe3name,
        'committe3position'=> $committe3position,
        'commette3phone'=> $commette3phone,
        'commette3pass'=> mt_rand(1000000, 9999999),
    ];



    $tenderList = TenderList::find($id);

    SmsNocSmsSend("ইযারা মূল্যায়নের পাসওয়ার্ড ".$updatedData['commette1pass'],$updatedData['commette1phone'],$tenderList->union_name);
    SmsNocSmsSend("ইযারা মূল্যায়নের পাসওয়ার্ড ".$updatedData['commette2pass'],$updatedData['commette2phone'],$tenderList->union_name);
    SmsNocSmsSend("ইযারা মূল্যায়নের পাসওয়ার্ড ".$updatedData['commette3pass'],$updatedData['commette3phone'],$tenderList->union_name);




    // return $updatedData;

    $tenderList->update($updatedData);



});

Route::get('get/all/aplications/{tender_id}', function (Request $request,$tender_id) {

$status = $request->status;
if($status){
    return Tender::where(['tender_id'=>$tender_id,'status'=>$status,'payment_status'=>'Paid'])->get();
}else{
    return Tender::where(['tender_id'=>$tender_id,'payment_status'=>'Paid'])->orderBy('DorAmount','desc')->get();
}
});

Route::get('get/all/tender/list', function (Request $request) {
$union_name = $request->union_name;

if($union_name){
    return TenderList::where('union_name',$union_name)->orderBy('id','desc')->get();
}else{
    return TenderList::orderBy('id','desc')->get();

}
});

Route::get('get/single/tender/{id}', function (Request $request,$id) {

    return TenderList::find($id);

});






Route::post('citizen/information/nid', [CitizenInformationController::class,'citizeninformationNID']);
Route::post('citizen/information/brn', [CitizenInformationController::class,'citizeninformationBRN']);

Route::get('check/tika',[TikaLogController::class,'tikacount']);


Route::get('get/sonod/count',[SonodnamelistController::class,'sonodCount']);
Route::post('prottoyon/update/{id}',[SonodController::class,'prottonupdate']);


Route::get('sonod/verify/get',[SonodController::class,'verifysonodId']);

Route::post('get/data/{id_no}',[SonodController::class,'tikaCreate']);


Route::get('sonod/list',[SonodController::class,'index']);
Route::get('application/status/{status}/{id}',[SonodController::class,'statusChange']);
Route::post('application/approve/submit',[AplicationController::class,'approve_submit']);


Route::post('role/assign',[authController::class,'roleAssign']);

Route::get('sonod/single/{id}',[SonodController::class, 'singlesonod']);
Route::post('sonod/submit',[SonodController::class, 'sonod_submit']);
Route::post('sonod/update',[SonodController::class, 'sonod_update']);

Route::get('sonod/delete/{id}',[SonodController::class, 'sonod_delete']);
Route::post('sonod/sec/approve/{id}',[SonodController::class, 'sec_sonod_action']);
Route::get('sonod/pay/{id}',[SonodController::class, 'sonod_pay']);
Route::post('sonod/cancel/{id}',[SonodController::class, 'cancelsonod']);
Route::get('sonod/{action}/{id}',[SonodController::class, 'sonod_action']);


Route::get('sonod/sonod_Id',[SonodController::class, 'sonod_id']);
Route::post('sonod/search',[SonodController::class, 'sonod_search']);

Route::get('payment/report/search',[PaymentController::class,'Search']);
Route::post('payment/report/search',[PaymentController::class,'Search']);

Route::post('ipn',[PaymentController::class ,'ipn']);
// Route::post('/re/call/ipn',[PaymentController::class ,'ReCallIpn']);
// Route::post('/check/payments/ipn',[PaymentController::class ,'AkpayPaymentCheck']);

Route::get('akpay',[SonodController::class, 'akpay']);


Route::post('contact',[UniouninfoController::class, 'contact']);

//////
// Dashboard all counting and chart




Route::post('visitorcreate',[VisitorController::class, 'visitorcreate']);
Route::get('visitorcount',[VisitorController::class, 'visitorCount']);




Route::get('get/union/list',[UniouninfoController::class,'index']);
Route::get('get/union/delete/{id}',[UniouninfoController::class,'deleteunion']);

Route::get('update/union/{id}',[UniouninfoController::class,'getunion']);
// Route::post('update/union',[UniouninfoController::class,'updateunion']);
Route::post('union/info',[UniouninfoController::class, 'unionInfo']);
Route::post('unionprofile/submit',[UniouninfoController::class, 'unionInfoUpdate']);
Route::post('payment/update',[UniouninfoController::class, 'paymentUpdate']);




Route::get('niddob/verify',[SonodController::class,'niddob']);
