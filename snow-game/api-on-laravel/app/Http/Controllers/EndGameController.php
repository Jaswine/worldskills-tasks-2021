<?php

namespace App\Http\Controllers;

use App\Models\EndGame as EndGameModel;
use Illuminate\Http\Request;

class EndGameController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'user',
            'startGame|min:5',
            'angle|min:1',
            'power|min:1',
            'endGame|min:5',
        ]);

        $game = EndGameModel::create([
            'user_id' => $request->user,
            'startGame' => $request->startGame,
            'angle' => $request->angle,
            'power' => $request->power,
            'endGame' => $request->endGame
        ]);

        return response([
            'status' => 'success',
            'data' => $game,
        ]);
    }
}
