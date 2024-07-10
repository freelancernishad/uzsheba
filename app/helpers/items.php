<?php

use App\Models\TenderCalender;

function tender_calander_pdf_items($id) {
    $tenderCalendar = TenderCalender::with('items')->find($id);

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
        <h3>হাট-বাজারের তথ্য</h3>
        <table>
            <thead>
                <tr>
                    <th>ক্রম</th>
                    <th>ইউনিয়নের নাম</th>
                    <th>হাট-বাজারের নাম</th>
                    <th>বিগত বছরের ইজারা মূল্য</th>
                    <th>৬% বৃদ্ধি</th>
                    <th>ইজারা মূল্য</th>
                </tr>
            </thead>
            <tbody>";
            foreach ($tenderCalendar->items as $key=>$item) {
                $html .= "<tr>
                    <td>".int_en_to_bn($key+1)."</td>
                    <td>{$item->union_name}</td>
                    <td>{$item->hat_name}</td>
                    <td>".int_en_to_bn($item->previous_ijara_price)."</td>
                    <td>".int_en_to_bn($item->six_percent_bitti)."</td>
                    <td>".int_en_to_bn($item->ijara_price)."</td>
                </tr>";
            }
            $html .= "</tbody>
        </table>
    </body>";

    return $html;
}
