<?php
namespace App\Http\Controllers;
use Exception;
use Carbon\Carbon;
use App\Models\Sonod;
use App\Models\Charage;
use App\Models\Citizen;
use App\Models\Payment;
use App\Models\TikaLog;
use App\Models\ActionLog;
use App\Models\aplication;
use App\Models\Uniouninfo;
use App\Models\Expenditure;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\Sonodnamelist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Validator;
use Rakibhstu\Banglanumber\NumberToBangla;

use Meneses\LaravelMpdf\Facades\LaravelMpdf;
use Symfony\Component\VarDumper\Caster\RedisCaster;


class SonodController extends Controller
{
    public function prottonupdate(Request $request, $id)
    {
        $sonod = Sonod::find($id);
        $sonod->update(['sec_prottoyon' => $request->sec_prottoyon]);
    }
    public function sonodpaymentSuccessView(Request $request, $id)
    {
        $sonod = Sonod::find($id);
        return view('sonodsuccess', compact('sonod'));
    }
    public function sonodpaymentSuccess(Request $request)
    {
        $transId =  $request->transId;
         $payment = Payment::where(['trxId' => $transId])->first();
        $id = $payment->sonodId;
        $sonod = aplication::find($id);

            if($payment->status=='Paid'){



                $InvoiceUrl =  url("/invoice/c/$id");

                if($payment->sonod_type=='application_fee'){

                    return view('applicationSuccess', compact('payment', 'sonod'));

                }else if($payment->sonod_type=='license_fee'){



                    $patmenturl = "/license/$id";

                    if($sonod->sonod_name=='নলকূপ লাইসেন্স'){
                        $des = "অনলাইন সেচ সেবায় আপনার আবেদনটি অনুমোদিত হয়েছে। লাইসেন্স প্রাপ্তির জন্য লিংকঃ $patmenturl";
                    }else{
                        $des = "অনলাইন ভবনের নকশা সেবায় আপনার আবেদনটি অনুমোদিত হয়েছে। লাইসেন্স প্রাপ্তির জন্য লিংকঃ $patmenturl";
                    }
                    $mobile = int_bn_to_en($sonod->mobile_number);
                    SmsNocSmsSend($des,"$mobile");

                    return view('LisenceSuccess', compact('payment', 'sonod'));

                }


            }else{

                $tryagain = '';

                if($payment->sonod_type=='application_fee'){

                   $tryagain = "/l/f/$sonod->id?f=a";

                }else if($payment->sonod_type=='license_fee'){

                    $tryagain = "/l/f/$sonod->id?f=l";

                }

                echo "
                <div style='text-align:center'>
                <h1 style='text-align:center'>Payment Failed</h1>
                <a href='/' style='border:1px solid black;padding:10px 12px; background:red;color:white'>Back To Home</a>
                <a href='$tryagain' style='border:1px solid black;padding:10px 12px; background:green;color:white'>Pay Again</a>
                </div>
                ";
            }




    }
    public function sonodpayment(Request $request, $id)
    {

        $sonod = aplication::find($id);


        $feeParams = $request->f;
        $total_amount = 0;



        if($sonod->sonod_name=='নলকূপ লাইসেন্স'){
            if($feeParams=='l'){
                $total_amount = 1000;
                $sonod_type = 'license_fee';

            }elseif($feeParams=='a'){
                $total_amount = 200;
                $sonod_type = 'application_fee';
            }
        }else{
            if($feeParams=='l'){
                $total_amount = 1000;
                $sonod_type = 'license_fee';

            }elseif($feeParams=='a'){
                $total_amount = 300;
                $sonod_type = 'application_fee';
            }
        }







            $amount = 0;

            if ($total_amount == null || $total_amount == '' || $total_amount < 1) {
                $amount = 1;
            } else {
                $amount = $total_amount;
            }
            $trnx_id = time();

            $cust_info = [
                "cust_email" => "",
                "cust_id" => "$sonod->id",
                "cust_mail_addr" => "Address",
                "cust_mobo_no" => "$sonod->mobile_number",
                "cust_name" => "Customer Name"
            ];
            $req_timestamp = date('Y-m-d H:i:s');
            $redirectutl =  ekpayToken($trnx_id, $amount, $cust_info);
            $customerData = [
                'union' => '',
                'trxId' => $trnx_id,
                'sonodId' => $id,
                'sonod_type' => $sonod_type,
                'amount' => $amount,
                'mob' => $sonod->mobile_number,
                'paymentUrl' => $redirectutl,
                'status' => "Pending",
                'date' => date('Y-m-d'),
                'created_at' => $req_timestamp,
            ];
            Payment::create($customerData);

            return redirect($redirectutl);

    }




    public function akpay(Request $request)
    {
        $trnx_id = time();
        $cust_info = [
            "cust_email" => "",
            "cust_id" => "1",
            "cust_mail_addr" => "Address",
            "cust_mobo_no" => "01909756552",
            "cust_name" => "Customer Name"
        ];
        $redirectutl =  ekpayToken($trnx_id, 10, $cust_info);
        return redirect($redirectutl);
    }

    function allsonodId($union, $sonodname)
    {
        $sonodFinalId = '';
        $sortYear =  date('y');
        $UniouninfoCount =   Uniouninfo::where('short_name_e', $union)->latest()->count();
        $SonodCount =   Sonod::where(['unioun_name' => $union, 'sonod_name' => $sonodname, 'year' => date('Y')])->latest()->count();
        if ($UniouninfoCount > 0) {
            $Uniouninfo =   Uniouninfo::where('short_name_e', $union)->latest()->first();
            if ($SonodCount > 0) {
                $Sonod =  Sonod::where(['unioun_name' => $union, 'sonod_name' => $sonodname, 'year' => date('Y')])->latest()->first();
                // $sonodFinalId = 'fgdfgdfg';
                $sonodFinalId = $Sonod->sonod_Id + 1;
                // if ($Sonod->sonod_Id == '') {
                //     $sonod_Id = str_pad(00001, 5, '0', STR_PAD_LEFT);
                //     $sonodFinalId =  $Uniouninfo->u_code . $sortYear . $sonod_Id;
                // } else {
                //     // $sonod_Id = $Sonod->Sonod+1;
                //     $sonod_Id = str_pad($Sonod->sonod_Id, 5, '0', STR_PAD_LEFT);
                //     // $sonodFinalId =  $Uniouninfo->u_code.$sortYear.$sonod_Id;
                //     $sonodFinalId = $Sonod->sonod_Id + 1;
                // }
            } else {
                $sonod_Id = str_pad(00001, 5, '0', STR_PAD_LEFT);
                $sonodFinalId =  $Uniouninfo->u_code . $sortYear . $sonod_Id;
            }
        };
        return $sonodFinalId;
    }



