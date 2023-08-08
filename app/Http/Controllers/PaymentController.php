<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use App\Models\Payment;
use App\Models\aplication;
use App\Models\TenderList;
use App\Models\Uniouninfo;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Exports\ReportExport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Meneses\LaravelMpdf\Facades\LaravelMpdf;

class PaymentController extends Controller
{


    public function ipn(Request $request)
    {
        Log::info('load');
        $data = $request->all();
        Log::info(json_encode($data));
        $sonod = aplication::find($data['cust_info']['cust_id']);
        $trnx_id = $data['trnx_info']['mer_trnx_id'];
        $payment = payment::where('trxid', $trnx_id)->first();

        $sonod_type = $payment->sonod_type;

        $Insertdata = [];
        if ($data['msg_code'] == '1020') {
            $Insertdata = [
                'status' => 'Paid',
                'method' => $data['pi_det_info']['pi_name'],
            ];

            if($sonod_type=='application_fee'){
                $updateData = ['status' => 'pending'];
                $sonod->update($updateData);
            }elseif($sonod_type=='license_fee'){
                $updateData = ['payment_status' => 'Paid'];
                $sonod->update($updateData);
            }elseif($payment->sonod_type=='Tenders_form'){



                $TenderFormBuy = Tender::find($payment->sonodId);
                $TenderFormBuy->update(['payment_status'=>'Paid']);


                $tenderList = TenderList::find($TenderFormBuy->tender_id);
                $unioun_name = $tenderList->union_name;
                $deccription = "Your Tender Successfuly submited";
                SmsNocSmsSend($deccription, $TenderFormBuy->mobile);



            }else{
                $updateData = ['status' => 'unknown'];
                $sonod->update($updateData);
            }


        } else {
            if($sonod_type=='application_fee'){
                $updateData = ['status' => 'Failed'];
            }elseif($sonod_type=='license_fee'){
                $updateData = ['payment_status' => 'Failed'];
            }else{
                $updateData = ['status' => 'unknown'];

            }
            $sonod->update($updateData);
            $Insertdata = ['status' => 'Failed',];
        }
        $Insertdata['ipnResponse'] = json_encode($data);
        return $payment->update($Insertdata);
    }

    public function export(Request $request)
    {










        //  $request->all();
        $union = $request->union;
        $sonod_type = $request->sonod_type;
        $from = $request->from;
        $to = $request->to;



        if($from && $to){

         $row = Payment::where(['status'=>'Paid'])->whereBetween('date', [$from, $to])->orderBy('id','desc')->get();
        $pdf = LaravelMpdf::loadView('Export',compact('row','from','to'));
        return $pdf->stream("hlsdfhlo.pdf");

        }





    }



    public function Search(Request $request)
    {
        // return $request->all();
        $sonod_type = $request->sonod_type;

        $from = $request->from;
        $to = $request->to;
        $union = $request->union;


            if($from && $to){

                return Payment::where(['status'=>'Paid'])->whereBetween('date', [$from, $to])->orderBy('id','desc')->get();
            }elseif($from){
                return Payment::where(['status'=>'Paid'])->where('date',$from)->orderBy('id','desc')->get();
            }else{

                return Payment::where(['status'=>'Paid'])->orderBy('id','desc')->get();

            }


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
