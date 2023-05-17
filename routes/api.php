<?php

use App\Http\Controllers\OffreFibreController;
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
    'categories' => \App\Http\Controllers\CategorieController::class,
    'adsls' => \App\Http\Controllers\AdslController::class,
    'offre_fibres' => \App\Http\Controllers\OffreFibreController::class,

]);
Route::post('import',[\App\Http\Controllers\ClientController::class, 'reportingImport']);
Route::post('/offre-fibre/store-multiple', [OffreFibreController::class, 'storeMultiple']);
Route::post('/segmentmarche/insert-multiple', [\App\Http\Controllers\SegmentMarcheController::class, 'insertMultiple']);
Route::post('/segment/insert-multiple', [\App\Http\Controllers\SegmentController::class, 'insertMultiple']);

