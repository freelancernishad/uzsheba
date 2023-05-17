<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>sechsheba-{{ $licence_no }}.pdf</title>

</head>
<body style="font-family: 'bangla', sans-serif;font-size:14px;">

    <div style="border:5px solid rgb(119, 119, 119);padding:10px">


    <table class="table" width="100%" style="margin-bottom:10px">
        <tr>
            <th style="text-align:left">

                <img width="50px" src="{!! $badc_logos !!}" alt="">

            </th>
            <th >
                <img width="50px" src="{!! $gov_logos !!}" alt="">



            </th>
             <th  style="text-align:right">
                <img width="50px" src="{!! $mojib_logos !!}" alt="">

            </th>
        </tr>

    </table>
    <table class="table" width="100%">

        <tr>
            <th width="120px" rowspan="4">

                <img width="120px" src="{!! $image !!}" alt="">

            </th>
            <th width="66%" ><div> <span  style="font-size:18px">উপজেলা সেচ কমিটি</span>  <br> তেঁতুলিয়া, পঞ্চগড়।</div> </div>

            </th>
              <th></th>
        </tr>
            <tr>



                <th colspan="2"   style="background:#06502B;color:white;width:100%;padding:10px;font-size:25px"><div> গভীর/অগভীর/পাওয়ার পাম্প স্থাপনের লাইসেন্স</div>

                </th>


            </tr>


            <tr>

                <th  width="66%" style="padding-left:0px;margin-left:10px;">
                <div style="" >
                    ফরম-খ <br>
                    [বাংলাদেশ গেজেট, অতিরিক্ত সংখ্যা, শনিবার, মে ২৫, ২০১৯, বিধি ৬(১) দ্রষ্টব্য]
                    </div>
                </th>

                <th></th>
            </tr>
            <tr>

                <th   style="text-align:center;">

                </th>
            </tr>


    </table>
    <?php
    $originalDate =$row->approved_date;
    $newDate = date("d/m/Y", strtotime($originalDate));

    $tomorrow = date("d/m/Y", strtotime("+1095 day"));

    ?>

<div style="width:300px;margin:0 auto;background:#06502B;color:white;text-align:center;padding:8px 12px;font-size:20px">লাইসেন্স নং {{ int_en_to_bn($row->licence_no ) }}</div>





<div style="width:500px;margin:5px auto;text-align:center;padding:8px 12px;font-size:20px;border:1px solid #06502B">প্রদানের তারিখ: {{ int_en_to_bn($newDate) }} &nbsp; | &nbsp; মেয়াদঃ {{ int_en_to_bn($tomorrow) }}</div>