    public function sonod_update(Request $r)
    {
        $id = $r->id;
        $Insertdata = $r->all();
        try {
             $sonod =   Sonod::find($id);
            $Insertdata['status'] = 'approved';
           return  $sonod->update($Insertdata);
            // return  $sonod;
        } catch (Exception $e) {
            return sent_error($e->getMessage(), $e->getCode());
        }
    }

    public function sonod_id($sonod_name)
    {
        $sonodFinalId = '';
        $sortYear =  date('y');
        $SonodCount =   aplication::where('sonod_name',$sonod_name)->latest()->count();
            if ($SonodCount > 0) {
                $Sonod =  aplication::where('sonod_name',$sonod_name)->latest()->first();
                if ($Sonod->licence_no == '') {
                    $licence_no = str_pad(00001, 5, '0', STR_PAD_LEFT);
                    $sonodFinalId =  '77190831' . $sortYear . $licence_no;
                } else {
                    $sonodFinalId = $Sonod->licence_no + 1;
                }
            }else{
                $licence_no = str_pad(00001, 5, '0', STR_PAD_LEFT);
                $sonodFinalId =  '77190831' . $sortYear . $licence_no;
            }
        return $sonodFinalId;
    }

    public function sonod_submit(Request $r)
    {
        $id = $r->id;
        $data = $r->except(['passport_size_mage','nid_copy','land_copy','khotiyan_copy','tax_copy','map','wyarisan','building_construction']);

        $data['licence_no'] = (string)$this->sonod_id($r->sonod_name);


        if($r->building_construction){

            $data['building_construction'] = json_encode($r->building_construction,JSON_UNESCAPED_UNICODE);
        }
        // return $r->land_copy;

        // return count($r->land_copy);
        if($r->sonod_name=='নলকূপ লাইসেন্স'){
            $land_copy = [];
            if($r->land_copy){
                foreach ($r->land_copy as $value) {
                    $land_copyCount =  count(explode(';', $value));
                    if ($land_copyCount > 1) {
                        array_push($land_copy,fileupload($value, "sonod/land_copy/"));
                    }
                }
            }
            $data['land_copy'] = json_encode($land_copy);
        }



        $passport_size_mageCount =  count(explode(';', $r->passport_size_mage));
        if ($passport_size_mageCount > 1) {
            $data['passport_size_mage'] =  fileupload($r->passport_size_mage, "sonod/passport_size_mage/");
        }

        $nid_copyCount =  count(explode(';', $r->nid_copy));
        if ($nid_copyCount > 1) {
            $data['nid_copy'] =  fileupload($r->nid_copy, "sonod/nid_copy/");
        }



        $khotiyan_copyCount =  count(explode(';', $r->khotiyan_copy));
        if ($khotiyan_copyCount > 1) {
            $data['khotiyan_copy'] =  fileupload($r->khotiyan_copy, "sonod/khotiyan_copy/");
        }

        $tax_copyCount =  count(explode(';', $r->tax_copy));
        if ($tax_copyCount > 1) {
            $data['tax_copy'] =  fileupload($r->tax_copy, "sonod/tax_copy/");
        }

        $mapCount =  count(explode(';', $r->map));
        if ($mapCount > 1) {
            $data['map'] =  fileupload($r->map, "sonod/map/");
        }

        $wyarisanCount =  count(explode(';', $r->wyarisan));
        if ($wyarisanCount > 1) {
            $data['wyarisan'] =  fileupload($r->wyarisan, "sonod/wyarisan/");
        }

        // return $data;
        try {
            $sonod =   aplication::create($data);


            if($r->sonod_name=='নলকূপ লাইসেন্স'){
                $des = "অভিনন্দন! অনলাইন সেচ সেবায় আপনার আবেদন গ্রহণ করা হয়েছে। বিধি মোতাবেক আগামী ২০ (বিশ) কার্যদিবসের মধ্যে তদন্ত সম্পন্ন করা হবে। ধন্যবাদ";
            }else{

                $des = "অভিনন্দন! অনলাইন ভবনের নকশা সেবায় আপনার আবেদন গ্রহণ করা হয়েছে। বিধি মোতাবেক আগামী ২০ (বিশ) কার্যদিবসের মধ্যে তদন্ত সম্পন্ন করা হবে। ধন্যবাদ";
            }

             $mobile = int_bn_to_en($r->mobile_number);
            SmsNocSmsSend($des,"$mobile");



            return  $sonod;
        } catch (Exception $e) {
            return sent_error($e->getMessage(), $e->getCode());
        }
    }















