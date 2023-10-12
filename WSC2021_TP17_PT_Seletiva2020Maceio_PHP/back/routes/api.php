<?php

use App\Http\Controllers\DetailsController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/')->group(function() {
    // Route::get('/', function () {
    //     return response(['message' => 'I work']);
    // });

    # auth routes
    Route::post('login',  [UserController::class,'login']);
    Route::post('register',  [UserController::class,'register']);
    Route::delete('logout', [UserController::class, 'logout']);
    
    # search routes
    Route::get('/', [DetailsController::class, 'all_details']);

    Route::get('motherboards', [DetailsController::class, 'motherboards']);
    Route::get('processors', [DetailsController::class, 'processors']);
    Route::get('rammemories', [DetailsController::class, 'rammemories']);
    Route::get('storagedevices', [DetailsController::class, 'storagedevices']);
    Route::get('graphiccards', [DetailsController::class, 'graphiccards']);
    Route::get('machines', [DetailsController::class, 'machines']);
    Route::get('power_supplies', [DetailsController::class, 'power_supplies']);
    Route::get('brands', [DetailsController::class, 'brands']);

    Route::get('search', [DetailsController::class, 'search']);
    

    # machine routes
    Route::post('verify-compatibility', [MachineController::class, 'verify_compatibility']);
    Route::post('machines', [MachineController::class, 'create']);
    Route::put('machines/{id}', [MachineController::class, 'update']);
    Route::delete('machines/{id}', [MachineController::class, 'delete']);
    Route::get('images/{id}', [MachineController::class, 'image']);
});