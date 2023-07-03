<?php

namespace App\Http\Controllers;

use App\Models\VoixFixe;
use App\Services\ClientService;
use Illuminate\Http\Request;

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

        //SOHO
        $forfaitVoipSoho = $this->clientService->countClientsByVoixFixeAndSegment('Forfait Voip', $this->clientService->getTabLibelleSohos());
        $VoipSoho = $this->clientService->countClientsByVoixFixeAndSegment('Voip', $this->clientService->getTabLibelleSohos());
        $forfaitVoixSoho = $this->clientService->countClientsByVoixFixeAndSegment('Forfait Voix', $this->clientService->getTabLibelleSohos());
        $packMultiplaySoho = $this->clientService->countClientsByVoixFixeAndSegment('Pack multiplay', $this->clientService->getTabLibelleSohos());
        $voixOnlySoho = $this->clientService->countClientsByVoixFixeAndSegment('Voix only', $this->clientService->getTabLibelleSohos());

        //PME-PMI
        $forfaitVoipPmePmi = $this->clientService->countClientsByVoixFixeAndSegment('Forfait Voip', $this->clientService->getTabLibellePmePmi());
        $VoipPmePmi = $this->clientService->countClientsByVoixFixeAndSegment('Voip', $this->clientService->getTabLibellePmePmi());
        $forfaitVoixPmePmi = $this->clientService->countClientsByVoixFixeAndSegment('Forfait Voix', $this->clientService->getTabLibellePmePmi());
        $packMultiplayPmePmi = $this->clientService->countClientsByVoixFixeAndSegment('Pack multiplay', $this->clientService->getTabLibellePmePmi());
        $voixOnlyPmePmi = $this->clientService->countClientsByVoixFixeAndSegment('Voix only', $this->clientService->getTabLibellePmePmi());

        //Particulier
        $forfaitVoipParticulier = $this->clientService->countClientsByVoixFixeAndSegment('Forfait Voip', $this->clientService->getTabLibelleParticulier());
        $VoipParticulier = $this->clientService->countClientsByVoixFixeAndSegment('Voip', $this->clientService->getTabLibelleParticulier());
        $forfaitVoixParticulier = $this->clientService->countClientsByVoixFixeAndSegment('Forfait Voix', $this->clientService->getTabLibelleParticulier());
        $packMultiplayParticulier = $this->clientService->countClientsByVoixFixeAndSegment('Pack multiplay', $this->clientService->getTabLibelleParticulier());
        $voixOnlyParticulier = $this->clientService->countClientsByVoixFixeAndSegment('Voix only', $this->clientService->getTabLibelleParticulier());

        //Etat
        $forfaitVoipEtat = $this->clientService->countClientsByVoixFixeAndSegment('Forfait Voip', $this->clientService->getTabLibelleEtat());
        $VoipEtat = $this->clientService->countClientsByVoixFixeAndSegment('Voip', $this->clientService->getTabLibelleEtat());
        $forfaitVoixEtat = $this->clientService->countClientsByVoixFixeAndSegment('Forfait Voix', $this->clientService->getTabLibelleEtat());
        $packMultiplayEtat = $this->clientService->countClientsByVoixFixeAndSegment('Pack multiplay', $this->clientService->getTabLibelleEtat());
        $voixOnlyEtat = $this->clientService->countClientsByVoixFixeAndSegment('Voix only', $this->clientService->getTabLibelleEtat());

        //Grands comptes
        $forfaitVoipGC = $this->clientService->countClientsByVoixFixeAndSegment('Forfait Voip', $this->clientService->getTabLibelleGC());
        $VoipGC = $this->clientService->countClientsByVoixFixeAndSegment('Voip', $this->clientService->getTabLibelleGC());
        $forfaitVoixGC = $this->clientService->countClientsByVoixFixeAndSegment('Forfait Voix', $this->clientService->getTabLibelleGC());
        $packMultiplayGC = $this->clientService->countClientsByVoixFixeAndSegment('Pack multiplay', $this->clientService->getTabLibelleGC());
        $voixOnlyGC = $this->clientService->countClientsByVoixFixeAndSegment('Voix only', $this->clientService->getTabLibelleGC());

        //Global
        $forfaitVoipGlobal = $this->clientService->countClientsByVoixFixeAndSegment('Forfait Voip', $this->clientService->getTabLibelleDVEI());
        $VoipGlobal = $this->clientService->countClientsByVoixFixeAndSegment('Voip', $this->clientService->getTabLibelleDVEI());
        $forfaitVoixGlobal = $this->clientService->countClientsByVoixFixeAndSegment('Forfait Voix', $this->clientService->getTabLibelleDVEI());
        $packMultiplayGlobal = $this->clientService->countClientsByVoixFixeAndSegment('Pack multiplay', $this->clientService->getTabLibelleDVEI());
        $voixOnlyGlobal = $this->clientService->countClientsByVoixFixeAndSegment('BIV PLATINUM', $this->clientService->getTabLibelleDVEI());

        $voixFixe=VoixFixe::with('accesReseaus')->orderBy('created_at','desc')->get();
        return response()->json([$voixFixe,
            'forfaitVoipSoho'=> $forfaitVoipSoho,'VoipSoho'=> $VoipSoho,
            'forfaitVoixSoho'=> $forfaitVoixSoho,'packMultiplaySoho'=> $packMultiplaySoho,
            'voixOnlySoho'=> $voixOnlySoho,'forfaitVoipPmePmi'=> $forfaitVoipPmePmi,
            'VoipPmePmi'=> $VoipPmePmi,'forfaitVoixPmePmi'=> $forfaitVoixPmePmi,
            'packMultiplayPmePmi'=> $packMultiplayPmePmi,'voixOnlyPmePmi'=> $voixOnlyPmePmi,
            'forfaitVoipParticulier'=> $forfaitVoipParticulier,'VoipParticulier'=> $VoipParticulier,
            'forfaitVoixParticulier'=> $forfaitVoixParticulier,
            'packMultiplayParticulier'=> $packMultiplayParticulier,'voixOnlyParticulier'=> $voixOnlyParticulier,
            'forfaitVoipEtat'=> $forfaitVoipEtat,'VoipEtat'=> $VoipEtat,
            'forfaitVoixEtat'=> $forfaitVoixEtat,
            'packMultiplayEtat'=> $packMultiplayEtat,'voixOnlyEtat'=> $voixOnlyEtat,
            'forfaitVoipGC'=> $forfaitVoipGC,'VoipGC'=> $VoipGC,
            'forfaitVoixGC'=> $forfaitVoixGC,
            'packMultiplayGC'=> $packMultiplayGC,'voixOnlyGC'=> $voixOnlyGC,
            'forfaitVoipGlobal'=> $forfaitVoipGlobal,'VoipGlobal'=> $VoipGlobal, 'forfaitVoixGlobal'=> $forfaitVoixGlobal,
            'packMultiplayGlobal'=> $packMultiplayGlobal,'voixOnlyGlobal'=> $voixOnlyGlobal],
            200);
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
