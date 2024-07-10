<?php

use App\Models\TenderCalender;


function tender_calander_pdf_body($id) {
         $tenderCalendar = TenderCalender::with(['teams','items','scheduleTimes'])->find($id);



        $html = "    <style>

        h4,h3,p{
        margin:0;padding:0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 2px;
            text-align: center;
        }
         th {
            background: green;
            color: white;

        }

        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .signature div {
            width: 30%;
            text-align: center;
        }


        .signature-table {
            width: 100%;
            margin-top: 40px;
            border: none;
        }
        .signature-table td {
            border: none;
            text-align: center;
            padding: 20px;
        }
    </style>

<body>
    <div class='header'>
        <img width='50px' src='".base64('assets/img/bd-logo.png')."' alt='BD Logo'>
        <h4>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার </h4>
        <h3>উপজেলা নির্বাহী অফিসের কার্যালয়</h3>
        <p>".getAddres($tenderCalendar->union)." </p>
    </div>


    <p>১৪৩২ বাংলা সনের হাট বাজার ইজারার ক্যালেন্ডার</p>

    <table>
        <thead>
            <tr>
                <th>ক্রম</th>
                <th>ইউনিয়নের নাম</th>
                <th> হাট-বাজারের নাম</th>
                <th>বিগত বছরের ইজারা মূল্য</th>
                <th>৬% বৃদ্ধি</th>
                <th>ইজারা মূল্য</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($tenderCalendar->items as $key=>$value) {



            $html .= "<tr>
                <td>".int_en_to_bn($key+1)."</td>
                <td>$value->union_name</td>
                <td>$value->hat_name</td>
                <td>".int_en_to_bn($value->previous_ijara_price)."</td>
                <td>".int_en_to_bn($value->six_percent_bitti)."</td>
                <td>".int_en_to_bn($value->ijara_price)."</td>
            </tr>";
        }


        $html .= "</tbody>
    </table>

   <table class='signature-table'>
        <tr>
            <td><img width='130px' src='".base64($tenderCalendar->dc_signature)."' alt='BD Logo'>
                <p>$tenderCalendar->dc_name</p>
                <p>জেলা প্রশাসক , পঞ্চগড়</p>";


                if($tenderCalendar->status=='approved'){

                    $html .= " <p style='color:green'>(অনুমোদিত)</p>";
                }else{

                    $html .= " <p style='color:red'>(এখনো অনুমোদন হয়নি)</p>";
                }







            $html .= " </td>
            <td></td>
            <td>
            <img width='130px' src='".base64($tenderCalendar->uno_signature)."' alt='BD Logo'>
                <p>$tenderCalendar->uno_name</p>
                <p>উপজেলা নির্বাহী অফিসার</p>
                <p>".getAddres($tenderCalendar->union)."</p>";



                if($tenderCalendar->teams->isEmpty()){

                    $html .= " <p style='color:red'>(এখনো কমিটি গঠন করা হয়নি)</p>";
                }

             $html .= "</td>
        </tr>
    </table>


</body>";


return $html;


    }
