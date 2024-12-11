<?php

// app/Http/Controllers/ShipmentController.php
namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{

    
    public function trackShipment($orderId)
    {
        $shipment = Shipment::where('order_id', $orderId)->first();

        if (!$shipment) {
            return response()->json(['message' => 'Shipment not found'], 404);
        }

        return response()->json(['shipment' => $shipment]);
    }

    public function updateStatus(Request $request, $shipmentId)
    {
        $shipment = Shipment::findOrFail($shipmentId);
        $shipment->update(['status' => $request->status, 'tracking_number' => $request->tracking_number]);

        return response()->json(['message' => 'Shipment status updated', 'shipment' => $shipment]);
    }
}
