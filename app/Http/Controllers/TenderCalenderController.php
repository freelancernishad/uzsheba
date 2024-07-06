<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenderCalender;
use App\Models\TenderCalenderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TenderCalenderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;

        $tenderCalenders = TenderCalender::with(['items','teams'])->where('status',$status)->orderBy('id','desc')->get();
        return response()->json($tenderCalenders);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'sorok_no' => 'required|string',
            'bn_year' => 'required|string',
            'en_year' => 'required|string',
            'union' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.union_name' => 'required|string',
            'items.*.hat_name' => 'required|string',
            'items.*.ijara_price' => 'required|numeric',
            'items.*.previous_ijara_price' => 'required|numeric',
            'items.*.six_percent_bitti' => 'required|numeric',
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
            'bn_year' => $request->input('bn_year'),
            'en_year' => $request->input('en_year'),
            'calender_id' => $calenderId,
            'union' => $request->union, // Use the 'union' field directly from request
            'dc_name' => $request->input('dc_name'),
            'dc_signature' => $request->input('dc_signature'),
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
            ]);
        }

        // Return a response indicating success
        return response()->json(['message' => 'Tender Calendar created successfully'], 201);
    }


    public function show($id)
    {
        $tenderCalender = TenderCalender::with('items')->findOrFail($id);
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
            'items.*.union_name' => 'required|string',
            'items.*.hat_name' => 'required|string',
            'items.*.ijara_price' => 'required|numeric',
            'items.*.previous_ijara_price' => 'required|numeric',
            'items.*.six_percent_bitti' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Find the Tender Calendar by ID
            $tenderCalender = TenderCalender::findOrFail($id);

            // Update the Tender Calendar with validated data
            $tenderCalender->update([
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
                ];

                $tenderCalender->items()->updateOrCreate(['id' => $id], $item);
            }

            // Optionally, you can return the updated Tender Calendar
            return response()->json($tenderCalender);
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


    function approveCalender(Request $request,$id) {
        
        $dc_name = $request->dc_name;
        $dc_signature = $request->dc_signature;

        $updatedItem = [
            'dc_name'=>$dc_name,
            'dc_signature'=>$dc_signature,
            'status'=>'approved',
        ];

        $tenderCalendar = TenderCalender::find($id);
        $tenderCalendar->update($updatedItem);
        return $tenderCalendar;
    }

}
