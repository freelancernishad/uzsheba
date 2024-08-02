<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use App\Models\Payment;
use App\Models\TenderFormBuy;
use App\Models\TenderList;
use App\Models\Uniouninfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Rakibhstu\Banglanumber\NumberToBangla;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;
use Illuminate\Support\Facades\Session;


class TenderListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $union_name = $request->union_name;
        $status = $request->status;
        if($union_name && $status){
            if($status=='all'){

                return TenderList::with(['tenderWorkOrders', 'resolutions'])
                ->where('union_name', $union_name)
                ->where('status', '<>', 'approved') // Exclude status 'approved'
                ->orderBy('id', 'desc')
                ->get();


            }

            return TenderList::with(['tenderWorkOrders','resolutions'])->where(['union_name'=>$union_name,'status'=>$status])->orderBy('id','desc')->get();

        }
        if($union_name){
            return TenderList::with(['tenderWorkOrders','resolutions'])->where('union_name',$union_name)->orderBy('id','desc')->get();
        }


        return TenderList::with(['tenderWorkOrders','resolutions'])->orderBy('id','desc')->get();
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
        $datas = $request->all();
        $random = Str::random(20);

        $datas['tender_sl'] = tenderSl();

        $datas['tender_id'] = time().$random;
        $datas['status'] = 'pending';



        return TenderList::create($datas);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TenderList  $tenderList
     * @return \Illuminate\Http\Response
     */
    public function show(TenderList $tenderList,$id)
    {
        return TenderList::with(['tenderWorkOrders','resolutions'])->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TenderList  $tenderList
     * @return \Illuminate\Http\Response
     */
    public function edit(TenderList $tenderList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TenderList  $tenderList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TenderList $tenderList,$id)
    {
        $datas = $request->all();

        $tenderList = TenderList::find($id);

        $tenderList->update($datas);

         return $tenderList;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TenderList  $tenderList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TenderList $tenderList)
    {
       $tenderList->delete();
       return 1;
    }


    public function viewpdf(Request $request, $tender_id)
    {






        ini_set('max_execution_time', '60000');
        ini_set("pcre.backtrack_limit", "50000000000000000");
        ini_set('memory_limit', '12008M');

        // $pdf = LaravelMpdf::loadView('tender.notice');
        // return $pdf->stream("fghfg.pdf");







        $tender_list_count = TenderList::where('tender_id',$tender_id)->count();
        if($tender_list_count<1){
            return 'No data Found';
        }

        $row = TenderList::where('tender_id',$tender_id)->first();

        $uniouninfo = Uniouninfo::where('short_name_e', $row->union_name)->first();
        $filename = time().".pdf";

        $html = $this->pdfHTMLut($row,$uniouninfo);
        $footer = $this->pdfFooter($row,$uniouninfo, $filename);
        if (!is_null($row->tender_calender_id) && $row->tender_calender_id !== '') {
            $html = hat_bazzar_notice($row->id);
            $footer = hat_bazzar_notice_Footer($row->id);
        }






        // return $this->pdfHTMLut($row,$uniouninfo);
            $mpdf = new \Mpdf\Mpdf([
                'default_font_size' => 11,
                'default_font' => 'bangla',
                'mode' => 'utf-8',
                'format' => 'A4',
                'setAutoTopMargin' => 'stretch',
                'autoMarginPadding' => 8,
                'setAutoBottomMargin' => 'stretch'
            ]);
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->SetHTMLHeader($this->pdfHeader($row,$uniouninfo, $filename));
            $mpdf->SetHTMLFooter($footer);
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

            $mpdf->WriteHTML($html);
            $mpdf->useSubstitutions = false;
            $mpdf->simpleTables = true;
            $mpdf->Output($filename, 'I');

    }

    public function pdfHTMLut($row,$uniouninfo)
    {

        $noticeDate = $row->noticeDate;
        $month = date('m', strtotime('01-07-2023'));
        $MYear = date('Y');
        $Mmonth = date('m');
        $Mdate = date('d');
        if($month>6){

            $meyad = "০১/০৭/".int_en_to_bn($MYear);
            $orthoBotsor = int_en_to_bn($MYear."-".($MYear+1));

        }else{
            $meyad = "০১/০৭/".int_en_to_bn($MYear-1);
            $orthoBotsor = int_en_to_bn($MYear-1 ."-".$MYear);
        }

        $form_price = $row->form_price;

        $numto = new NumberToBangla();
        $the_amount_of_money_in_words = $numto->bnMoney($form_price) . ' মাত্র';


    //     <tr>
    //     <td style='text-align:center'>১</td>
    //     <td style='text-align:center'>".int_en_to_bn(date('d/m/Y h:i', strtotime($row->form_buy_last_date)))."</td>
    //     <td style='text-align:center'>".int_en_to_bn(date('d/m/Y h:i', strtotime($row->tender_start)))."</td>
    //     <td style='text-align:center'>".int_en_to_bn(date('d/m/Y h:i', strtotime($row->tender_end)))."</td>
    //     <td style='text-align:center'>".int_en_to_bn(date('d/m/Y h:i', strtotime($row->tender_open)))."</td>
    // </tr>







        $nagoriinfo = "


        <style>
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


            <p class='mb-0' style='text-align:center;text-weight:900;font-size:30px;margin-top:-100px !important;'><u>নিলাম  দরপত্র বিজ্ঞপ্তি</u></p>


            <p class='mb-0' style='text-align:justify'>
             &nbsp;&nbsp;&nbsp;&nbsp;

              $row->description




</p>







             <table width='100%' border='1' style='border-collapse:collapse;'>

                <tr>
                    <td style='text-align:center' width='25%'>দরপত্র সিডিউল ক্রয়ের তারিখ, শেষ সময় ও স্থান</td>
                    <td style='text-align:center' width='75%'>".int_en_to_bn(date('d/m/Y', strtotime($noticeDate)))." তারিখ হতে ".int_en_to_bn(date('d/m/Y h:i', strtotime($row->form_buy_last_date)))." টা পর্যন্ত <br/> $row->form_buy_address</td>
                </tr>


                <tr>
                    <td style='text-align:center' >দরপত্র দাখিলের নির্ধারিত তারিখ, পদ্ধতি ও স্থান এবং শেষ সময়</td>
                    <td style='text-align:center' >".int_en_to_bn(date('d/m/Y h:i', strtotime($row->tender_start)))." টা হতে ".int_en_to_bn(date('d/m/Y h:i', strtotime($row->tender_end)))." টা পর্যন্ত <br/> $row->tender_submit_role_address</td>
                </tr>


                <tr>
                    <td style='text-align:center' >দরপত্র খোলার তারিখ, সময় ও স্থান</td>
                    <td style='text-align:center'>".int_en_to_bn(date('d/m/Y h:i', strtotime($row->tender_open)))." টা পর্যন্ত<br/> $row->tender_open_address</td>
                </tr>



             </table>";





                //  $nagoriinfo .= "<p class='mb-0' style='text-align:center;text-weight:900;font-size:20px'><u>নিলামকৃত গাছের বিবরণ</u></p>";
                 $nagoriinfo .= "<p class='mb-0' style='text-align:center;text-weight:900;font-size:20px'><u>$row->tender_product_title</u></p>";




             $nagoriinfo .= "

             <div class='roles'>
             ".replacefontfamilly($row->tender_product_Number_Quantity)."
             </div>



             <p class='mb-0' style='text-align:left;text-weight:900;font-size:20px'><u>শর্তাবলী:</u></p>

             <div class='roles'>
             ".replacefontfamilly($row->tender_roles)."
             </div>";

             $nagoriinfo .= '

        <table width="100%" style="border-collapse: collapse;" border="0">
                              <tr>
                                  <td  style="text-align: center;" width="40%"></td>
                                  <td style="text-align: center; width: 200px;" width="30%"></td>
                                  <td style="text-align: center;" width="40%">
                                      <div class="signature text-center position-relative">

                                    সোহাগ চন্দ্র সাহা <br>
                                    উপজেলা নির্বাহী অফিসার <br>
                                    তেঁতুলিয়া, পঞ্চগড়। <br>
                                    ফোন: ০২৫৮৯৯৪২৬০১ <br>
                                    e-mail: unotetulia@mopa.gov.bd
                                      </div>
                                  </td>
                              </tr>
                          </table>

                          <pagebreak>
                          ';





             $nagoriinfo .= "<div class='roles' style='margin-top:40px'>
             $row->other_content
             </div>



        ";



        $nagoriinfo .= '

        <table width="100%" style="border-collapse: collapse;" border="0">
                              <tr>
                                  <td  style="text-align: center;" width="40%"></td>
                                  <td style="text-align: center; width: 200px;" width="30%"></td>
                                  <td style="text-align: center;" width="40%">
                                      <div class="signature text-center position-relative">

                                    সোহাগ চন্দ্র সাহা <br>
                                    উপজেলা নির্বাহী অফিসার <br>
                                    তেঁতুলিয়া, পঞ্চগড়। <br>
                                    ফোন: ০২৫৮৯৯৪২৬০১ <br>
                                    e-mail: unotetulia@mopa.gov.bd
                                      </div>
                                  </td>
                              </tr>
                          </table>
                          ';


        return $nagoriinfo;
    }

    public function pdfHeader($row,$uniouninfo, $filename)
    {

        $noticeDate = $row->noticeDate;



        $output = "



    <div style='text-align:center'>
        <p style='margin:0' >গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
        <p style='margin:0' >উপজেলা নির্বাহী অফিসারের কার্যালয়</p>
        <p style='margin:0' >".getAddres($uniouninfo->short_name_e)."</p>
        <p style='margin:0' >www.$uniouninfo->short_name_e.panchagarh.gov.bd</p>

    </div>




        <table width='100%' style='margin-bottom:0px !important'>
            <tr>
                <td style='text-align:left'>স্মারক নং:- ".int_en_to_bn($row->memorial_no)."</td>
                <td style='text-align:right'>তারিখ:- ".int_en_to_bn(date('d/m/Y', strtotime($noticeDate)))."</td>
            </tr>
        </table>
        ";
        return $output;
    }
    public function pdfFooter($row,$uniouninfo, $filename)
    {


        $output = '
        <table width="100%" style="border-collapse: collapse;" border="0">
                              <tr>
                                  <td  style="text-align: center;" width="40%"></td>
                                  <td style="text-align: center; width: 200px;" width="30%"></td>
                                  <td style="text-align: center;" width="40%">
                                      <div class="signature text-center position-relative">

                                    সোহাগ চন্দ্র সাহা <br>
                                    উপজেলা নির্বাহী অফিসার <br>
                                    তেঁতুলিয়া, পঞ্চগড়। <br>
                                    ফোন: ০২৫৮৯৯৪২৬০১ <br>
                                    e-mail: unotetulia@mopa.gov.bd
                                      </div>
                                  </td>
                              </tr>
                          </table>';
        return $output;
    }





    public function workAccessPdf(Request $request, $tender_id)
    {



        ini_set('max_execution_time', '60000');
        ini_set("pcre.backtrack_limit", "50000000000000000");
        ini_set('memory_limit', '12008M');

        // $pdf = LaravelMpdf::loadView('tender.notice');
        // return $pdf->stream("fghfg.pdf");


        $tender_list_count = TenderList::where('tender_id',$tender_id)->count();
        if($tender_list_count<1){
            return 'No data Found';
        }

        $row = TenderList::with('tenderWorkOrders')->where('tender_id',$tender_id)->first();



        $uniouninfo = Uniouninfo::where('short_name_e', $row->union_name)->first();

        $filename = time().".pdf";
        // return $this->pdfWordHTMLut($row,$uniouninfo);
            $mpdf = new \Mpdf\Mpdf([
                'default_font_size' => 13,
                'default_font' => 'bangla',
                'mode' => 'utf-8',
                'format' => 'A4',
                'setAutoTopMargin' => 'stretch',
                'autoMarginPadding' => -25,
                'setAutoBottomMargin' => 'stretch'
            ]);


            $mpdf->SetDisplayMode('fullpage');
            $mpdf->SetHTMLHeader($this->pdfWordHeader($row,$uniouninfo, $filename));
            // $mpdf->SetHTMLFooter($this->pdfWordFooter($row,$uniouninfo, $filename));
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

            $mpdf->WriteHTML($this->pdfWordHTMLut($row,$uniouninfo));
            $mpdf->useSubstitutions = false;
            $mpdf->simpleTables = true;
            $mpdf->Output($filename, 'I');

    }

    public function pdfWordHTMLut($row,$uniouninfo)
    {

        $tenderWorkOrders =  $row->tenderWorkOrders;


        $tenderSubmitCount = Tender::where(['tender_id'=>$row->id,'payment_status'=>'Paid'])->count();
        $tenderSelected = Tender::where(['tender_id'=>$row->id,'status'=>'Selected'])->first();
        $noticeDate = $row->noticeDate;
        $month = date('m', strtotime('01-07-2023'));
        $MYear = date('Y');
        $Mmonth = date('m');
        $Mdate = date('d');
        if($month>6){

            $meyadStart = "০১/০৭/".int_en_to_bn($MYear);
            $meyadEnd = "৩০/০৬/".int_en_to_bn($MYear+1);
            $orthoBotsor = int_en_to_bn($MYear."-".($MYear+1));

        }else{
            $meyadStart = "০১/০৭/".int_en_to_bn($MYear-1);
            $meyadEnd = "৩০/০৬/".int_en_to_bn($MYear);
            $orthoBotsor = int_en_to_bn($MYear-1 ."-".$MYear);
        }

        $form_price = $row->form_price;

        $numto = new NumberToBangla();
        $the_amount_of_money_in_words = $numto->bnMoney($form_price) . ' মাত্র';


        $amount = number_format((float)$tenderSelected->DorAmount, 2, '.', '');


        $DorAmount = $numto->bnMoney($amount) . ' মাত্র';


        $percentage15 = 15;
        $result15Percent = number_format((float)($amount * $percentage15) / 100, 2, '.', '');
        $result15PercentText = $numto->bnMoney($result15Percent) . ' মাত্র';

        $percentage5 = 5;
        $result5Percent = number_format((float)($amount * $percentage5) / 100, 2, '.', '');
        $result5PercentText = $numto->bnMoney(round($result5Percent, 2)) . ' মাত্র';


        $nagoriinfo = "


        <style>
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
        p{
            font-size:16px
         }
         .selector p::first-line {
            text-indent: 20px !important;
          }
          .copy_text p {
            margin: 7px 0px !important;
        }
    </style>



            <p style='text-weight:bold;margin-bottom:10px'>বিষয়ঃ  কার্যাদেশ প্রদান। </p>
            <p style='text-align: justify;margin-top:-30px' class='mb-0'>$tenderWorkOrders->formula
            </p>



            <div class='selector' style='text-align: justify;margin-bottom:10px;text-indent: 20px !important;'>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $tenderWorkOrders->order_description
            </div>

            ";



            if($row->permitDetials){
                $nagoriinfo .= "<p style='text-align: justify;margin-top:-30px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      $row->permitDetials</p>";
            }else{
            $nagoriinfo .= " <p style='text-align: justify;margin-top:-5px'>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            তৎপ্রেক্ষিতে, $tenderSelected->applicant_orgName, পিতা: $tenderSelected->applicant_org_fatherName, গ্রামঃ $tenderSelected->vill, ডাকঘরঃ $tenderSelected->postoffice, উপজেলাঃ $tenderSelected->thana, জেলাঃ $tenderSelected->distric-কে তার দাখিলকৃত সর্বোচ্চ দর ".int_en_to_bn($tenderSelected->DorAmount)."/-($DorAmount) টাকা $tenderWorkOrders->bank_name, তেঁতুলিয়া শাখা, পঞ্চগড় এর অনুকূলে থাকা ব্যাংক হিসাব নম্বর $tenderWorkOrders->bank_account_no-এ জমা প্রদানসহ বিধি মোতাবেক ভ্যাট/মূসক ও আয়কর নির্ধারিত কোডে সরকারি কোষাগারে জমা নিশ্চিত পূর্বক নিলামকৃত গাছ এবং গাছের ডালপালা আগামী ০৭ (সাত) দিনের মধ্যে কর্তন/অপসারণের জন্য কার্যাদেশ প্রদান করা হলো।




            </p>";
        }











            $nagoriinfo .= "


         <table width='100%' style='border-collapse: collapse;margin-bottom:15px' border='0'>
         <tr>
             <td  style='text-align: left;' width='40%'>
             <br/>
             <br/>
            <p>
             &nbsp;&nbsp;&nbsp;&nbsp; $tenderSelected->applicant_orgName , পিতা: $tenderSelected->applicant_org_fatherName, <br/>
             &nbsp;&nbsp;&nbsp;&nbsp; গ্রামঃ $tenderSelected->vill , ডাকঘরঃ $tenderSelected->postoffice , <br/>
             &nbsp;&nbsp;&nbsp;&nbsp; উপজেলাঃ $tenderSelected->thana, জেলাঃ $tenderSelected->distric <br/>
          </p></td>
             <td style='text-align: center; width: 200px;' width='30%'></td>
             <td style='text-align: center;' width='40%'>
                 <div class='signature text-center position-relative'>

               সোহাগ চন্দ্র সাহা <br>
               উপজেলা নির্বাহী অফিসার <br>
               তেঁতুলিয়া, পঞ্চগড়। <br>
               ফোন: ০২৫৮৯৯৪২৬০১ <br>
               <span style='font-size:12px'>e-mail: unotetulia@mopa.gov.bd</span>
                 </div>
             </td>
         </tr>
     </table>
















         <div class='copy_text' style='text-align: justify;margin-top:-10px;text-indent: 20px !important;'>
            $tenderWorkOrders->copy_details
        </div>







        ";
        // <p style='margin:0 !important'>অনুলিপি : সদয় জ্ঞাতার্থে /জ্ঞাতার্থে  কার্যাথে</p>
        // <p style='margin:0 !important'>১। জেলা প্রশাসক,পঞ্চগড়।</p>
        // <p style='margin:0 !important'>২। চেয়ারম্যান, উপজেলা পরিষদ তেতুলিয়া, পঞ্চগড়।</p>
        // <p style='margin:0 !important'>৩। উপজেলা নির্বাহী অফিসার, তেতুলিয়া, পঞ্চগড়।</p>
        // <p style='margin:0 !important'>৪। নোটিশ বোড/ওয়েবসাইড।</p>
        // <p style='margin:0 !important'>৫। অফিস কপি।</p>
        return $nagoriinfo;
    }

    public function pdfWordHeader($row,$uniouninfo, $filename)
    {
        $tenderWorkOrders =  $row->tenderWorkOrders;

        $noticeDate = $row->noticeDate;



        $output = "



    <div style='text-align:center'>
        <p class='m-0'>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
        <p class='m-0'>উপজেলা নির্বাহী অফিসারের কার্যালয়</p>
        <p class='m-0'>তেঁতুলিয়া, পঞ্চগড়।</p>
        <p class='m-0'>www.tetulia.panchagarh.gov.bd</p>

    </div>




        <table width='100%' style='margin-bottom:20px !important'>
            <tr>
                <td style='text-align:left'>স্মারক নং:- ".int_en_to_bn($tenderWorkOrders->memorial_no)."</td>
                <td style='text-align:right'>তারিখ:- ".int_en_to_bn(date('d/m/Y', strtotime($tenderWorkOrders->date)))."</td>
            </tr>
        </table>
        ";
        return $output;
    }




    public function pdfWordFooter($row,$uniouninfo, $filename)
    {

        $output = '
        <table width="100%" style="border-collapse: collapse;" border="0">
                              <tr>
                                  <td  style="text-align: center;" width="40%"></td>
                                  <td style="text-align: center; width: 200px;" width="30%"></td>
                                  <td style="text-align: center;" width="40%">
                                      <div class="signature text-center position-relative">

                                    সোহাগ চন্দ্র সাহা <br>
                                    উপজেলা নির্বাহী অফিসার <br>
                                    তেঁতুলিয়া, পঞ্চগড়। <br>
                                    ফোন: ০২৫৮৯৯৪২৬০১ <br>
                                    <span style="font-size:12px">e-mail: unotetulia@mopa.gov.bd</span>
                                      </div>
                                  </td>
                              </tr>
                          </table>';
        return $output;
    }


    function SeletionTender(Request $request,$tender_id){



    $tender_list =  TenderList::find($tender_id);




    $currentDate = strtotime(date("d-m-Y H:i:s"));
    $tender_open = strtotime(date("d-m-Y H:i:s",strtotime($tender_list->tender_open)));
    if($currentDate<$tender_open){
        $result =  [
            "messages"=>"tender Open date : $tender_list->tender_open",
            "status"=>422,
        ];
        return response()->json([$result],422);
    }


     $tendersCount = Tender::where(['tender_id'=>$tender_id,'payment_status'=>'Paid'])->orderBy('DorAmount','desc')->count();
    if($tendersCount<1){
       $result =  [
           "messages"=>"Cant find Tender",
           "status"=>404,
       ];
       return response()->json([$result],404);
    }
    $tendersDorAmount = Tender::where(['tender_id'=>$tender_id,'payment_status'=>'Paid'])->orderBy('DorAmount','desc')->first()->DorAmount;
    $tenders = Tender::where(['DorAmount'=>$tendersDorAmount,'payment_status'=>'Paid'])->orderBy('DorAmount','desc')->get();

    foreach ($tenders as $value) {
        $value->update(['status'=>'Selected']);
    }
    $tender_list->update(['status'=>'Completed']);
    $result =  [
        "data"=>$tenders,
        "messages"=>"found Tender",
        "status"=>200,
    ];
    return response()->json([$result],200);




    }


    function PaymentCreate($id) {


        $tenderformBuy  = TenderFormBuy::find($id);

    //   return  $tenderform = Tender::find($tenderformBuy->tender_id);
        $sonodFees =  TenderList::find($tenderformBuy->tender_id);
        $sonod_fee =  $sonodFees->form_price;
        $unioun_name =  $sonodFees->union_name;
        $unioninfos = Uniouninfo::where(['short_name_e' => $unioun_name])->first();
        $u_code = $unioninfos->u_code;






        $totalamount = $sonod_fee;
        $applicant_mobile = $tenderformBuy->PhoneNumber;
        $total_amount = $totalamount;
        $amount = 0;
        if ($total_amount == null || $total_amount == '' || $total_amount < 1) {
            $amount = 1;
        } else {
            $amount = $total_amount;
        }
        $trnx_id = $u_code.'-'.time();
        $cust_info = [
            "cust_email" => "",
            "cust_id" => "$id",
            "cust_mail_addr" => "Address",
            "cust_mobo_no" => "$applicant_mobile",
            "cust_name" => "Customer Name"
        ];
        $trns_info = [
            "ord_det" => 'sonod',
            "ord_id" => "$id",
            "trnx_amt" => $amount,
            "trnx_currency" => "BDT",
            "trnx_id" => "$trnx_id"
        ];
        // return $sonod->unioun_name;


        $redirectutl = ekpayToken2($trnx_id, $trns_info, $cust_info,'payment',$unioun_name);



        $req_timestamp = date('Y-m-d H:i:s');

        $customerData = [
            'union' => $unioun_name,
            'trxId' => $trnx_id,
            'sonodId' => $id,
            'sonod_type' => 'Tenders_form',
            'amount' => $amount,
            'mob' => $applicant_mobile,
            'status' => "Pending",
            'paymentUrl' => $redirectutl,
            'method' => 'ekpay',
            'payment_type' => 'online',
            'date' => date('Y-m-d'),
            'created_at' => $req_timestamp,
        ];
        Payment::create($customerData);





        return redirect($redirectutl);

    }



    function TenderForm(Request $request,$tender_id) {


         $requestMethod = request()->method();

        //  if($requestMethod=='POST'){

        //      $PhoneNumber = $request->PhoneNumber;
        //      $form_code = $request->form_code;
        //      $TenderFormBuy =  TenderFormBuy::where(['PhoneNumber'=>$PhoneNumber,'form_code'=>$form_code,'status'=>'Paid'])->count();

        //     if($TenderFormBuy<1){
        //         // $messageData =  "
        //         //     <h1 style='color:red;text-align:center'>মোবাইল নং অথবা ফর্ম নং ভুল। দরপত্র দাখিক করার জন্য সঠিক মোবাইল নং এবং সঠিক ফর্ম নং প্রদান করুন।</h1>
        //         // ";

        //         $messageData =  "মোবাইল নং অথবা ফর্ম নং ভুল। দরপত্র দাখিক করার জন্য সঠিক মোবাইল নং এবং সঠিক ফর্ম নং প্রদান করুন।";

        //         Session::flash('Fmessage', $messageData);
        //         return redirect()->back();
        //     }


        //  }





        $tender_list_count = TenderList::where('tender_id',$tender_id)->count();
        if($tender_list_count<1){
            return 'No data Found';
        }

        $tender_list = TenderList::where('tender_id',$tender_id)->first();
        $tenderCount =  Tender::where('tender_id',$tender_list->id)->count();
        if($tenderCount>0){
            $tender = Tender::where('tender_id',$tender_list->id)->orderBy('id','desc')->first();
            $dorId = $tender->dorId+1;
        }else{
            $dorId = 120001;
        }



        // return view('form');
          $currentDate = strtotime(date("d-m-Y H:i:s"));

        $startDate = strtotime(date("d-m-Y H:i:s",strtotime($tender_list->tender_start)));

        $EndDate = strtotime(date("d-m-Y H:i:s",strtotime($tender_list->tender_end)));


        // <h1 style='text-align:center;margin-top:20px;color:green'>ফলাফল এর জন্য অপেক্ষা করুন :- ".date('d-m-Y h:i A',strtotime($tender_list->tender_open))."  পর্যন্ত</h1>

       if($currentDate>$EndDate){


           if($tender_list->status=='Completed'){
            $selectedPerson = Tender::where(['tender_id'=>$tender_list->id,'status'=>'Selected'])->get();

            $table = "";
            $table .="
            <table class='table' border='1' style='border-collapse:collapse'>
            <thead>
                <tr>
                <th scope='col'>দরপত্র নম্বর</th>
                <th scope='col'>নাম</th>
                <th scope='col'>পিতার নাম</th>
                <th scope='col'>ঠিকানা</th>
                <th scope='col'>মোবাইল</th>
                <th scope='col'>দরের পরিমাণ</th>
                <th scope='col'>কথায়</th>
                <th scope='col'>জামানতের পরিমাণ</th>
                </tr>
            </thead>
            <tbody>";

            foreach ($selectedPerson as $application) {


                $table .="
                <tr>
                <th scope='row'>$application->dorId</th>
                    <td>$application->applicant_orgName</td>
                    <td>$application->applicant_org_fatherName</td>
                    <td>গ্রাম- $application->vill, ডাকঘর- $application->postoffice, উপজেলা- $application->thana, জেলা- $application->distric</td>
                    <td>$application->mobile</td>
                    <td>$application->DorAmount</td>
                    <td>$application->DorAmountText</td>
                    <th>$application->depositAmount</td>
                    </tr>";

                }


            $table .="</tbody>
            </table>";


            return "

                <style>

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                tr:nth-of-type(odd) {
                    background: #eee;
                }
                th {
                    background: green;
                    color: white;
                    font-weight: bold;
                }
                td, th {
                    padding: 6px;
                    border: 1px solid #ccc;
                    text-align: left;
                }
                </style>

            <h1 style='text-align:center;margin-top:20px;color:green'>এই ইজারার নির্বাচিত সদস্য এর তথ্য নিচে দেখুন।</h1>

                $table


            ";
        }else{
            $tender_list->update(['status'=>'proccesing']);
            return "
            <h1 style='text-align:center;margin-top:20px;color:red'>দরপত্র দাখিলের সময় শেষ</h1>
            <h1 style='text-align:center;margin-top:20px;color:green'>ফলাফল এর জন্য অপেক্ষা করুন </h1>
            ";
        }





        }

       if($currentDate>$startDate){
        $tender_list->update(['status'=>'active']);





           return view('tender.form',compact('dorId','tender_list','requestMethod'));



        }else{

            return view('tender.countdown',compact('tender_list'));
       }



    }





    public function ResulationPdf(Request $request, $tender_id)
    {



        ini_set('max_execution_time', '60000');
        ini_set("pcre.backtrack_limit", "50000000000000000");
        ini_set('memory_limit', '12008M');

        // $pdf = LaravelMpdf::loadView('tender.notice');
        // return $pdf->stream("fghfg.pdf");


        $tender_list_count = TenderList::where('tender_id',$tender_id)->count();
        if($tender_list_count<1){
            return 'No data Found';
        }

        $row = TenderList::with(['tenderWorkOrders','resolutions'])->where('tender_id',$tender_id)->first();



        $uniouninfo = Uniouninfo::where('short_name_e', $row->union_name)->first();

        $filename = time().".pdf";
        // return $this->pdfWordHTMLut($row,$uniouninfo);
            $mpdf = new \Mpdf\Mpdf([
                'default_font_size' => 13,
                'default_font' => 'bangla',
                'mode' => 'utf-8',
                'format' => 'A4',
                'setAutoTopMargin' => 'stretch',
                'autoMarginPadding' => -25,
                'setAutoBottomMargin' => 'stretch'
            ]);


            $mpdf->SetDisplayMode('fullpage');
            // $mpdf->SetHTMLHeader($this->pdfWordHeader($row,$uniouninfo, $filename));
            // $mpdf->SetHTMLFooter($this->pdfWordFooter($row,$uniouninfo, $filename));
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

            $mpdf->WriteHTML($this->pdfResulationHTMLut($row,$uniouninfo));
            $mpdf->useSubstitutions = false;
            $mpdf->simpleTables = true;
            $mpdf->Output($filename, 'I');

    }

    public function pdfResulationHTMLut($row,$uniouninfo)
    {




        $selected = Tender::where(['tender_id'=>$row->id,'payment_status'=>'Paid','status'=>'Selected'])->first();



        $tenderSubmitCount = Tender::where(['tender_id'=>$row->id,'payment_status'=>'Paid'])->count();

        $numto = new NumberToBangla();
        $tenderSubmitCount_word = $numto->bnWord($tenderSubmitCount);
        $tenders = Tender::where(['tender_id'=>$row->id,'payment_status'=>'Paid'])->orderBy('DorAmount','desc')->get();




        $nagoriinfo = "


        <style>
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
        p{
            font-size:16px
         }
         .selector p::first-line {
            text-indent: 20px !important;
          }

     .copy_text p {
        margin: 7px 0px !important;
    }
    </style>

    <div style='text-align:center'>
        <p class='m-0' style='font-size:20px'><u>উপজেলা দরপত্র মূল্যায়ন ও বাছাই কমিটির সভার কার্যবিবরণী:</u></p>
        <p class='m-0'>উপজেলা- তেঁতুলিয়া, জেলা- পঞ্চগড়</p>
    </div>

    <table>

          <tr>
            <td style='vertical-align: top;'>সভাপতি</td>
            <td>: জনাব সোহাগ চন্দ্র সাহা <br/>
            উপজেলা নির্বাহী অফিসার, তেঁতুলিয়া, পঞ্চগড়।</td>
          </tr>

          <tr>
            <td>স্থান</td>
            <td>: উপজেলা নির্বাহী অফিসারের অফিস কক্ষ, তেঁতুলিয়া, পঞ্চগড়।</td>
          </tr>

          <tr>
            <td>তারিখ</td>
            <td>: ".int_en_to_bn(date('d/m/Y', strtotime($row->tender_open)))." খ্রি., সময়:- বিকাল  ".int_en_to_bn(date('h.i', strtotime($row->tender_open)))." ঘটিকা।</td>
          </tr>

    </table>




            <p style='margin-top:0px'>সভায় উপস্থিত সদস্যবৃন্দ - পরিশিষ্ট ‘ক’-তে দেখানো হলো।</p>


            <p style='text-align: justify;margin-top:-30px;text-indent: 40px;' class='mb-0'>
            সভাপতি মহোদয় উপস্থিত সকল সদস্যকে স্বাগত জানিয়ে সভার কাজ শুরু করেন। অত:পর সভাপতি মহোদয় সভায় জানান,
            ".$row->resolutions->description." নিমিত্ত গত ".int_en_to_bn(date('d/m/Y', strtotime($row->noticeDate)))." তারিখে নিলাম দরপত্র বিজ্ঞপ্তি আহবান করা হয়। তৎপ্রেক্ষিতে, অদ্য ".int_en_to_bn(date('d/m/Y', strtotime($row->tender_end)))." তারিখ দরপত্র দাখিলের নির্ধারিত সময় দুপুর ".int_en_to_bn(date('h.i', strtotime($row->tender_end)))." ঘটিকা পর্যন্ত মোট ".int_en_to_bn($tenderSubmitCount)." ($tenderSubmitCount_word)টি প্রতিষ্ঠানের নিকট হতে দরপত্র পাওয়া যায়। <br/>
            জনাব $row->committe5name সভায় জানান যে, বিক্রিত সিডিউলের মধ্যে ".int_en_to_bn($tenderSubmitCount)."টি প্রতিষ্ঠানই নির্ধারিত তারিখ ও সময়ের মধ্যে দরপত্র দাখিল করেন
            </p>




            ";


            $nagoriinfo .= "

    <table width='100%' border='1' style='border-collapse: collapse;'>

    <tr>
      <td style='vertical-align: top;'>ক্র. নং</td>
      <td style='text-align:center'>সরবরাহকারী প্রতিষ্ঠানের নাম</td>
      <td style='text-align:center'>দাখিলকৃত দর</td>
      <td style='text-align:center'>মন্তব্য</td>
    </tr>";


          $i = 1;
    foreach ($tenders as $tender) {
        $nagoriinfo .= "<tr>
        <td  style='text-align:center;padding:0px 10px'>". int_en_to_bn($i)."</td>
        <td  style='text-align:left;padding:0px 10px'>
        $tender->applicant_orgName <br/>
        $tender->vill, $tender->postoffice, $tender->thana, $tender->distric

        </td>
        <td  style='text-align:center;padding:0px 10px'>". int_en_to_bn($tender->DorAmount)."</td>
        <td  style='text-align:center;padding:0px 10px'>";

        if($tender->status=='Selected'){

            $nagoriinfo .= "
            সর্বোচ্চ দরদাতা";
        }else{

        }



        $nagoriinfo .= "</td></tr>";

        $i++;
    }





    $nagoriinfo .= "</table>

    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; দরপত্র মূল্যায়ন কমিটি কর্তৃক দাখিলকৃত দরদাতা প্রতিণ্ঠান সমূহের বিবরণী যাচাই বাছাই করা হয়। স্থানীয় বাজারদর অনুযায়ী $selected->applicant_orgName এর দাখিলকৃত দর সর্বোচ্চ হওয়ায় দরপত্র মূল্যায়ন ও বাছাই কমিটি কর্তৃক উক্ত দরদাতার দাখিলকৃত দর গৃহীত হলো। এতদসংশ্লিষ্ট সকল বিধি বিধান/শর্তাবলী প্রতিপালন পূর্বক দরদাতার অনুকূলে কার্যাদেশ প্রদানের জন্য সুপারিশ করা হলো। <br/> <br/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; অত:পর অদ্য আর কোন আলোচনা না থাকায় সভাপতি উপস্থিত সকল সদস্যকে ধন্যবাদ জানিয়ে সভার সমাপ্তি ঘোষণা করেন।</p>



            ";











            $nagoriinfo .= "


         <table width='100%' style='border-collapse: collapse;margin-bottom:15px;margin-top:35px' border='0'>
         <tr>
             <td  style='text-align: left;' width='40%'>
            </td>
             <td style='text-align: center; width: 200px;' width='30%'></td>
             <td style='text-align: center;' width='40%'>
                 <div class='signature text-center position-relative'>

               সোহাগ চন্দ্র সাহা <br>
               উপজেলা নির্বাহী অফিসার <br>
               তেঁতুলিয়া, পঞ্চগড়। <br>
               ফোন: ০২৫৮৯৯৪২৬০১ <br>
               <span style='font-size:12px'>e-mail: unotetulia@mopa.gov.bd</span>
                 </div>
             </td>
         </tr>
     </table>

     <pagebreak>



     <div style='text-align:center'>
     <p class='m-0'>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
     <p class='m-0'>উপজেলা নির্বাহী অফিসারের কার্যালয়</p>
     <p class='m-0'>তেঁতুলিয়া, পঞ্চগড়।</p>
 </div>




     <table width='100%' style='margin-bottom:40px !important'>
         <tr>
             <td style='text-align:left'>স্মারক নং:- ".int_en_to_bn($row->resolutions->memorial_no)."</td>
             <td style='text-align:right'>তারিখ:- ".int_en_to_bn(date('d/m/Y', strtotime($row->tender_open)))."</td>
         </tr>
     </table>













    <div class='copy_text' style='text-align: justify;margin-top:0px;'>
        ". $row->resolutions->copy_details ."
    </div>





        ";

        return $nagoriinfo;
    }










}
