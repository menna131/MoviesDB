<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    public function store(Request $request)
    {
        // "period": "10",
        // "num_of_records": "5"
        if($request->period < 60){
            return response(['message' => 'period should be > or = 1 min (60)']);
        }
        Setting::create([
            'period' => $request->period,
            'num_of_records' => $request->num_of_records,
        ]);
        return response(['message' => 'settings are saved successfully', 'period' => $request->period.' seconds', 'number of records' => $request->num_of_records.' record(s)']);
    }
}