    public function sonod_delete($id)
    {
        $sonod =  Sonod::find($id);
        $sonod->delete();
        return 'Sonod deleted!';
    }
    public function sec_sonod_action(Request $request, $id)
    {




        $sonod = Sonod::find($id);






        $sec_prottoyon = $request->sec_prottoyon;
        // return $request->all();
        $arraydata = [
            'total_amount' => $request->amounta,
            'pesaKor' => $request->pesaKor,
            'tredeLisenceFee' => $request->tredeLisenceFee,
            'vatAykor' => $request->vatAykor,
            'khat' => $request->khat,
            'last_years_money' => $request->last_years_money,
            'currently_paid_money' => $request->currently_paid_money,
        ];
        $amount_deails = json_encode($arraydata);
        $numto = new NumberToBangla();
        $the_amount_of_money_in_words = $numto->bnMoney($request->amounta) . ' মাত্র';
        if ($sec_prottoyon) {
             $approveData = $request->approeDatav;

            if($approveData =='null_approved'){
                $approveData = 'Secretary_approved';
            }else{
                $approveData = 'Secretary_approved';
            }
            $updateData = [
                'khat' => $request->khat,
                'last_years_money' => $request->last_years_money,
                'currently_paid_money' => $request->currently_paid_money,
                'total_amount' => $request->amounta,
                'the_amount_of_money_in_words' => $the_amount_of_money_in_words,
                'khat' => $request->khat,
                'amount_deails' => $amount_deails,
                'sec_prottoyon' => $sec_prottoyon,
                'stutus' => $approveData,
            ];


            $notifiData = ['union'=>$sonod->unioun_name,'roles'=>'Chairman'];
            $notificationsCount = Notifications::where($notifiData)->count();
            if($notificationsCount>0){
               $notifications = Notifications::where($notifiData)->latest()->first();
               $data =' {"to":"'.$notifications->key.'","notification":{"body":"সচিব '.$sonod->applicant_name.' এর '.$sonod->sonod_name.' এর আবেদনটি অনুমোদন করেছে","title":"সনদ নং '.int_en_to_bn($sonod->sonod_Id).'","icon":"'.asset('assets/img/bangladesh-govt.png').'","click_action":"'.url('/chairman/approve/'.$sonod->id).'"}}';
               pushNotification($data);
            }







            // return $updateData;
            return $sonod->update($updateData);
        }


        $updateData = [
            'khat' => $request->khat,
            'last_years_money' => $request->last_years_money,
            'currently_paid_money' => $request->currently_paid_money,
            'total_amount' => $request->amounta,
            'amount_deails' => $amount_deails,
            'the_amount_of_money_in_words' => $the_amount_of_money_in_words,
            'stutus' => $request->approeDatav,
        ];

        $Uniouninfo =   Uniouninfo::where('short_name_e', $sonod->unioun_name)->latest()->first();
        $updateData['chaireman_name'] = $Uniouninfo->c_name;
        $updateData['c_email'] = $Uniouninfo->c_email;
        $updateData['chaireman_sign'] = $Uniouninfo->c_signture;




        return $sonod->update($updateData);
    }
    public function sonod_pay(Request $request, $id)
    {
        $type = $request->type;
        // return $request->all();
        $sonod = Sonod::find($id);
        $sonodUrl =  url("/sonod/d/$id");
        $InvoiceUrl =  url("/invoice/d/$id");
        $deccription = "Congratulation! Your application $sonod->sonod_Id  has been Paid. Sonod : " . $sonodUrl . " Invoice : " . $InvoiceUrl;
        // $deccription = "অভিনন্দন! আপনার আবেদনটি সফলভাবে পরিশোধিত হয়েছে। সনদ : $sonodUrl রশিদ : $InvoiceUrl";
        smsSend($deccription, $sonod->applicant_mobile);
        $req_timestamp = date('Y-m-d H:i:s');


    //     $monthName = date('F');
    //     $expenditure = Expenditure::where(['month'=>$monthName])->latest()->first();
    //    $buyBalance = $expenditure->balance+$sonod->total_amount;
    //     $expenditure->update(['balance'=>$buyBalance]);


        $customerData = [
            'union' => $sonod->unioun_name,
            'trxId' => time(),
            'sonodId' => $id,
            'sonod_type' => $sonod->sonod_name,
            'amount' => $sonod->total_amount,
            'mob' => $sonod->applicant_mobile,
            'status' => "Paid",
            'date' => date('Y-m-d'),
            'month' => date('F'),
            'year' => date('Y'),
            'balance' =>0,
            'created_at' => $req_timestamp,
        ];
        Payment::create($customerData);

        if($type=='notify'){

             $sonod->update(['payment_status' => 'Paid']);
            return Sonod::find($id);
        }else{

            return $sonod->update(['payment_status' => 'Paid']);
        }


    }
    public function cancelsonod(Request $request, $id)
    {
        $sonod = Sonod::find($id);
        $data = $request->all();
        ActionLog::create($data);
        $sonod->update(['cancedby' => $request->names, 'cancedbyUserid' => $request->user_id]);
        $InvoiceUrl =  url("/reject/$id");
        $deccription = "Opps! Your application $sonod->sonod_Id  has been Not Approve. Details : " . $InvoiceUrl;
        smsSend($deccription, $sonod->applicant_mobile);
        $updatedata = [
            'stutus' => $request->status,
        ];
        return $sonod->update($updatedata);
    }
    public function sonod_action(Request $request, $action, $id)
    {
        $sonod = Sonod::find($id);
        $type = $request->type;
        $unioun_name = $sonod->unioun_name;
        $uniouninfos = Uniouninfo::where(['short_name_e' => $unioun_name])->first();
        if ($action == 'approved') {
            $updatedata = [
                'chaireman_name' => $uniouninfos->c_name,
                'c_email' => $uniouninfos->c_email,
                'chaireman_sign' => $uniouninfos->c_signture,
                'stutus' => $action,
            ];
            $sonod_name =  sonodEnName($sonod->sonod_name);
            $payment_type = $uniouninfos->payment_type;
            if ($payment_type == 'Prepaid') {
                $sonodUrl =  url("/sonod/d/$id");
                $InvoiceUrl =  url("/invoice/d/$id");
                $deccription = "Congratulation! Your application $sonod->sonod_Id  has been Approved. Sonod : " . $sonodUrl . " Invoice : " . $InvoiceUrl;
                // $deccription = "অভিনন্দন! আপনার আবেদনটি সফলভাবে অনুমোদিত হয়েছে। সনদ : $sonodUrl রশিদ : $InvoiceUrl";
            } elseif ($payment_type == 'Postpaid') {
                $paymentUrl =  url("/sonod/payment/$id");
                $deccription = "Congratulation! Your application $sonod->sonod_Id  has been Approved. Pay: " . $paymentUrl;
                // $deccription = "অভিনন্দন! আপনার আবেদনটি সফলভাবে অনুমোদিত হয়েছে। আবেদনের ফি প্রদানের জন্য ক্লিক করুন " . $paymentUrl;
            }
            smsSend($deccription, $sonod->applicant_mobile);







        } else {
            $updatedata = [
                'stutus' => $action,
            ];
        }



        $notifiData = ['union'=>$sonod->unioun_name,'roles'=>'Secretary'];
        $notificationsCount = Notifications::where($notifiData)->count();
        if($notificationsCount>0){
           $notifications = Notifications::where($notifiData)->latest()->first();
           $data =' {"to":"'.$notifications->key.'","notification":{"body":"চেয়ারম্যান '.$sonod->applicant_name.' এর '.$sonod->sonod_name.' এর আবেদনটি অনুমোদন করেছে","title":"সনদ নং '.int_en_to_bn($sonod->sonod_Id).'","icon":"'.asset('assets/img/bangladesh-govt.png').'","click_action":"'.url('/secretary/pay/'.$sonod->id).'"}}';
           pushNotification($data);
        }


        // return $type;
        if($type=='notify'){

             $sonod->update($updatedata);
             return redirect('/dashboard');
            }
            return $sonod->update($updatedata);
    }

    public function ChairnamNotificationApprove($id)
    {
        $redirecturl = "?redirect=".url('/chairman/approve/'.$id);

        if(!Auth::user()){
            return redirect('/login'.$redirecturl);
        }
     $user = Auth::user();

     $sonod= Sonod::find($id);
     $unioun = $user->unioun;
    if($unioun!=$sonod->unioun_name){
        $unionname = Uniouninfo::where('short_name_e',$sonod->unioun_name)->first();
           $unionname2 = Uniouninfo::where('short_name_e',$unioun)->first();
        return "আপনি $unionname->full_name এর তথ্য $unionname2->full_name থেকে অনুমোদন করতে পারবেন না";
    }
    $position = $user->position;
    if($position=='Secretary'){
        return "সচিব এই এড্রেসটি অ্যাক্সেস করতে পারবে না <a href='/dashboard/logout$redirecturl'>Logout</a>";
    }



        $enname= str_replace("_", " ",sonodEnName($sonod->sonod_name));

            $sonodnamedata =  Sonodnamelist::where('enname', $enname)->first();

        // return Sonodnamelist::all();


        $role = 'Chairman';
        $Secretary_pay = '';
        if($sonod->stutus=='Secretary_approved'){


            return view('chairemanapprove',compact('sonod','sonodnamedata','role','Secretary_pay'));

        }elseif($sonod->stutus=='approved'){
            if($sonod->payment_status=='Paid'){
                $Secretary_pay = 'Secretary_pay';
                return view('chairemanapprove',compact('sonod','sonodnamedata','role','Secretary_pay'));
            }
            return 'সনদটি ইতিমধ্যে চেয়ারম্যান কর্তৃক অনুমোদিত হয়েছে';
        }else{
            return 'সনদটি এখনো সচিব এর প্যানেল এ আছে';

        }

    }


