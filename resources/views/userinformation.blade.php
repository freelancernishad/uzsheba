<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
@page {

	/* margin: 0px; */
    /* background-color:#F3E308; */


}



        .logos {
            width: 50px;
        }
        .bgtitle {
            background: #D75947;
            color: #F3E308;
            font-size:15px
            /* font-weight: 900; */
        }
        .childInfo{
            padding-top:10px !important;

        }
        td{
            font-size: 15px;
        }
    </style>
</head>
<body style="font-family: 'bangla', sans-serif;">


    <div width="100%" style="float: right;padding:1.5%">





        <table width="100%">
            <tr>
                <td><img class="logos" src="{{ base64('assets/img/bd-logo.png') }}" alt=""> </td>
                <td style="text-align:center">
                    <h2>শিশুর তথ্য</h2>
                </td>
                <td style="text-align:right"><img class="logos"
                        src="{{ base64('assets/img/epi_tika_logo.png') }}" alt=""> </td>
            </tr>


        </table>




        <table width="100%" border="1" style="border-collapse:collapse;margin-top:20px">

            <tr>
                <td width="20%">নাম</td>
                <td width="80%">{{ $row->childs_name }}</td>
            </tr>

            <tr>
                <td>জন্ম তারিখ</td>
                <td>{{ int_en_to_bn(date("d M. Y", strtotime($row->date_of_birth))) }}</td>
            </tr>
            <tr>
                <td>লিঙ্গ</td>
                <td>{{ $row->gender }}</td>
            </tr>

            <tr>
                <td>জন্মস্থান</td>
                <td>গ্রাম/মহল্লা/পাড়া:- {{ $row->village }}, ওয়ার্ড নং:- {{ int_en_to_bn($row->word_number) }}, ইউনিয়ন/জোন:- {{ $row->post_office }}, উপজেলা/পৌরসভা/সিটি করপােরেশন:- {{ $row->upazila }}, জেলা:- {{ $row->district }}</td>
            </tr>

            <tr>
                <td>পিতার নাম</td>
                <td>{{ $row->husband_name }}</td>
            </tr>
            <tr>
                <td>পিতার জাতীয় পরিচয়পত্র</td>
                <td>{{ $row->husband_name_nid }}</td>
            </tr>
            <tr>
                <td>মাতার নাম</td>
                <td>{{ $row->name }}</td>
            </tr>
            <tr>
                <td>মাতার জাতীয় পরিচয়পত্র</td>
                <td>{{ $row->pregnant_woman_nid }}</td>
            </tr>

        </table>









    </div>
</body>
</html>
