<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\VoixFixe;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VoixFixeController extends Controller
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
        $cacheKey = 'voix_fixes_data';
        $cacheDuration = 60; // Durée de mise en cache en minutes

        $voixFixe = Cache::remember($cacheKey, $cacheDuration, function (){
            $nblOffreVoixFixe= Client::whereHas('voixFixes')->count();
            return [VoixFixe::with('accesReseaus')->orderBy('created_at','desc')->get(),
                'nombre_ligne_voix_fixe' => $nblOffreVoixFixe,
                'voixFixe' => $this->clientService->countClientsByOffreVoixFixe(VoixFixe::all()),
                'voixFixeDvei' => $this->clientService->countClientsByOffresAndSegmentDVEI(VoixFixe::all()),
                'voixFixeDvps' => $this->clientService->countClientsByOffresAndSegmentDVPS(VoixFixe::all()),
                'voixFixeSoho' => $this->clientService->countClientsByOffresAndSegmentSoho(VoixFixe::all()),
                'voixFixeParticulier' => $this->clientService->countClientsByOffresAndSegmentParticulier(VoixFixe::all()),
                'voixFixePmePMi' => $this->clientService->countClientsByOffresAndSegmentPmePMi(VoixFixe::all()),
                'voixFixeEtat' => $this->clientService->countClientsByOffresAndSegmentEtat(VoixFixe::all()),
                'voixFixeGC' => $this->clientService->countClientsByOffresAndSegmentGc(VoixFixe::all()),
            ];
        });

        return response()->json($voixFixe,200);
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
