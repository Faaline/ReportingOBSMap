<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\OffreAdsl;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OffreAdslController extends Controller

{
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cacheKey = 'offre_adsl_data';
        $cacheDuration = 60; // Durée de mise en cache en minutes

        $offreAdsls = Cache::remember($cacheKey, $cacheDuration, function (){
            $nblOffreAdsl= Client::whereHas('adsls')->count();
            return [OffreAdsl::orderBy('created_at','desc')->get(),
                'nombre_ligne_offre_adsl' => $nblOffreAdsl,
                'offreAdsl' => $this->clientService->countClientsByOffreAdsls(OffreAdsl::all()),
                'offreAdslDvei' => $this->clientService->countClientsByOffresTypeAndSegmentDVEI(OffreAdsl::all()),
                'offreAdslDvps' => $this->clientService->countClientsByOffresTypeAndSegmentDVPS(OffreAdsl::all()),
                'offreAdslSoho' => $this->clientService->countClientsByOffresTypeAndSegmentSoho(OffreAdsl::all()),
                'offreAdslParticulier' => $this->clientService->countClientsByOffresTypeAndSegmentParticulier(OffreAdsl::all()),
                'offreAdslPmePMi' => $this->clientService->countClientsByOffresTypeAndSegmentPmePmi(OffreAdsl::all()),
                'offreAdslEtat' => $this->clientService->countClientsByOffresTypeAndSegmentEtat(OffreAdsl::all()),
                'offreAdslGC' => $this->clientService->countClientsByOffresTypeAndSegmentGC(OffreAdsl::all()),
            ];
        });

        return response()->json($offreAdsls,200);
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
        //
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