    public function SecretariNotificationApprove($id)
    {

        $redirecturl = "?redirect=".url('/secretary/approve/'.$id);

        if(!Auth::user()){
            return redirect('/login'.$redirecturl);
        }
     $user = Auth::user();

     $sonod= Sonod::find($id);
     $unioun = $user->unioun;
    if($unioun!=$sonod->unioun_name){
        $unionname = Uniouninfo::where('short_name_e',$sonod->unioun_name)->first();
           $unionname2 = Uniouninfo::where('short_name_e',$unioun)->first();
        return "আপনি $unionname->full_name এর তথ্য $unionname2->full_name থেকে অনুমোদন করতে পারবেন না";
    }
    $position = $user->position;
    if($position=='Chairman'){
        return "চেয়ারম্যান এই এড্রেসটি অ্যাক্সেস করতে পারবে না <a href='/dashboard/logout$redirecturl'>Logout</a>";
    }



        $enname= str_replace("_", " ",sonodEnName($sonod->sonod_name));

            $sonodnamedata =  Sonodnamelist::where('enname', $enname)->first();

        // return Sonodnamelist::all();

        $role = 'Secretary';
        $Secretary_pay = '';

        if($sonod->stutus=='Pending'){


            return view('chairemanapprove',compact('sonod','sonodnamedata','role','Secretary_pay'));



        }elseif($sonod->stutus=='approved'){
            if($sonod->payment_status=='Paid'){
                $Secretary_pay = 'Secretary_pay';
                return view('chairemanapprove',compact('sonod','sonodnamedata','role','Secretary_pay'));
            }
            return 'সনদটি ইতিমধ্যে চেয়ারম্যান কর্তৃক অনুমোদিত হয়েছে';
        }else{
            return 'সনদটি চেয়ারম্যান এর প্যানেল এ আছে';

        }

    }