<div style="margin-top:30px;">জেলা: পঞ্চগড়,	&nbsp;	উপজেলা: তেঁতুলিয়া, &nbsp;	ইউনিয়ন: {{ $row->union }}, &nbsp;
    নলকূপের শ্রেণি: {{ $row->nolkup_type }},	&nbsp;		সাইজ: {{ $row->nolkup_size }} &nbsp; <br>




    <?php
    if ($row->applicant_type == 'একক ব্যক্তি') {
    ?>
নামঃ {{ $row->appicant_name }},&nbsp;
পিতার নাম: {{ $row->applicant_father_name }},&nbsp;
    <?php
    } else if ($row->applicant_type == 'সমবায় সমিতি/প্রতিষ্ঠান') {
    ?>
    নামঃ {{ $row->appicant_sumiti_name }},&nbsp;
    সমবায় সমিতি/প্রতিষ্ঠান পক্ষে {{ $row->applicant_p_m_name }},&nbsp;
    <?php

    } else if ($row->applicant_type == 'একটি গোষ্ঠী') {
    ?>
    নামঃ {{ $row->gostir_name }},&nbsp;
    সমবায় গোষ্ঠীর পক্ষে {{ $row->applicant_g_p_m_name }},&nbsp;
    <?php
    }

    ?>




    গ্রাম: {{ $row->village }}, &nbsp; ডাকঘর: {{ $row->post }},&nbsp;
    উপজেলা: {{ $row->upozila }}, &nbsp;  জেলা: {{ $row->district }}।&nbsp; <br>
    মৌজা: {{ $row->mouja_name }},&nbsp; জে.এল.নং- {{ $row->JL_No }},&nbsp; খতিয়ান নং- {{ $row->khotiyan_no }},&nbsp;
    দাগ নং- {{ $row->dag_NO }},&nbsp; জমির পরিমাণ: {{ $row->land_amount }} - তে নিম্নে বর্ণিত শর্তে নলকূপ স্থাপনের জন্য লাইসেন্স প্রদান করা হলো।
    </div>





    <div style="width:80px;margin-top:20px;font-size:20px;background:#06502B;color:white;text-align:center">শর্তাবলী</div>
    <div >
        ১.	লাইসেন্সের মেয়াদ ইস্যুর তারিখ হতে ০৩ (তিন) বছর পর্যন্ত বলবৎ থাকবে। <br>
        ২.	লাইসেন্স প্রাপ্তির ০১ (এক) বছরের মধ্যে নলকূপ স্থাপন করা না হলে লাইসেন্সটি বাতিল বলে গণ্য হবে।  <br>
        ৩.	নলকূপ স্থাপনের ০৭ (সাত) দিনের মধ্যে স্থাপনের তারিখ উপজেলা সেচ কমিটিকে অবহিত করতে হবে। <br>
        ৪.	উপজেলা সেচ কমিটির অনুমতি ব্যতিরেখে নলকূপের স্থান পরিবর্তন বা অন্য কোনভাবে স্থানান্তর করা যাবে না। <br>
        ৫.	কৃষি কাজের জন্য সেচ কার্য ছাড়া অন্য কেনো কাজে নলকূপটি ব্যবহার করা যাবে না। <br>
        ৬.	লাইসেন্স হস্তান্তরযোগ্য নয়। <br>
        ৭.	সেচযন্ত্রটি কোন প্রকার বাণিজ্যিক কাজে ব্যবহার করা যাবে না। <br>
        ৮.	সেচযন্ত্রটি পরিচালনার ক্ষেত্রে কোন প্রকার লীজ গ্রহণযোগ্য নয়। <br>
        ৯.	সেচ চার্জ রশিদের মাধ্যমে আদায় করতে হবে এবং সেচের যাবতীয় আদায়ের হিসাব যথাযথভাবে সংরক্ষণ করতে হবে <br>
        ১০.	লাইসেন্সটির মেয়াদকাল পর্যন্ত সেচ সুবিধাভোগীদের মধ্যে সেচচার্জ, পানি সরবরাহ, অংশীদারদের মধ্যে দ্ব`দ্ব ইত্যাদির ক্ষেত্রে বিনা &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; নোটিশে  লাইসেন্সটি বাতিল করার ক্ষমতা উপজেলা সেচ কমিটি সংরক্ষণ করে। <br>
        ১১.	লাইসেন্সের মেয়াদ উত্তীর্ণ হওয়ার অন্যূন ৭ (সাত) দিন পূর্বে লাইসেন্স নবায়নের জন্য বিধি ৪ এর উপ-বিধি (৩) এ উল্লিখিত ফি সহ &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;তপশিল-২  এর ফরম গ অনুযায়ী উপজেলা পরিষদের নিকট আবেদন করতে হবে। <br>
        ১২.	লাইসেন্স নবায়নের জন্য আবেদন করিতে বিলম্ব হলে, উক্ত বিলম্বের জন্য নবায়ন ফি এর অতিরিক্ত হিসাবে, গভীর নলকূপের ক্ষেত্রে &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp;  ৫০০/-  (পাঁচশত) টাকা এবং অগভীর নলকূপের ক্ষেত্রে ২৫০ (দুইশত পঞ্চাশ) টাকা বিলম্ব ফি জমা প্রদান করতে হবে। <br>
        ১৩.	তবে শর্ত থাকে যে, উক্ত বিলম্বের সময়সীমা লাইসেন্সের মেয়াদ উত্তীর্ণের তারিখ হতে ৬০ (ষাট) দিনের অধিক হলে নতুন করে &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; লাইসেন্সের জন্য  আবেদন করতে হবে। <br>

    </div>


<table width="100%" style="margin-top:20px;">
<tr>
    <td width="15%" style="text-align:center">

       {!! $qrcode !!}

    </td>
       <td width="50%">



    </td>

    <td>


            <center style="text-align:center">
                উপজেলা নির্বাহী অফিসার
                 <br>
        ও  <br>
        সভাপতি <br>
        উপজেলা সেচ কমিটি <br> তেঁতুলিয়া, পঞ্চগড়।

            </center>


    </td>
</tr>
</table>







<div style="width:400px;margin:0 auto;background:#06502B;color:white;text-align:center;padding:8px 12px;font-size:16px">স্বল্প সেচে অধিক ফসল, সেচনীতির মন্ত্র আসল</div>

<div style="width:100%;text-align:center;margin-top:10px">ইস্যুকৃত সনদ যাচাই করেত QR কোড স্ক্যান করুন অথবা ভিজিট করুন www.sechshebatetulia.gov.bd</div>

</div>


</body>
</html>
