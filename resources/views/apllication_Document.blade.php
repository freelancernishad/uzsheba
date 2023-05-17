<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>


</head>
<body style="font-family: 'bangla', sans-serif;">




<div style="text-align:center">
    <h3 style="margin:0 !important;text-align:center">অভিনন্দন</h3>
    <h4 style="margin:0 !important;text-align:center">আপনার আবেদনটি সফল গৃহীত হয়েছে</h4>



    আবেদনের ক্রমিক নং: {{ int_en_to_bn($row->licence_no ) }} । তারিখঃ {{  int_en_to_bn(date('d-m-Y',strtotime($row->created_at))) }}


</div>
<div style="text-align:center">

    তফশিল - ২ <br>
ফরম-ক [বিধি ৪(১) দ্রষ্টব্য] <br>
গভীর/অগভীর নলকূপ স্থাপনের লাইসেন্সের জন্য আবেদন <br>

</div>



<div style="text-align:left">
    বরাবর,<br>
    চেয়ারম্যান,<br>
    উপজেলা পরিষদ, তেঁতুলিয়া, পঞ্চগড়।<br>


</div>
<br>




<div>১.	আবেদনকারীঃ- </div>



<?php
if ($row->applicant_type == 'একক ব্যক্তি') {
?>

<div> &nbsp; &nbsp; &nbsp; নাম: &nbsp; <b style="border-bottom:1px solid black;margin-left:20px" > &nbsp; {{ $row->appicant_name }} </b> &nbsp; পিতার নাম: &nbsp; <b style="border-bottom:1px solid black;margin-left:20px" > &nbsp; {{ $row->applicant_father_name }} </b>   </div>

<?php
} else if ($row->applicant_type == 'সমবায় সমিতি/প্রতিষ্ঠান') {
?>

<div> &nbsp; &nbsp; &nbsp;সমিতি/প্রতিষ্ঠানের নাম : &nbsp; <b style="border-bottom:1px solid black;margin-left:20px" > &nbsp; {{ $row->appicant_sumiti_name }} </b>   </div>
<div>  &nbsp; &nbsp; &nbsp;রেজিস্ট্রেশন নম্বর: &nbsp; <b style="border-bottom:1px solid black;margin-left:20px" > &nbsp; {{ $row->applicant_sumiti_registration_no }} </b> </div>
<div> &nbsp; &nbsp; &nbsp;আবেদন করিবার জন্য ক্ষমতাপ্রাপ্ত প্রতিনিধির নাম : &nbsp; <b style="border-bottom:1px solid black;margin-left:20px" > &nbsp; {{ $row->applicant_p_m_name }} </b>   </div>
<?php

} else if ($row->applicant_type == 'একটি গোষ্ঠী') {
?>

<div> &nbsp; &nbsp; &nbsp;গোষ্ঠীর নাম  : &nbsp; <b style="border-bottom:1px solid black;margin-left:20px" > &nbsp; {{ $row->gostir_name }} </b>   </div>
<div> &nbsp; &nbsp; &nbsp; আবেদন করিবার জন্য ক্ষমতাপ্রাপ্ত প্রতিনিধির নাম: &nbsp; <b style="border-bottom:1px solid black;margin-left:20px" > &nbsp; {{ $row->applicant_g_p_m_name }} </b> </div>
<?php
}

?>







<div>২.	ঠিকানাঃ- </div>

<div> &nbsp; &nbsp; &nbsp;গ্রাম:  <b style="border-bottom:1px solid black;margin-left:20px" > &nbsp; {{ $row->village }}, </b>&nbsp;  ইউনিয়ন: <b style="border-bottom:1px solid black;margin-left:20px" >  {{ $row->union }}, </b>&nbsp; ওয়ার্ড নং:  <b style="border-bottom:1px solid black;margin-left:20px" > &nbsp; {{ $row->wordNo }} </b>
   &nbsp; ডাকঘর:  <b style="border-bottom:1px solid black;margin-left:20px" >  {{ $row->post }}, </b>&nbsp; উপজেলা:  <b style="border-bottom:1px solid black;margin-left:20px" >  {{ $row->upozila }}, </b>&nbsp; জেলা:  <b style="border-bottom:1px solid black;margin-left:20px" >  {{ $row->district }} </b>
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; মোবাইল নম্বর:  <b style="border-bottom:1px solid black;margin-left:20px" > {{ $row->mobile_number }} </b>  &nbsp;   জাতীয় পরিচয় নং: <b style="border-bottom:1px solid black;margin-left:20px" > {{ int_en_to_bn($row->nid_no) }} </b>
      </div>

