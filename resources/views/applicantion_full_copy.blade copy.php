<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>

    <style>
.form_title {
    border-bottom: 2px solid #159513;
    color: #159513;
    margin: 23px 0;
}
.form_title h5 {
    color: #159513 !important;
}
.text-center{
    text-align: center;
}

    </style>

</head>
<body style="font-family: 'bangla', sans-serif;">



    <div class="row">

        <div class="col-md-12 text-center">
            <img width="100px"  src="{{ base64($row->passport_size_mage) }}" alt="">
        </div>





        <div class="col-md-12 form_title">
            <h5>আবেদনকারীর নামঃ</h5>
        </div>


        <table width="100%">
            @if($row->applicant_type=='একক ব্যক্তি')
            <tr>
                <td width='33.33%'><b>আবেদনকারীর ধরণ : </b>{{ $row->applicant_type }}</td>
                <td width='33.33%'><b>নাম : </b>{{ $row->appicant_name }}</td>
                <td width='33.33%'><b>পিতার নাম : </b>{{ $row->applicant_father_name }}</td>
            </tr>
            @elseif ($row->applicant_type=='সমবায় সমিতি/প্রতিষ্ঠান')
            <tr>
                <td width='33.33%'><b>আবেদনকারীর ধরণ : </b>{{ $row->applicant_type }}</td>
                <td width='33.33%'><b>সমিতি/প্রতিষ্ঠানের নাম : </b>{{ $row->appicant_sumiti_name }}</td>
                <td width='33.33%'><b>রেজিস্ট্রেশন নম্বর : </b>{{ $row->applicant_sumiti_registration_no }}</td>
            </tr>
            <tr>
                <td colspan="3"><b>আবেদন করিবার জন্য ক্ষমতাপ্রাপ্ত প্রতিনিধির নাম : </b>{{ $row->applicant_p_m_name }}</td>
            </tr>
            @elseif ($row->applicant_type=='একটি গোষ্ঠী')
            <tr>
                <td width='33.33%'><b>আবেদনকারীর ধরণ : </b>{{ $row->applicant_type }}</td>
                <td width='33.33%'><b>গোষ্ঠীর নাম : </b>{{ $row->gostir_name }}</td>
                <td width='33.33%'><b>আবেদন করিবার জন্য ক্ষমতাপ্রাপ্ত প্রতিনিধির নাম : </b>{{ $row->applicant_g_p_m_name }}</td>
            </tr>
            @endif


        </table>




        <div class="col-md-12 form_title">
            <h5>আবেদনকারীর ঠিকানা</h5>
        </div>




        <table width="100%">

            <tr>
                <td width='33.33%'><b>জেলা : </b>{{ $row->district }}</td>
                <td width='33.33%'><b>উপজেলা : </b>{{ $row->upozila }}</td>
                <td width='33.33%'><b>ইউনিয়ন : </b>{{ $row->union }}</td>
            </tr>

            <tr>
                <td width='33.33%'><b>ডাকঘর : </b>{{ $row->post }}</td>
                <td width='33.33%'><b>ওয়ার্ড নং : </b>{{ $row->wordNo }}</td>
                <td width='33.33%'><b>গ্রাম : </b>{{ $row->village }}</td>
            </tr>

            <tr>
                <td width='33.33%'><b>মোবাইল নম্বর : </b>{{ $row->mobile_number }}</td>
                <td width='33.33%'><b>জাতীয় পরিচয় নং : </b>{{ $row->nid_no }}</td>
                <td width='33.33%'><b>প্রার্থীত নলকূপের শ্রেণি : </b>{{ $row->nolkup_type }}</td>
            </tr>

            <tr>
                <td width='33.33%'><b>প্রার্থীত নলকূপের সাইজ : </b>{{ $row->nolkup_size }}</td>
                <td width='33.33%'></td>
                <td width='33.33%'></td>
            </tr>

        </table>







        <div class="col-md-12 form_title">
            <h5>নলকূপের দ্বারা সম্ভাব্য উপকৃত এলাকা এবং তথ্যাদি</h5>
        </div>


        <div class="col-md-12 col-12 mt-3">{{ $row->area_description }}</div>



        <div class="col-md-12 form_title">
            <h5>নলকূপ স্থাপনের প্রস্তাবিত স্থান</h5>
        </div>



        <table width="100%">

            <tr>
                <td width='33.33%'><b>এলাকার নাম : </b>{{ $row->area_name }}</td>
                <td width='33.33%'><b>মৌজার নাম : </b>{{ $row->mouja_name }}</td>
                <td width='33.33%'><b>জে.এল নং : </b>{{ $row->JL_No }}</td>
            </tr>

            <tr>
                <td width='33.33%'><b>খতিয়ান নং : </b>{{ $row->khotiyan_no }}</td>
                <td width='33.33%'><b>দাগ নং : </b>{{ $row->dag_NO }}</td>
                <td width='33.33%'><b>চাষাবাদকৃত জমির পরিমাণ : </b>{{ $row->land_amount }}</td>
            </tr>


        </table>








        <div class="col-md-12 form_title">
            <h5>প্রস্তাবিত স্থান হতে নিকটবর্তী নলকূপের দূরত্ব</h5>
        </div>

        <table width="100%">

            <tr>
                <td width='33.33%'><b>নিকটবর্তী নলকূপের শ্রেণি : </b>{{ $row->near_nolkup_type }}</td>
                <td width='33.33%'><b>উত্তর দিকে (মিটার ) : </b>{{ $row->near_nolkup_uttor }}</td>
                <td width='33.33%'><b>দক্ষিণ দিকে (মিটার ) : </b>{{ $row->near_nolkup_dokkhin }}</td>
            </tr>

            <tr>
                <td width='33.33%'><b>পূর্ব দিকে (মিটার ) : </b>{{ $row->near_nolkup_purbo }}</td>
                <td width='33.33%'><b>পশ্চিম দিকে (মিটার ) : </b>{{ $row->near_nolkup_poscim }}</td>
                <td width='33.33%'><b>বৈদ্যুতিক সংযোগের দূরত্ব (মিটার ) : </b>{{ $row->electricity_distance }}</td>
            </tr>

            <tr>
                <td width='33.33%'><b>লাইসেন্স প্রদানের জন্য কোনো বিশেষ বিবেচনা : </b>{{ $row->description }}</td>
                <td width='33.33%'><b>জমাকৃত ফি এর পরিমাণ : </b>{{ $row->deposite_fee }}</td>
                <td width='33.33%'><b>জমাদানের তারিখ : </b>{{ $row->deposite_date }}</td>
            </tr>

            <tr>
                <td width='33.33%'><b>নলকূপ স্থাপনের জন্য প্রস্তাবিত স্থান/জমির মালিকানার ধরণ : </b>{{ $row->owner_type }}</td>
                <td width='33.33%'></td>
                <td width='33.33%'></td>
            </tr>


        </table>

        </div>

        <pagebreak />

        <div class="row">







            <div class="col-md-12 form_title">
                <h5>জাতীয় পরিচয়পত্রের কপি</h5>
            </div>

            <div class="col-md-12 text-center">
                <img width="250px" height="300px" src="{{ base64($row->nid_copy) }}" alt="">

            </div>



            <div class="col-md-12 form_title">
                <h5>দলিলের কপি</h5>
            </div>

            <div class="col-md-12 text-center">
                <img width="250px" height="300px" src="{{ base64($row->land_copy) }}" alt="">
            </div>

            <pagebreak />

            <div class="col-md-12 form_title">
                <h5>খতিয়ানের কপি</h5>
            </div>

            <div class="col-md-12 text-center">
                <img width="250px" height="300px" src="{{ base64($row->khotiyan_copy) }}" alt="">

            </div>



            <div class="col-md-12 form_title">
                <h5>ভূমি উন্নয়ন কর পরিশোধের কপি</h5>
            </div>

            <div class="col-md-12 text-center">
                <img width="250px" height="300px" src="{{ base64($row->tax_copy) }}" alt="">
            </div>

            <pagebreak />

            <div class="col-md-12 form_title">
                <h5>নকশা/মৌজা ম্যাপ</h5>
            </div>

            <div class="col-md-12 text-center">
                <img width="250px" height="300px" src="{{ base64($row->map) }}" alt="">
            </div>




            <div class="col-md-12 form_title">
                <h5>ওয়ারিশান সনদপত্রের কপি</h5>
            </div>

            <div class="col-md-12 text-center">
                <img width="250px" height="300px" src="{{ base64($row->wyarisan) }}" alt="">
            </div>




        </div>


</body>
</html>
