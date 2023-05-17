<?php

namespace App\Http\Controllers\mainAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class holdingtaxController extends Controller
{



	public function int_bn_to_en($number){

 $bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
 $en_digits=array('0','1','2','3','4','5','6','7','8','9');

return str_replace($bn_digits,$en_digits, $number);
	}



    public function holding_tax_list(Request $r)
    {


       return view('mainAdmin/holdingTax.word');
    }


    public function holding_tax_list_word(Request $r,$word)
    {
       $data['word'] = $word;
       $data['uniounName'] = '';
       $data['unioun_infos'] = DB::table('unioun_infos')->get();
 if($r->session()->has('unioun')){
    $unionName = $r->session()->get('unioun');

$wheredata = [
   'unioun'=>$unionName,
   'word_no'=>$word,
];

    $data['result'] = DB::table('holdingtaxs')->where($wheredata)->get();

 }else{
    $data['result'] = DB::table('holdingtaxs')->where('word_no',$word)->get();

 }




       return view('mainAdmin/holdingTax.list', $data);
    }



    public function holding_tax_Add(Request $r,$word)
    {

     $datep = date('Y')-1;
   $date = date('Y');
  $float = (float) $date;
$date = $float - 1;
$floatp = (float) $datep;
$datep = $floatp - 1;
      $array[0] = [
         'itemId' => '1',
         'year' => $datep.'-'.$date,
         'price' => '0',
         'status' => 'Unpaid',
     ];


 $bokeya = json_encode($array);

       $items = [[
      'id'=>'',
		'unioun' => '',
		'holding_no' => '',
		'maliker_name' => '',
		'father_or_samir_name' => '',
		'gramer_name' => '',
		'word_no' => '',
		'nid_no' => '',
		'mobile_no' => '',
		'griher_barsikh_mullo' => 0,
		'barsikh_muller_percent' => '',
		'jomir_vara' => 0,
		'total_mullo' => '',
		'rokhona_bekhon_khoroch' => '',
		'prakklito_mullo' => '',
		'reyad' => '',
		'angsikh_prodoy_korjoggo_barsikh_mullo' => '',
		'barsikh_vara' => 0,
		'rokhona_bekhon_khoroch_percent' => '',
		'prodey_korjoggo_barsikh_mullo'	 => '',
		'total_prodey_korjoggo_barsikh_mullo'	 => '',
		'current_year_kor'	 => '',
		'bokeya'	 => $bokeya,
		'total_bokeya'	 => '',
       ],];
       $object = json_decode(json_encode($items));
       $data['word'] = $word;
       $data['result'] = $object;
       return view('mainAdmin/holdingTax.add', $data);
    }

    public function holding_tax_Edit(Request $r, $id,$word)
    {
       $data['word'] = $word;
       $data['result'] = DB::table('holdingtaxs')->where('id', $id)->get();
       return view('mainAdmin/holdingTax.add', $data);
    }

