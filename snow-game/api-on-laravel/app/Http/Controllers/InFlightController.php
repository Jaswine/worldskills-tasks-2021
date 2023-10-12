<?php

namespace App\Http\Controllers;

use App\Models\InFlight;
use Illuminate\Http\Request;

class InFlightController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'user',
            'speed|min:1',
            'x|min:1',
            'y|min:1'
        ]);

        $flight = InFlight::create([
            'user_id' => $request->user,
            'speed' => $request->speed,
            'x' => $request->x,
            'y' => $request->y,
        ]);

        return response([
            'status' => 'success',
            'flight' => $flight,
        ]);
    }
}
