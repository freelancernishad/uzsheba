<?php

namespace App\Http\Controllers;

use App\Models\TenderCalenderItem;
use Illuminate\Http\Request;

class TenderCalenderItemController extends Controller
{
    public function index()
    {
        $tenderCalenderItems = TenderCalenderItem::all();
        return response()->json($tenderCalenderItems);
    }

    public function store(Request $request)
    {
        $tenderCalenderItem = TenderCalenderItem::create($request->all());
        return response()->json($tenderCalenderItem, 201);
    }

    public function show($id)
    {
        $tenderCalenderItem = TenderCalenderItem::findOrFail($id);
        return response()->json($tenderCalenderItem);
    }

    public function update(Request $request, $id)
    {
        $tenderCalenderItem = TenderCalenderItem::findOrFail($id);
        $tenderCalenderItem->update($request->all());
        return response()->json($tenderCalenderItem);
    }

    public function destroy($id)
    {
        $tenderCalenderItem = TenderCalenderItem::findOrFail($id);
        $tenderCalenderItem->delete();
        return response()->json(null, 204);
    }
}
