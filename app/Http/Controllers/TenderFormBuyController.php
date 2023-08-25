<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use App\Models\Payment;
use App\Models\Uniouninfo;
use Illuminate\Http\Request;
use App\Models\TenderFormBuy;
use App\Models\TenderList;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;
use Rakibhstu\Banglanumber\NumberToBangla;

class TenderFormBuyController extends Controller
{

    function tenderformBuyList($tender_id) {
        return TenderFormBuy::where(['tender_id'=>$tender_id,'status'=>'Paid'])->get();
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
       $tender_id = $request->tender_id;
       $name = $request->name;
       $PhoneNumber = $request->PhoneNumber;

       $form_code = mt_rand(1000000, 9999999);

       $datas = [
            'tender_id'=>$tender_id,
            'nidNo'=>$request->nidNo,
            'nidDate'=>$request->nidDate,
            'name'=>$name,
            'applicant_org_fatherName'=>$request->applicant_org_fatherName,
            'vill'=>$request->vill,
            'postoffice'=>$request->postoffice,
            'thana'=>$request->thana,
            'distric'=>$request->distric,
            'PhoneNumber'=>$PhoneNumber,
            'form_code'=>$form_code,
            'status'=>'Unpaid',
       ];
       $tenderformbuy = TenderFormBuy::create($datas);

       return redirect("/tenders/payment/$tenderformbuy->id");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TenderFormBuy  $tenderFormBuy
     * @return \Illuminate\Http\Response
     */
    public function show(TenderFormBuy $tenderFormBuy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TenderFormBuy  $tenderFormBuy
     * @return \Illuminate\Http\Response
     */
    public function edit(TenderFormBuy $tenderFormBuy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TenderFormBuy  $tenderFormBuy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TenderFormBuy $tenderFormBuy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TenderFormBuy  $tenderFormBuy
     * @return \Illuminate\Http\Response
     */
    public function destroy(TenderFormBuy $tenderFormBuy)
    {
        //
    }


    function tenderFormPaymentSuccess(Request $request){


        $transId =  $request->transId;
        $payment = Payment::where(['trxId' => $transId])->first();
        $id = $payment->sonodId;
        $sonod = TenderFormBuy::find($id);






                    if($payment->status=='Paid'){
                        $deccription = "Congratulation! Your Tender form no is $sonod->form_code has been Paid.";
                        return view('tenderSuccess', compact('payment', 'sonod'));
                    }else{
                    echo "
                    <div style='text-align:center'>
                    <h1 style='text-align:center'>Payment Failed</h1>
                    <a href='/' style='border:1px solid black;padding:10px 12px; background:red;color:white'>Back To Home</a>
                    <a href='/sonod/payment/$sonod->id' style='border:1px solid black;padding:10px 12px; background:green;color:white'>Pay Again</a>
                    </div>
                    ";
                    }


    }



    function check_form_code(Request $request){
        $form_code = $request->form_code;
      $tenderformbuy = TenderFormBuy::where(['form_code'=>$form_code,'status'=>'Paid'])->first();
      if($tenderformbuy){
        return 1;
      }else{
        return 0;
      }

    }






    public function invoice(Request $request, $id)
    {
        $row = TenderFormBuy::find($id);
        $tenderList = TenderList::find($row->tender_id);
        $uniouninfo = Uniouninfo::where('short_name_e', $tenderList->union_name)->first();
        $payment = Payment::where(['sonodId'=>$id,'sonod_type'=>'Tenders_form','status'=>'Paid'])->first();

        $numto = new NumberToBangla();

        $amountText = $numto->bnMoney($payment->amount) . ' মাত্র';
            $pdf = LaravelMpdf::loadView('tenderSlip', compact('row', 'uniouninfo','payment','amountText'));
            $pdf->stream("$row->form_code.pdf");


    }




}
