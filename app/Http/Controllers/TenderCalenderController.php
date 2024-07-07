<?php

namespace App\Http\Controllers;

use App\Models\TenderList;
use Illuminate\Support\Str;
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
            'rules' => 'nullable|string',
            'onulipi' => 'nullable|string',
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
                'memorial_no' => $tenderCalendar->sorok_no,
                'union_name' => $tenderCalendar->union,
                'tender_roles' => $tenderCalendar->rules,
                'other_content' => $tenderCalendar->onulipi,
                'tender_name' => $item->hat_name,
                'govt_price' => $item->ijara_price,
                'tender_id' => time().$random,
                'status' => 'approved', // Adjust this as needed
            ], $committeeData));
        }

        return response()->json($tenderCalendar, 200);
    }



    function calander_download(Request $request, $id) {
          $html = $this->tender_calander_pdf_body($id);
        $Filename = "tender-calander-".time().".pdf";
      return  PdfMaker('A4',$html,$Filename);

    }

    function tender_calander_pdf_body($id) {
         $tenderCalendar = TenderCalender::with(['teams','items'])->find($id);



        $html = "    <style>

        h4,h3,p{
        margin:0;padding:0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 2px;
            text-align: center;
        }
         th {
            background: green;
            color: white;

        }

        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .signature div {
            width: 30%;
            text-align: center;
        }


        .signature-table {
            width: 100%;
            margin-top: 40px;
            border: none;
        }
        .signature-table td {
            border: none;
            text-align: center;
            padding: 20px;
        }
    </style>

<body>
    <div class='header'>
        <img width='50px' src='".base64('assets/img/bd-logo.png')."' alt='BD Logo'>
        <h4>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার </h4>
        <h3>উপজেলা নির্বাহী অফিসের কার্যালয়</h3>
        <p>".getAddres($tenderCalendar->union)." </p>
    </div>


    <p>১৪৩২ বাংলা সনের হাট বাজার ইজারার ক্যালেন্ডার</p>

    <table>
        <thead>
            <tr>
                <th>ক্রম</th>
                <th>ইউনিয়নের নাম</th>
                <th> হাট-বাজারের নাম</th>
                <th>বিগত বছরের ইজারা মূল্য</th>
                <th>৬% বৃদ্ধি</th>
                <th>ইজারা মূল্য</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($tenderCalendar->items as $key=>$value) {



            $html .= "<tr>
                <td>".int_en_to_bn($key+1)."</td>
                <td>$value->union_name</td>
                <td>$value->hat_name</td>
                <td>$value->previous_ijara_price</td>
                <td>$value->six_percent_bitti</td>
                <td>$value->ijara_price</td>
            </tr>";
        }


        $html .= "</tbody>
    </table>

   <table class='signature-table'>
        <tr>
            <td><img width='130px' src='".base64($tenderCalendar->dc_signature)."' alt='BD Logo'>
                <p>$tenderCalendar->dc_name</p>
                <p>জেলা প্রশাসক , পঞ্চগড়</p>";


                if($tenderCalendar->status=='approved'){

                    $html .= " <p style='color:green'>(অনুমোদিত)</p>";
                }else{

                    $html .= " <p style='color:red'>(এখনো অনুমোদন হয়নি)</p>";
                }







            $html .= " </td>
            <td></td>
            <td>
            <img width='130px' src='".base64($tenderCalendar->uno_signature)."' alt='BD Logo'>
                <p>$tenderCalendar->uno_name</p>
                <p>উপজেলা নির্বাহী অফিসার</p>
                <p>".getAddres($tenderCalendar->union)."</p>";



                if($tenderCalendar->teams->isEmpty()){

                    $html .= " <p style='color:red'>(এখনো কমিটি গঠন করা হয়নি)</p>";
                }

             $html .= "</td>
        </tr>
    </table>


</body>";


return $html;


    }

}
