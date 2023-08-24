<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\TenderWorkOrder;

class TenderWorkOrderController extends Controller
{
    public function index()
    {
        $workOrders = TenderWorkOrder::all();
        return response()->json($workOrders);
    }

    public function show($id)
    {
        $workOrder = TenderWorkOrder::findOrFail($id);
        return response()->json($workOrder);
    }

    public function store(Request $request)
    {
        
        $workOrder = TenderWorkOrder::create($request->all());

        return response()->json($workOrder, 201);
    }

    public function update(Request $request, $id)
    {
        $workOrder = TenderWorkOrder::findOrFail($id);
        $workOrder->update($request->all());
        return response()->json($workOrder, 200);
    }

    public function destroy($id)
    {
        $workOrder = TenderWorkOrder::findOrFail($id);
        $workOrder->delete();
        return response()->json(null, 204);
    }
}
