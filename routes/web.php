<?php
use App\Models\Role;
use App\Models\Sonod;
use App\Models\Tender;
use App\Models\Payment;
use App\Models\TikaLog;
use App\Models\Visitor;
use App\Models\TenderList;
use App\Models\Uniouninfo;
use Illuminate\Http\Request;
use App\Models\TenderFormBuy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RedisTaggedCache;
use App\Http\Controllers\SonodController;
use App\Http\Controllers\fronendController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AplicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HoldingtaxController;
use App\Http\Controllers\TenderListController;
use App\Http\Controllers\UniouninfoController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\TenderFormBuyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/akpay/test', function () {


    $trnx_id = time();

    $Apiurl = 'https://pg.ekpay.gov.bd/ekpaypg/v1';
    $url = 'https://www.esspmtetulia.gov.bd';

    $whitelistip = '198.54.114.109';
   $req_timestamp = date('Y-m-d H:i:s');

 $AKPAY_MER_REG_ID = 'tetulia_sechsheba_mer';
$AKPAY_MER_PASS_KEY = 'sI8^Q2##';





   $post = [
      'mer_info' => [
         "mer_reg_id" => $AKPAY_MER_REG_ID,
         "mer_pas_key" => $AKPAY_MER_PASS_KEY
      ],
      "req_timestamp" => "$req_timestamp GMT+6",
      "feed_uri" => [
         "c_uri" => url("payment/cancel"),
         "f_uri" => url("payment/fail"),
         "s_uri" => url("payment/success")
      ],
      "cust_info" => [
        "cust_email" => "",
        "cust_id" => "1",
        "cust_mail_addr" => "Address",
        "cust_mobo_no" => "01909756552",
        "cust_name" => "Customer Name"
    ],
      "trns_info" =>[
        "ord_det" => 'sonod',
        "ord_id" => "1",
        "trnx_amt" => 10,
        "trnx_currency" => "BDT",
        "trnx_id" => "$trnx_id"
    ],
      "ipn_info" => [
         "ipn_channel" => "3",
         "ipn_email" => "freelancernishad123@gmail.com",
         "ipn_uri" => "$url/api/ipn"
      ],
      "mac_addr" => "$whitelistip"
   ];

   // 148.163.122.80
   $post = json_encode($post);


   $ch = curl_init($Apiurl.'/merchant-api');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
   $response = curl_exec($ch);
   curl_close($ch);

/*      echo '<pre>';
   print_r($response); */


  return   $response = json_decode($response);
   $sToken =  $response->secure_token;


   return "$Apiurl?sToken=$sToken&trnsID=$trnx_id";


});

Route::get('/tenders/payment/{id}', [TenderListController::class,'PaymentCreate']);

Route::get('/tenders/{tender_id}', [TenderListController::class,'TenderForm']);
Route::post('/tenders/{tender_id}', [TenderListController::class,'TenderForm']);


Route::get('/pdf/tenders/{tender_id}', [TenderListController::class,'viewpdf']);



Route::get('/tenders/form/buy/{tender_id}', function ($tender_id) {


    $tender_list_count = TenderList::where('tender_id',$tender_id)->count();
    if($tender_list_count<1){
        return '<h1 style="text-align:center;color:red">কোনও তথ্য খুজে পাওয়া জায় নি</h1>';
    }

    $tender_list = TenderList::where('tender_id',$tender_id)->first();

      $currentDate = strtotime(date("d-m-Y H:i:s"));

    $form_buy_last_date = strtotime(date("d-m-Y H:i:s",strtotime($tender_list->form_buy_last_date)));



   if($currentDate<$form_buy_last_date){

    $tender_list->update(['status'=>'active']);
       return view('tender.formbuy',compact('tender_list'));

    }else{

        return '<h1 style="text-align:center;color:red">সিডিউল ফর্ম কেনার সময় শেষ</h1>';
   }





});

