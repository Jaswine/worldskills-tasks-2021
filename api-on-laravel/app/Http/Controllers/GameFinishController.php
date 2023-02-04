<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameFinishResource;
use App\Models\GameFinish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameFinishController extends Controller
{
    public function index() {
        $games = GameFinish::orderBy('result', 'DESC')->take(5)->get();

        return response([
            'data' => GameFinishResource::collection($games),
        ]);
    }

    public function create(Request $request) {
        $request -> validate([
            'user',
            'result|min:1'
        ]);
        
        $result = GameFinish::create([
            'user_id' => $request->user,
            'result' => $request->result
        ]);

        return response([
            'status' => 'success',
            'data' => new GameFinishResource($result)
        ]);
    }
}
