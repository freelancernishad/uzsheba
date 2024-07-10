<?php

namespace App\Http\Controllers;

use App\Models\TenderList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TenderCalender;
use App\Models\TenderCalenderItem;
use App\Models\TenderScheduleTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TenderCalenderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;

        $tenderCalenders = TenderCalender::with(['items','teams','scheduleTimes'])->where('status',$status)->orderBy('id','desc')->get();
        return response()->json($tenderCalenders);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'sorok_no' => 'required|string',
            'date' => 'required',
            'bn_year' => 'required|string',
            'en_year' => 'required|string',
            'union' => 'required|string',
            'rules' => 'nullable|string',
            'onulipi' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.union_name' => 'required|string',
            'items.*.hat_name' => 'required|string',
            'items.*.ijara_price' => 'required|numeric',
            'items.*.previous_ijara_price' => 'required|numeric',
            'items.*.six_percent_bitti' => 'required|numeric',
            'items.*.form_price' => 'required|numeric',
            'scheduleTimes' => 'required|array|min:1',
            'scheduleTimes.*.stage_of_tender' => 'required|string',
            'scheduleTimes.*.form_buy_start' => 'required|date',
            'scheduleTimes.*.form_buy_end' => 'required|date',
            'scheduleTimes.*.tender_start' => 'required|date',
            'scheduleTimes.*.tender_end' => 'required|date',
            'scheduleTimes.*.tender_open' => 'required|date',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Set the authenticated user's union (assuming 'union' field is directly accessible)
    //    return  $union = Auth::user();

        // Generate a unique calendar_id (example: using timestamp)
        $calenderId = 'cal' . now()->timestamp;

        // Create the Tender Calendar record
        $tenderCalendar = TenderCalender::create([
            'sorok_no' => $request->input('sorok_no'),
            'date' => $request->input('date'),
            'bn_year' => $request->input('bn_year'),
            'en_year' => $request->input('en_year'),
            'calender_id' => $calenderId,
            'union' => $request->union, // Use the 'union' field directly from request
            'dc_name' => $request->input('dc_name'),
            'dc_signature' => $request->input('dc_signature'),
            'rules' => $request->input('rules'),
            'onulipi' => $request->input('onulipi'),
            'status' => 'new', // Set status to "pending"
        ]);

        // Create Tender Calendar items with serial index_no
        $indexNo = 1; // Initialize index_no counter

        foreach ($request->input('items') as $itemData) {
            $tenderCalendar->items()->create([
                'index_no' => $indexNo++, // Assign serial index_no
                'union_name' => $itemData['union_name'],
                'hat_name' => $itemData['hat_name'],
                'ijara_price' => $itemData['ijara_price'],
                'previous_ijara_price' => $itemData['previous_ijara_price'],
                'six_percent_bitti' => $itemData['six_percent_bitti'],
                'form_price' => $itemData['form_price'],
            ]);
        }


           // Create Tender Schedule Times
        foreach ($request->input('scheduleTimes') as $timeData) {
            $tenderCalendar->scheduleTimes()->create([
                'stage_of_tender' => $timeData['stage_of_tender'],
                'form_buy_start' => $timeData['form_buy_start'],
                'form_buy_end' => $timeData['form_buy_end'],
                'tender_start' => $timeData['tender_start'],
                'tender_end' => $timeData['tender_end'],
                'tender_open' => $timeData['tender_open'],
            ]);
        }

        // Return a response indicating success
        return response()->json(['message' => 'Tender Calendar created successfully'], 201);
    }


    public function show($id)
    {
        $tenderCalender = TenderCalender::with(['items','teams','scheduleTimes'])->findOrFail($id);
        return response()->json($tenderCalender);
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'sorok_no' => 'required|string',
            'bn_year' => 'required|string',
            'en_year' => 'required|string',
            'items' => 'required|array',
            'items.*.id' => 'required|integer', // Ensure each item has an ID for update
            'items.*.union_name' => 'required|string',
            'items.*.hat_name' => 'required|string',
            'items.*.ijara_price' => 'required|numeric',
            'items.*.previous_ijara_price' => 'required|numeric',
            'items.*.six_percent_bitti' => 'required|numeric',
            'items.*.form_price' => 'required|numeric',
            'scheduleTimes' => 'required|array|min:1',
            'scheduleTimes.*.id' => 'required|integer', // Ensure each schedule time has an ID for update
            'scheduleTimes.*.stage_of_tender' => 'required|string',
            'scheduleTimes.*.form_buy_start' => 'required|date',
            'scheduleTimes.*.form_buy_end' => 'required|date',
            'scheduleTimes.*.tender_start' => 'required|date',
            'scheduleTimes.*.tender_end' => 'required|date',
            'scheduleTimes.*.tender_open' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Find the Tender Calendar by ID
            $tenderCalendar = TenderCalender::findOrFail($id);

            // Update the Tender Calendar with validated data
            $tenderCalendar->update([
                'sorok_no' => $request->input('sorok_no'),
                'bn_year' => $request->input('bn_year'),
                'en_year' => $request->input('en_year'),
            ]);

            // Update or create items related to the Tender Calendar
            foreach ($request->input('items') as $itemData) {
                $id = $itemData['id'];
                $item = [
                    'index_no' => $itemData['index_no'],
                    'union_name' => $itemData['union_name'],
                    'hat_name' => $itemData['hat_name'],
                    'ijara_price' => $itemData['ijara_price'],
                    'previous_ijara_price' => $itemData['previous_ijara_price'],
                    'six_percent_bitti' => $itemData['six_percent_bitti'],
                    'form_price' => $itemData['form_price'],
                ];

                $tenderCalendar->items()->updateOrCreate(['id' => $id], $item);
            }

            // Update or create schedule times related to the Tender Calendar
            foreach ($request->input('scheduleTimes') as $timeData) {
                $timeId = $timeData['id'];
                $scheduleTime = [
                    'stage_of_tender' => $timeData['stage_of_tender'],
                    'form_buy_start' => $timeData['form_buy_start'],
                    'form_buy_end' => $timeData['form_buy_end'],
                    'tender_start' => $timeData['tender_start'],
                    'tender_end' => $timeData['tender_end'],
                    'tender_open' => $timeData['tender_open'],
                ];

                $tenderCalendar->scheduleTimes()->updateOrCreate(['id' => $timeId], $scheduleTime);
            }

            // Optionally, you can return the updated Tender Calendar
            return response()->json(['message' => 'Tender Calendar updated successfully', 'data' => $tenderCalendar]);
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        $tenderCalender = TenderCalender::findOrFail($id);
        $tenderCalender->delete();
        return response()->json(null, 204);
    }

    public function approveCalender(Request $request, $id)
    {
        $request->validate([
            'dc_name' => 'required|string|max:255',
            'dc_signature' => 'required|string|max:255',
        ]);

        $dc_name = $request->dc_name;
        $dc_signature = $request->dc_signature;

        $updatedItem = [
            'dc_name' => $dc_name,
            'dc_signature' => $dc_signature,
            'status' => 'approved',
        ];

        $tenderCalendar = TenderCalender::findOrFail($id);
        $tenderCalendar->update($updatedItem);

        // Retrieve items associated with this calendar
        $items = $tenderCalendar->items;

        // Retrieve committee members from TenderTeam
        $teams = $tenderCalendar->teams;

        // Prepare committee member data
        $committeeData = [];
        foreach ($teams as $index => $team) {
            $committeeData['committe'.($index+1).'name'] = $team->name;
            $committeeData['committe'.($index+1).'position'] = $team->position;
            $committeeData['commette'.($index+1).'phone'] = $team->phone;
            $committeeData['commette'.($index+1).'pass'] = $team->pass;
        }

        // Create TenderList entries based on TenderCalenderItems
        foreach ($items as $item) {
            $random = Str::random(20);
            TenderList::create(array_merge([
                'tender_sl' => tenderSl(), // Adjust this as needed
                'tender_calender_id' => $tenderCalendar->id,
                'tender_calender_item_id' => $item->id,
                'memorial_no' => $tenderCalendar->sorok_no,
                'noticeDate' => $tenderCalendar->date,
                'union_name' => $tenderCalendar->union,
                'tender_roles' => $tenderCalendar->rules,
                'other_content' => $tenderCalendar->onulipi,
                'tender_name' => $item->hat_name,
                'form_price' => $item->form_price,
                'govt_price' => $item->ijara_price,
                'tender_id' => time().$random,
                'status' => 'approved', // Adjust this as needed
            ], $committeeData));
        }

        return response()->json($tenderCalendar, 200);
    }



    function calander_download(Request $request,$type,$id) {


        if($type=='calander'){
            $html = tender_calander_pdf_body($id);
        }elseif($type=='teams'){
            $html = tender_calander_pdf_teams($id);
        }elseif($type=='items'){
            $html = tender_calander_pdf_items($id);
        }elseif($type=='schedule_times'){
            $html = tender_calander_pdf_schedule_times($id);
        }else{
            $html = "<h1 style='color:red'>Page Not Found</h1>";
        }





        $Filename = "tender-calander-".time().".pdf";
      return  PdfMaker('A4',$html,$Filename);

    }




    public function updateTenderListsFromScheduleTime(Request $request)
    {
        // Validate request data
        $request->validate([
            'scheduleTimeId' => 'required|numeric',
            'calenderId' => 'required|numeric',
            'selectedItems' => 'required|array',
        ]);

        $scheduleTimeId = $request->input('scheduleTimeId');
        $calenderId = $request->input('calenderId');
        $selectedItems = $request->input('selectedItems');

        try {
            // Find the corresponding TenderScheduleTime
            $scheduleTime = TenderScheduleTime::findOrFail($scheduleTimeId);

                 // Update Tender Calender Items
            TenderCalenderItem::where('tender_calender_id', $calenderId)
            ->whereIn('id', $selectedItems)
            ->update([
                'stage_of_tender' => $scheduleTime->stage_of_tender,
                'tender_schedule_time_id' => $scheduleTime->id,
            ]);


            // Fetch all TenderLists related to the given calenderId and selectedItems
            $tenderLists = TenderList::where('tender_calender_id', $calenderId)
                                     ->whereIn('tender_calender_item_id', $selectedItems)
                                     ->get();

            // Update each TenderList based on the TenderScheduleTime
            foreach ($tenderLists as $tenderList) {



                $tenderList->update([
                    'tender_schedule_times_id' => $scheduleTime->id,
                    'form_buy_last_date' => $scheduleTime->form_buy_end,
                    'tender_start' => $scheduleTime->tender_start,
                    'tender_end' => $scheduleTime->tender_end,
                    'tender_open' => $scheduleTime->tender_open,
                    'status' => 'pending',
                    // Add other fields to update as needed
                ]);
            }

            return response()->json(['message' => 'TenderLists updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update TenderLists.', 'error' => $e->getMessage()], 500);
        }
    }


}
