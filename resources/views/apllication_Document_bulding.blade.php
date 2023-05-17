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

    <p style="font-size: 25px;text-align:center">তফসিল-১</p>
    <p style="font-size: 18px;text-align:center">(বিধি ২ এর দফা (চ) দ্রষ্টব্য)</p>


    <p  class="defaultFontSize">Building Construction Act, 1952 (E.B Act II of 1953) এর section 3 এবং 3c এর অধীন ইমারত নির্মাণ/পুকুর খনন/পাহাড় কর্তন বা ধ্বংস সাধন অনুমোদনের জন্য আবেদনপত্রের ফরম।</p>

    <ol  class="defaultFontSize"  style="margin-top:0px;padding-left: 15px;">
        <li>আবেদনকারী/আবেদনকারীগণের পূর্ণ নাম :- @if($row->applicant_type=='একক ব্যক্তি') {{ $row->appicant_name }} @elseif($row->applicant_type=='সমবায় সমিতি/প্রতিষ্ঠান') {{ $row->gostir_name }} @elseif($row->applicant_type=='একটি গোষ্ঠী') {{ $row->appicant_sumiti_name }} @endif</li>

        <li>আবেদনকারী/আবেদনকারীগণের পূর্ণ ঠিকানা :-
            <ol  class="defaultFontSize"  style="margin-top:0px;padding-left: 15px;">
                <li>বর্তমান/ডাকযোগাযোগের ঠিকানা : {{ $row->district }},{{ $row->upozila }},{{ $row->upozila }},{{ $row->upozila }},{{ $row->post }}</li>
            </ol>
        </li>
        <li>যে দাগের জমিতে ইমারত নির্মাণ/পুকুর খনন/পাহাড় কর্তন বা ধ্বংস সাধন করা হইবে উহার বিবরণ :-
            <ol  class="defaultFontSize"  style="margin-top:0px;padding-left: 15px;">
                <li>সিটি কর্পোরেশন/পৌরসভা/আম/মহল্লা/ উন্নয়নকৃত এলাকার নাম: {{ $sonod->areaName }}</li>
                <li>দাগ ও খতিয়ান নং (জরিপ মোতাবেক)/প্লট নংঃ{{ $sonod->dagKhotiyan }}</li>
                <li>মৌজার নাম / ব্লক নং/সেক্টর নংঃ{{ $sonod->Mouja }}</li>
                <li>ওয়ার্ড নং (প্রযোজ্য ক্ষেত্রে){{ $sonod->wordNo }}</li>
                <li>রাস্তার নামঃ{{ $sonod->rastarName }}</li>
                <li>সিট নং (প্রযোজ্য ক্ষেত্রে){{ $sonod->sitNo }}</li>
                <li>দাগে আবেদনকারী/আবেদনকারীগণের অংশের পরিমাণঃ{{ $sonod->dageApplicantOngso }}</li>
                <li>আবেদনকারী/আবেদনকারীগণ কি সূত্রে সাইটের জমি অর্জন করিয়াছেন (মালিকানার প্রমাণপত্র দাখিল করিতে হইবে){{ $sonod->jomirMakilType }}</li>
            </ol>
        </li>
        <li>সাইটের বিবরণ :-
            <ol  class="defaultFontSize"  style="margin-top:0px;padding-left: 15px;">
                <li>সাইটের আয়তন (ক্ষেত্রফল):{{ $sonod->siterAyoton }}</li>
                <li>সাইটের চৌহদ্দী (বাহুর পরিমাণ)
                    <ol  class="defaultFontSize"  style="margin-top:0px;padding-left: 15px;">
                        <li>উত্তরেঃ{{ $sonod->siterUttore }}</li>
                        <li>দক্ষিণেঃ{{ $sonod->siterDokhine }}</li>
                        <li>পূর্বেঃ{{ $sonod->siterPurbe }}</li>
                        <li>পশ্চিমেঃ{{ $sonod->siterPoschime }}</li>
                    </ol>
                </li>
                <li>ইমারত দ্বারা সাইটের যে পরিমাণ স্থান আচ্ছাদিত হইবে তাহার বিশদ বিবরণ-
                    <ol  class="defaultFontSize"  style="margin-top:0px;padding-left: 15px;">
                        <li>১ম তলা - {{ $sonod->protomTola }}</li>
                        <li>অন্যান্য তলা - {{ $sonod->OnnannoTola }}</li>
                    </ol>
                </li>
                <li>সাইটের নিকটস্থ রাস্তার বিবরণ-
                    <ol  class="defaultFontSize"  style="margin-top:0px;padding-left: 15px;">
                        <li>নামঃ{{ $sonod->siterNikotName }}</li>
                        <li>অবস্থান (কোনদিকে):{{ $sonod->siterNikotObostan }}</li>
                        <li>দূরত্বঃ{{ $sonod->siterNikotDurotto }}</li>
                        <li>বিস্তার:{{ $sonod->siterNikotBistar }}</li>
                    </ol>
                </li>
                <li>নিকটস্থ রাস্তা হইতে সাইটে যাতায়াতের উপায়ঃ{{ $sonod->siterNikotJatayatUpay }}</li>
                <li>সাইটের বিভিন্ন দিকে যে পরিমাণ স্থান উন্মুক্ত রাখা হইবে-
                    <ol  class="defaultFontSize"  style="margin-top:0px;padding-left: 15px;">
                        <li>উত্তর সীমানা হইতেঃ{{ $sonod->siterFakaUttorDike }}</li>
                        <li>দক্ষিণ সীমানা হইতেঃ{{ $sonod->siterFakaDokhinDike }}</li>
                        <li>পূর্ব সীমানা হইতেঃ{{ $sonod->siterFakaPurboDike }}</li>
                        <li>পশ্চিম সীমানা হইতেঃ{{ $sonod->siterFakaPoschimDike }}</li>
                    </ol>

                </li>
                <li>সাইটের পূর্ব নির্মিত কাঁচা পাকা ইমারতের (যদি থাকে) বিবরণ ঃ-
                    <ol  class="defaultFontSize"  style="margin-top:0px;padding-left: 15px;">
                        <li>পূর্ব নির্মিত ইমারতের সংখ্যা ও তদ্বারা বেষ্টিত স্থানের পরিমাণঃ{{ $sonod->PurbeImaroterSonkha }}</li>
                        <li>প্রস্তাবিত ইমারত নির্মাণ অনুমোদিত হইলে পূর্ব নির্মিত ইমারতের কোন অংশ ভাংগিতে হইবে কিনা এবং হইলে তদ্বারা বেষ্টিত স্থানের পরিমাণঃ{{ $sonod->vagaStanerPoriman }}</li>
                    </ol>
                </li>
            </ol>
        </li>
        <li>এলাকার বিভিন্ন সেবা-সুযোগের বিবরণ :-
            <ol  class="defaultFontSize"  style="margin-top:0px;padding-left: 15px;">
                <li>বিদ্যুৎ সরবরাহ লাইন আছে কিনাঃ{{ $sonod->BidudLIneAcheKina }}</li>
                <li>পানি সরবরাহ লাইন আছে কিনাঃ{{ $sonod->BidudLIneAcheKina }}</li>
                <li>গ্যাস সরবরাহ লাইন আছে কিনাঃ{{ $sonod->BidudLIneAcheKina }}</li>
                <li>পয়ঃ নিস্কাশন লাইন আছে কিনাঃ{{ $sonod->BidudLIneAcheKina }}</li>
                <li>প্রস্তাবিত ইমারতের ক্ষেত্রে সেপ্টিক ট্যাংকের ব্যবস্থা আছে কিনাঃ{{ $sonod->BidudLIneAcheKina }}</li>
            </ol>
        </li>
        <li>প্রস্তাবিত ইমারত নির্মাণ/পুকুর খনন/পাহাড় কর্তন বা ধ্বংস সাধনের কাজ কখন শুরু হইবেঃ-{{ $sonod->startDate }}</li>
        <li>প্রস্তাবিত ইমারত নির্মাণ/পুকুর খনন/পাহাড় কর্তন বা ধ্বংস সাধনের উদ্দেশ্যঃ-{{ $sonod->uddesso }}</li>
        <li>অথরাইজড অফিসারের অনুমোদন ব্যতীত আবেদনকারী পূর্বে কোন ইমারত নির্মাণ/পুকুর খনন/পাহাড় কর্তন বা ধ্বংস সাধন করিয়া থাকিলে তজ্জন্য তাহার বিরুদ্ধে Building Construction Act, 1952 (E.B. Act II of 1953) এর অধীন নোটিশ জারী হইয়াছে কিনাঃ-{{ $sonod->faltImarotTodontto }}</li>
        <li>প্রস্তাবিত ইমারত নির্মাণ/পুকুর খনন/পাহাড় কর্তন বা ধ্বংস সাধন সম্পর্কে আবেদনকারীর বিরুদ্ধে Building Construction Act, 1952 (E.B. Act II of 1953) এর section 12 এর অধীন কোন মামলা দায়ের হইয়াছে কিনাঃ-{{ $sonod->mamlaTodontto }}</li>
        <li>প্রস্তাবিত পুকুর খনন/পাহাড় কর্তন বা ধ্বংস সাধনের স্থান হইতে নিকটবর্তী ঃ-
            <ol  class="defaultFontSize"  style="margin-top:0px;padding-left: 15px;">
                <li>রাস্তার দূরত্বঃ{{ $sonod->rastarDurotto }}</li>
                <li>ইমারতের দূরত্বঃ{{ $sonod->imaroterDurotto }}</li>
                <li>পয়ঃ নালার দূরত্বঃ{{ $sonod->poyNalarDurotto }}</li>
                <li>বিদ্যুৎ সরবরাহ লাইনের দূরত্বঃ{{ $sonod->bidudLineDurotto }}</li>
                <li>গ্যাস সরবরাহ লাইনের দূরত্বঃ{{ $sonod->gasLineDurotto }}</li>
            </ol>
        </li>
    </ol>


    <p  class="defaultFontSize detailsOfSonod" >
        আমি @if($row->applicant_type=='একক ব্যক্তি') {{ $row->appicant_name }} @elseif($row->applicant_type=='সমবায় সমিতি/প্রতিষ্ঠান') {{ $row->gostir_name }} @elseif($row->applicant_type=='একটি গোষ্ঠী') {{ $row->appicant_sumiti_name }} @endif ইমারত নির্মাণ/পুকুর খনন/পাহাড় কর্তন বা ধ্বংস সাধন অনুমোদনের জন্য প্রয়োজনীয় নকশার ............... ফর্দ এবং ................ টাকা ফি............. ব্যাংক শাখার ব্যাংক ড্রাফট/পে অর্ডার/ট্রেজারী চালান নং ................. তারিখ এর মাধ্যমে যথাযথ কর্তৃপক্ষের নিকট জমা দিয়া উক্ত ব্যাংক ড্রাফট/পে-অর্ডার/ট্রেজারী চালান এর কপি এতদসংগে সংযুক্ত করতঃ ঘোষণা করিতেছি যে, সংযুক্ত নকশা ইমারত নির্মাণ বিধিমালা ১৯৯৬ মোতাবেক প্রণীত এবং এই আবেদনপত্রে বর্ণিত তথ্য ও সংযুক্ত নকশার সমস্ত বিবরণ সত্য।
    </p>

    <br/>
    <br/>
    <br/>

   <p  class="defaultFontSize detailsOfSonod" style="width:60%;margin:0 auto" >
            আবেদনকারীর/আবেদনকারীগণের নাম ও স্বাক্ষর.................. <br/>
            (ক) পূর্ণ নাম :-  @if($row->applicant_type=='একক ব্যক্তি') {{ $row->appicant_name }} @elseif($row->applicant_type=='সমবায় সমিতি/প্রতিষ্ঠান') {{ $row->gostir_name }} @elseif($row->applicant_type=='একটি গোষ্ঠী') {{ $row->appicant_sumiti_name }} @endif, স্বাক্ষর.................<br/>
            (খ) ঠিকানা :- {{ $row->district }},{{ $row->upozila }},{{ $row->upozila }},{{ $row->upozila }},{{ $row->post }}<br/>
            (গ) ফোন নং (যদি থাকে) :- {{ $row->mobile_number }}<br/>
    </p>


</body>

</html>
