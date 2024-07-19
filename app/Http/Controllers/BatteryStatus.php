<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BatteryStatus extends Controller
{
    public function sendNotifications(Request $request)
    {
        $batteryLevel = $request->input('battery_lvl');

        switch(true) {
            case ($batteryLevel <= 50):
                return response()->json(['message' => 'Niveau batterie réduit de moitié']);
                break; 
            case ($batteryLevel <= 20):
                return response()->json(['message' => 'Niveau batterie Faible (20%)']);
                break;
            case ($batteryLevel <= 10):
                return response()->json(['message' => 'Niveau batterie Très faible (10%)']);
                break;
            default:
        }

        return response()->json(['message' => 'Niveau de batterie suffisante']);
    }
}
