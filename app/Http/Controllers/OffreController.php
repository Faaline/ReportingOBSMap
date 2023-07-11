<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Offre;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OffreController extends Controller
{
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
        set_time_limit(3000000);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cacheKey = 'offres_data';
        $cacheDuration = 60; // Durée de mise en cache en minutes

        $offres = Cache::remember($cacheKey, $cacheDuration, function () {

            $nblOffre= Client::whereHas('offres')->count();
            return [Offre::all(),
                    'nombre_ligne_offre_fibre' => $nblOffre,'offres' => $this->clientService->countClientsByOffres(Offre::all()),
                    'offresDVEI' => $this->clientService->countClientsByOffreFibreAndSegmentDVEI(Offre::all()),
                    'offresDVPS' => $this->clientService->countClientsByOffreFibreAndSegmentDVPS(Offre::all()),
                    'offresSoho' => $this->clientService->countClientsByOffreFibreAndSegmentSoho(Offre::all()),
                    'offresPmePMi' => $this->clientService->countClientsByOffreFibreAndSegmentPmePmi(Offre::all()),
                    'offresParticulier' => $this->clientService->countClientsByOffreFibreAndSegmentParticulier(Offre::all()),
                    'offresEtat' => $this->clientService->countClientsByOffreFibreAndSegmentEtat(Offre::all()),
                    'offresGC' => $this->clientService->countClientsByOffreFibreAndSegmentGC(Offre::all()),
            ];
        });

        return response()->json($offres,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Offre::create(array_merge(
            [
                'type'=>strtoupper($request->all()['type']),
            ]));

        return response()->json([
            'success'=>'Offre ajoutée avec succes',
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