    public function SecretariNotificationPay($id)
    {

        $redirecturl = "?redirect=".url('/secretary/pay/'.$id);

        if(!Auth::user()){
            return redirect('/login'.$redirecturl);
        }
     $user = Auth::user();

     $sonod= Sonod::find($id);
     $unioun = $user->unioun;
    if($unioun!=$sonod->unioun_name){
        $unionname = Uniouninfo::where('short_name_e',$sonod->unioun_name)->first();
           $unionname2 = Uniouninfo::where('short_name_e',$unioun)->first();
        return "আপনি $unionname->full_name এর তথ্য $unionname2->full_name থেকে অনুমোদন করতে পারবেন না";
    }
    $position = $user->position;
    if($position=='Chairman'){
        return "চেয়ারম্যান এই এড্রেসটি অ্যাক্সেস করতে পারবে না <a href='/dashboard/logout$redirecturl'>Logout</a>";
    }



        $enname= str_replace("_", " ",sonodEnName($sonod->sonod_name));

            $sonodnamedata =  Sonodnamelist::where('enname', $enname)->first();

        // return Sonodnamelist::all();

        $role = 'Secretary';
        $Secretary_pay = 'Secretary_pay';

        if($sonod->stutus=='approved'){


            return view('chairemanapprove',compact('sonod','sonodnamedata','role','Secretary_pay'));



        }elseif($sonod->stutus=='approved'){
            return 'সনদটি ইতিমধ্যে চেয়ারম্যান কর্তৃক অনুমোদিত হয়েছে';
        }else{
            return 'সনদটি এখনো চেয়ারম্যান এর প্যানেল এ আছে';

        }

    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function enBnName($data)
    {
        $data =  str_replace("_", " ", $data);
        return Sonodnamelist::where('enname', $data)->first();
    }
    public function index(Request $request)
    {





        $sonod_name = $request->sonod_name;
        $stutus = $request->stutus;
        $word_number = $request->word;
        $unioun = $request->unioun;

        $payment_status = $request->payment_status;
        $unioun_name = $request->unioun_name;
        $sondId = $request->id_no;
        $userid = $request->userid;

        if ($sondId) {





            $where = ['status'=>"$stutus",'sonod_name'=>"$sonod_name"];
            if($stutus=='processing'){
                $where['id_of_the_investigating_officer'] = $userid;
            }

        return aplication::where($where)
        ->where(function ($q)  use ($sondId) {
            $q->  orWhere('appicant_name', 'like', "%$sondId%")
            ->orWhere('licence_no', 'like', "%$sondId%")
            ->orWhere('mobile_number', 'like', "%$sondId%");
        })
        ->paginate(20);




            // return $sondId;
            // return 'sss';
            // return aplication::where(['status'=>$stutus])->where("id_no", "LIKE", "%$sondId%")->orderBy('id', 'DESC')->paginate(20);
        }
        if ($unioun_name) {

            if ($payment_status) {

                $where = ['status'=>$stutus,'sonod_name'=>"$sonod_name"];
                if($stutus=='processing'){
                    $where['id_of_the_investigating_officer'] = $userid;
                }
                return aplication::where($where)->orderBy('id', 'DESC')->paginate(20);
            }
            $where = ['status'=>$stutus,'sonod_name'=>"$sonod_name"];
            if($stutus=='processing'){
                $where['id_of_the_investigating_officer'] = $userid;
            }
            return aplication::where($where)->orderBy('id', 'DESC')->paginate(20);
        }


        $dataType = $request->dataType;

        if($dataType){
            $where = ['status'=>$stutus,'sonod_name'=>"$sonod_name"];
            if($stutus=='processing'){
                $where['id_of_the_investigating_officer'] = $userid;
            }

            $sonods =  aplication::where($where);

            $from = $request->from;
            $to = $request->to;

            if($dataType=='month'){
                $month = $request->month;
                $year = date('Y');

                $startDate = Carbon::createFromFormat('Y-m-d', $year.'-'.Carbon::parse($month)->format('m').'-01');

                  $to = $startDate->copy()->endOfMonth();
                  $from =  $startDate->toDateString();

            }
            $sonods->whereBetween('date_of_birth', [$from, $to]);

            return $sonods->orderBy('id', 'DESC')->paginate(20);

        }


        $where = ['status'=>$stutus,'sonod_name'=>"$sonod_name"];
        if($stutus=='processing'){
            $where['id_of_the_investigating_officer'] = $userid;
        }


        return aplication::where($where)->orderBy('id', 'DESC')->paginate(20);

    }
    public function sonodDownload(Request $request, $name, $id)
    {
       $row = Sonod::find($id);
        $sonod_name = $row->sonod_name;
        $sonod = Sonodnamelist::where('bnname', $row->sonod_name)->first();
        $uniouninfo = Uniouninfo::where('short_name_e', $row->unioun_name)->first();
        $sonodnames = Sonodnamelist::where(['bnname' => $row->sonod_name])->first();
        // return view('sonod',compact('row','sonod','uniouninfo'));
        $EnsonodName = str_replace(" ", "_", $sonodnames->enname);
        if ($sonod_name == 'ওয়ারিশান সনদ' || $sonod_name == 'উত্তরাধিকারী সনদ') {
            $filename = "$EnsonodName-$row->sonod_Id.pdf";
            // return $this->pdfHeader($id,$filename);
            // $pdf = LaravelMpdf::loadView('utsonod', compact('row', 'sonod', 'uniouninfo'));
            // return $pdf->stream("$EnsonodName-$row->sonod_Id.pdf");
            $mpdf = new \Mpdf\Mpdf([
                'default_font_size' => 12,
                'default_font' => 'bangla',
                'mode' => 'utf-8',
                'format' => 'A4',
                'setAutoTopMargin' => 'stretch',
                'setAutoBottomMargin' => 'stretch'
            ]);
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->SetHTMLHeader($this->pdfHeader($id, $filename));
            $mpdf->SetHTMLFooter($this->pdfFooter($id, $filename));
            // $mpdf->SetHTMLHeader('Document Title|Center Text|{PAGENO}');
            $mpdf->defaultheaderfontsize = 10;
            $mpdf->defaultheaderfontstyle = 'B';
            $mpdf->defaultheaderline = 0;
            $mpdf->defaultfooterfontsize = 10;
            $mpdf->defaultfooterfontstyle = 'BI';
            $mpdf->defaultfooterline = 0;
            $mpdf->showWatermarkImage = true;
            // $mpdf->WriteHTML('<watermarkimage src="'.$watermark.'" alpha="0.1" size="80,80" />');
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($this->pdfHTMLut($id, $filename));
            $mpdf->useSubstitutions = false;
            $mpdf->simpleTables = true;
            $mpdf->Output($filename, 'I');
        } else {



            // return view('sonod', compact('row', 'sonod', 'uniouninfo'));
            $pdf = LaravelMpdf::loadView('sonod', compact('row', 'sonod', 'uniouninfo','sonodnames'));
            return $pdf->stream("$EnsonodName-$row->sonod_Id.pdf");
        }
    }
    public function invoice(Request $request, $name, $id)
    {
        $row = Sonod::find($id);
        $row->unioun_name;
        $sonod = Sonodnamelist::where('bnname', $row->sonod_name)->first();
        $uniouninfo = Uniouninfo::where('short_name_e', $row->unioun_name)->first();
        $sonodnames = Sonodnamelist::where(['bnname' => $row->sonod_name])->first();
        $EnsonodName = str_replace(" ", "_", $sonodnames->enname);
        if ($name == 'c') {
            $pdf = LaravelMpdf::loadView('cinvoice', compact('row', 'sonod', 'uniouninfo'));
            $pdf->stream("$EnsonodName-$row->sonod_Id.pdf");
        } else {
            $pdf = LaravelMpdf::loadView('invoice', compact('row', 'sonod', 'uniouninfo'));
            $pdf->stream("$EnsonodName-$row->sonod_Id.pdf");
        }

    }

    public function TikaLogFun($row,$filter=[])
    {
        $bcgcount = TikaLog::where($filter)->count();
        $bcg = '';
        if($bcgcount>0){
            $bcg = TikaLog::where($filter)->first();
        }else{
            $bcg = ['tikaDate'=>date('d-m-Y'),'nextTikaDate'=>date('d-m-Y')];
            $bcg = json_decode(json_encode($bcg));

        }
        return $bcg;

    }

    public function userDocument(Request $request, $name, $id)
    {

        ini_set('max_execution_time', '60000');
        ini_set("pcre.backtrack_limit", "5000000000000000050000000000000000");
        ini_set('memory_limit', '12008M');



         $row = Sonod::find($id);
        $date_of_birth = $row->date_of_birth;



         $TikaDetials =  TikaLog::where(['applicantId'=>$row->id,'tikadose'=> '১ম বার'])->first();

          $bcgFirstDose =  TikaLog::where(['applicantId'=>$row->id,'tikadose'=> '১ম বার','tikaname'=> 'বিসিজি'])->first();
          $bcgSecondDose =  TikaLog::where(['applicantId'=>$row->id,'tikadose'=> '২য় বার','tikaname'=> 'বিসিজি'])->first();
          $bcgThirdDose =  TikaLog::where(['applicantId'=>$row->id,'tikadose'=> '৩য় বার','tikaname'=> 'বিসিজি'])->first();
          $bcgFourthDose =  TikaLog::where(['applicantId'=>$row->id,'tikadose'=> '৪র্থ বার','tikaname'=> 'বিসিজি'])->first();
          $bcgFifthDose =  TikaLog::where(['applicantId'=>$row->id,'tikadose'=> '৫ম বার','tikaname'=> 'বিসিজি'])->first();

         $firstDose =  TikaLog::where(['applicantId'=>$row->id,'tikadose'=> '১ম বার'])->where('tikaname','!=', 'বিসিজি')->select('tikadose','tikaDate','nextTikaDate')->distinct()->first();
        $secondDose =  TikaLog::where(['applicantId'=>$row->id,'tikadose'=> '২য় বার'])->where('tikaname','!=', 'বিসিজি')->select('tikadose','tikaDate','nextTikaDate')->distinct()->first();
        $thirthDose =  TikaLog::where(['applicantId'=>$row->id,'tikadose'=> '৩য় বার'])->where('tikaname','!=', 'বিসিজি')->select('tikadose','tikaDate','nextTikaDate')->distinct()->first();
        $fourthDose =  TikaLog::where(['applicantId'=>$row->id,'tikadose'=> '৪র্থ বার'])->where('tikaname','!=', 'বিসিজি')->select('tikadose','tikaDate','nextTikaDate')->distinct()->first();
        $fifthDose =  TikaLog::where(['applicantId'=>$row->id,'tikadose'=> '৫ম বার'])->where('tikaname','!=', 'বিসিজি')->select('tikadose','tikaDate','nextTikaDate')->distinct()->first();



        $firstDoseDate = date('Y-m-d', strtotime('+42 day', strtotime($date_of_birth)));

        // $secondDoseDate = date('Y-m-d', strtotime('+42 day', strtotime($date_of_birth)));
        // $thirthDoseDate = date('Y-m-d', strtotime('+42 day', strtotime($date_of_birth)));

        $fourthDoseDate = date('Y-m-d', strtotime('+270 day', strtotime($date_of_birth)));
        $fifthDoseDate = date('Y-m-d', strtotime('+450 day', strtotime($date_of_birth)));




        //  $bcg = $this->TikaLogFun($row,['applicantId'=>$row->id,'tikaname'=>'বিসিজি','tikadose'=>'১ম বার']);
        //  $penta = $this->TikaLogFun($row,['applicantId'=>$row->id,'tikaname'=>'পেন্টা (ডিপিটি, হেপ-বি, হিব)','tikadose'=>'১ম বার']);
        //  $opv = $this->TikaLogFun($row,['applicantId'=>$row->id,'tikaname'=>'ওপিভি','tikadose'=>'১ম বার']);
        //  $pcv = $this->TikaLogFun($row,['applicantId'=>$row->id,'tikaname'=>'পিসিভি','tikadose'=>'১ম বার']);
        //  $ipv = $this->TikaLogFun($row,['applicantId'=>$row->id,'tikaname'=>'আইপিভি','tikadose'=>'১ম বার']);
        //  $mr = $this->TikaLogFun($row,['applicantId'=>$row->id,'tikaname'=>'এমআর','tikadose'=>'১ম বার']);
        //  $mrHam = $this->TikaLogFun($row,['applicantId'=>$row->id,'tikaname'=>'এমআর (হাম ও রুবেলা)','tikadose'=>'১ম বার']);


            // return view('userdocument',compact('row'));
            // return view('card',compact('row'));


            $pdf = LaravelMpdf::loadView('card', compact('row','firstDose','secondDose','thirthDose','fourthDose','fifthDose','TikaDetials','bcgFirstDose','bcgSecondDose','bcgThirdDose','bcgFourthDose','bcgFifthDose','firstDoseDate','fourthDoseDate','fifthDoseDate'));
            return $pdf->stream("$row->id_no.pdf");

    }
    public function userinformation(Request $request, $name, $id)
    {
        $row = Sonod::find($id);


            // return view('userdocument',compact('row'));
            $pdf = LaravelMpdf::loadView('userinformation', compact('row'));
            return $pdf->stream("$row->id_no.pdf");

    }
    public function sonod_search(Request $request)
    {
        $sonodcount =  aplication::where(['licence_no' => $request->sonod_Id, 'status' => 'approved'])->count();
        if ($sonodcount > 0) {
            $sonod =  aplication::where(['licence_no' => $request->sonod_Id, 'status' => 'approved'])->first();
            $sonod['sonodUrl'] = "/license/$sonod->id";
            $sonod['searchstatus'] = "approved";
            return  $sonod;
        } else {
            $sonodcountall =  aplication::where(['licence_no' => $request->sonod_Id])->count();
            if ($sonodcountall > 0) {
                $sonod =   aplication::where(['licence_no' => $request->sonod_Id])->first();
                $sonod['searchstatus'] = "all";
                return $sonod;
            }
        }
        return 0;
    }
    public function singlesonod(Request $request, $id)
    {
        $admin = $request->admin;
        if($admin){
            $sonod =  aplication::find($id);

            $sonod['image'] = asset($sonod->image);
            $sonod['applicant_national_id_front_attachment'] = asset($sonod->applicant_national_id_front_attachment);
            $sonod['applicant_national_id_back_attachment'] = asset($sonod->applicant_national_id_back_attachment);
            $sonod['applicant_birth_certificate_attachment'] = asset($sonod->applicant_birth_certificate_attachment);

           return $data = [
                'sonod'=>$sonod,

            ];
        }

        return aplication::find($id);
    }
    public function totlaAmount(Request $request)
    {
        $union = $request->union;
        if ($union) {
            return Payment::where(['status' => 'Paid', 'union' => $union])->sum('amount');
        } else {
            return Payment::where('status', 'Paid')->sum('amount');
        }
    }
    public function counting(Request $request, $status)
    {
        $union = $request->union;
        if ($union) {
            if ($status == 'all') {
                return  Sonod::where('stutus', '!=', 'Prepaid')->where(['unioun_name' => $union])->count();
            }
            return  Sonod::where(['stutus' => $status, 'unioun_name' => $union])->count();
        }
        if ($status == 'all') {
            return  Sonod::where('stutus', '!=', 'Prepaid')->count();
        }
        return  Sonod::where(['stutus' => $status])->count();
    }
    public function niddob(Request $request)
    {
        $applicant_national_id_number = $request->applicant_national_id_number;
        $applicant_birth_certificate_number = $request->applicant_birth_certificate_number;
        if ($applicant_national_id_number) {
            return   $citizen = Citizen::where(['nidno' => $applicant_national_id_number])->count();
        }
        if ($applicant_birth_certificate_number) {
            return   $citizen = Citizen::where(['dobno' => $applicant_birth_certificate_number])->count();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sonod  $sonod
     * @return \Illuminate\Http\Response
     */
    public function show(Sonod $sonod)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sonod  $sonod
     * @return \Illuminate\Http\Response
     */
    public function edit(Sonod $sonod)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sonod  $sonod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sonod $sonod)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sonod  $sonod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sonod $sonod)
    {
        //
    }
    public function pdfHeader($id, $filename)
    {
        $row = Sonod::find($id);
        $sonod_name = $row->sonod_name;
        $sonod = Sonodnamelist::where('bnname', $row->sonod_name)->first();
        $uniouninfo = Uniouninfo::where('short_name_e', $row->unioun_name)->first();
        $sonodnames = Sonodnamelist::where(['bnname' => $row->sonod_name])->first();
        // return view('sonod',compact('row','sonod','uniouninfo'));
        $EnsonodName = str_replace(" ", "_", $sonodnames->enname);
        $w_list = $row->successor_list;
        $w_list = json_decode($w_list);
        $pdfHead = '';
        $ssName = '  <div class="nagorik_sonod" style="margin-bottom:10px;">
                <div style="
                background-color: #159513;
                color: #fff;
                font-size: 30px;
                border-radius: 30em;
                width:320px;
                margin:10px auto;
                margin-bottom:0px;
                text-align:center
                ">' . $sonod_name . '</div> <br>
                ';

        $output = '
          ' . $pdfHead . '
              <table width="100%" style="border-collapse: collapse;" border="0">
                  <tr>
                      <td style="text-align: center;" width="20%">
					  <span style="color:#b400ff;"><b>
					  উন্নয়নের গণতন্ত্র,  <br /> শেখ হাসিনার মূলমন্ত্র </b>

					  </span>
                      </td>
                      <td style="text-align: center;" width="20%">
                          <img width="70px" src="' . base64('backend/bd-logo.png') . '">
                      </td>
                      <td style="text-align: center;" width="20%">';
        //   if ($Sname == 'successor_apps' || $Sname == 'ut') {}else{
        // 	     $output .= '<img width="100px" src="' . $logoPofile . '">';
        //   }
        $output .= '</td>
                  </tr>
                  <tr style="margin-top:2px;margin-bottom:2px;">
                      <td>
                      </td>
                      <td style="text-align: center;" width="50%">
                          <p style="font-size:20px">গণপ্রজাতন্ত্রী বাংলাদেশ</p>
                          <p style="font-size:25px">চেয়ারম্যানের কার্যালয়</p>

                      </td>
                      <td>
                      </td>
                  </tr>
                  <tr style="margin-top:0px;margin-bottom:0px;">
                      <td>
                      </td>
                      <td style="margin-top:0px; margin-bottom:0px; text-align: center;" width=50%>
                          <h1 style="color: #7230A0; margin: 0px; font-size: 28px">' . $uniouninfo->full_name . '</h3>
                      </td>
                      <td>
                      </td>
                  </tr>
                  <tr style="margin-top:2px;margin-bottom:2px;">
                      <td>
                      </td>
                      <td style="text-align: center; " width="50%">

                          <p style="font-size:20px">উপজেলা: ' . $uniouninfo->thana . ', জেলা: ' . $uniouninfo->district . ' ।</p>
                      </td>
                      <td>
                      </td>
                  </tr>
  </table>
                ' . $ssName . '
        ';
        return $output;
    }
    public function pdfFooter($id, $filename)
    {
        $row = Sonod::find($id);
        $sonod_name = $row->sonod_name;
        $sonod = Sonodnamelist::where('bnname', $row->sonod_name)->first();
        $uniouninfo = Uniouninfo::where('short_name_e', $row->unioun_name)->first();
        $sonodnames = Sonodnamelist::where(['bnname' => $row->sonod_name])->first();
        // return view('sonod',compact('row','sonod','uniouninfo'));
        $EnsonodName = str_replace(" ", "_", $sonodnames->enname);
        $sonodNO = ' <div class="signature text-center position-relative">
সনদ নং: ' .  int_en_to_bn($row->sonod_Id) . ' <br /> ইস্যুর তারিখ: </div>';




$C_color = '#7230A0';
$C_size = '18px';
$color = 'black';
if($row->unioun_name=='dhamor'){
    $C_color = '#5c1caa';
    $C_size = '20px';
    $color = '#5c1caa';
}


            $ccc = '<img width="170px"  src="' . base64($row->chaireman_sign) . '"><br/>
                              <b><span style="color:'.$C_color.';font-size:'.$C_size.';">' . $row->chaireman_name . '</span> <br />
                                      </b><span style="font-size:16px;">চেয়ারম্যান</span><br />';



         $qrurl = url("/verification/sonod/$row->id?sonod_name=$sonod->enname&sonod_Id=$row->sonod_Id");

        // $qrurl = url("/verification/sonod/$row->id");
        //in Controller
        $qrcode = \QrCode::size(70)
            ->format('svg')
            ->generate($qrurl);
        $output = '
        <table width="100%" style="border-collapse: collapse;" border="0">
                              <tr>
                                  <td  style="text-align: center;" width="40%">
                             <div class="signature text-center position-relative">
                                      ' . $qrcode . '<br/>
                                       ' . $sonodNO . '
                                    </div>
                                  </td>
                                  <td style="text-align: center; width: 200px;" width="30%">
                                      <img width="100px" src="' . base64($uniouninfo->sonod_logo) . '">
                                  </td>
                                  <td style="text-align: center;" width="40%">
                                      <div class="signature text-center position-relative" style="color:'.$color.'">

                                      ' . $ccc . $uniouninfo->full_name . ' <br> ' . $uniouninfo->thana . ', ' . $uniouninfo->district . ' ।
                                      <br/>
                                      '. $row->c_email.'

                                      </div>
                                  </td>
                              </tr>
                          </table>
                            <p style="background: #787878;
            color: white;
            text-align: center;
            padding: 2px 2px;font-size: 16px;     margin-top: 0px;" class="m-0">"সময়মত ইউনিয়ন কর পরিশোধ করুন। ইউনিয়নের উন্নয়নমূক কাজে সহায়তা করুন"</p>
                            <p class="m-0" style="font-size:14px;text-align:center">ইস্যুকৃত সনদটি যাচাই করতে QR কোড স্ক্যান করুন অথবা ভিজিট করুন ' . $uniouninfo->domain . '</p>
                      </div>
                  </div>
              </div>

              ';

            //   <div class="nagorik_sonod" style="margin-bottom:10px;">
            //   <div style="
            //   background-color: black;
            //   color: white;
            //   font-size: 16px;
            //   border-radius: 30em;
            //   width:100px;
            //   margin:10px auto;
            //   text-align:center
            //   "> পাতা- '.int_en_to_bn("{PAGENO}").' </div>

            //             </div>

        $output = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $output);
        return $output;
    }
    public function pdfHTMLut($id, $filename)
    {
        $row = Sonod::find($id);
        $sonod_name = $row->sonod_name;
        if ($sonod_name == 'ওয়ারিশান সনদ') {
            $text = 'ওয়ারিশ/ওয়ারিশগণের নাম ও সম্পর্ক';
        } else {
            $text = 'উত্তরাধিকারীগণের নাম ও সম্পর্ক';
        }
        $sonod = Sonodnamelist::where('bnname', $row->sonod_name)->first();
        $uniouninfo = Uniouninfo::where('short_name_e', $row->unioun_name)->first();
        $sonodnames = Sonodnamelist::where(['bnname' => $row->sonod_name])->first();
        // return view('sonod',compact('row','sonod','uniouninfo'));
        $EnsonodName = str_replace(" ", "_", $sonodnames->enname);
        $sonodurl = 'https://' . $_SERVER['HTTP_HOST'] . '/pdf/download' . '/' . $id;
        //in Controller
        $qrcode = \QrCode::size(70)
            ->format('svg')
            ->generate($sonodurl);
        $w_list = $row->successor_list;
        $w_list = json_decode($w_list);


$nagoriinfo = '';




if ($sonod_name == 'ওয়ারিশান সনদ') {
        $nagoriinfo .= '
            <p style="margin-top:0px;margin-bottom:5px;font-size:15px;text-align:justify">&nbsp; &nbsp; &nbsp; এই মর্মে প্রত্যয়ন করা যাচ্ছে যে, মরহুম ' . $row->utname . ', পিতা/স্বামী- ' . $row->ut_father_name . ', মাতা- ' . $row->ut_mother_name . ', গ্রাম- ' . $row->ut_grame . ', ডাকঘর- ' . $row->ut_post . ', উপজেলা: ' . $row->ut_thana . ', জেলা- ' . $row->ut_district . '। তিনি অত্র ইউনিয়নের '.int_en_to_bn($row->ut_word).' নং ওয়ার্ডের '.$row->applicant_resident_status.' বাসিন্দা ছিলেন। মৃত্যুকালে তিনি নিম্নোক্ত ওয়ারিশগণ রেখে যান। নিম্নে তাঁর ওয়ারিশ/ওয়ারিশগণের নাম ও সম্পর্ক উল্লেখ করা হলো।<br>
            <br>

            &nbsp; &nbsp; &nbsp; আমি মরহুমের বিদেহী আত্মার মাগফেরাত কামনা করি।
                </p>';
            } else {

            $nagoriinfo .= '
            <p style="margin-top:0px;margin-bottom:5px;font-size:15px;text-align:justify">&nbsp; &nbsp; &nbsp; এই মর্মে প্রত্যয়ন করা যাচ্ছে যে, জনাব ' . $row->utname . ', পিতা/স্বামী- ' . $row->ut_father_name . ', মাতা- ' . $row->ut_mother_name . ', গ্রাম- ' . $row->ut_grame . ', ডাকঘর- ' . $row->ut_post . ', উপজেলা: ' . $row->ut_thana . ', জেলা- ' . $row->ut_district . '। তিনি অত্র ইউনিয়নের '.int_en_to_bn($row->ut_word).' নং ওয়ার্ডের '.$row->applicant_resident_status.' বাসিন্দা। নিম্নে তাঁর উত্তরাধিকারী/উত্তরাধিকারীগণের নাম ও সম্পর্ক উল্লেখ করা হলো।<br>
            <br>


                </p>';



            }









 $nagoriinfo .= '<h4 style="text-align:center;margin-bottom:0px">' . $text . '</h4>
<table class="table " style="width:100%;border-collapse: collapse;" cellspacing="0" cellpadding="0"  >
<tr>
  <th style="        border: 1px dotted black;
        padding:4px 10px;
        font-size: 12px;" width="10%">ক্রমিক নং</th>
  <th style="        border: 1px dotted black;
        padding:4px 10px;
        font-size: 12px;" width="30%">নাম</th>
  <th style="        border: 1px dotted black;
        padding:4px 10px;
        font-size: 12px;" width="10%">সম্পর্ক</th>
  <th style="        border: 1px dotted black;
        padding:4px 10px;
        font-size: 12px;" width="10%">বয়স</th>
  <th style="        border: 1px dotted black;
        padding:4px 10px;
        font-size: 12px;" width="20%">জাতীয় পরিচয়পত্র নাম্বার/জন্মনিবন্ধন নাম্বার</th>
</tr>';
        $i = 1;
        foreach ($w_list as $rowList) {
            $nagoriinfo .= '
    <tr>
      <td style="text-align:center;        border: 1px dotted black;
        padding:4px 10px;
        font-size: 12px;">' . int_en_to_bn($i) . '</td>
      <td style="text-align:center;        border: 1px dotted black;
        padding:4px 10px;
        font-size: 12px;">' . $rowList->w_name . '</td>
      <td style="text-align:center;        border: 1px dotted black;
        padding:4px 10px;
        font-size: 12px;">' . $rowList->w_relation . '</td>
      <td style="text-align:center;        border: 1px dotted black;
        padding:4px 10px;
        font-size: 12px;">' . int_en_to_bn($rowList->w_age) . '</td>
      <td style="text-align:center;        border: 1px dotted black;
        padding:4px 10px;
        font-size: 12px;">' . int_en_to_bn($rowList->w_nid) . '</td>
    </tr>';
            $i++;
        }
        $nagoriinfo .= '
</table>
<br>
<p style="margin-top:-10px;margin-bottom:5px">
আবেদনকারীর নামঃ '.$row->applicant_name.'।  পিতা/স্বামীর নামঃ '.$row->applicant_father_name.'।  মাতার নামঃ '.$row->applicant_mother_name.'
</p><br>

<p style="margin-top:-10px;margin-bottom:5px">
সংশ্লিষ্ট ওয়ার্ডের ইউপি সদস্য কর্তৃক আবেদনকারীর দাখিলকৃত তথ্য যাচাই/সত্যায়নের পরিপ্রেক্ষিতে অত্র সনদপত্র প্রদান করা হলো।
</p> <br/>
<p style="margin-top:-10px; margin-bottom:0px">
&nbsp; &nbsp; &nbsp; আমি তাঁর/তাঁদের সর্বাঙ্গীন উন্নতি ও মঙ্গল কামনা করছি।
</p>
';

        $output = ' ';
        $output .= '' . $nagoriinfo . '';
        return $output;
    }