Route::post('/form/submit', function (Request $request) {


    $data = $request->except(['_token','bank_draft_image','deposit_details','form_code']);

    $form_code = $request->form_code;
     $tenderformbuy = TenderFormBuy::where(['form_code'=>$form_code,'status'=>'Paid'])->first();
    if($tenderformbuy){

        $data['nidNo'] = $tenderformbuy->nidNo;
        $data['nidDate'] = $tenderformbuy->nidDate;
        $data['applicant_orgName'] = $tenderformbuy->name;
        $data['applicant_org_fatherName'] = $tenderformbuy->applicant_org_fatherName;
        $data['vill'] = $tenderformbuy->vill;
        $data['postoffice'] = $tenderformbuy->postoffice;
        $data['thana'] = $tenderformbuy->thana;
        $data['distric'] = $tenderformbuy->distric;
        $data['mobile'] = $tenderformbuy->PhoneNumber;



    }else{
        Session::flash('Fmessage', 'দয়া করে সঠিক সিডিউল ফর্ম নং প্রদান করুন');
        return redirect()->back();
    }





    $bank_draft_image = $request->file('bank_draft_image');
    $extension = $bank_draft_image->getClientOriginalExtension();
    $path = public_path('files/bank_draft_image/');
    $fileName = $request->dorId.'-'.uniqid().'.'.$extension;
    $bank_draft_image->move($path, $fileName);
    $bank_draft_image = asset('files/bank_draft_image/'.$fileName);





    // $deposit_details = $request->file('deposit_details');
    // $extension = $deposit_details->getClientOriginalExtension();
    // $path = public_path('files/deposit_details/');
    // $fileName = $request->dorId.'-'.uniqid().'.'.$extension;
    // $deposit_details->move($path, $fileName);
    // $deposit_details = asset('files/deposit_details/'.$fileName);
    // $data['deposit_details'] = $deposit_details;



    $data['bank_draft_image'] = $bank_draft_image;
    $data['payment_status'] = 'Paid';











  $tender =  Tender::create($data);
  Session::flash('Smessage', 'আপনার দরপত্রটি দাখিল হয়েছে');

//   return redirect("/tenders/payment/$tender->id");

  return redirect()->back();


});


Route::get('/pdf/sder/download/{tender_id}', function (Request $request,$tender_id) {

    $row = TenderList::find($tender_id);
$html = '
<style>
td{
    border: 1px solid black;
    padding:4px 10px;
    font-size: 14px;
}    th{
    border: 1px solid black;
    padding:4px 10px;
    font-size: 14px;
}


.m-0{
    margin:0 !important;
}
.mb-0{
    margin-bottom:0 !important;
}
.mt-0{
    margin-top:0 !important;
}
.roles p {
    margin:0 !important;
}


</style>

<div style="text-align:center">
<p class="m-0">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
<p class="m-0">উপজেলা নির্বাহী অফিসারের কার্যালয়</p>
<p class="m-0">তেঁতুলিয়া, পঞ্চগড়।</p>
<p class="m-0">www.tetulia.panchagarh.gov.bd</p>

</div>
<table width="100%" style="border:0">
<tr>
    <td style="text-align:left;border:0">স্মারক নং:- '.int_en_to_bn($row->memorial_no).'</td>
    <td style="text-align:right;border:0">তারিখ:- '.int_en_to_bn(date("d/m/Y", strtotime(now()))).'</td>
</tr>
</table>

    <p style="text-align:center;font-size:25px">দরপত্র দাখিল কারীর তালিকা</p>


<table class="table" border="1" style="border-collapse: collapse;width:100%">
<thead>
    <tr>
    <td>দরপত্র নম্বর</td>
    <td>নাম</td>
    <td>পিতার নাম</td>
    <td>ঠিকানা</td>
    <td>মোবাইল</td>
    <td>দরের পরিমাণ</td>
    <td>কথায়</td>
    <td>জামানতের পরিমাণ</td>
    <td>দাখিলের তারিখ ও সময়</td>
    </tr>
</thead>
<tbody>';
        $tenders =  Tender::where('tender_id',$tender_id)->get();
    foreach ($tenders as $application) {


    $html .= " <tr>
        <td>$application->dorId</td>
        <td>$application->applicant_orgName</td>
        <td>$application->applicant_org_fatherName</td>
        <td>গ্রাম- $application->vill, ডাকঘর- $application->postoffice, উপজেলা- $application->thana, জেলা- $application->distric</td>
        <td>$application->mobile</td>
        <td>$application->DorAmount</td>
        <td>$application->DorAmountText</td>
        <td>$application->depositAmount</td>
        <td>".int_en_to_bn(date("d/m/Y h:i", strtotime($application->created_at)))."</td>
    </tr>";
}


    $html .= '

</tbody>
</table>



';
   return PdfMaker('A4',$html,'list',false);



});