    public function holding_tax_Submit(Request $r,$word)
    {
      //  echo '<pre>';
      //  print_r($r->input());



 $griher_barsikh_mullo = $this->int_bn_to_en($r->griher_barsikh_mullo);
$jomir_vara = $this->int_bn_to_en($r->jomir_vara);
  $barsikh_vara = $this->int_bn_to_en($r->barsikh_vara);





$category = $r->category;

if($category=='মালিক নিজে বসবাসকারী'){

//বার্ষিক মূল্যের 7.5%
$barsikh_muller_percent = ($griher_barsikh_mullo*7.5)/100;
//মোট মূল্য
$total_mullo = $jomir_vara+$barsikh_muller_percent;
//রক্ষণাবেক্ষণ খরচ
$rokhona_bekhon_khoroch = $total_mullo/6;
// প্রাক্কলিত মূল্য
$prakklito_mullo = $total_mullo-$rokhona_bekhon_khoroch;
// রেয়াত
$reyad = $prakklito_mullo/4;
// প্রদেয় করযোগ্য বার্ষিক মূল্য
$prodey_korjoggo_barsikh_mullo = $prakklito_mullo-$reyad;
// নির্ধারিত হোল্ডিং কর (৭%)
$current_year_kor = ($prodey_korjoggo_barsikh_mullo*7)/100;





//আংশিক প্রদেয় করযোগ্য
$angsikh_prodoy_korjoggo_barsikh_mullo = '';
//রক্ষণাবেক্ষণ খরচ (6%)
$rokhona_bekhon_khoroch_percent = '';
//প্রদেয় করযোগ্য বার্ষিক ভাড়ার মূল্য
$prodey_korjoggo_barsikh_varar_mullo = '';
//মোট প্রদেয় করযোগ্য বার্ষিক মূল্য
$total_prodey_korjoggo_barsikh_mullo = '';



}else if($category=='ভাড়া'){



//ভারা
//বার্ষিক ভাড়ার মূল্যের
//রক্ষণাবেক্ষণ খরচ ৬%
// প্রদেয় করযোগ্য বার্ষিক মূল্য = বার্ষিক ভাড়ার মূল্যের - রক্ষণাবেক্ষণ খরচ
// নির্ধারিত হোল্ডিং কর (৭%) =  প্রদেয় করযোগ্য বার্ষিক মূল্য৭%






//বার্ষিক মূল্যের 7.5%
$barsikh_muller_percent = '';
//মোট মূল্য
$total_mullo = '';
//রক্ষণাবেক্ষণ খরচ
$rokhona_bekhon_khoroch = '';
// প্রাক্কলিত মূল্য
$prakklito_mullo = '';
// রেয়াত
$reyad = '';



// প্রদেয় করযোগ্য বার্ষিক মূল্য
$prodey_korjoggo_barsikh_mullo = '';


//আংশিক প্রদেয় করযোগ্য
$angsikh_prodoy_korjoggo_barsikh_mullo = '';
//রক্ষণাবেক্ষণ খরচ (6%)
 $rokhona_bekhon_khoroch_percent = $barsikh_vara/6;;
//প্রদেয় করযোগ্য বার্ষিক ভাড়ার মূল্য
$prodey_korjoggo_barsikh_varar_mullo = $barsikh_vara-$rokhona_bekhon_khoroch_percent;
//মোট প্রদেয় করযোগ্য বার্ষিক মূল্য
$total_prodey_korjoggo_barsikh_mullo = '';


// নির্ধারিত হোল্ডিং কর (৭%)
$current_year_kor = ($prodey_korjoggo_barsikh_varar_mullo*7)/100;






}else if($category=='আংশিক ভাড়া'){





//বার্ষিক মূল্যের 7.5%
$barsikh_muller_percent = ($griher_barsikh_mullo*7.5)/100;
//মোট মূল্য
$total_mullo = $jomir_vara+$barsikh_muller_percent;
//রক্ষণাবেক্ষণ খরচ
$rokhona_bekhon_khoroch = $total_mullo/6;
// প্রাক্কলিত মূল্য
$prakklito_mullo = $total_mullo-$rokhona_bekhon_khoroch;
// রেয়াত
$reyad = $prakklito_mullo/4;



// প্রদেয় করযোগ্য বার্ষিক মূল্য
$prodey_korjoggo_barsikh_mullo = '';






//আংশিক প্রদেয় করযোগ্য
$angsikh_prodoy_korjoggo_barsikh_mullo = $prakklito_mullo - $reyad;
//রক্ষণাবেক্ষণ খরচ (6%)
$rokhona_bekhon_khoroch_percent = $barsikh_vara/6;
//প্রদেয় করযোগ্য বার্ষিক ভাড়ার মূল্য
$prodey_korjoggo_barsikh_varar_mullo = $barsikh_vara-$rokhona_bekhon_khoroch_percent;
//মোট প্রদেয় করযোগ্য বার্ষিক মূল্য
$total_prodey_korjoggo_barsikh_mullo = $angsikh_prodoy_korjoggo_barsikh_mullo+$prodey_korjoggo_barsikh_varar_mullo;


// নির্ধারিত হোল্ডিং কর (৭%)
$current_year_kor = ($total_prodey_korjoggo_barsikh_mullo*7)/100;

}


return $current_year_kor;

die();





//ভারা
//বার্ষিক ভাড়ার মূল্যের
//রক্ষণাবেক্ষণ খরচ ৬%
// প্রদেয় করযোগ্য বার্ষিক মূল্য = বার্ষিক ভাড়ার মূল্যের - রক্ষণাবেক্ষণ খরচ
// নির্ধারিত হোল্ডিং কর (৭%) =  প্রদেয় করযোগ্য বার্ষিক মূল্য৭%







//মালিক + ভাড়া
//গৃহের বার্ষিক  মূল্য
//বার্ষিক মূল্যের 7.5%
//জমির ভাড়া
//মোট মূল্য
//রক্ষণাবেক্ষণ খরচ
//প্রাক্কলিত মূল্য
//রেয়াত

//আংশিক প্রদেয় করযোগ্য = প্রাক্কলিত মূল্য -রেয়াত
//বার্ষিক ভাড়ার = ইনপুট
//রক্ষণাবেক্ষণ খরচ (6%)  = বার্ষিক ভাড়ার ৬%
//প্রদেয় করযোগ্য বার্ষিক ভাড়ার মূল্য  = বার্ষিক ভাড়ার -রক্ষণাবেক্ষণ খরচ
//মোট প্রদেয় করযোগ্য বার্ষিক মূল্য  = আংশিক প্রদেয় করযোগ্য + প্রদেয় করযোগ্য বার্ষিক ভাড়ার মূল্য


// নির্ধারিত হোল্ডিং কর (৭%) = মোট প্রদেয় করযোগ্য বার্ষিক মূল্য৭%

       $union = $r->session()->get('unioun');




$total_bokeya = '';
$total_bokeya = (float)$total_bokeya;

if($r->itemId==null){
	$count = 0;
}else{
	$count = count($r->itemId);
}





           $j = 1;
               $i = 0;
               while($i<$count){

                  $bokeya = $this->int_bn_to_en($r->input('price')[$i]);
                  $bokeya = (float)$bokeya;


                     $total_bokeya += $bokeya;


                   $array[$j] = [
                          'itemId' => $r->input('itemId')[$i],
                          'year' => $r->input('year')[$i],
                          'price' => $this->int_bn_to_en($r->input('price')[$i]),
                          'status' => $r->input('status')[$i],
                      ];


                  $i++;
                  $j++;
                }

/*
echo $i;
	  die(); */

	 if($r->itemId==null){
	$lastItemid = 0;
}else{
	$lastItemid = $r->input('itemId')[$i-1];
}



     $datep = date('Y')-1;
   $date = date('Y');
  $float = (float) $date;
$date = $float;
$floatp = (float) $datep;
$datep = $floatp;
                $array[$j] = [
                  'itemId' => $lastItemid+1,
                  'year' => $datep.' '.$date,
                  'price' => $current_year_kor,
                  'status' => 'Unpaid',
              ];





               $bokeya = json_encode($array);


        /*  echo '<pre>';
              print_r($array);
               echo $j;
               die(); */


 $total_bokeya = $current_year_kor+$total_bokeya;


               //die();

       $data = array(


       'category' => $category,
       'unioun' => $union,
       'holding_no' => $r->holding_no,
       'maliker_name' => $r->maliker_name,
       'father_or_samir_name' => $r->father_or_samir_name,
       'gramer_name' => $r->gramer_name,
       'word_no' => $r->word_no,
       'nid_no' => $r->nid_no,
       'mobile_no' => $r->mobile_no,
       'griher_barsikh_mullo' => $r->griher_barsikh_mullo,
       'barsikh_muller_percent' => $barsikh_muller_percent,
       'jomir_vara' => $r->jomir_vara,
       'total_mullo' => $total_mullo,
       'rokhona_bekhon_khoroch' => $rokhona_bekhon_khoroch,
       'prakklito_mullo' => $prakklito_mullo,
       'reyad' => $reyad,
       'angsikh_prodoy_korjoggo_barsikh_mullo' => $angsikh_prodoy_korjoggo_barsikh_mullo,
       'barsikh_vara' => $barsikh_vara,
       'rokhona_bekhon_khoroch_percent' => $rokhona_bekhon_khoroch_percent,
       'prodey_korjoggo_barsikh_mullo'	 => $prodey_korjoggo_barsikh_mullo,
       'prodey_korjoggo_barsikh_varar_mullo'	 => $prodey_korjoggo_barsikh_varar_mullo,
       'total_prodey_korjoggo_barsikh_mullo'	 => $total_prodey_korjoggo_barsikh_mullo,
       'current_year_kor'	 => $current_year_kor,
       'bokeya'	 => $bokeya,
       'total_bokeya'	 => $total_bokeya,

       );

       $id = $r->input('id');
       if ($id == '') {
          DB::table('holdingtaxs')->insert($data);
          $r->session()->flash('insertmsg', 'Data Insert Succcessfully');
       } else {
          DB::table('holdingtaxs')->where('id', $id)->update($data);
          $r->session()->flash('insertmsg', 'Data Update Succcessfully');
       }
       return redirect('/admin/holding_tax/list/'.$word);
    }

