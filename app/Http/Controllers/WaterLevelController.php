<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Http\Requests\StoreWaterLevelRequest;
use Illuminate\Http\Request;
use App\Models\WaterLevel;

class WaterLevelController extends Controller
{
    public function setting(StoreWaterLevelRequest $request)
    {
        $validated = $request->validated();
        WaterLevel::query()->delete(); 
        $waterLevel = WaterLevel::create($validated);
        return response()->json($waterLevel);
    }

    public function fetch()
    {
        $waterLevel = WaterLevel::orderBy('created_at', 'desc')->first();
        return response()->json($waterLevel);
    }
}