    public function verifysonodId(Request $request)
    {

        $sonod_Id = $request->sonod_Id;


        return aplication::where(['licence_no'=>$sonod_Id])->first();

        // return $request->all();
    }


    public function tikaCreate($id_no)
    {
        // return $id_no;

        $sonodCount = Sonod::where('id_no',$id_no)->count();

        if($sonodCount>0){
            return Sonod::where('id_no',$id_no)->first();
        }

        return 0;
    }



    public function ReportDownload(Request $request)
    {
        $stutus = $request->stutus;
        $word_number = $request->word;
        $unioun = $request->unioun;
        $dataType = $request->dataType;
        if($dataType){
            $sonods =  Sonod::where(['status'=>$stutus,'word_number'=>$word_number,'union'=>$unioun]);
            $from = $request->from;
            $to = $request->to;
            if($dataType=='month'){
                $month = $request->month;
                $year = date('Y');
                $startDate = Carbon::createFromFormat('Y-m-d', $year.'-'.Carbon::parse($month)->format('m').'-01');

                  $to = $startDate->copy()->endOfMonth();
                  $from =  $startDate->toDateString();
            }
            $sonods->whereBetween('date_of_birth', [$from, $to]);
           $rows =   $sonods->orderBy('id', 'DESC')->get();

                    //  return $rows;

                     $pdf = LaravelMpdf::loadView('sonod.sonodReports', compact('rows','from','to'));
                     return $pdf->stream("5555.pdf");

        }



    }



