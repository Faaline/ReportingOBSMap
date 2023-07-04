<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OffreFibreController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => 'api', 'prefix' => 'auth'
], function (){
    Route::post('register', [ AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::apiResources([
    'communes' => \App\Http\Controllers\CommuneController::class,
    'reparts' => \App\Http\Controllers\RepartController::class,
    'segments' => \App\Http\Controllers\SegmentController::class,
    'segment-marches' => \App\Http\Controllers\SegmentMarcheController::class,
    'clients' => \App\Http\Controllers\ClientController::class,
    'offres' => \App\Http\Controllers\OffreController::class,
    'agences' => \App\Http\Controllers\AgenceController::class,
    'fibres' => \App\Http\Controllers\FibreController::class,
    'voix-fixes' => \App\Http\Controllers\VoixFixeController::class,
    'categories' => \App\Http\Controllers\CategorieController::class,
    'adsls' => \App\Http\Controllers\AdslController::class,
    'offre-fibres' => \App\Http\Controllers\OffreFibreController::class,
    'offre-adsl-adsl' => \App\Http\Controllers\OffreAdslAdslController::class,
    'commune-reparts' => \App\Http\Controllers\CommuneRepartController::class,
    'acces-reseau' => \App\Http\Controllers\AccesReseauController::class,
    'offre-adsl' => \App\Http\Controllers\OffreAdslController::class,
    'users' => \App\Http\Controllers\UserController::class,
]);

Route::middleware(['auth'])->group(function (){
    Route::apiResources([
        'users' => \App\Http\Controllers\UserController::class,
        'profiles' => \App\Http\Controllers\ProfileController::class
    ]);
});

Route::post('import',[\App\Http\Controllers\ClientController::class, 'reportingImport']);
//Route::post('profiles/creation', [\App\Http\Controllers\ProfilController::class, 'store']);
Route::post('/offre-fibre/store-multiple', [OffreFibreController::class, 'storeMultiple']);
Route::post('/segment-offre/store-multiple', [\App\Http\Controllers\SegmentSegmentMarcheController::class, 'storeMultiple']);
Route::post('/commune-repart/store-multiple', [\App\Http\Controllers\CommuneRepartController::class, 'storeMultiple']);
Route::post('/segmentmarche/insert-multiple', [\App\Http\Controllers\SegmentMarcheController::class, 'insertMultiple']);
Route::post('/segment/insert-multiple', [\App\Http\Controllers\SegmentController::class, 'insertMultiple']);
Route::post('/commune/insert-multiple', [\App\Http\Controllers\CommuneController::class, 'insertMultiple']);
Route::post('/repart/insert-multiple', [\App\Http\Controllers\RepartController::class, 'insertMultiple']);
Route::post('/acces-reseau/insert-multiple', [\App\Http\Controllers\AccesReseauController::class, 'insertMultiple']);
Route::get('/client/search', [\App\Http\Controllers\ClientController::class, 'searchClient']);