    public function holding_tax_Delete($id,$word)
    {
       DB::table('holdingtaxs')->where('id', $id)->delete();
       return redirect('/admin/holding_tax/list/'.$word);
    }









    public function holding_tax_view(Request $r,$id,$word)
    {
    $data['word'] = $word;
    $data['name'] = 'হোল্ডিং ট্যাক্স';






                $data['result'] = DB::table('holdingtaxs')->where('id', $id)->get();
                return view('mainAdmin/holdingTax.view',$data);


    }





    public function holding_tax_pay(Request $r,$id,$itemId,$word)
    {


      $taxData = DB::table('holdingtaxs')->where('id',$id)->get();


      $items = json_decode($taxData[0]->bokeya);

 $j = 0;
  foreach($items as $list){

if($list->itemId==$itemId){
   $status ='Paid';

}else{
   $status =$list->status;
}


   $array[$j] = [
      'itemId' => $list->itemId,
      'year' => $list->year,
      'price' => $list->price,
      'status' => $status,
  ];

$j++;
  }
/* echo '<pre>';
print_r($array); */
$bokeya = json_encode($array);
$data =[
   'bokeya'	 => $bokeya,
];


DB::table('holdingtaxs')->where('id', $id)->update($data);




//return redirect('/admin/holding_tax/list/'.$word);
return redirect("/invoice/holdintax/$id/$itemId/$word");


    }








}
