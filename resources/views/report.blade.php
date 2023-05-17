<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
    <style>
        .m-0{
            margin: 0;
        }    .text-center{
            text-align:center;
        }
    td{
        border: 1px dotted black;
        padding:4px 10px;
        font-size: 14px;
    }
       th{
        border: 1px dotted black;
        padding:4px 10px;
        font-size: 16px;
    }

    .li{
        font-size: 10px;
    }



	table{
		border-collapse: collapse;
		width:100%
	}
    </style>

</head>
<body style="font-family: 'bangla', sans-serif;">




    <h3 style="text-align:center;margin:0">নলকূপ স্থাপনের লাইসেন্সের জন্য প্রাপ্ত আবেদনের স্থান পরিদর্শন ও সংশ্লিষ্ট তথ্যাবলি সরেজমিনে যাচাইপূর্বক মন্তব্য ও সুপারিশ সম্বলিত প্রতিবেদন</h3>
<div style="text-align:center">তেঁতুলিয়া, পঞ্চগড়।</div>

    <p>আবেদনকারীর নাম:  <u> {{ $row->appicant_name }}</u> ,  পিতার নাম- <u> {{ $row->applicant_father_name }}</u>
        গ্রাম: <u> {{ $row->village }}</u>, ইউনিয়ন- <u> {{ $row->union }}</u>, মৌজা- <u> {{ $row->mouja_name }}</u>
        জে.এল.নং- <u> {{ $row->JL_No }}</u>,  খতিয়ান নং- <u> {{ $row->khotiyan_no }}</u>, দাগ নং- <u> {{ $row->dag_NO }}</u>
        </p>

        <table style="width:100%">
            <tr>
                <td width="10%">ক্রমিক নং</td>
                <td width="20%">পরিদর্শনের বিষয়</td>
                <td width="70%">পরিদর্শনকারীর মন্তব্য</td>
            </tr>


            <tr>
                <td>১</td>
                <td>যে স্থানে নলকূপ স্থাপন করা হবে সেই স্থানের পানিধারক স্তরের অবস্থা</td>
                <td>{{ $row->save_water_Condition }}</td>
            </tr>



            <tr>
                <td>২</td>
                <td>নলকূপ দ্বারা উপকৃত হবে এইরূপ সম্ভাব্য এলাকা</td>
                <td>{{ $row->helpfull_area }}</td>
            </tr>



            <tr>
                <td>৩</td>
                <td>গৃহস্থালীর উদ্দেশ্যে ব্যবহৃত নলকূপসহ অন্যান্য নলকূপের উপর সম্ভাব্য প্রভাব</td>
                <td>{{ $row->home_and_other_benefite }}</td>
            </tr>



            <tr>
                <td>৪</td>
                <td>নলকূপ স্থাপনের জন্য খনন স্থানের উপযুক্ততা</td>
                <td>{{ $row->right_area }}</td>
            </tr>



            <tr>
                <td>৫</td>
                <td>দুইটি নলকূপের পারস্পরিক দূরত্ব (সর্বনিম্ন ০.৫০ কিউসেক ক্যাপাসিটির ২৫০ মিটার)</td>
                <td>{{ $row->distanceTo }}</td>
            </tr>



            <tr>
                <td>৬</td>
                <td>নিকটবর্তী অন্যান্য নলকূপ এবং বৈদ্যুতিক সংযোগের দূরত্ব (হাত নকশা)</td>
                <td><img width="100px" src="{!! $map !!}" alt=""></td>
            </tr>


        </table>

<p>নলকূপ স্থাপনের স্থান নির্বাচনের শর্তাবলি <br>
    ১। মৃত্তিকা: বোরো, গম, ভুট্টা ও শাকসব্জি চাষের উপযোগী মৃত্তিকাবিশিষ্ট জমিকে অগ্রাধিকার প্রদান করা হবে।<br>
    ২। স্থায়ী নদী হতে দূরত্ব: সর্বদা প্রবাহমান নদী হতে নলকূপ স্থাপনের স্থান অন্তত ১.৫ কি.মি দূরে অবস্থিত হবে।<br>
    ৩। ভূ-প্রকৃতি: নলকূপ স্থাপনের স্থানটি এইরূপে নির্বাচিত হবে যাতে নলকূপের প্লাটফরমটি বন্যার সময় পানির সচরাচর সর্বোচ্চ স্তর অপেক্ষা উঁচু স্থানে থাকে।<br>
    ৪। সেচের পানি বন্টন: নলকূপ স্থাপনের স্থানটি এইরূপে নির্বাচিত হবে যাতে সেচের পানি চর্তুদিকে বিতরণ করা যায়।<br>
    </p>

    <div style="width:100%;margin-top:50px" >

<p style="text-align: center;width:200px;float:right">
        <img width="200px" src="{{ base64($row->reporter_signature) }}" alt=""> <br>
    <span style='margin-bottom:0 !important'>{{ $row->reporter_name }}</span> <br>
    <span style='margin-bottom:0 !important'>তদন্তকারীর সাক্ষর</span>
</p>

    </div>



</body>
</html>
