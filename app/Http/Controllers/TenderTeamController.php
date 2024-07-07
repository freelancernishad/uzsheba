<?php

namespace App\Http\Controllers;

use App\Models\TenderCalender;
use App\Models\TenderTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TenderTeamController extends Controller
{
    public function index()
    {
        $tenderTeams = TenderTeam::all();
        return response()->json($tenderTeams);
    }

    public function store(Request $request)
    {
        // Validate the request using Validator facade
        $validator = Validator::make($request->all(), [
            'tender_calender_id' => 'required|exists:tender_calenders,id',
            'items' => 'required|array',
            'items.*.name' => 'required|string|max:255',
            'items.*.position' => 'required|string|max:255',
            'items.*.phone' => 'required|string|max:15',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Extract items from the request
        $items = $request->input('items');

        // Initialize an array to store created TenderTeam instances
        $createdTeams = [];

        $tenderCalendar = TenderCalender::find($request->tender_calender_id);

        // Iterate through each item and create a TenderTeam record
        foreach ($items as $item) {
            $pass = mt_rand(1000000, 9999999);
            $team = new TenderTeam([
                'tender_calender_id' => $request->input('tender_calender_id'),
                'name' => $item['name'],
                'position' => $item['position'],
                'phone' => $item['phone'],
                'pass' => $pass,
            ]);
            SmsNocSmsSend("ইযারা মূল্যায়নের পাসওয়ার্ড ".$pass,$item['phone'], $tenderCalendar->union);
            // Save the TenderTeam instance
            $team->save();
            // Push the created team to the array
            $createdTeams[] = $team;
        }

        $uno_name = $request->uno_name;
        $uno_signature = $request->uno_signature;
        $tenderCalendar->update(['status'=>'pending','uno_name'=>$uno_name,'uno_signature'=>$uno_signature]);

        return response()->json($createdTeams, 201);
    }

    public function show($id)
    {
        $tenderTeam = TenderTeam::findOrFail($id);
        return response()->json($tenderTeam);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tender_calender_id' => 'required|exists:tender_calenders,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'pass' => 'required|string|max:255',
        ]);

        $tenderTeam = TenderTeam::findOrFail($id);
        $tenderTeam->update($request->all());

        return response()->json($tenderTeam);
    }

    public function destroy($id)
    {
        $tenderTeam = TenderTeam::findOrFail($id);
        $tenderTeam->delete();

        return response()->json(null, 204);
    }
}
