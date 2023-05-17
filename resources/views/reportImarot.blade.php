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




    <h3 style="text-align:center;margin:0">ইমারত/স্থাপনার নকশা অনুমোদনের তদন্ত প্রতিবেদন</h3>
<div style="text-align:center">তেঁতুলিয়া, পঞ্চগড়।</div>



        <table style="width:100%">
            <tr>
                <td width="10%">ক্রমিক নং</td>
                <td width="20%">পরিদর্শনের বিষয়</td>
                <td width="70%">পরিদর্শনকারীর মন্তব্য</td>
            </tr>


            <tr>
                <td>১</td>
                <td>আবেদনের ক্রমিক নম্বর</td>
                <td>{{ int_en_to_bn($sonod->licence_no) }}</td>
            </tr>

            <tr>
                <td>২</td>
                <td>আবেদনের তারিখ</td>
                <td>{{ int_en_to_bn(date("d/m/Y", strtotime($sonod->created_at))) }}</td>
            </tr>


            <tr>
                <td>৩</td>
                <td>আবেদনকারী/মালিকের নাম </td>
                <td>{{ $row->appicant_name }}</td>
            </tr>


            <tr>
                <td>৪</td>
                <td>ঠিকানা</td>
                <td>{{ $sonod->district }},{{ $sonod->upozila }},{{ $sonod->upozila }},{{ $sonod->upozila }},{{ $sonod->post }}</td>
            </tr>



            <tr>
                <td>৫</td>
                <td>প্রস্তাবিত স্থানের তফসিল</td>
                <td>মৌজা- <u> {{ $row->mouja_name }}</u>
                    জে.এল.নং- <u> {{ $row->JL_No }}</u>,  খতিয়ান নং- <u> {{ $row->khotiyan_no }}</u>, দাগ নং- <u> {{ $row->dag_NO }}</u>, জমির পরিমাণ-  <u> {{ $row->land_length }}</u>
                </td>
            </tr>



            <tr>
                <td>৬</td>
                <td>ইমারত/স্থাপনার আয়তন</td>
                <td>{{ $row->ayoton }}</td>
            </tr>



            <tr>
                <td>৭</td>
                <td>প্রাস্তাবিত স্থানের জমির মালিকানা সংক্রান্ত কাগজপত্রাদি সঠিক রয়েছে কি, না?</td>
                <td>{{ $row->paperTrueOrNot }}</td>
            </tr>



            <tr>
                <td>৮</td>
                <td>BNBC এর কোড ও ইমারত নির্মাণ বিধিমালা অনুযায়ী নকশা প্রস্তুত করা হয়েছে কি না?</td>
                <td>{{ $row->mapBNNCCode }}</td>
            </tr>



            <tr>
                <td>৯</td>
                <td>সুপারভিশন ইঞ্জিনিয়ার নিয়োগ করা হয়েছে কি না?</td>
                <td>{{ $row->Supervision_Engineer }}</td>
            </tr>

            <tr>
                <td>১০</td>
                <td>প্রস্তাবিত জায়গায় ভবন/স্থাপনা নির্মাণ করা হলে  পরিবেশগত কোন ক্ষতির সম্ভাবনা রয়েছে কি না?</td>
                <td>{{ $row->posibleFalse }}</td>
            </tr>

            <tr>
                <td>১১</td>
                <td>তদন্তকারীর মন্তব্য</td>
                <td>{{ $row->note }}</td>
            </tr>


        </table>



    <div style="width:100%;margin-top:50px" >

<p style="text-align: center;width:200px;float:right">
        <img width="200px" src="{{ base64($row->reporter_signature) }}" alt=""> <br>
    <span style='margin-bottom:0 !important'>{{ $row->reporter_name }}</span> <br>
    <span style='margin-bottom:0 !important'>তদন্তকারীর সাক্ষর</span>
</p>

    </div>



</body>
</html>