<div>৩. প্রার্থীত নলকূপের শ্রেণি:   <b style="border-bottom:1px solid black;margin-left:20px" > {{ $row->nolkup_type }} </b> </div>
<div>৪.	প্রার্থীত নলকূপের সাইজ:   <b style="border-bottom:1px solid black;margin-left:20px" >  {{ $row->nolkup_size }}</ </b>div>
<div>৫.	নলকূপের দ্বারা সম্ভাব্য উপকৃত এলাকা এবং তথ্যাদি:   <b style="border-bottom:1px solid black;margin-left:20px" > {{ $row->area_description }}</ </b>div>
<div>৬.	নলকূপ স্থাপনের প্রস্তাবিত স্থান:  </div>
<div> &nbsp; &nbsp; &nbsp;এলাকার নাম: <b style="border-bottom:1px solid black;margin-left:20px" >  {{ $row->area_name }} </b> &nbsp; মৌজার নাম: <b style="border-bottom:1px solid black;margin-left:20px" > {{ $row->mouja_name }} </b>&nbsp;
    জে.এল নং  <b style="border-bottom:1px solid black;margin-left:20px" > {{ $row->JL_No }} </b>&nbsp; খতিয়ান নং  <b style="border-bottom:1px solid black;margin-left:20px" >  {{ $row->khotiyan_no }}, </b>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; দাগ নং  <b style="border-bottom:1px solid black;margin-left:20px" >  {{ $row->dag_NO }} </b>&nbsp;
    চাষাবাদকৃত জমির পরিমাণ:  <b style="border-bottom:1px solid black;margin-left:20px" >  {{ $row->land_amount }} </b>     </div>
<div>৭.	প্রস্তাবিত স্থান হতে নিকটবর্তী নলকূপের দূরত্ব </div>
<div> &nbsp; &nbsp; &nbsp;নিকটবর্তী নলকূপের শ্রেণি   <b style="border-bottom:1px solid black;margin-left:20px" > &nbsp; {{ $row->near_nolkup_type }} </b>  &nbsp;  উত্তর:  <b style="border-bottom:1px solid black;margin-left:20px" > &nbsp; {{ $row->near_nolkup_uttor }} </b> মিটার  &nbsp;  দক্ষিণ:  <b style="border-bottom:1px solid black;margin-left:20px" > {{ $row->near_nolkup_dokkhin }} </b> মিটার &nbsp;   পূর্ব:  <b style="border-bottom:1px solid black;margin-left:20px" >  {{ $row->near_nolkup_purbo }} </b> মিটার  &nbsp;  পশ্চিম:  <b style="border-bottom:1px solid black;margin-left:20px" >  {{ $row->near_nolkup_poscim }} </b> মিটার </div>
<div>৮.	বৈদ্যুতিক সংযোগের দূরত্ব: <b style="border-bottom:1px solid black;margin-left:20px" >  {{ $row->electricity_distance }} </b> মিটার</div>
<div>৯.	লাইসেন্স প্রদানের জন্য কোনো বিশেষ বিবেচনা   &nbsp; <b style="border-bottom:1px solid black;margin-left:20px" > &nbsp; {{ $row->description }}</ </b>div>
<div>১০.	জমাকৃত ফি`র পরিমাণ:  <b style="border-bottom:1px solid black;margin-left:20px" > {{ int_en_to_bn($row->deposite_fee) }}, </b> &nbsp;  জমাদানের তারিখ-  <b style="border-bottom:1px solid black;margin-left:20px" >{{ int_en_to_bn($row->deposite_date) }} </b> </div>


    <div>
        ১১.	আবেদনের সাথে দাখিলকৃত প্রয়োজনীয় কাগজপত্রের তালিকা:
        <div>
            &nbsp; &nbsp; &nbsp; (১) পাসপোর্ট সাইজের ছবি <br>
            &nbsp; &nbsp; &nbsp; (২) জাতীয় পরিচয়পত্রের কপি <br>
            &nbsp; &nbsp; &nbsp; (৩) জমাকৃত ফি`র রশিদের কপি <br>
            &nbsp; &nbsp; &nbsp; (৪) দলিলের কপি <br>
            &nbsp; &nbsp; &nbsp; (৫) খতিয়ানের কপি <br>
            &nbsp; &nbsp; &nbsp; (৬) ভূমি উন্নয়ন কর পরিশোধের কপি <br>
            &nbsp; &nbsp; &nbsp;  (৭) নকশা/মৌজা ম্যাপ <br>

    </div>
    </div>
<div style="width:100%;text-align:right;margin-top:20px" >আবেদনকারীর স্বাক্ষর</div>


</body>
</html>
