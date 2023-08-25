<?php

namespace App\Http\Controllers;


use App\Models\Resolution;
use Illuminate\Http\Request;

class ResolutionController extends Controller
{
    public function index()
    {
        $resolutions = Resolution::all();
        return response()->json($resolutions);
    }

    public function show($id)
    {
        $resolution = Resolution::findOrFail($id);
        return response()->json($resolution);
    }

    public function store(Request $request)
    {

        $tender_list_id = $request->tender_list_id;
        $resolutionCount = Resolution::where('tender_list_id',$tender_list_id)->count();
        if($resolutionCount){
            $resolution = Resolution::where('tender_list_id',$tender_list_id)->first();
            $resolution->update($request->all());
            return response()->json($resolution, 200);
        }


        $resolution = Resolution::create($request->all());
        return response()->json($resolution, 201);


    }

    public function update(Request $request, $id)
    {
        $resolution = Resolution::findOrFail($id);
        $resolution->update($request->all());
        return response()->json($resolution, 200);
    }

    public function destroy($id)
    {
        $resolution = Resolution::findOrFail($id);
        $resolution->delete();
        return response()->json(null, 204);
    }
}
