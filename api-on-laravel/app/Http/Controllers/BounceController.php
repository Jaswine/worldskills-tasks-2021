<?php

namespace App\Http\Controllers;

use App\Models\Bounce;
use Illuminate\Http\Request;

class BounceController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'user',
            'speed|min:1',
            'baseAngle|min:1',
            'lastAngle|min:1',
            'power|min:1',
            'time',
        ]);

        $bounce = Bounce::create([
            'user_id' => $request->user,
            'speed' => $request->speed,
            'baseAngle' => $request->baseAngle,
            'lastAngle' => $request->lastAngle,
            'power' => $request->power,
            'time' => $request->time,
        ]);

        return response([
            'status' => 'success',
            'bounce' => $bounce
        ]);
    }
}
