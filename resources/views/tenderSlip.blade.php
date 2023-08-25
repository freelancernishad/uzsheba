<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>



</head>

<body style="font-family: 'bangla', sans-serif;">

@php


    $html = "
            <style type='text/css'>

        td{
            text-align:center
        }
        </style>
        <div class='pdfhead' style='text-align:center'>

        <h5 style='margin:0;width:100%;font-size:16px'>গণপ্রজাতন্ত্রী বাংলাদেশ</h6>
        <h4 style='margin:0;width:100%;font-size:20px' > $uniouninfo->full_name </h4>
        <h6 style='margin:0;width:100%;font-size:16px' >উপজেলা:   $uniouninfo->thana , জেলা:   $uniouninfo->district  ।</h6>
        <h2 style='margin:0 auto;width:100%;background:black;color:white;width:400px;' >দরপত্র সিডিউল মূল্য পরিশোধের রশিদ
</h2>


        </div>

        <table width='100%' style='margin-top:10px;margin-bottom:10px'>
            <tr>
                <td width='50%' style='text-align:left'>সিডিউল ফর্ম নং $row->form_code </td>
                <td width='50%' style='text-align:right'>রশিদ নং :".int_en_to_bn($payment->trxId)."</td>
            </tr>
        </table>

        <p>নাম:  $row->name  , পিতা/স্বামীর নাম:   $row->applicant_org_fatherName  , গ্রাম:   $row->vill ,  উপজেলা:  $row->thana  , জেলা:  $row->distric </p>";





        $html .="

        <style>
        .tdlist{
    height: 200px;
    vertical-align: top;
}
    </style>
    <table class='table ' style='width:100%;' cellspacing='0' cellpadding='0' border='1' >
  <thead>
    <tr>

      <th scope='col'>খাত/আদায়ের বিবরণ</th>
      <th scope='col'>মোট টাকার পরিমাণ</th>

    </tr>
  </thead>
  <tbody>

    <tr>

      <td class='tdlist'>দরপত্র সিডিউল ক্রয়</td>

      <td class='tdlist'>".int_en_to_bn($payment->amount)."</td>

    </tr>
    <tr class='tr'>
            <td colspan='1' class='defalttext td defaltfont'style='text-align:right;    padding: 0 13px;'><p> মোট </p></td>
            <td class='td defaltfont'>".int_en_to_bn($payment->amount)."</td>
    </tr>

  </tbody>
</table>




        ";

        $html .="</div>
       <p style='text-align:left'>কথায় :  $amountText ।</p>

        ";
        echo $html;
// echo "<h5>..................................................................................................................................................................................................</h5>";
//     echo $html;

@endphp
{{-- <p style='text-align:left'>কথায় :  $row->the_amount_of_money_in_words ।</p> --}}
{{-- <p style='text-align:right'>আদায়কারীর স্বাক্ষর</p> --}}
</body>

</html>