Route::get('/pdf/tender/selected/download/{tender_id}', function (Request $request,$tender_id) {

    $row = TenderList::find($tender_id);


$html = '
<style>
td{
    border: 1px solid black;
    padding:4px 10px;
    font-size: 14px;
}    th{
    border: 1px solid black;
    padding:4px 10px;
    font-size: 14px;
}


.m-0{
    margin:0 !important;
}
.mb-0{
    margin-bottom:0 !important;
}
.mt-0{
    margin-top:0 !important;
}
.roles p {
    margin:0 !important;
}


</style>

<div style="text-align:center">
<p class="m-0">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
<p class="m-0">উপজেলা নির্বাহী অফিসারের কার্যালয়</p>
<p class="m-0">তেঁতুলিয়া, পঞ্চগড়।</p>
<p class="m-0">www.tetulia.panchagarh.gov.bd</p>

</div>
<table width="100%" style="border:0">
<tr>
    <td style="text-align:left;border:0">স্মারক নং:- '.int_en_to_bn($row->memorial_no).'</td>
    <td style="text-align:right;border:0">তারিখ:- '.int_en_to_bn(date("d/m/Y", strtotime(now()))).'</td>
</tr>
</table>

    <p style="text-align:center;font-size:25px">দরপত্র দাখিল কারীর তালিকা</p>


<table class="table" border="1" style="border-collapse: collapse;width:100%">
<thead>
    <tr>
    <td>দরপত্র নম্বর</td>
    <td>নাম</td>
    <td>পিতার নাম</td>
    <td>ঠিকানা</td>
    <td>মোবাইল</td>
    <td>দরের পরিমাণ</td>
    <td>কথায়</td>
    <td>জামানতের পরিমাণ</td>
    <td>দাখিলের তারিখ ও সময়</td>
    </tr>
</thead>
<tbody>';
    $tenders = Tender::where(['tender_id'=>$tender_id,'payment_status'=>'Paid'])->orderBy('DorAmount','desc')->get();
    // $tenders =  Tender::where('tender_id',$tender_id)->get();
    foreach ($tenders as $application) {


    $html .= " <tr>
        <td>$application->dorId</td>
        <td>$application->applicant_orgName</td>
        <td>$application->applicant_org_fatherName</td>
        <td>গ্রাম- $application->vill, ডাকঘর- $application->postoffice, উপজেলা- $application->thana, জেলা- $application->distric</td>
        <td>$application->mobile</td>
        <td>$application->DorAmount</td>
        <td>$application->DorAmountText</td>
        <td>$application->depositAmount</td>";


        if($application->status=='Selected'){
            $html .= "<td>সর্বোচ্চ দরদাতা</td>";
        }else{
            $html .= "<td></td>";
        }



        $html .= "</tr>";
}


    $html .= '

</tbody>
</table>



';
   return PdfMaker('A4',$html,'list',false);



});





Route::get('/tenderformpay/success', [TenderFormBuyController::class,'tenderFormPaymentSuccess']);












Route::get('/apllication/document/{id}',[fronendController::class,'apllication_Document'])->name('apllication_Document');
Route::get('/license/{id}',[fronendController::class,'license'])->name('license');


Route::get('/applicantion/full/copy/{id}',[fronendController::class,'applicantCopy']);




Route::get('/passGen/{pass}', function ($pass) {
    return  hash::make($pass);
});




Route::get('/sonod/payment/success/{id}', [SonodController::class,'sonodpaymentSuccessView']);

Route::get('/payment/success', function (Request $request) {
    // return $request->all();
    $transId = $request->transId;

    $payment = Payment::where(['trxId' => $transId])->first();


    if($payment->sonod_type=='Tenders_form'){
        $redirect = "/tenderformpay/success?transId=$transId";
    }else{
        $redirect = "/payment/success/confirm?transId=$transId";
    }



    // $redirect = "/payment/success/confirm?transId=$transId";
    echo "
    <h3 style='text-align:center'>Please wait 10 seconds.This page will auto redirect you</h3>
    <script>
    setTimeout(() => {
    window.location.href='$redirect'
    }, 10000);
    </script>
    ";




    // return redirect("/payment/success/confirm?transId=$transId");
});
Route::get('/payment/success/confirm', [SonodController::class,'sonodpaymentSuccess']);

Route::get('/l/f/{id}', [SonodController::class,'sonodpayment']);

// Route::get('/sonod/payment/{id}', [SonodController::class,'sonodpayment']);







