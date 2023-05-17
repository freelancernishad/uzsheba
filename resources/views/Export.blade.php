<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .td {
            border: 1px dotted black;
        }
    </style>
</head>
<body style="font-family: 'bangla', sans-serif;">
    <table width="100%" style="border-collapse: collapse;" border="0">
        <tr>
            <td style="text-align: center;" width="20%">
                {{-- <span style="color:#b400ff;"><b>
                        উন্নয়নের গণতন্ত্র, <br /> শেখ হাসিনার মূলমন্ত্র </b>
                </span> --}}
            </td>
            <td style="text-align: center;" width="20%">
                <img width="70px" src="{{ base64('backend/bd-logo.png') }}">
            </td>
            <td style="text-align: center;" width="20%">
            </td>
        </tr>
        <tr style="margin-top:2px;margin-bottom:2px;">
            <td>
            </td>
            <td style="text-align: center;" width="50%">
                <p style="font-size:20px">গণপ্রজাতন্ত্রী বাংলাদেশ</p>
                {{-- <p style="font-size:25px">চেয়ারম্যানের কার্যালয়</p> --}}
            </td>
            <td>
            </td>
        </tr>
        <tr style="margin-top:0px;margin-bottom:0px;">
            <td>
            </td>
            <td style="margin-top:0px; margin-bottom:0px; text-align: center;">
                {{-- <h1 style="color: #7230A0; margin: 0px; font-size: 28px">Title</h3> --}}
            </td>
            <td>
            </td>
        </tr>
        <tr style="margin-top:2px;margin-bottom:2px;">
            <td>
            </td>
            <td style="text-align: center; ">
                <p style="font-size:20px">উপজেলা: তেতুলিয়া, জেলা: পঞ্চগড় ।</p>
            </td>
            <td>
            </td>
        </tr>
    </table>


    <h2 style="width:300px;background:green;padding:10px 10px;margin:10px auto;text-align:center;color:white;border-radius: 20px;font-size:20px">ফি আদায় সংক্রান্ত প্রতিবেদন</h2>



    <table width="100%">
        <tr style="margin-top:2px;margin-bottom:2px;">

            <td></td>
            <td style="text-align: center; " width="50%">
            </td>
            <td style="text-align: right">

            </td>
        </tr>
        <tr style="margin-top:2px;margin-bottom:2px;">
            <td colspan="2">
              <span>প্রতিবেদনের সময়কালঃ</span>  {{ int_en_to_bn(date("d/m/Y", strtotime($from))) }} থেকে {{ int_en_to_bn(date("d/m/Y", strtotime($to))) }} পর্যন্ত
            </td>
            <td style="text-align: right">

            </td>

        </tr>
    </table>


    <table width="100%" style="border-collapse: collapse;" border="0">
        <thead>
            <tr>
                <th class="td" style="text-align:center" width="10%">ক্রমিক নং</th>
                <th class="td" style="text-align:center" width="10%">তারিখ</th>

                <th class="td" style="text-align:center" width="20%">আদায়কৃত ফি এর পরিমান</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total = 0;
            $i = 1;
            @endphp
            @foreach ($row as $Product)
            <tr>
                <td class="td" style="text-align:center">{{ int_en_to_bn($i) }}</td>
                <td class="td" style="text-align:center">{{ int_en_to_bn($Product->date) }}</td>

                <td class="td" style="text-align:center">{{ int_en_to_bn(round($Product->amount,2)) }}</td>
            </tr>
            @php
            $i++;
            $total += $Product->amount;
            @endphp
            @endforeach
            <tr>

                <td colspan="2" class="td" style="text-align: right">মোট</td>

                <td class="td" style="text-align:center">{{ int_en_to_bn(round($total,2)) }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
