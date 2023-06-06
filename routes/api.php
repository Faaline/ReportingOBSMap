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
    'clients' => \App\Http\Controllers\ClientController::class,
    'offres' => \App\Http\Controllers\OffreController::class,
    'agences' => \App\Http\Controllers\AgenceController::class,
    'fibres' => \App\Http\Controllers\FibreController::class,
    'voix-fixes' => \App\Http\Controllers\VoixFixeController::class,
    'categories' => \App\Http\Controllers\CategorieController::class,
    'adsls' => \App\Http\Controllers\AdslController::class,
    'offre_fibres' => \App\Http\Controllers\OffreFibreController::class,
    'offre-adsl-adsl' => \App\Http\Controllers\OffreAdslAdslController::class,
    'commune-reparts' => \App\Http\Controllers\CommuneRepartController::class,

]);
Route::post('import',[\App\Http\Controllers\ClientController::class, 'reportingImport']);
Route::post('/offre-fibre/store-multiple', [OffreFibreController::class, 'storeMultiple']);
Route::post('/segment-offre/store-multiple', [\App\Http\Controllers\SegmentSegmentMarcheController::class, 'storeMultiple']);
Route::post('/commune-repart/store-multiple', [\App\Http\Controllers\CommuneRepartController::class, 'storeMultiple']);
Route::post('/segmentmarche/insert-multiple', [\App\Http\Controllers\SegmentMarcheController::class, 'insertMultiple']);
Route::post('/segment/insert-multiple', [\App\Http\Controllers\SegmentController::class, 'insertMultiple']);
Route::post('/commune/insert-multiple', [\App\Http\Controllers\CommuneController::class, 'insertMultiple']);
Route::post('/repart/insert-multiple', [\App\Http\Controllers\RepartController::class, 'insertMultiple']);
Route::post('/acces-reseau/insert-multiple', [\App\Http\Controllers\AccesReseauController::class, 'insertMultiple']);

