<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
@page {

	margin: 0px;
    background-color:#F3E308;


}


        .bodyBg {
            background: #F3E308 !important;
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
            font-size: 14px;
        }
    </style>
</head>
<body style="font-family: 'bangla', sans-serif;background: #F3E308 !important;">

    <div style="width:46.5%;float: left;padding:1.5%;">


        <p class="bgtitle" style="text-align:center;margin:0;margin-bottom:10px;margin-top:25px">
            <b>প্রতিটি শিশুর রয়েছে সবগুলাে টিকা পাওয়ার অধিকার </b>
        </p>

        <table width="100%" border="1" style="border-collapse:collapse;">
            <tr>
                <td width='75%'>টিকা কেন্দ্রে আসার তারিখসমূহ</td>
                <td width="25%">তারিখ</td>
            </tr>
            <tr>
                <td>১। ১ম বার শিশুকে বিসিজি, পােলিও-১, পেন্টা-১ | (ডিপিটি, হেপা-বি, হিব) টিকা
                    পাওয়ার তারিখ
                    (পেন্টা-১ এবং হামের ক্যালেন্ডার থেকে)।</td>
                <td style="font-size:12px">{{ int_en_to_bn($row->first_dose) }}</td>
            </tr>
            <tr>
                <td>২। ২য় বার শিশুকে পােলিও-২, পেন্টা-২ (ডিপিটি,
                    হেপা-বি, হিব) টিকা দেয়ার জন্য যে তারিখে টিকা
                    কেন্দ্রে আনতে হবে (সেশন প্ল্যান থেকে)।</td>
                <td style="font-size:12px">{{ int_en_to_bn($row->second_dose) }}</td>
            </tr>
            <tr>
                <td>৩। ৩য় বার শিশুকে পােলিও-৩, পেন্টা-৩ (ডিপিটি,
                    হেপা-বি, হিব) টিকা দেয়ার জন্য যে তারিখে টিকা
                    কেন্দ্রে আনতে হবে (সেশন প্ল্যান থেকে)।</td>
                <td style="font-size:12px">{{ int_en_to_bn($row->third_dose) }}</td>
            </tr>
            <tr>
                <td>৪। ৪র্থ বার শিশুকে হাম, পােলিও-৪, এবং ভিটামিন-এ
                    পাওয়ার তারিখ (পেন্টা-১ এবং হামের ক্যালেন্ডার থেকে)।</td>
                <td style="font-size:12px">{{ int_en_to_bn($row->forth_dose) }}</td>
            </tr>
        </table>
        <p style="margin:0">
            <b>মাঠকর্মী রেজিষ্ট্রেশনের সময় শিশুকে বিসিজি, পােলিও-১, পেন্টা-১ এবং হামের টিকা দেয়ার
                তারিখ লিখে দিবেন।</b>

                <p class="bgtitle" style="text-align:center;margin:0;margin-bottom:10px">
                    <b>যে কোন ধরণের অসুস্থতায় স্বাস্থ্যকর্মীকে খবর দিন এবং
                        শিশুকে নিকটস্থ স্বাস্থ্য কেন্দ্রে নিয়ে আসুন।</b>
                </p>



        <p style="border: 2px solid #d75947;padding: 7px 11px; margin:0;font-size:13px">আপনার এলাকায় জন্মের ২৮ দিনের মধ্যে
            কোন শিশুর মৃত্যু হলে অথবা কোন শিশু হামে আক্রান্ত হলে অথবা ১৫ বছরের কম বয়সের কোন
            ছেলেমেয়ের এক বা একাধিক হাত অথবা পা হঠাৎ থলথলে প্যারালাইসিস হলে সাথে সাথে নিকটস্থ
            স্বাস্থ্য কেন্দ্রে অথবা মাঠকর্মীকে খবর দিন।</p>
        <p style="text-align:center; margin:0;font-size:13px">সম্প্রসারিত টিকাদান কর্মসূচি (ইপিআই), স্বাস্থ্য অধিদপ্তর
            স্বাস্থ্য ও পরিবার কল্যাণ মন্ত্রণালয়।</p>




    </div>
    <div style="width:46.5%;float: right;padding:1.5%">





        <table width="100%">
            <tr>
                <td><img class="logos" src="{{ base64('assets/img/bd-logo.png') }}" alt=""> </td>
                <td style="text-align:center">
                    <h2>শিশু কার্ড</h2>
                </td>
                <td style="text-align:right"><img class="logos"
                        src="{{ base64('assets/img/epi_tika_logo.png') }}" alt=""> </td>
            </tr>


        </table>

        <p class="bgtitle" style="text-align:center;margin:0;margin-bottom:10px">
            <b>জনের ৪২ দিন পূর্ণ হলেই শিশুকে টিকা দেয়া শুরু করুন এবং । নির্দিষ্ট বিরতিতে ১ বছরের
                মধ্যে
                সবগুলাে টিকা দেয়া শেষ করুন। </b>
        </p>


