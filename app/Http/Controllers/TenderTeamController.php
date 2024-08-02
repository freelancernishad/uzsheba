<?php

namespace App\Http\Controllers;

use App\Models\TenderList;
use App\Models\TenderTeam;
use Illuminate\Http\Request;
use App\Models\TenderCalender;
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


        // Prepare the committee data
        $committeeData = [];
        foreach ($createdTeams as $index => $team) {
            $committeeData['committe'.($index+1).'name'] = $team->name;
            $committeeData['committe'.($index+1).'position'] = $team->position;
            $committeeData['commette'.($index+1).'phone'] = $team->phone;
            $committeeData['commette'.($index+1).'pass'] = $team->pass;
        }

        // Find all TenderList instances with the specified tender_calender_id
        $tenderLists = TenderList::where('tender_calender_id', $request->tender_calender_id)->get();

        // Check if any TenderList instances exist
        if ($tenderLists->isEmpty()) {
            // Handle the case where no TenderList instances were found
            // For example, throw an exception or return an error response
            throw new Exception('No TenderList records found.');
        } else {
            // Iterate over each TenderList instance and update it
            foreach ($tenderLists as $tenderList) {
                // Merge the committee data with the existing attributes
                $tenderList->fill($committeeData);

                // Save the updated TenderList
                $tenderList->save();
            }
        }






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
