<?php

use App\Models\TenderCalender;

function tender_calander_pdf_teams($id) {
    $tenderCalendar = TenderCalender::with('teams')->find($id);

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
        <h3>কমিটির তথ্য</h3>
        <table>
            <thead>
                <tr>
                    <th>ক্রম</th>
                    <th>নাম</th>
                    <th>পদবি</th>
                    <th>ফোন</th>
                </tr>
            </thead>
            <tbody>";
            foreach ($tenderCalendar->teams as $key=>$team) {
                $html .= "<tr>
                    <td>".int_en_to_bn($key+1)."</td>
                    <td>{$team->name}</td>
                    <td>{$team->position}</td>
                    <td>{$team->phone}</td>
                </tr>";
            }
            $html .= "</tbody>
        </table>
    </body>";

    return $html;
}
