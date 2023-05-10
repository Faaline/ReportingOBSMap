<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResources([
    'communes' => \App\Http\Controllers\CommuneController::class,
    'reparts' => \App\Http\Controllers\RepartController::class,
    'segments' => \App\Http\Controllers\SegmentController::class,
    'offres' => \App\Http\Controllers\OffreController::class,
    'agences' => \App\Http\Controllers\AgenceController::class,
    'fibres' => \App\Http\Controllers\FibreController::class,



    //'import'=>[\App\Http\Controllers\ClientController::class, 'reportingImport']
]);
