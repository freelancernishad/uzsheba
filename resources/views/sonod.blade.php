<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sechsheba-{{ $licence_no }}.pdf</title>

    <style>
        .defaultFontSize , .defaultFontSize li , .defaultFontSize p{
            font-size: 14px;
            margin-bottom: 0;
        }
        .detailsOfSonod:first-line {
            text-indent: 1em;
        }
        .paddingAdd{
            padding: 5px;
        }
    </style>


</head>

<body style="font-family: 'bangla', sans-serif;">



            <table width="100%" style="border-collapse: collapse;" border="0">
                <tr>
                    <td style="text-align: center;" width="25%"></td>
                    <td style="text-align: center;" width="50%">
                        <p style="font-size: 25px;">উপজেলা পরিষদ</p>
                        <p class="defaultFontSize">তেতুলিয়া,পঞ্চগড়</p>
                        <p class="defaultFontSize">www.website.com</p>
                    </td>
                    <td style="text-align: center;" width="25%">
                        <span style="color:#b400ff;"><b>উন্নয়নের গণতন্ত্র,  <br /> শেখ হাসিনার মূলমন্ত্র </b></span>
                    </td>
                </tr>
            </table>


            <table width="100%" style="border-collapse: collapse;" border="0">
                <tr>
                    <td style="text-align: left;" width="50%"  class="defaultFontSize">
                    সনদ নং - {{ int_en_to_bn($row->licence_no) }}
                    </td>

                    <td style="text-align: right;" width="50%"  class="defaultFontSize">
                        তারিখঃ {{ int_en_to_bn(date('d/m/Y', strtotime($row->approved_date))) }}
                    </td>
                </tr>
            </table>

            <p  class="defaultFontSize" style="font-weight: 500"><b> বিষয়: ইমারত/স্থাপনার নকশা অনুমোদন প্রদান</b></p>


            <table width="100%" style="border-collapse: collapse;" border="0">
                <tr>
                    <td  width="5%" style="  vertical-align: top;">
                    <p  class="defaultFontSize">সুত্র:</p>
                    </td>

                    <td  width="95%"  style="  vertical-align: top;">
                        <p  class="defaultFontSize">

                            ১। স্থানীয় সরকার বিভাগের ইপ-১ অধিশাখার গত ১০/০৭/২০১৭ তারিখের ৫৪২ নং স্মারক। <br/>
                            ২। জনাব {{ $row->applicant_name }}, পিতা- {{ $row->applicant_father_name }}, বর্তমান ঠিকানা: গ্রাম- {{ $row->applicant_present_village }}, ডাকঘর- {{ $row->applicant_present_post_office }}, উপজেলা- {{ $row->applicant_present_Upazila }}, জেলা- {{ $row->applicant_present_district }} কর্তৃক অত্রাফিসে দাখিলকৃত আবেদন।  <br/>
                        </p>
                    </td>
                </tr>
            </table>

            <p  class="defaultFontSize detailsOfSonod" >
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;উপর্যুক্ত বিষয় ও সূত্রের প্রেক্ষিতে জানানো যাচ্ছে যে জনাব {{ $row->applicant_name }}, পিতা- {{ $row->applicant_father_name }}, বর্তমান ঠিকানা: গ্রাম- {{ $row->applicant_present_village }}, ডাকঘর- {{ $row->applicant_present_post_office }}, উপজেলা- {{ $row->applicant_present_Upazila }}, জেলা- {{ $row->applicant_present_district }} এর নিকট হতে নিম্ন তফসিল বর্ণিত জমির উপর {{ int_en_to_bn($sonod->siterAyoton) }} স্কয়ারফিট আয়তনের ০৪ (চার) তলা বিশিষ্ট একটি আবাসিক বাসভন নির্মাণের নিমিত্ত ইমারত/স্থাপনার নকশা অনুমোদনের আবেদনপত্র অত্রাফিসে পাওয়া যায়। বর্ণিত আবেদনপত্রের সাথে সংযুক্ত নকশা নিম্নবর্ণিত শর্তসাপেক্ষে অনুমোদন প্রদান করা হলো।
            </p>

            <table width="100%" style="border-collapse: collapse;" border="1">
                <tr>
                    <td  width="50%" style="text-align: center;"  class="defaultFontSize">
                        জমি সংক্রান্ত
                    </td>

                    <td  width="50%" style="text-align: center;"  class="defaultFontSize">
                        ভবন সংক্রান্ত তথ্য
                    </td>
                </tr>

                <tr>
                    <td  width="50%"  class="defaultFontSize paddingAdd">
                        <b><u>তফসিল:</u></b> <br>
                        <p>জেলা- {{ $row->applicant_present_district }}, উপজেলা/থানা- {{ $row->applicant_present_Upazila }}</p>
                        <p>মৌজা- {{ $sonod->Mouja }}, জেএল নং- ১০</p>
                        <p>খতিয়ান নম্বর- {{ int_en_to_bn($sonod->dagKhotiyan) }}, দাগ নম্বর- ৫৪৪ ও ৬৬৩</p>
                        <p>জমির পরিমাণ: {{ int_en_to_bn($sonod->dageApplicantOngso) }}</p>
                    </td>

                    <td  width="50%"  class="defaultFontSize paddingAdd">
                        <b><u>Proposed Plinth Area:</u></b> <br>
                        <p>{{ $sonod->siterAyoton }} SQ.FT.</p>
                        <p>04 (Four) Storied Residential Building</p>
                    </td>
                </tr>
            </table>

            <p class="defaultFontSize" style="margin-top:0px;"> <b><u> শর্তসমূহঃ</u></b></p>

            <ol  class="defaultFontSize"  style="margin-top:0px;padding-left: 15px;">
                <li>Architectural & Structural Design অনুযায়ী ইমারতের নির্মাণ কাজ বাস্তবায়ন নিশ্চিত করতে হবে।</li>
                <li>ইমারত আংশিক বা সম্পূর্ণ নির্মাণ সম্পন্ন হওয়ার পর ব্যবহারের সনদপত্র গ্রহণ করতে হবে।</li>
                <li>যে উদ্দেশ্যে ভবন নির্মানের অনুমতি দেওয়া হয়েছে সে উদ্দেশ্য ব্যতীত অন্য কোন উদ্দেশ্যে ভবন ব্যবহার করা যাবে না।</li>
                <li>ভবন নির্মাণের অনুমতিপত্র পাওয়ার পর ভবনের লে-আউট প্রদানের সময় ভবনের মালিক সুপারভিশন ইঞ্জিনিয়ারের উপস্থিত থাকা নিশ্চিত করবেন।</li>
                <li>নির্মাণ চলাকালীন পার্শ্ববর্তী ভবন, অবকাঠামো এবং জনগণের কোন প্রকার বাধাগ্রস্থ/ক্ষতিসাধন করা যাবে না।</li>
                <li>BNBC (Bangladesh National Building Code) এর কোড অনুযায়ী ইমারতে পানি সরবরাহ পয়ঃনিস্কাশন, ড্রেনের, গ্যাস সরবরাহ, বৈদ্যুতিক স্থাপনা, শীততাপ নিয়ন্ত্রনসহ অন্যান্য সকল সেবা বাস্তবায়ন করতে হবে।</li>
                <li>আবেদনে উল্লেখিত জমির মালিকানা সংক্রান্ত বিষয়ে বিজ্ঞ আদালতে কোন অভিযোগ/মামলা চলমান থাকলে বা হলে তাৎক্ষনিকভাবে প্রদত্ত অনুমোদনপত্রটি তাৎক্ষনিক বাতিল বলে গণ্য হবে।</li>
                <li>ইমারত নির্মাণ কাজের সময় অনুমোদনকৃত নকশা বর্হিভূত কোন কাজ গরমিল পরিলক্ষিত হলে কর্তৃপক্ষ যে কোন সময় অত্র অনুমোদনপত্রটি বাতিল করার ক্ষমতা সংরক্ষণ করে।</li>
            </ol>



            <table width="100%" style="border-collapse: collapse; margin-top:50px" border="0">
                <tr>
                    <td style="text-align: center;" width="50%">
                        @php

                        $qrurl = url("/license/$row->id");


                        //  $qrurl = url("/verification/sonod/$row->id");
                            $qrcode = \QrCode::size(70)
                        ->format('svg')
                        ->generate($qrurl);

                       echo $output = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrcode);
                        @endphp
                    </td>

                    <td style="text-align: center;" width="50%"  class="defaultFontSize">
                       <p>কাজী মাহমদুর রহমান</p>
                       <p>চেয়ারম্যান, উপজেলা পরিষদ</p>
                       <p>ও</p>
                       <p>সভাপতি</p>
                       <p style="font-size: 11px;">উন্নয়ন কর্তৃপক্ষ সমূহের আওতা বহির্ভূত উপজেলা ও ইউনিয়ন পরিষদের অধিক্ষেত্রাধীন এলাকায় ইমারত / স্থাপনার নকশা অনুমোদন এবং ভবনের গুণগতমান নিশ্চিতকরণ বিষয়ক কমিটি</p>
                       <p> তেঁতুলিয়া, পঞ্চগড়।</p>
                    </td>
                </tr>
            </table>


            <p  class="defaultFontSize"><b><u> অনুলিপি: সদয় অবগিত/অবগতি ও কার্যার্থে</u></b></p>


            <ol  class="defaultFontSize" style="padding-left: 15px;">
                <li>উপজেলা নির্বাহী অফিসার, তেঁতুলিয়া, পঞ্চগড়।</li>
                <li>সহকারী কমিশনার (ভূমি), তেঁতুলিয়া, পঞ্চগড় ।</li>
                <li>উপজেলা প্রকৌশলী, এলজিইডি, তেঁতুলিয়া, পঞ্চগড়।</li>
                <li>.....................সদস্য, উন্নয়ন কর্তৃপক্ষ সমূহের আওতা বহির্ভূত উপজেলা
                    ও ইউনিয়ন পরিষদের অধিক্ষেত্রাধীন এলাকায় ইমারত/ স্থাপনার নকশা অনুমোদন এবং ভবনের গুণগতমান নিশ্চিতকরণ বিষয়ক কমিটি, তেঁতুলিয়া, পঞ্চগড়।।</li>
                <li>জনাব আঁখি সরকার, পিতা- মৃত আব্বাস আলী, বর্তমান ঠিকানা: গ্রাম- সাহেবজোত, ডাকঘর ও উপজেলা- তেঁতুলিয়া, জেলা- পঞ্চগড়।</li>
                <li>অফিস কপি ।</li>

            </ol>



</body>

</html>
