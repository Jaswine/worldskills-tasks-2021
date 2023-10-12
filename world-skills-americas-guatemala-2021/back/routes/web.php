<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('XX_module05')->group(function () {
    Route::get('/', [MainController::class, 'jobIndicator']);
    Route::post('/', [MainController::class, 'jobIndicatorCreate']);

    Route::get('/create-job', [MainController::class, 'createJobView']);
    Route::post('/create-job', [MainController::class, 'createJob']);
    
    Route::get('joblist', [MainController::class, 'jobIndicatorList']);
});
