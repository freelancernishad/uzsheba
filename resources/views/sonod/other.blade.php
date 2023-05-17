
<table width="100%" style="margin-top:-40px">
    <tr>
        <td width="30%">সনদ নং</td><td>: {{ int_en_to_bn($row->sonod_Id) }}</td>
        </tr>

        <tr>
        <td width="30%">সনদধারীর নাম</td><td>: {{ $row->applicant_name }}</td>
        </tr>
        <tr>
        <td width="30%">পিতা/স্বামীর নাম</td><td>: {{ $row->applicant_father_name }}</td>
        </tr>
        <tr>
        <td width="30%">মাতার নাম</td><td>: {{ $row->applicant_mother_name }}</td>
        </tr>
        <tr>
        <td width="30%">জাতীয় পরিচয়পত্র নং</td><td>: {{ int_en_to_bn($row->applicant_national_id_number) }}</td>
        </tr>
        <tr>
        <td width="30%">ঠিকানা</td><td>:  গ্রাম: {{ $row->applicant_present_village }}, ডাকঘর: {{ $row->applicant_present_post_office }}, উপজেলা: {{ $row->applicant_present_Upazila }}, জেলা: {{ $row->applicant_present_district }}</td>
        </tr>
        {{-- <tr>
        <td width="30%">পেশা</td><td>: {{ $row->applicant_occupation }}</td>
        </tr> --}}
    </table>

    <p
    > {!! int_en_to_bn($row->sec_prottoyon) !!}<br>
    </p>

    <p style="margin-bottom: 10px;"
    > {!! $sonod->template  !!}<br>
    </p>



{{--
<p style="margin-top:15px;margin-bottom:15px;font-size:15px;text-align:justify">&nbsp; &nbsp; &nbsp; এই মর্মে
    প্রত্যয়ন করা যাচ্ছে যে, {{ $row->applicant_name }}, পিতা/স্বামী: {{ $row->applicant_father_name }}, মাতা: {{ $row->applicant_mother_name }}, ওয়ার্ড নং- {{ $row->applicant_present_word_number }} হোল্ডিং নং- {{ $row->applicant_holding_tax_number }}, গ্রাম: {{ $row->applicant_present_village }}, ডাকঘর: {{ $row->applicant_present_post_office }}, উপজেলা: {{ $row->applicant_present_Upazila }} , জেলা: {{ $row->applicant_present_district }}।

     {{-- @if($row->sonod_name=='প্রত্যয়নপত্র' || $row->sonod_name=='বিবিধ প্রত্যয়নপত্র')  --}}

        {{-- {!! $row->sec_prottoyon !!} --}}

    {{-- <!-- @else --}}

        {{-- {!! $sonod->template  !!} --}}
    {{-- @endif --> --}}


{{-- </p> --}}
