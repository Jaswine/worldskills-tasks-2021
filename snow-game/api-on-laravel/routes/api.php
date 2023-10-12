<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BounceController;
use App\Http\Controllers\EndGameController;
use App\Http\Controllers\GameFinishController;
use App\Http\Controllers\InFlightController;
use App\Http\Controllers\StartGameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('loaded', [AuthController::class, 'isLoaded']);

Route::post('start-game', [AuthController::class, 'create']);
Route::post('save-throw', [StartGameController::class, 'start']);
Route::post('game-over', [EndGameController::class, 'create']);
Route::post('in-flight', [InFlightController::class, 'create']);
Route::post('bounce', [BounceController::class, 'create']);

Route::get('game-finish', [GameFinishController::class, 'index']);
Route::post('game-finish', [GameFinishController::class, 'create']);



