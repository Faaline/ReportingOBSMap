<?php

namespace App\Http\Controllers;

use App\Imports\ReportingImport;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
        ini_set('memomry_limit', '1024M');
        ini_set('post_max_size', '5000M');
        ini_set('upload_max_filesize', '5000M');
        set_time_limit(3000000);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $soho = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
            ->whereIn('segments.libelle',['SOHO','OBO','PPR','SGM','TPE','VPP3','SOH',
                'PROS PRESTIGES','PRO','VPP','VPP2','STARTUP','TAM'])
            ->count();

        $offre = Client::whereHas('offres')->count();

        $pmePMi = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
            ->whereIn('segments.libelle', ['PME/PMI','ORG','PEI','PEI2','ORGANISME'])
            ->count();
        $particulier = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
            ->whereIn('segments.libelle', ['PARTICULIER 1', 'PARTICULIER 2','PA1', 'PA2','PA3','VIP'])
            ->count();
        $etat = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
            ->whereIn('segments.libelle', ['ETAT','ADMINISTRATION','COP','ETA','FONCTIONNAIRE','COLLECTIVITES PUBLIQUES','EGO'])
            ->count();
        $grandsCompte = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
            ->where('segments.libelle', ['GRANDS COMPTES'])
            ->count();
        $sonatel = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
            ->whereIn('segments.libelle', ['RSN','XSB','XSM','XSN','XSR','EXPLOITATION SONATEL','EMPLOYE GROUPE SONATEL',
                'RETRAITE GROUPE SONATEL','ESN','XSE','EOR','EXPLOITATION SONATEL MOBILES'])
            ->count();
        $autre = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
            ->whereIn('segments.libelle', ['OPE','OPERATEURS'])
            ->count();
        $fibre= Client::whereHas('fibres')->count();
        $adsl= Client::whereHas('adsls')->count();
        $dvps = $soho + $particulier + $pmePMi;
        $dvei = $grandsCompte  + $etat;

        //offreFibres
        $fibreOfficeIntenseGlobal = $this->countClientsByOffreAndSegmentGlobal('offres','FIBRE OFFICE INTENSE');
        $fibreCollaboGlobal = $this->countClientsByOffreAndSegmentGlobal('offres','FIBRE COLLABO');
        $fibreFTTOGlobal = $this->countClientsByOffreAndSegmentGlobal('offres','FIBRE FTTO');
        $fibreOfficeIntenseOuvertGlobal = $this->countClientsByOffreAndSegmentGlobal('offres','FIBRE OFFICE INTENSE OUVERT');
        $fibreOfficeGlobal = $this->countClientsByOffreAndSegmentGlobal('offres','FIBRE OFFICE');
        $fibreProGlobal = $this->countClientsByOffreAndSegmentGlobal('offres','FIBRE PRO');
        $fibreProMaxGlobal = $this->countClientsByOffreAndSegmentGlobal('offres','FIBRE PRO MAX');
        $fibreProXaragneGlobal = $this->countClientsByOffreAndSegmentGlobal('offres','FIBRE PRO XARAGNE');
        $internetProPlusGlobal = $this->countClientsByOffreAndSegmentGlobal('offres','INTERNET PRO PLUS');
        $keurguiPlusGlobal = $this->countClientsByOffreAndSegmentGlobal('offres','KEURGUI PLUS');
        $fibreBiGlobal = $this->countClientsByOffreAndSegmentGlobal('offres','FIBRE BI');
        $fibreMegaGlobal = $this->countClientsByOffreAndSegmentGlobal('offres','FIBRE MEGA');

        //offreAdsl
        $adslAutresGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','ADSL autres');
        $bio10MaxGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','BIO 10M MAX');
        $bio2MaxGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','BIO 2M MAX');
        $bio1MCollaboGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','BIO 1M Collabo');
        $bivSilverGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','BIV SILVER');
        $OSMBio2MGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','OSM BIO 2M');
        $internetProGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','Internet Pro');
        $bioOptionIPGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','BIO OPTION IP');
        $bivGoldGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','BIV GOLD');
        $internetProSilverGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','INTERNET PRO SILVER');
        $internetProGoldGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','INTERNET PRO GOLD');
        $connectProGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','CONNECT PRO');
        $bivPlatinumGlobal = $this->countClientsByOffreAndSegmentGlobal('offreAdsl','BIV PLATINUM');

        //offreVoixFixes
        $forfaitVoipGlobal = $this->countClientsByOffreAndSegmentVoixFixeGlobal('voixFixes','Forfait Voip');
        $VoipGlobal = $this->countClientsByOffreAndSegmentVoixFixeGlobal('voixFixes','Voip');
        $forfaitVoixGlobal = $this->countClientsByOffreAndSegmentVoixFixeGlobal('voixFixes','Forfait Voix');
        $packMultiplayGlobal = $this->countClientsByOffreAndSegmentVoixFixeGlobal('voixFixes','Pack multiplay');
        $voixOnlyGlobal = $this->countClientsByOffreAndSegmentVoixFixeGlobal('voixFixes','Voix only');
        //dd($fibreOfficeIntenseGlobal);

        // SOHO
        $fibreOfficeIntenseSoho = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE INTENSE', $this->clientService->getTabLibelleSohos());

        $fibreCollaboSoho = $this->clientService->countClientsByOffreAndSegment('FIBRE COLLABO', $this->clientService->getTabLibelleSohos());

        $fibreFTTOSoho = $this->clientService->countClientsByOffreAndSegment('FIBRE FTTO', $this->clientService->getTabLibelleSohos());

        $fibreOfficeIntenseOuvertSoho = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE INTENSE OUVERT', $this->clientService->getTabLibelleSohos());

        $fibreOfficeSoho = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE', $this->clientService->getTabLibelleSohos());

        $fibreProSoho = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO', $this->clientService->getTabLibelleSohos());

        $fibreProMaxSoho = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO MAX', $this->clientService->getTabLibelleSohos());

        $fibreProXaragneSoho = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO XARAGNE', $this->clientService->getTabLibelleSohos());

        $internetProPlusSoho = $this->clientService->countClientsByOffreAndSegment('INTERNET PRO PLUS', $this->clientService->getTabLibelleSohos());

        $keurguiPlusSoho = $this->clientService->countClientsByOffreAndSegment('KEURGUI PLUS', $this->clientService->getTabLibelleSohos());

        $fibreBiSoho = $this->clientService->countClientsByOffreAndSegment('FIBRE BI', $this->clientService->getTabLibelleSohos());

        $fibreMegaSoho = $this->clientService->countClientsByOffreAndSegment('FIBRE MEGA', $this->clientService->getTabLibelleSohos());

        // PME/PMI
        $fibreOfficeIntensePmePmi = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE INTENSE', $this->clientService->getTabLibellePmePmi());

        $fibreCollaboPmePmi = $this->clientService->countClientsByOffreAndSegment('FIBRE COLLABO', $this->clientService->getTabLibellePmePmi());

        $fibreFTTOPmePmi = $this->clientService->countClientsByOffreAndSegment('FIBRE FTTO', $this->clientService->getTabLibellePmePmi());

        $fibreOfficeIntenseOuvertPmePmi = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE INTENSE OUVERT', $this->clientService->getTabLibellePmePmi());

        $fibreOfficePmePmi = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE', $this->clientService->getTabLibellePmePmi());

        $fibreProPmePmi = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO', $this->clientService->getTabLibellePmePmi());

        $fibreProMaxPmePmi = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO MAX', $this->clientService->getTabLibellePmePmi());

        $fibreProXaragnePmePmi = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO XARAGNE', $this->clientService->getTabLibellePmePmi());

        $internetProPlusPmePmi = $this->clientService->countClientsByOffreAndSegment('INTERNET PRO PLUS', $this->clientService->getTabLibellePmePmi());

        $keurguiPlusPmePmi = $this->clientService->countClientsByOffreAndSegment('KEURGUI PLUS', $this->clientService->getTabLibellePmePmi());

        $fibreBiPmePmi = $this->clientService->countClientsByOffreAndSegment('FIBRE BI', $this->clientService->getTabLibellePmePmi());

        $fibreMegaPmePmi = $this->clientService->countClientsByOffreAndSegment('FIBRE MEGA', $this->clientService->getTabLibellePmePmi());


        // Particulier
        $fibreOfficeIntenseParticulier = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE INTENSE', $this->clientService->getTabLibelleParticulier());

        $fibreCollaboParticulier = $this->clientService->countClientsByOffreAndSegment('FIBRE COLLABO', $this->clientService->getTabLibelleParticulier());

        $fibreFTTOParticulier = $this->clientService->countClientsByOffreAndSegment('FIBRE FTTO', $this->clientService->getTabLibelleParticulier());

        $fibreOfficeIntenseOuvertParticulier = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE INTENSE OUVERT', $this->clientService->getTabLibelleParticulier());

        $fibreOfficeParticulier = $this->clientService->countClientsByOffreAndSegment('FIBRE OFFICE', $this->clientService->getTabLibelleParticulier());

        $fibreProParticulier = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO', $this->clientService->getTabLibelleParticulier());

        $fibreProMaxParticulier = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO MAX', $this->clientService->getTabLibelleParticulier());

        $fibreProXaragneParticulier = $this->clientService->countClientsByOffreAndSegment('FIBRE PRO XARAGNE', $this->clientService->getTabLibelleParticulier());

        $internetProPlusParticulier = $this->clientService->countClientsByOffreAndSegment('INTERNET PRO PLUS', $this->clientService->getTabLibelleParticulier());

        $keurguiPlusParticulier = $this->clientService->countClientsByOffreAndSegment('KEURGUI PLUS', $this->clientService->getTabLibelleParticulier());

        $fibreBiParticulier = $this->clientService->countClientsByOffreAndSegment('FIBRE BI', $this->clientService->getTabLibelleParticulier());

        $fibreMegaParticulier = $this->clientService->countClientsByOffreAndSegment('FIBRE MEGA', $this->clientService->getTabLibelleParticulier());


        $clients=Client::with(['categorie','segment','statut','offres','reparts','agences','communes','adsls','fibres','offreAdsl'])->orderBy('created_at','desc')->paginate(10);
        return response()->json([$clients,'soho'=> $soho,'pme_pmi'=> $pmePMi,
            'particulier'=> $particulier,'etat'=> $etat,'grandsCompte'=> $grandsCompte,
            'fibre'=> $fibre,'adsl'=> $adsl,'dvps'=> $dvps,
            'seriesDvps'=>[$soho,$pmePMi,$particulier],'dvei'=> $dvei,
            'sonatel'=> $sonatel,'autre'=> $autre,'total'=> $dvps + $dvei + $sonatel + $autre,
            'fibreOfficeIntenseOuvertSoho'=> $fibreOfficeIntenseOuvertSoho,'fibreCollaboSoho'=> $fibreCollaboSoho, 'fibreFTTOSoho'=>$fibreFTTOSoho,
            'fibreOfficeSoho'=> $fibreOfficeSoho,'fibreOfficeIntenseSoho'=> $fibreOfficeIntenseSoho,'fibreProSoho'=> $fibreProSoho,
            'fibreProMaxSoho'=> $fibreProMaxSoho,'fibreProXaragneSoho'=> $fibreProXaragneSoho,'internetProPlusSoho'=> $internetProPlusSoho,
            'keurguiPlusSoho'=> $keurguiPlusSoho,'fibreBiSoho'=> $fibreBiSoho,'fibreMegaSoho'=> $fibreMegaSoho,
            'fibreOfficeIntenseOuvertPmePmi'=> $fibreOfficeIntenseOuvertPmePmi,'fibreCollaboPmePmi'=> $fibreCollaboPmePmi, 'fibreFTTOPmePmi'=>$fibreFTTOPmePmi,
            'fibreOfficePmePmi'=> $fibreOfficePmePmi,'fibreOfficeIntensePmePmi'=> $fibreOfficeIntensePmePmi,'fibreProPmePmi'=> $fibreProPmePmi,
            'fibreProMaxPmePmi'=> $fibreProMaxPmePmi,'fibreProXaragnePmePmi'=> $fibreProXaragnePmePmi,'internetProPlusPmePmi'=> $internetProPlusPmePmi,
            'keurguiPlusPmePmi'=> $keurguiPlusPmePmi,'fibreBiPmePmi'=> $fibreBiPmePmi,'fibreMegaPmePmi'=> $fibreMegaPmePmi,
            'fibreOfficeIntenseOuvertParticulier'=> $fibreOfficeIntenseOuvertParticulier,'fibreCollaboParticulier'=> $fibreCollaboParticulier, 'fibreFTTOParticulier'=>$fibreFTTOParticulier,
            'fibreOfficeParticulier'=> $fibreOfficeParticulier,'fibreOfficeIntenseParticulier'=> $fibreOfficeIntenseParticulier,'fibreProParticulier'=> $fibreProParticulier,
            'fibreProMaxParticulier'=> $fibreProMaxParticulier,'fibreProXaragneParticulier'=> $fibreProXaragneParticulier,'internetProPlusParticulier'=> $internetProPlusParticulier,
            'keurguiPlusParticulier'=> $keurguiPlusParticulier,'fibreBiParticulier'=> $fibreBiParticulier,'fibreMegaParticulier'=> $fibreMegaParticulier,
            'fibreOfficeIntenseOuvertGlobal'=> $fibreOfficeIntenseOuvertGlobal,'fibreCollaboGlobal'=> $fibreCollaboGlobal, 'fibreFTTOGlobal'=>$fibreFTTOGlobal,
            'fibreOfficeGlobal'=> $fibreOfficeGlobal,'fibreOfficeIntenseGlobal'=> $fibreOfficeIntenseGlobal,'fibreProGlobal'=> $fibreProGlobal,
            'fibreProMaxPGlobal'=> $fibreProMaxGlobal,'fibreProXaragneGlobal'=> $fibreProXaragneGlobal,'internetProPlusGlobal'=> $internetProPlusGlobal,
            'keurguiPlusGlobal'=> $keurguiPlusGlobal,'fibreBiGlobal'=> $fibreBiGlobal,'fibreMegaGlobal'=> $fibreMegaGlobal,
            'adslAutresGlobal'=> $adslAutresGlobal,'bio10MaxGlobal'=> $bio10MaxGlobal,
            'bio2MaxGlobal'=> $bio2MaxGlobal,'bio1MCollaboGlobal'=> $bio1MCollaboGlobal,
            'bivSilverGlobal'=> $bivSilverGlobal,'OSMBio2MGlobal'=> $OSMBio2MGlobal,
            'internetProGlobal'=> $internetProGlobal,'bioOptionIPGlobal'=> $bioOptionIPGlobal,
            'bivGoldGlobal'=> $bivGoldGlobal,'internetProSilverGlobal'=> $internetProSilverGlobal,
            'internetProGoldGlobal'=> $internetProGoldGlobal,'connectProGlobal'=> $connectProGlobal,
            'bivPlatinumGlobal'=> $bivPlatinumGlobal,
            'forfaitVoipGlobal'=> $forfaitVoipGlobal,'VoipGlobal'=> $VoipGlobal, 'forfaitVoixGlobal'=> $forfaitVoixGlobal,
            'packMultiplayGlobal'=> $packMultiplayGlobal,'voixOnlyGlobal'=> $voixOnlyGlobal],
            200);
    }
    /**
     * Count number of fibre with ower segment
     */

    public function countClientsByOffreAndSegmentGlobal($offres, $offreType)
    {
        return Client::whereHas($offres, function ($query) use ($offreType) {
            $query->where('type', $offreType);
        })->count();
    }
    public function countClientsByOffreAndSegmentVoixFixeGlobal($offres, $offreType)
    {
        return Client::whereHas($offres, function ($query) use ($offreType) {
            $query->where('libelle', $offreType);
        })->count();
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
        $client = Client::with(['categorie','segment','statut','offres','reparts','agences','communes','adsls','fibres'])->find($id);
        if ($client){
            return response()->json($client,200);
        }
        return response()->json(['message'=>'client non trouve'],404);
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

    public function reportingImport(Request $request){
        $reportingImport = new ReportingImport();
        Excel::import($reportingImport, $request->file('fileupload'));
        $nombre_de_ligne = $reportingImport ? $reportingImport->getRowCount() : 0;
        //dd($nombre_de_ligne);
        return response()->json([
            'nombre_de_ligne'=> $nombre_de_ligne,
            'message'=> 'Fichier importe avec succes'
        ],
            200);
    }

    public function searchClient(Request $request)
    {
        $ndos = $request->input('ndos');
        $statut = $request->input('statut_id');
        $segment = $request->input('segment_id');
        $categorie = $request->input('categorie_id');
        $ncli = $request->input('ncli');

        $clients = Client::with(['categorie','segment','statut'])
            ->when($ndos, function ($query, $ndos) {
                return $query->where('ndos', $ndos);
            })
            ->when($statut, function ($query, $statut) {
                return $query->where('statut_id', $statut);
            })
            ->when($segment, function ($query, $segment) {
                return $query->where('segment_id', $segment);
            })
            ->when($categorie, function ($query, $categorie) {
                return $query->where('categorie_id', $categorie);
            })
            ->when($ncli, function ($query, $ncli) {
                return $query->where('ncli', $ncli);
            });
            $perPage = 10;
            $page = $request->input('page', 1);
            $total = $clients->count();
            $result = $clients->offset(($page - 1) * $perPage)->limit($perPage)
            ->get();

        return response()->json([$clients,
            'message' => 'Résultat de la recheche ...',
            'data' => $result,
            'total' => $total,
            'page' => $page,
            'last_page' => ceil($total / $perPage)
        ]);
        // Faites ce que vous voulez avec les résultats de la requête filtrée (par exemple, les retourner à la vue)
        //return view('clients.index', ['clients' => $clients]);
    }


}