Route::post('unionCreate', [UniouninfoController::class,'unionCreate']);
Auth::routes([
    'login'=>false,
]);
Route::post('login',[LoginController::class,'login']);
Route::post('logout',[LoginController::class,'logout']);
// Route::group(['middleware' => ['is_admin']], function() {
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// });
// Route::group(['middleware' => ['CustomerMiddleware']], function() {
// Route::get('/sub', [App\Http\Controllers\HomeController::class, 'sub'])->name('sub');
// });






Route::get('/sonod/payment/success/{id}', [SonodController::class,'sonodpaymentSuccessView']);
// Route::get('/payment/success', [SonodController::class,'sonodpaymentSuccess']);
Route::get('/sonod/payment/{id}', [SonodController::class,'sonodpayment']);
Route::get('/sonod/{name}/{id}', [SonodController::class,'sonodDownload']);
Route::get('/invoice/{name}/{id}', [SonodController::class,'invoice']);
Route::get('/card/{name}/{id}', [SonodController::class,'userDocument']);
Route::get('/information/{name}/{id}', [SonodController::class,'userinformation']);
Route::get('/pay/holding/tax/{id}', [HoldingtaxController::class,'holding_tax_pay_Online']);

Route::get('/holdingPay/success', [HoldingtaxController::class,'holdingPaymentSuccess']);

Route::get('/holding/tax/invoice/{id}', [HoldingtaxController::class,'holdingPaymentInvoice']);

Route::get('/report/export', [PaymentController::class,'export']);

Route::get('/cashbook/download', [ExpenditureController::class,'cashbook_download']);

Route::get('/secretary/approve/{id}', [SonodController::class,'SecretariNotificationApprove']);
Route::get('/chairman/approve/{id}', [SonodController::class,'ChairnamNotificationApprove']);
Route::get('/secretary/pay/{id}', [SonodController::class,'SecretariNotificationPay']);
Route::get('/allow/application/notification', function () {







    return view('applicationNotification');


    });
Route::group(['prefix' => 'dashboard','middleware' => ['auth']], function() {




    Route::get('/pdf/tenders/work/access/{tender_id}', [TenderListController::class,'workAccessPdf']);

    Route::get('/pdf/tenders/resulation/{tender_id}', [TenderListController::class,'ResulationPdf']);



    Route::get('/application/report/{id}',[AplicationController::class,'download_report']);

Route::get('/report/download', [SonodController::class,'ReportDownload']);



    Route::get('/{vue_capture?}', function () {
        // return   Auth::user()->roles->permission;
        $roles = Role::all();
        return view('layout',compact('roles'));
    })->where('vue_capture', '[\/\w\.-]*')->name('dashboard');
});
Route::get('/{vue_capture?}', function () {




    $url = url()->current();
 $domain =  explode('//',$url);

  $subdomain =  explode('.', $domain[1]);

    if($subdomain[0]=='www'){

         $subdomainCount =  count($subdomain);
         $subdomainget = $subdomain[1];
        if($subdomainCount>env('WITH_WWW')){
            $sub = true;
        }else{
            $sub = false;

        }
    }else{


        $subdomainCount =  count($subdomain);
        $subdomainget = $subdomain[0];

        if($subdomainCount>env('WITHOUT_WWW')){
            $sub = true;
        }else{
            $sub = false;

        }
    }




 if($sub){

    $uniounDetials = cache()->remember('uniounDetials-'.$subdomainget, 60*60*24, function () use($subdomainget) {
        return Uniouninfo::where(['short_name_e'=>$subdomainget])->first();
    });
     return view('frontlayout',compact('uniounDetials'));
    }else{




        // return  Uniouninfo::find(1);

    //   $uniounDetials = json_decode(json_encode($uniounDetials));
    //   $uniounDetials =  Uniouninfo::where(['short_name_e'=>'uniontax'])->first();
      $uniounDetials = cache()->remember('uniounDetials-uniontax', 60*60*24, function () {
        return Uniouninfo::where(['short_name_e'=>'uniontax'])->first();
    });
    $uniounDetials['defaultColor']  = 'green';
     return view('frontlayout',compact('uniounDetials'));
 }



















        // return  Uniouninfo::find(1);
 $uniounDetials['defaultColor']  = 'green';
      $uniounDetials = json_decode(json_encode($uniounDetials));
     return view('frontlayout',compact('uniounDetials'));

})->where('vue_capture', '[\/\w\.-]*')->name('frontend');



