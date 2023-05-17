<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        td{
            border:1px solid black;
            text-align: center;
            font-size: 12px;
           }
    </style>


</head>

<body style="font-family: 'bangla', sans-serif;">


    <p>{{ int_en_to_bn(date("d-m-Y", strtotime($from))) }} থেকে {{ int_en_to_bn(date("d-m-Y", strtotime($to))) }} তারিখের প্রতিবেদন</p>




    <table width="100%" style="border-collapse: collapse;" border="0">

        <tr>
            <td>নাম</td>
            <td>জন্ম তারিখ</td>
            <td>লিঙ্গ</td>
            <td>জন্মস্থান</td>
            <td>পিতার নাম</td>
            <td>পিতার জাতীয় পরিচয়পত্র</td>
            <td>মাতার নাম</td>
            <td>মাতার জাতীয় পরিচয়পত্র</td>
        </tr>

        @foreach ($rows as $row)

        <tr>
            <td>{{ $row->childs_name }}</td>
            <td>{{ int_en_to_bn(date("d M. Y", strtotime($row->date_of_birth))) }}</td>
            <td>{{ $row->gender }}</td>
            <td>গ্রাম/মহল্লা/পাড়া:- {{ $row->village }}, ওয়ার্ড নং:- {{ int_en_to_bn($row->word_number) }}, ইউনিয়ন/জোন:- {{ $row->post_office }}, উপজেলা/পৌরসভা/সিটি করপােরেশন:- {{ $row->upazila }}, জেলা:- {{ $row->district }}</td>
            <td>{{ $row->husband_name }}</td>
            <td>{{ $row->husband_name_nid }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->pregnant_woman_nid }}</td>

        </tr>
        @endforeach

    </table>



</body>

</html>
