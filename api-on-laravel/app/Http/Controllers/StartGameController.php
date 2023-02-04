<?php

namespace App\Http\Controllers;

use App\Models\StartGame;
use Illuminate\Http\Request;

class StartGameController extends Controller
{
    
    // * Method: POST
    // ! Route: /api/save-throw
    // TODO: aving the game starting timestamp, angle, and power of the attempt.(3)
    // ? registered user
    public function start(Request $request) {
        $request-> validate([
            'user',
            'started|min:5',
            'angle',
            'power',
        ]);
        
        $startGame = StartGame::create([
            'user_id' => $request->user,
            'started' => $request->started,
            'angle' => $request->angle,
            'power' => $request->power
        ]);

        $startGame->save();

        return response([
            'status' => 'success',
            'data' => $startGame
        ]);
    }
}
