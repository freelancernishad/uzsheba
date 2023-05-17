<?php

namespace App\Http\Controllers;

use App\Models\Sonod;
use App\Models\TikaLog;
use Illuminate\Http\Request;

class TikaLogController extends Controller
{


    public function tikacount(Request $request)
    {
        $applicantId = $request->applicantId;
        $tikadoseSingle = $request->tikadose;
        $tikatype = $request->tikatype;


        $row = Sonod::find($applicantId);
        $date_of_birth = $row->date_of_birth;

        $fourthDoseDate = date('Y-m-d', strtotime('+270 day', strtotime($date_of_birth)));
        $fifthDoseDate = date('Y-m-d', strtotime('+450 day', strtotime($date_of_birth)));

        if($tikatype=='বিসিজি টিকা'){

            $countData =  TikaLog::where(['applicantId'=>$applicantId,'tikadose'=>$tikadoseSingle,'tikaname'=>'বিসিজি'])->count();
            return $data = [
                'statusCode' => $countData,
                'nextDate' => 'বিসিজি টিকা যেকোনো সময় দিতে পারেন',
            ];

        }else{

            $getTikaLog = TikaLog::where(['applicantId'=>$applicantId])->where('tikaname','!=', 'বিসিজি')->orderBy('id','desc')->first();

            $tikadose = $getTikaLog->tikadose;

            if($tikadose=='১ম বার' || $tikadose=='২য় বার' ){
                $nextDate = $getTikaLog->nextTikaDate;
            }elseif($tikadose=='৩য় বার'){
                $nextDate = $fourthDoseDate;
            }elseif($tikadose=='৪র্থ বার'){
                $nextDate = $fifthDoseDate;
            }elseif($tikadose=='৫ম বার'){
                $nextDate = 'end';
            }


            $countData =  TikaLog::where(['applicantId'=>$applicantId,'tikadose'=>$tikadoseSingle])->where('tikaname','!=', 'বিসিজি')->count();

            return $data = [
                'statusCode' => $countData,
                'nextDate' => int_en_to_bn($nextDate),
            ];

        }


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $applicantId = $request->applicantId;

        return TikaLog::where('applicantId',$applicantId)->get();
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
        $tikaname = $request->tikaname;

        foreach ($tikaname as $value) {
            // print_r($value);
            $datas = [
                'applicantId'=>$request->applicantId,
                'kendro_name'=>$request->kendro_name,
                'kormir_name'=>$request->kormir_name,
                'nextTikaDate'=>$request->nextTikaDate,
                'tikaDate'=>$request->tikaDate,
                'tikadose'=>$request->tikadose,
                'tikaname'=>$value,
            ];
             TikaLog::create($datas);
        }

        // return $data =  $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TikaLog  $tikaLog
     * @return \Illuminate\Http\Response
     */
    public function show(TikaLog $tikaLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TikaLog  $tikaLog
     * @return \Illuminate\Http\Response
     */
    public function edit(TikaLog $tikaLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TikaLog  $tikaLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TikaLog $tikaLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TikaLog  $tikaLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(TikaLog $tikaLog)
    {
        //
    }
}