    public function statusChange(Request $request,$status,$id)
    {
        $approved_date = date('Y-m-d H:i:s');
        $aplication = aplication::find($id);


        if($status=='approved'){

            $patmenturl = asset("/l/f/$id?f=l");

            if($aplication->sonod_name=='নলকূপ লাইসেন্স'){
                $des = "অনলাইন সেচ সেবায় আপনার আবেদনটি অনুমোদিত হয়েছে। লাইসেন্স প্রাপ্তির জন্য লিংকে গিয়ে নির্ধারিত ফি পরিশোধ করুন $patmenturl";
            }else{
                $des = "অনলাইন ভবনের নকশা সেবায় আপনার আবেদনটি অনুমোদিত হয়েছে। লাইসেন্স প্রাপ্তির জন্য লিংকে গিয়ে নির্ধারিত ফি পরিশোধ করুন $patmenturl";
            }


              $mobile = int_bn_to_en($aplication->mobile_number);
            SmsNocSmsSend($des,"$mobile");
         }

         if($request->id_of_the_investigating_officer){
            $updatedData = ['status'=>$status,'approved_date'=>$approved_date,'id_of_the_investigating_officer'=>$request->id_of_the_investigating_officer];
        }else{

            $updatedData = ['status'=>$status,'approved_date'=>$approved_date];
         }




         $aplication->update($updatedData);




    }




}
