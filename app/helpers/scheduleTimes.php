<?php

use App\Models\TenderCalender;

function tender_calander_pdf_schedule_times($id) {
    $tenderCalendar = TenderCalender::with('scheduleTimes')->find($id);

    $html = "<style>
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
    </style>
    <body>
        <div class='header'>
            <img width='50px' src='".base64('assets/img/bd-logo.png')."' alt='BD Logo'>
            <h4>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার </h4>
            <h3>উপজেলা নির্বাহী অফিসের কার্যালয়</h3>
            <p>".getAddres($tenderCalendar->union)." </p>
        </div>
        <div>
            <p>স্মারক নং: {$tenderCalendar->sorok_no}</p>
            <p>তারিখ: {$tenderCalendar->date}</p>
            <p>বাংলা সাল: {$tenderCalendar->bn_year}</p>
            <p>ইংরেজি সাল: {$tenderCalendar->en_year}</p>
        </div>
        <h3>সময়সূচী</h3>
        <table>
            <thead>
                <tr>

                    <th>পর্যায়</th>
                    <th>ফর্ম ক্রয় শুরুর তারিখ</th>
                    <th>ফর্ম ক্রয় শেষের তারিখ</th>
                    <th>টেন্ডার শুরুর তারিখ</th>
                    <th>টেন্ডার শেষের তারিখ</th>
                    <th>টেন্ডার খোলার তারিখ</th>
                </tr>
            </thead>
            <tbody>";
            foreach ($tenderCalendar->scheduleTimes as $key=>$time) {
                $html .= "<tr>
                  
                    <td>{$time->stage_of_tender}</td>
                    <td>".formatBengaliDateTime($time->form_buy_start)."</td>
                    <td>".formatBengaliDateTime($time->form_buy_end)."</td>
                    <td>".formatBengaliDateTime($time->tender_start)."</td>
                    <td>".formatBengaliDateTime($time->tender_end)."</td>
                    <td>".formatBengaliDateTime($time->tender_open)."</td>
                </tr>";
            }
            $html .= "</tbody>
        </table>
    </body>";

    return $html;
}
