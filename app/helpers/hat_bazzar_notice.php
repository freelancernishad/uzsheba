<?php

use App\Models\TenderList;
use App\Models\TenderCalender;

function hat_bazzar_notice($id) {

    // Fetch the tender list by ID
    $tenderList = TenderList::find($id);
    if (!$tenderList) {
        return "Tender List not found.";
    }

    // Get the tender calendar ID from the tender list
    $tender_calender_id = $tenderList->tender_calender_id;

    // Fetch the tender calendar with related teams, items, and schedule times
    $tenderCalendar = TenderCalender::with(['teams', 'items', 'scheduleTimes'])->find($tender_calender_id);
    if (!$tenderCalendar) {
        return "Tender Calendar not found.";
    }

    // Generate the table rows dynamically from the tender calendar items
    $tableRows = '';
    foreach ($tenderCalendar->items as $index => $item) {
        $tableRows .= '<tr>';
        $tableRows .= '<td>' . int_en_to_bn($index + 1) . '</td>';
        $tableRows .= '<td>' . $item->union_name . '</td>';
        $tableRows .= '<td>' . $item->hat_name . '</td>';
        $tableRows .= '<td>' . int_en_to_bn(number_format($item->ijara_price, 2)) . '</td>';
        $tableRows .= '<td>' . int_en_to_bn(number_format($item->form_price, 2)) . '</td>';
        $tableRows .= '</tr>';
    }

    // Generate the schedule table dynamically from the tender calendar schedule times
    $scheduleRows = '';
    foreach ($tenderCalendar->scheduleTimes as $schedule) {
        $scheduleRows .= '<tr>';
        $scheduleRows .= '<td>' . $schedule->stage_of_tender . '</td>';
        $scheduleRows .= '<td>' . formatBengaliDateTime($schedule->form_buy_end) . '</td>';
        $scheduleRows .= '<td>' . formatBengaliDateTime($schedule->tender_start) . '</td>';
        $scheduleRows .= '<td>' . formatBengaliDateTime($schedule->tender_open) . '</td>';
        $scheduleRows .= '</tr>';
    }

    $upzelaName = upzilaConvert($tenderCalendar->union);
    $upzelaAddress = getAddres($tenderCalendar->union);
    $banglaYear = int_en_to_bn($tenderCalendar->bn_year);
    $rules = replacefontfamilly($tenderCalendar->rules);
    $onulipi = replacefontfamilly($tenderCalendar->onulipi);


    // Generate the HTML string
    $html = <<<HTML

    <style>

        .header, .content {
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 1px 3px;
            text-align: center;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 20px;
        }
        h3{
            margin:0px;
        }

    </style>

    <div class="content" style="margin-top:100px !important">

        <h2 style="margin-bottom:0px;text-decoration:underline">  $upzelaName উপজেলার হাট-বাজারসমূহের $banglaYear বাংলা সালের জন্য ইজারা বিজ্ঞপ্তি</h2>
        <h3 style="text-decoration:underline">বিজ্ঞপ্তি নং-০১/২০২৪ (১ম বদ্ধ অথবা পরবর্তীতে নির্দেশিত)</h3>

        <p style="text-align:justify">$upzelaName উপজেলার আওতাধীন জনস্বার্থে নানা সেবা যেমন ভূমি ব্যবস্থা, ভূমি উন্নয়ন ও সেবা প্রদান, খাদ্য সহায়তা এবং সামাজিক সুরক্ষা প্রদান করা হয়ে থাকে। এসব সেবা অব্যাহত রাখার জন্য $banglaYear বাংলা সালের জন্য হাট-বাজারসমূহ ইজারা প্রদানের জন্য আগ্রহী ব্যক্তি/প্রতিষ্ঠান থেকে দরপত্র আহ্বান করা হচ্ছে। নির্ধারিত সময়ের মধ্যে দরপত্র ক্রয়ের জন্য প্রয়োজনীয় দলিলসহ দরপত্র জমা দিতে হবে।</p>
        <p style="text-align:justify">দরপত্র জমা দেওয়ার জন্য সমস্ত প্রয়োজনীয় দলিলাদি ৩০ দিনের মধ্যে জমা দিতে হবে। নির্ধারিত সময়ের পরে প্রাপ্ত দরপত্র গ্রহণযোগ্য হবে না। দরপত্র কমিটির সিদ্ধান্ত চূড়ান্ত হবে। দরপত্র www.$tenderList->union_name.panchagarh.gov.bd ওয়েবসাইটের মাধ্যমে বা সরাসরি জমা দিতে হবে।</p>

        <h3 >যে সকল হাট-বাজারের ইজারা আহ্বান করা হচ্ছে তার বিবরণ:</h3>
        <table class="table">
            <tr>
                <th>ক্র.নং</th>
                <th>ইউনিয়নের নাম</th>
                <th>হাট-বাজারের নাম</th>
                <th>সরকারি মূল্য</th>
                <th>সিডিউল মূল্য </th>
            </tr>
            $tableRows
        </table>

        <div class="footer">
            <h3>দরপত্র দাখিলের সময়সূচী ও ফি:</h3>
            <table class="table">
                <tr>
                    <th>দরপত্র আহবানের পর্যায়</th>
                    <th>দরপত্র সিডিউল বিক্রয়ের শেষ তারিখ ও সময়</th>
                    <th>দরপত্র গ্রহণের তারিখ ও সময়</th>
                    <th>দরপত্র বাক্স খোলার তারিখ ও সময়</th>
                </tr>
                $scheduleRows
            </table>


        </div>
    </div>



    <div class="content2" style="margin-top:15px">
            <h3>অনুলিপি</h3>
            $onulipi
        </div>



        <div class="container">
        <h2>হাট-বাজার ইজারার শর্তাবলী</h2>
            $rules
    </div>


HTML;

    // Return the HTML string
    return $html;
}


 function hat_bazzar_notice_Footer($id)
{

    // Fetch the tender list by ID
    $tenderList = TenderList::find($id);
    if (!$tenderList) {
        return "Tender List not found.";
    }

    // Get the tender calendar ID from the tender list
    $tender_calender_id = $tenderList->tender_calender_id;

    // Fetch the tender calendar with related teams, items, and schedule times
    $tenderCalendar = TenderCalender::with(['teams', 'items', 'scheduleTimes'])->find($tender_calender_id);
    if (!$tenderCalendar) {
        return "Tender Calendar not found.";
    }

    $upzelaAddress = getAddres($tenderList->union_name);


    $output = '
    <table width="100%" style="border-collapse: collapse;" border="0">
                          <tr>
                              <td  style="text-align: center;" width="40%"></td>
                              <td style="text-align: center; width: 200px;" width="30%"></td>
                              <td style="text-align: center;" width="40%">
                                  <div class="signature text-center position-relative">
                                <img width="130px" src="'.base64($tenderCalendar->uno_signature).'" alt="BD Logo"><br>
                                '.$tenderCalendar->uno_name.' <br>
                                উপজেলা নির্বাহী অফিসার <br>
                                '.$upzelaAddress.' <br>
                                  </div>
                              </td>
                          </tr>
                      </table>';
    return $output;
}
