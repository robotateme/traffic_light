<?php

use App\Http\Controllers\TrafficLightController;
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

Route::middleware('api')->group(function () {
    Route::get('/traffic-light/start', [TrafficLightController::class, 'startDriving']);
    Route::get('/traffic-light/log', [TrafficLightController::class, 'log']);
});