<p style="text-align:left;line-height:2em">
    রেজিষ্ট্রেশন নং <b><u>{{ int_en_to_bn($row->id_no) }}</u></b> রেজিষ্ট্রেশনের তারিখ <b><u>{{ int_en_to_bn(date("d M. Y", strtotime($row->created_at))) }}</u></b> <br>
     নাম <b><u>{{ $row->childs_name }}</u></b> <b><u>{{ $row->gender }}</u></b> <br> জন্ম তারিখ (ইং) <b><u>{{ $row->date_of_birth }}</u></b>  <br> মাতার নাম <b><u>{{ $row->name }}</u></b> পিতার নাম <b><u>{{ $row->husband_name }}</u></b> <br> বাড়ি/জিআর/হােল্ডিং নং............গ্রাম/মহল্লা/পাড়া <b><u>{{ $row->village }}</u></b> <br>উপজেলা/পৌরসভা/সিটি করপােরেশন <b><u>{{ $row->upazila }}</u></b>  জেলা <b><u>{{ $row->district }}</u></b> <br>ইউনিয়ন/জোন <b><u>{{ $row->post_office }}</u></b> ওয়ার্ড নং <b><u>{{ int_en_to_bn($row->word_number) }}</u></b> <br>কেন্দ্রের নাম.....................সাব-রক.........

</p>

{{--
        <div class="childInfo" style="text-align:justify">রেজিষ্ট্রেশন নং ....................রেজিষ্ট্রেশনের তারিখ..................... </div>
        <div class="childInfo" style="text-align:justify;">নাম......................ছেলে/মেয়ে </div>
        <div class="childInfo" style="text-align:justify">জন্ম তারিখ (ইং)........দিন........মাস.........বছর </div>
        <div class="childInfo" style="text-align:justify">মাতার নাম..................... ............. পিতার নাম................... </div>
        <div class="childInfo" style="text-align:justify">বাড়ি/জিআর/হােল্ডিং নং............গ্রাম/মহল্লা/পাড়া.................... </div>
        <div class="childInfo" style="text-align:justify">উপজেলা/পৌরসভা/সিটি করপােরেশন.................... জেলা ... </div>
        <div class="childInfo" style="text-align:justify">ইউনিয়ন/জোন....................ওয়ার্ড নং....... </div>
        <div class="childInfo" style="text-align:justify">কেন্দ্রের নাম.....................সাব-রক......... </div> --}}




        <p class="bgtitle" style="text-align:center;margin:0;margin-bottom:10px">
            <b> টিকার এই কার্ডটি যত্ন করে রাখুন। ভবিষ্যতে শিশুকে স্কুলে ভর্তি করানাের সময়, বিদেশে
                গমনের সময় এবং টিডি টিকা দেয়ার সময় এই কার্ডটির প্রয়ােজন হবে। </b>
        </p>

    </div>
</body>
</html>
