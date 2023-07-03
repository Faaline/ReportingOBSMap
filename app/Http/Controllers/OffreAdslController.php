<?php

namespace App\Http\Controllers;

use App\Models\OffreAdsl;
use App\Services\ClientService;
use Illuminate\Http\Request;

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
        //SOHO
        $adslAutresSoho = $this->clientService->countClientsByOffreAdslAndSegment('ADSL autres', $this->clientService->getTabLibelleSohos());
        $bio10MaxSoho = $this->clientService->countClientsByOffreAdslAndSegment('BIO 10M MAX', $this->clientService->getTabLibelleSohos());
        $bio2MaxSoho = $this->clientService->countClientsByOffreAdslAndSegment('BIO 2M MAX', $this->clientService->getTabLibelleSohos());
        $bio1MCollaboSoho = $this->clientService->countClientsByOffreAdslAndSegment('BIO 1M Collabo', $this->clientService->getTabLibelleSohos());
        $bivSilverSoho = $this->clientService->countClientsByOffreAdslAndSegment('BIV SILVER', $this->clientService->getTabLibelleSohos());
        $OSMBio2MSoho = $this->clientService->countClientsByOffreAdslAndSegment('OSM BIO 2M', $this->clientService->getTabLibelleSohos());
        $internetProSoho = $this->clientService->countClientsByOffreAdslAndSegment('Internet Pro', $this->clientService->getTabLibelleSohos());
        $bioOptionIPSoho = $this->clientService->countClientsByOffreAdslAndSegment('BIO OPTION IP', $this->clientService->getTabLibelleSohos());
        $bivGoldSoho = $this->clientService->countClientsByOffreAdslAndSegment('BIV GOLD', $this->clientService->getTabLibelleSohos());
        $internetProSilverSoho = $this->clientService->countClientsByOffreAdslAndSegment('INTERNET PRO SILVER', $this->clientService->getTabLibelleSohos());
        $internetProGoldSoho = $this->clientService->countClientsByOffreAdslAndSegment('INTERNET PRO GOLD', $this->clientService->getTabLibelleSohos());
        $connectProSoho = $this->clientService->countClientsByOffreAdslAndSegment('CONNECT PRO', $this->clientService->getTabLibelleSohos());
        $bivPlatinumSoho = $this->clientService->countClientsByOffreAdslAndSegment('BIV PLATINUM', $this->clientService->getTabLibelleSohos());

        //PME-PMI
        $adslAutresPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('ADSL autres', $this->clientService->getTabLibellePmePmi());
        $bio10MaxPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('BIO 10M MAX', $this->clientService->getTabLibellePmePmi());
        $bio2MaxPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('BIO 2M MAX', $this->clientService->getTabLibellePmePmi());
        $bio1MCollaboPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('BIO 1M Collabo', $this->clientService->getTabLibellePmePmi());
        $bivSilverPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('BIV SILVER', $this->clientService->getTabLibellePmePmi());
        $OSMBio2MPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('OSM BIO 2M', $this->clientService->getTabLibellePmePmi());
        $internetProPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('Internet Pro', $this->clientService->getTabLibellePmePmi());
        $bioOptionIPPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('BIO OPTION IP', $this->clientService->getTabLibellePmePmi());
        $bivGoldPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('BIV GOLD', $this->clientService->getTabLibellePmePmi());
        $internetProSilverPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('INTERNET PRO SILVER', $this->clientService->getTabLibellePmePmi());
        $internetProGoldPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('INTERNET PRO GOLD', $this->clientService->getTabLibellePmePmi());
        $connectProPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('CONNECT PRO', $this->clientService->getTabLibellePmePmi());
        $bivPlatinumPmePmi = $this->clientService->countClientsByOffreAdslAndSegment('BIV PLATINUM', $this->clientService->getTabLibellePmePmi());

        //Particulier
        $adslAutresParticulier = $this->clientService->countClientsByOffreAdslAndSegment('ADSL autres', $this->clientService->getTabLibelleParticulier());
        $bio10MaxParticulier = $this->clientService->countClientsByOffreAdslAndSegment('BIO 10M MAX', $this->clientService->getTabLibelleParticulier());
        $bio2MaxParticulier = $this->clientService->countClientsByOffreAdslAndSegment('BIO 2M MAX', $this->clientService->getTabLibelleParticulier());
        $bio1MCollaboParticulier = $this->clientService->countClientsByOffreAdslAndSegment('BIO 1M Collabo', $this->clientService->getTabLibelleParticulier());
        $bivSilverParticulier = $this->clientService->countClientsByOffreAdslAndSegment('BIV SILVER', $this->clientService->getTabLibelleParticulier());
        $OSMBio2MParticulier = $this->clientService->countClientsByOffreAdslAndSegment('OSM BIO 2M', $this->clientService->getTabLibelleParticulier());
        $internetProParticulier = $this->clientService->countClientsByOffreAdslAndSegment('Internet Pro', $this->clientService->getTabLibelleParticulier());
        $bioOptionIPParticulier = $this->clientService->countClientsByOffreAdslAndSegment('BIO OPTION IP', $this->clientService->getTabLibelleParticulier());
        $bivGoldParticulier = $this->clientService->countClientsByOffreAdslAndSegment('BIV GOLD', $this->clientService->getTabLibelleParticulier());
        $internetProSilverParticulier = $this->clientService->countClientsByOffreAdslAndSegment('INTERNET PRO SILVER', $this->clientService->getTabLibelleParticulier());
        $internetProGoldParticulier = $this->clientService->countClientsByOffreAdslAndSegment('INTERNET PRO GOLD', $this->clientService->getTabLibelleParticulier());
        $connectProParticulier = $this->clientService->countClientsByOffreAdslAndSegment('CONNECT PRO', $this->clientService->getTabLibelleParticulier());
        $bivPlatinumParticulier = $this->clientService->countClientsByOffreAdslAndSegment('BIV PLATINUM', $this->clientService->getTabLibelleParticulier());
        //dd($adslAutresSoho,$bio10MaxSoho,$bio2MaxSoho,$bio1MCollaboSoho,$bivSilverSoho,$OSMBio2MSoho,$internetProSoho,$bioOptionIPSoho,$bivGoldSoho,$internetProSilverSoho,$internetProGoldSoho,$connectProSoho,$bivPlatinumSoho);

        //Etat
        $adslAutresEtat = $this->clientService->countClientsByOffreAdslAndSegment('ADSL autres', $this->clientService->getTabLibelleEtat());
        $bio10MaxEtat = $this->clientService->countClientsByOffreAdslAndSegment('BIO 10M MAX', $this->clientService->getTabLibelleEtat());
        $bio2MaxEtat = $this->clientService->countClientsByOffreAdslAndSegment('BIO 2M MAX', $this->clientService->getTabLibelleEtat());
        $bio1MCollaboEtat = $this->clientService->countClientsByOffreAdslAndSegment('BIO 1M Collabo', $this->clientService->getTabLibelleEtat());
        $bivSilverEtat = $this->clientService->countClientsByOffreAdslAndSegment('BIV SILVER', $this->clientService->getTabLibelleEtat());
        $OSMBio2MEtat = $this->clientService->countClientsByOffreAdslAndSegment('OSM BIO 2M', $this->clientService->getTabLibelleEtat());
        $internetProEtat = $this->clientService->countClientsByOffreAdslAndSegment('Internet Pro', $this->clientService->getTabLibelleEtat());
        $bioOptionIPEtat = $this->clientService->countClientsByOffreAdslAndSegment('BIO OPTION IP', $this->clientService->getTabLibelleEtat());
        $bivGoldEtat = $this->clientService->countClientsByOffreAdslAndSegment('BIV GOLD', $this->clientService->getTabLibelleEtat());
        $internetProSilverEtat = $this->clientService->countClientsByOffreAdslAndSegment('INTERNET PRO SILVER', $this->clientService->getTabLibelleEtat());
        $internetProGoldEtat = $this->clientService->countClientsByOffreAdslAndSegment('INTERNET PRO GOLD', $this->clientService->getTabLibelleEtat());
        $connectProEtat = $this->clientService->countClientsByOffreAdslAndSegment('CONNECT PRO', $this->clientService->getTabLibelleEtat());
        $bivPlatinumEtat = $this->clientService->countClientsByOffreAdslAndSegment('BIV PLATINUM', $this->clientService->getTabLibelleEtat());
        //dd($adslAutresSoho,$bio10MaxSoho,$bio2MaxSoho,$bio1MCollaboSoho,$bivSilverSoho,$OSMBio2MSoho,$internetProSoho,$bioOptionIPSoho,$bivGoldSoho,$internetProSilverSoho,$internetProGoldSoho,$connectProSoho,$bivPlatinumSoho);

        //Grands Comptes
        $adslAutresGC = $this->clientService->countClientsByOffreAdslAndSegment('ADSL autres', $this->clientService->getTabLibelleGC());
        $bio10MaxGC = $this->clientService->countClientsByOffreAdslAndSegment('BIO 10M MAX', $this->clientService->getTabLibelleGC());
        $bio2MaxGC = $this->clientService->countClientsByOffreAdslAndSegment('BIO 2M MAX', $this->clientService->getTabLibelleGC());
        $bio1MCollaboGC = $this->clientService->countClientsByOffreAdslAndSegment('BIO 1M Collabo', $this->clientService->getTabLibelleGC());
        $bivSilverGC = $this->clientService->countClientsByOffreAdslAndSegment('BIV SILVER', $this->clientService->getTabLibelleGC());
        $OSMBio2MGC = $this->clientService->countClientsByOffreAdslAndSegment('OSM BIO 2M', $this->clientService->getTabLibelleGC());
        $internetProGC = $this->clientService->countClientsByOffreAdslAndSegment('Internet Pro', $this->clientService->getTabLibelleGC());
        $bioOptionIPGC = $this->clientService->countClientsByOffreAdslAndSegment('BIO OPTION IP', $this->clientService->getTabLibelleGC());
        $bivGoldGC = $this->clientService->countClientsByOffreAdslAndSegment('BIV GOLD', $this->clientService->getTabLibelleGC());
        $internetProSilverGC = $this->clientService->countClientsByOffreAdslAndSegment('INTERNET PRO SILVER', $this->clientService->getTabLibelleGC());
        $internetProGoldGC = $this->clientService->countClientsByOffreAdslAndSegment('INTERNET PRO GOLD', $this->clientService->getTabLibelleGC());
        $connectProGC = $this->clientService->countClientsByOffreAdslAndSegment('CONNECT PRO', $this->clientService->getTabLibelleGC());
        $bivPlatinumGC = $this->clientService->countClientsByOffreAdslAndSegment('BIV PLATINUM', $this->clientService->getTabLibelleGC());
        //dd($adslAutresSoho,$bio10MaxSoho,$bio2MaxSoho,$bio1MCollaboSoho,$bivSilverSoho,$OSMBio2MSoho,$internetProSoho,$bioOptionIPSoho,$bivGoldSoho,$internetProSilverSoho,$internetProGoldSoho,$connectProSoho,$bivPlatinumSoho);

        //Global
        $adslAutresGlobal = $this->clientService->countClientsByOffreAdslAndSegment('ADSL autres', $this->clientService->getTabLibelleDVEI());
        $bio10MaxGlobal = $this->clientService->countClientsByOffreAdslAndSegment('BIO 10M MAX', $this->clientService->getTabLibelleDVEI());
        $bio2MaxGlobal = $this->clientService->countClientsByOffreAdslAndSegment('BIO 2M MAX', $this->clientService->getTabLibelleDVEI());
        $bio1MCollaboGlobal = $this->clientService->countClientsByOffreAdslAndSegment('BIO 1M Collabo', $this->clientService->getTabLibelleDVEI());
        $bivSilverGlobal = $this->clientService->countClientsByOffreAdslAndSegment('BIV SILVER', $this->clientService->getTabLibelleDVEI());
        $OSMBio2MGlobal = $this->clientService->countClientsByOffreAdslAndSegment('OSM BIO 2M', $this->clientService->getTabLibelleDVEI());
        $internetProGlobal = $this->clientService->countClientsByOffreAdslAndSegment('Internet Pro', $this->clientService->getTabLibelleDVEI());
        $bioOptionIPGlobal = $this->clientService->countClientsByOffreAdslAndSegment('BIO OPTION IP', $this->clientService->getTabLibelleDVEI());
        $bivGoldGlobal = $this->clientService->countClientsByOffreAdslAndSegment('BIV GOLD', $this->clientService->getTabLibelleDVEI());
        $internetProSilverGlobal = $this->clientService->countClientsByOffreAdslAndSegment('INTERNET PRO SILVER', $this->clientService->getTabLibelleDVEI());
        $internetProGoldGlobal = $this->clientService->countClientsByOffreAdslAndSegment('INTERNET PRO GOLD', $this->clientService->getTabLibelleDVEI());
        $connectProGlobal = $this->clientService->countClientsByOffreAdslAndSegment('CONNECT PRO', $this->clientService->getTabLibelleDVEI());
        $bivPlatinumGlobal = $this->clientService->countClientsByOffreAdslAndSegment('BIV PLATINUM', $this->clientService->getTabLibelleDVEI());

        $offreAdsl= OffreAdsl::with(['adsls'])->orderBy('created_at','desc')->get();
        return response()->json([$offreAdsl,'adslAutresSoho'=> $adslAutresSoho,'bio10MaxSoho'=> $bio10MaxSoho,
            'bio2MaxSoho'=> $bio2MaxSoho,'bio1MCollaboSoho'=> $bio1MCollaboSoho,
            'bivSilverSoho'=> $bivSilverSoho,'OSMBio2MSoho'=> $OSMBio2MSoho,
            'internetProSoho'=> $internetProSoho,'bioOptionIPSoho'=> $bioOptionIPSoho,
            'bivGoldSoho'=> $bivGoldSoho,'internetProSilverSoho'=> $internetProSilverSoho,
            'internetProGoldSoho'=> $internetProGoldSoho,'connectProSoho'=> $connectProSoho,
            'bivPlatinumSoho'=> $bivPlatinumSoho,
            'adslAutresPmePmi'=> $adslAutresPmePmi,'bio10MaxPmePmi'=> $bio10MaxPmePmi,
            'bio2MaxPmePmi'=> $bio2MaxPmePmi,'bio1MCollaboPmePmi'=> $bio1MCollaboPmePmi,
            'bivSilverPmePmi'=> $bivSilverPmePmi,'OSMBio2MPmePmi'=> $OSMBio2MPmePmi,
            'internetProPmePmi'=> $internetProPmePmi,'bioOptionIPPmePmi'=> $bioOptionIPPmePmi,
            'bivGoldPmePmi'=> $bivGoldPmePmi,'internetProSilverPmePmi'=> $internetProSilverPmePmi,
            'internetProGoldPmePmi'=> $internetProGoldPmePmi,'connectProPmePmi'=> $connectProPmePmi,
            'bivPlatinumPmePmi'=> $bivPlatinumPmePmi,
            'adslAutresParticulier'=> $adslAutresParticulier,'bio10MaxParticulier'=> $bio10MaxParticulier,
            'bio2MaxParticulier'=> $bio2MaxParticulier,'bio1MCollaboParticulier'=> $bio1MCollaboParticulier,
            'bivSilverParticulier'=> $bivSilverParticulier,'OSMBio2MParticulier'=> $OSMBio2MParticulier,
            'internetProParticulier'=> $internetProParticulier,'bioOptionIPParticulier'=> $bioOptionIPParticulier,
            'bivGoldParticulier'=> $bivGoldParticulier,'internetProSilverParticulier'=> $internetProSilverParticulier,
            'internetProGoldParticulier'=> $internetProGoldParticulier,'connectProParticulier'=> $connectProParticulier,
            'bivPlatinumParticulier'=> $bivPlatinumParticulier,
            'adslAutresEtat'=> $adslAutresEtat,'bio10MaxEtat'=> $bio10MaxEtat,
            'bio2MaxEtat'=> $bio2MaxEtat,'bio1MCollaboEtat'=> $bio1MCollaboEtat,
            'bivSilverEtat'=> $bivSilverEtat,'OSMBio2MEtat'=> $OSMBio2MEtat,
            'internetProEtat'=> $internetProEtat,'bioOptionIPEtat'=> $bioOptionIPEtat,
            'bivGoldEtat'=> $bivGoldEtat,'internetProSilverEtat'=> $internetProSilverEtat,
            'internetProGoldEtat'=> $internetProGoldEtat,'connectProEtat'=> $connectProEtat,
            'bivPlatinumEtat'=> $bivPlatinumEtat,
            'adslAutresGC'=> $adslAutresGC,'bio10MaxGC'=> $bio10MaxGC,
            'bio2MaxGC'=> $bio2MaxGC,'bio1MCollaboGC'=> $bio1MCollaboGC,
            'bivSilverGC'=> $bivSilverGC,'OSMBio2MGC'=> $OSMBio2MGC,
            'internetProGC'=> $internetProGC,'bioOptionIPGC'=> $bioOptionIPGC,
            'bivGoldGC'=> $bivGoldGC,'internetProSilverGC'=> $internetProSilverGC,
            'internetProGoldGC'=> $internetProGoldGC,'connectProGC'=> $connectProGC,
            'bivPlatinumGC'=> $bivPlatinumGC,
            'adslAutresGlobal'=> $adslAutresGlobal,'bio10MaxGlobal'=> $bio10MaxGlobal,
            'bio2MaxGlobal'=> $bio2MaxGlobal,'bio1MCollaboGlobal'=> $bio1MCollaboGlobal,
            'bivSilverGlobal'=> $bivSilverGlobal,'OSMBio2MGlobal'=> $OSMBio2MGlobal,
            'internetProGlobal'=> $internetProGlobal,'bioOptionIPGlobal'=> $bioOptionIPGlobal,
            'bivGoldGlobal'=> $bivGoldGlobal,'internetProSilverGlobal'=> $internetProSilverGlobal,
            'internetProGoldGlobal'=> $internetProGoldGlobal,'connectProGlobal'=> $connectProGlobal,
            'bivPlatinumGlobal'=> $bivPlatinumGlobal,],
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
