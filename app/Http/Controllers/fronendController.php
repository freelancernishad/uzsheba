<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\aplication;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class fronendController extends Controller
{
    public function index(Request $r)
    {
        return view('index');
    }

    public function license(Request $r,$id)
    {






        ini_set('max_execution_time', '60000');
        ini_set("pcre.backtrack_limit", "5000000000000000050000000000000000");
        ini_set('memory_limit', '12008M');

        $apllicationCount = aplication::where('id',$id)->count();
        if($apllicationCount>0){



        $row = aplication::where('id',$id)->first();


        if($row->status!='approved'){

            if($row->sonod_name=='নলকূপ লাইসেন্স'){

                echo "
                <div style='width:80%;margin:0 auto;text-align: center;'>
                <h1 style='color:red;text-align:center'>গভীর/অগভীর নলকূপ স্থাপনের এই লাইসেন্সের আবেদনটি এখনো অনুমোদিত হয়নি</h1>
                <div>
                ";
            }else{

                echo "
                <div style='width:80%;margin:0 auto;text-align: center;'>
                <h1 style='color:red;text-align:center'>ভবনের নকশার এই লাইসেন্সের আবেদনটি এখনো অনুমোদিত হয়নি</h1>
                <div>
                ";
            }


            return;
        }
        if($row->payment_status=='Unpaid'){


            if($row->sonod_name=='নলকূপ লাইসেন্স'){
            echo "
            <div style='width:80%;margin:0 auto;text-align: center;'>
                <h1 style='color:red;text-align:center'>গভীর/অগভীর নলকূপ স্থাপনের এই লাইসেন্সের আবেদনটি অনুমোদিত হয়েছে। কিন্তু ফি প্রদান করা হয়নি। দয়া করে লাইসেন্সটির ফি প্রদান করুন</h1>
                <a href='/l/f/$row->id?f=l' style='background: #002bff;
                color: white;
                padding: 12px 12px;
                font-size: 30px;
                text-decoration: none;'>ফি প্রদান করুন</a>
            </div>
            ";
        }else{

            echo "
            <div style='width:80%;margin:0 auto;text-align: center;'>
                <h1 style='color:red;text-align:center'>ভবনের নকশার এই লাইসেন্সের আবেদনটি অনুমোদিত হয়েছে। কিন্তু ফি প্রদান করা হয়নি। দয়া করে লাইসেন্সটির ফি প্রদান করুন</h1>
                <a href='/l/f/$row->id?f=l' style='background: #002bff;
                color: white;
                padding: 12px 12px;
                font-size: 30px;
                text-decoration: none;'>ফি প্রদান করুন</a>
            </div>
            ";
        }

            return;
        }







    //in Controller

    $image = base64($row->passport_size_mage);
    $gov_logos = base64('assets/img/bd-logo.png');
    $mojib_logos = base64('assets/img/mujib_100_logo.png');
    $badc_logos = base64('assets/img/badc logo png.png');



    $url = url("/license/$id");
    $qrcode = QrCode::size(70)->format('svg') ->generate($url);
    $output = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrcode);

    $qrcode = $output;
    $licence_no =   $row->licence_no;


    if($row->sonod_name=='নলকূপ লাইসেন্স'){

        $pdf = PDF::loadView('license',compact('row','image','gov_logos','mojib_logos','badc_logos','qrcode','licence_no'));
    }else{

        $sonod  = json_decode($row->building_construction);

        $pdf = PDF::loadView('sonod',compact('row','image','gov_logos','mojib_logos','badc_logos','qrcode','licence_no','sonod'));
    }


        return $pdf->stream("$licence_no.pdf");
        //  return view('license',$data);
    }else{
        echo "
        <div style='width:80%;margin:0 auto;text-align: center;'>
            <h1 style='color:red;text-align:center'>কোনো গভীর/অগভীর নলকূপ স্থাপনের লাইসেন্স খুজে পাওয়া যায়নি</h1>
        <div>
        ";
    }
    }


    public function applicantCopy(Request $r,$id)
    {
        ini_set('max_execution_time', '60000');
        ini_set("pcre.backtrack_limit", "5000000000000000050000000000000000");
        ini_set('memory_limit', '12008M');

        $row = aplication::where('id',$id)->first();


        $image = base64($row->passport_size_mage);
        $gov_logos = base64('assets/img/bd-logo.png');
        $mojib_logos = base64('assets/img/mujib_100_logo.png');
        $badc_logos = base64('assets/img/badc logo png.png');


        $url = url("/license/$id");
        $qrcode = QrCode::size(70)->format('svg') ->generate($url);
        $output = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrcode);

        $qrcode = $output;
        $licence_no =   $row->licence_no;

        //  return base64($row->nid_copy);

        //  return view('applicantion_full_copy',compact('row','image','gov_logos','mojib_logos','badc_logos','qrcode','licence_no'));

        if($row->sonod_name=='নলকূপ লাইসেন্স'){
            $pdf = PDF::loadView('applicantion_full_copy',compact('row','image','gov_logos','mojib_logos','badc_logos','qrcode','licence_no'));
        }else{
            $sonod = json_decode($row->building_construction);
            $pdf = PDF::loadView('apllication_Document_bulding',compact('row','sonod','licence_no'));
        }





        return $pdf->stream("sechsheba-77190$licence_no.pdf");

    }


    public function apllication_Document(Request $r,$id)
    {


        $row = aplication::where('id',$id)->first();
        $licence_no = $row->licence_no;

        if($row->sonod_name=='নলকূপ লাইসেন্স'){
            $pdf = PDF::loadView('apllication_Document',compact('row','licence_no'));
        }else{
            $sonod = json_decode($row->building_construction);
            $pdf = PDF::loadView('apllication_Document_bulding',compact('row','sonod','licence_no'));
        }


        return $pdf->stream('document.pdf');
        // return view('apllication_Document');



    }


    public function apllication(Request $r)
    {
        $data['datas'] = Division::all();
        return view('form',$data);
    }
    public function apllication_submit(Request $r)
    {
    //     echo '<pre>';
    //   print_r($r->all());





    $licence_no = 00001;
    $sonod_no_sqlCount = DB::table('aplications')->count();
    if($sonod_no_sqlCount>0){
        $sonod_no_sql = DB::table('aplications')->orderBy('licence_no','DESC')->get();

        $licence_no =  $sonod_no_sql[0]->licence_no;
        if($licence_no===null){
            $licence_no = 00001;
        }else{
            $licence_no = $licence_no+1;
        }


    }



   $licence_no = str_pad($licence_no, 5, '0', STR_PAD_LEFT);


// die();

$id = $r->id;
    $data = [];
    $inputData = $r->all();
    foreach ($inputData as $key => $value) {
        if ($key == 'id' || $key == '_token') {
        } else {
            $data[$key] = $value;
        }
    }





    if($r->hasfile('passport_size_mage'))	{
        $passport_size_mage = $r->file('passport_size_mage');
    $passport_size_mage_ext = $passport_size_mage->extension();
    $passport_size_mage_file=time().'.'.$passport_size_mage_ext;

    $passport_size_mage->storeAs('/public/passport_size_mage/',$passport_size_mage_file);
    $data['passport_size_mage']=$passport_size_mage_file;
    }


    if($r->hasfile('nid_copy'))	{
        $nid_copy = $r->file('nid_copy');
    $nid_copy_ext = $nid_copy->extension();
    $nid_copy_file=time().'.'.$nid_copy_ext;

    $nid_copy->storeAs('/public/nid_copy/',$nid_copy_file);
    $data['nid_copy']=$nid_copy_file;
    }



    if($r->hasfile('land_copy'))	{
        $land_copy = $r->file('land_copy');
    $land_copy_ext = $land_copy->extension();
    $land_copy_file=time().'.'.$land_copy_ext;

    $land_copy->storeAs('/public/land_copy/',$land_copy_file);
    $data['land_copy']=$land_copy_file;
    }



    if($r->hasfile('khotiyan_copy'))	{
        $khotiyan_copy = $r->file('khotiyan_copy');
    $khotiyan_copy_ext = $khotiyan_copy->extension();
    $khotiyan_copy_file=time().'.'.$khotiyan_copy_ext;

    $khotiyan_copy->storeAs('/public/khotiyan_copy/',$khotiyan_copy_file);
    $data['khotiyan_copy']=$khotiyan_copy_file;
    }


    if($r->hasfile('tax_copy'))	{
        $tax_copy = $r->file('tax_copy');
    $tax_copy_ext = $tax_copy->extension();
    $tax_copy_file=time().'.'.$tax_copy_ext;

    $tax_copy->storeAs('/public/tax_copy/',$tax_copy_file);
    $data['tax_copy']=$tax_copy_file;
    }


    if($r->hasfile('map'))	{
        $map = $r->file('map');
    $map_ext = $map->extension();
    $map_file=time().'.'.$map_ext;

    $map->storeAs('/public/map/',$map_file);
    $data['map']=$map_file;
    }



    if($r->hasfile('wyarisan'))	{
        $wyarisan = $r->file('wyarisan');
    $wyarisan_ext = $wyarisan->extension();
    $wyarisan_file=time().'.'.$wyarisan_ext;

    $wyarisan->storeAs('/public/wyarisan/',$wyarisan_file);
    $data['wyarisan']=$wyarisan_file;
    }



    if ($id == '') {
        $data['licence_no'] = $licence_no;
        aplication::insert($data);
        $r->session()->flash('msg', 'Data Inserted Succcessfully');


        $lastdata = aplication::latest('id')->first();
         $lastid = $lastdata->id;

        return redirect("/apllication/document/$lastid");

    } else {

        $data['licence_no'] = $r->licence_no;

        aplication::where('id',$id)->update($data);

        $r->session()->flash('msg', 'Data Updated Succcessfully');
        return redirect("/admin/application/pending/list");
    }






    }




    function sonod_verify(){

        return view('sonod_verify');
    }



    function sonod_verify_submit(Request $r){

       $sonod_no = $r->sonod_no;

       $count = DB::table('aplications')->where('licence_no',$sonod_no)->count();

       if($count>0){
        $data = DB::table('aplications')->where('licence_no',$sonod_no)->get();
        $id = $data[0]->id;
        return redirect("/license/$id");
       }else{
        return redirect()->back()->with("error","77190$sonod_no এই লাইসেন্স নাম্বার এর কোনো লাইসেন্স পাওয়া যায় নি");
       }


    }







}
