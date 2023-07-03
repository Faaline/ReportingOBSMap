<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Services\ClientService;
use Illuminate\Http\Request;

class OffreController extends Controller
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

        // Etat
        $fibreOfficeIntenseEtat = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE INTENSE', $this->clientService->getTabLibelleEtat());
        $fibreCollaboEtat = $this->clientService->countClientsByOffreAndSegment('FIBRE COLLABO', $this->clientService->getTabLibelleEtat());
        $fibreFTTOEtat = $this->clientService->countClientsByOffreAndSegment('FIBRE FTTO', $this->clientService->getTabLibelleEtat());
        $fibreOfficeIntenseOuvertEtat = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE INTENSE OUVERT', $this->clientService->getTabLibelleEtat());
        $fibreOfficeEtat = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE', $this->clientService->getTabLibelleEtat());
        $fibreProEtat = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO', $this->clientService->getTabLibelleEtat());
        $fibreProMaxEtat = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO MAX', $this->clientService->getTabLibelleEtat());
        $fibreProXaragneEtat = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO XARAGNE', $this->clientService->getTabLibelleEtat());
        $internetProPlusEtat = $this->clientService->countClientsByOffreAndSegment('INTERNET PRO PLUS', $this->clientService->getTabLibelleEtat());
        $keurguiPlusEtat = $this->clientService->countClientsByOffreAndSegment('KEURGUI PLUS', $this->clientService->getTabLibelleEtat());
        $fibreBiEtat = $this->clientService->countClientsByOffreAndSegment('FIBRE BI', $this->clientService->getTabLibelleEtat());
        $fibreMegaEtat = $this->clientService->countClientsByOffreAndSegment('FIBRE MEGA', $this->clientService->getTabLibelleEtat());

        // Grands comptes
        $fibreOfficeIntenseGC = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE INTENSE', $this->clientService->getTabLibelleGC());
        $fibreCollaboGC = $this->clientService->countClientsByOffreAndSegment('FIBRE COLLABO', $this->clientService->getTabLibelleGC());
        $fibreFTTOGC = $this->clientService->countClientsByOffreAndSegment('FIBRE FTTO', $this->clientService->getTabLibelleGC());
        $fibreOfficeIntenseOuvertGC = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE INTENSE OUVERT', $this->clientService->getTabLibelleGC());
        $fibreOfficeGC = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE', $this->clientService->getTabLibelleGC());
        $fibreProGC = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO', $this->clientService->getTabLibelleGC());
        $fibreProMaxGC = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO MAX', $this->clientService->getTabLibelleGC());
        $fibreProXaragneGC = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO XARAGNE', $this->clientService->getTabLibelleGC());
        $internetProPlusGC = $this->clientService->countClientsByOffreAndSegment('INTERNET PRO PLUS', $this->clientService->getTabLibelleGC());
        $keurguiPlusGC = $this->clientService->countClientsByOffreAndSegment('KEURGUI PLUS', $this->clientService->getTabLibelleGC());
        $fibreBiGC = $this->clientService->countClientsByOffreAndSegment('FIBRE BI', $this->clientService->getTabLibelleGC());
        $fibreMegaGC = $this->clientService->countClientsByOffreAndSegment('FIBRE MEGA', $this->clientService->getTabLibelleGC());

        //Global
        $fibreOfficeIntenseGlobal = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE INTENSE', $this->clientService->getTabLibelleDVEI());
        $fibreCollaboGlobal = $this->clientService->countClientsByOffreAndSegment('FIBRE COLLABO', $this->clientService->getTabLibelleDVEI());
        $fibreFTTOGlobal = $this->clientService->countClientsByOffreAndSegment('FIBRE FTTO', $this->clientService->getTabLibelleDVEI());
        $fibreOfficeIntenseOuvertGlobal = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE INTENSE OUVERT', $this->clientService->getTabLibelleDVEI());
        $fibreOfficeGlobal = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE', $this->clientService->getTabLibelleDVEI());
        $fibreProGlobal = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO', $this->clientService->getTabLibelleDVEI());
        $fibreProMaxGlobal = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO MAX', $this->clientService->getTabLibelleDVEI());
        $fibreProXaragneGlobal = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO XARAGNE', $this->clientService->getTabLibelleDVEI());
        $internetProPlusGlobal = $this->clientService->countClientsByOffreAndSegment('INTERNET PRO PLUS', $this->clientService->getTabLibelleDVEI());
        $keurguiPlusGlobal = $this->clientService->countClientsByOffreAndSegment('KEURGUI PLUS', $this->clientService->getTabLibelleDVEI());
        $fibreBiGlobal = $this->clientService->countClientsByOffreAndSegment('FIBRE BI', $this->clientService->getTabLibelleDVEI());
        $fibreMegaGlobal = $this->clientService->countClientsByOffreAndSegment('FIBRE MEGA', $this->clientService->getTabLibelleDVEI());

        $offre= Offre::with('fibres','segments')->orderBy('created_at','desc')->get();
        return response()->json([$offre,
            'fibreOfficeIntenseEtat' => $fibreOfficeIntenseEtat,'fibreCollaboEtat' => $fibreCollaboEtat,
            'fibreFTTOEtat' => $fibreFTTOEtat,'fibreOfficeIntenseOuvertEtat' => $fibreOfficeIntenseOuvertEtat,
            'fibreOfficeEtat' => $fibreOfficeEtat,'fibreProEtat' => $fibreProEtat,
            'fibreProMaxEtat' => $fibreProMaxEtat,'fibreProXaragneEtat' => $fibreProXaragneEtat,
            'internetProPlusEtat' => $internetProPlusEtat,'fibreBiEtat' => $fibreBiEtat,
            'fibreMegaEtat' => $fibreMegaEtat,'keurguiPlusEtat' => $keurguiPlusEtat,
            'fibreOfficeIntenseGC' => $fibreOfficeIntenseGC,'fibreCollaboGC' => $fibreCollaboGC,
            'fibreFTTOGC' => $fibreFTTOGC,'fibreOfficeIntenseOuvertGC' => $fibreOfficeIntenseOuvertGC,
            'fibreOfficeGC' => $fibreOfficeGC,'fibreProGC' => $fibreProGC,
            'fibreProMaxGC' => $fibreProMaxGC,'fibreProXaragneGC' => $fibreProXaragneGC,
            'internetProPlusGC' => $internetProPlusGC,'fibreBiGC' => $fibreBiGC,
            'fibreMegaGC' => $fibreMegaGC,'keurguiPlusGC' => $keurguiPlusGC,
            'fibreOfficeIntenseOuvertGlobal'=> $fibreOfficeIntenseOuvertGlobal,'fibreCollaboGlobal'=> $fibreCollaboGlobal, 'fibreFTTOGlobal'=>$fibreFTTOGlobal,
            'fibreOfficeGlobal'=> $fibreOfficeGlobal,'fibreOfficeIntenseGlobal'=> $fibreOfficeIntenseGlobal,'fibreProGlobal'=> $fibreProGlobal,
            'fibreProMaxPGlobal'=> $fibreProMaxGlobal,'fibreProXaragneGlobal'=> $fibreProXaragneGlobal,'internetProPlusGlobal'=> $internetProPlusGlobal,
            'keurguiPlusGlobal'=> $keurguiPlusGlobal,'fibreBiGlobal'=> $fibreBiGlobal,'fibreMegaGlobal'=> $fibreMegaGlobal,],200);
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
