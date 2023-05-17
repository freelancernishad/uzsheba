<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Division;
use App\Models\aplication;
use Illuminate\Http\Request;
use App\Models\application_repprt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashbord()
    {


       return view('admin.dashbord');

    }
     public function Application_edit($id)
    {
$data['rows'] = DB::table('aplications')->where('id',$id)->get();

        $data['datas'] = Division::all();
        return view('admin.form',$data);

    }

    public function download_report($id)
    {



        ini_set('max_execution_time', '60000');
        ini_set("pcre.backtrack_limit", "5000000000000000050000000000000000");
        ini_set('memory_limit', '12008M');


        $rowcount = application_repprt::where('license_id',$id)->count();

        if($rowcount>0){

            $sonod = aplication::find($id);
            $row = application_repprt::where('license_id',$id)->first();

                    $map = base64('backend/image.png');



            if($row->sonod_name=='নলকূপ লাইসেন্স'){
                $pdf = PDF::loadView('report',compact('row','map'));
            }else{
                $pdf = PDF::loadView('reportImarot',compact('row','map','sonod'));
            }




                    return $pdf->stream('document.pdf');
        }else{
            echo "<h1 style='color:red;text-align:center'>কোনো প্রতিবেদন দাখিল করা হয়নি</h1>";
        }


        // return view('apllication_Document');





    }
    public function index($status)
    {


        if($status=='deleted'){

            $data['rows'] = DB::table('aplications')->where('deleted_at','!=','')->get();
        }else if($status=='all'){

            $data['rows'] = DB::table('aplications')->get();
        }else{
            $wh = [
                'status'=>$status,
                'deleted_at'=>null,
            ];
            $data['rows'] = DB::table('aplications')->where($wh)->orderBy('id','desc')->get();
        }
// return $data;




       return view('admin.list', $data);

    }

    public function Application_approved($status,$id)
    {

$Insertdata = [
    'status'=>$status,
    'approved_date'=> date("Y-m-d H:i:s")
];




$aplication = aplication::findOrFail($id);
$aplication->update($Insertdata);




        $data['rows'] = DB::table('aplications')->where('status',$status)->get();


       return redirect()->back()->with("msg","Application successfully $status ");

    }


    public function delete(Request $r, $id)
    {
        $aplication = aplication::findOrFail($id);
        $aplication->delete();
        return redirect()->back()->with("msg","Application successfully Deleted ");

    }


    public function view(Request $r, $id)
    {


        $data['result'] = DB::table('aplications')->where('id',$id)->get();
        return view('admin.view',$data);

    }


    public function approve(Request $r, $id)
    {


        $data['result'] = DB::table('aplications')->where('id',$id)->get();
        return view('admin.approve',$data);

    }


    public function approve_submit(Request $r)
    {


        $license_id = $r->license_id;
        $id = $r->id;

        $data = [

            'license_id'=>$r->license_id,
            'appicant_name'=>$r->appicant_name,
            'applicant_father_name'=>$r->applicant_father_name,
            'village'=>$r->village,
            'union'=>$r->union,
            'mouja_name'=>$r->mouja_name,
            'JL_No'=>$r->JL_No,
            'khotiyan_no'=>$r->khotiyan_no,
            'dag_NO'=>$r->dag_NO,
            'save_water_Condition'=>$r->save_water_Condition,
            'helpfull_area'=>$r->helpfull_area,
            'home_and_other_benefite'=>$r->home_and_other_benefite,
            'right_area'=>$r->right_area,
            'distanceTo'=>$r->distanceTo,
            'reporter_name'=>$r->reporter_name,
            'reporter_signature'=>$r->reporter_signature,
            'reporter_id'=>$r->reporter_id,
            'land_length'=>$r->land_length,
            'ayoton'=>$r->ayoton,
            'paperTrueOrNot'=>$r->paperTrueOrNot,
            'mapBNNCCode'=>$r->mapBNNCCode,
            'Supervision_Engineer'=>$r->Supervision_Engineer,
            'posibleFalse'=>$r->posibleFalse,
            'note'=>$r->note,
        ];






        $hand_mapCount =  count(explode(';', $r->hand_map));
        if ($hand_mapCount > 1) {
            $data['hand_map'] =  fileupload($r->hand_map, "sonod/hand_map/");
        }





        application_repprt::create($data);
        $up = [
            'status'=>'processied',
            'reporter_name'=>$r->reporter_name,
            'reporter_signature'=>$r->reporter_signature,
            'reporter_id'=>$r->reporter_id,
        ];
       return   aplication::find($license_id)->update($up);







    }


    public function restore(Request $r, $id)
    {
        // $user = User::findOrFail($id);

        aplication::withTrashed()->find($id)->restore();


    }
    public function restoreAll(Request $r)
    {

            aplication::onlyTrashed()->restore();

    }

    public function profile(Request $request)
    {
        $data['row']= Auth::user();
        return view('admin.profile',$data);
    }

    public function profileupdate(Request $request)
    {
        $data =  $request->except('id','_token','passwordchange','oldpass','newpass');

        $user = User::findOrFail($request->id);

        if($request->passwordchange){
            if (Hash::check($request->oldpass, $user->password)) {
                $data['password'] = Hash::make($request->newpass);
                $request->session()->flash('success', 'Profile Updated');
            } else {
                $request->session()->flash('failed', 'Old Password is invalid');
                return redirect()->back();
            }
        }else{
            $request->session()->flash('success', 'Profile Updated');
        }

        // return $data;
        $user->update($data);

        return redirect()->back();



    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\aplication  $aplication
     * @return \Illuminate\Http\Response
     */
    public function show(aplication $aplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\aplication  $aplication
     * @return \Illuminate\Http\Response
     */
    public function edit(aplication $aplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\aplication  $aplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, aplication $aplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\aplication  $aplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(aplication $aplication)
    {
        //
    }
}
