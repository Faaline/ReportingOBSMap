<?php

namespace App\Http\Controllers;

use App\Imports\ReportingImport;
use App\Models\Client;
use App\Models\VoixFixe;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
        ini_set('memomry_limit', '1024M');
        set_time_limit(3000000);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $cacheKey = 'clients_data';
        $cacheDuration = 60; // Durée de mise en cache en minutes

        $clients = Cache::remember($cacheKey, $cacheDuration, function (){

            $soho = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
                ->whereIn('segments.libelle',['SOHO','OBO','PPR','SGM','TPE','VPP3','SOH',
                    'PROS PRESTIGES','PRO','VPP','VPP2','STARTUP','TAM'])->count();
            $pmePMi = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
                ->whereIn('segments.libelle', ['PME/PMI','ORG','PEI','PEI2','ORGANISME'])->count();
            $particulier = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
                ->whereIn('segments.libelle', ['PARTICULIER 1', 'PARTICULIER 2','PA1', 'PA2','PA3','VIP'])->count();
            $etat = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
                ->whereIn('segments.libelle', ['ETAT','ADMINISTRATION','COP','ETA','FONCTIONNAIRE','COLLECTIVITES PUBLIQUES','EGO'])->count();
            $grandsCompte = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
                ->where('segments.libelle', ['GRANDS COMPTES'])->count();
            $sonatel = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
                ->whereIn('segments.libelle', ['RSN','XSB','XSM','XSN','XSR','EXPLOITATION SONATEL','EMPLOYE GROUPE SONATEL',
                    'RETRAITE GROUPE SONATEL','ESN','XSE','EOR','EXPLOITATION SONATEL MOBILES'])->count();
            $autre = Client::join('segments', 'clients.segment_id', '=', 'segments.id')
                ->whereIn('segments.libelle', ['OPE','OPERATEURS'])->count();
            $fibre= Client::whereHas('fibres')->count();
            $adsl= Client::whereHas('adsls')->count();
            $dvps = $soho + $particulier + $pmePMi;
            $dvei = $grandsCompte  + $etat;
            return [Client::with(['categorie','segment','statut','offres','reparts','agences','communes','adsls','fibres','offreAdsl'])->orderBy('created_at','desc')->paginate(10),
                'soho'=> $soho,'pme_pmi'=> $pmePMi,
                'particulier'=> $particulier,'etat'=> $etat,'grandsCompte'=> $grandsCompte,
                'fibre'=> $fibre,'adsl'=> $adsl,'dvps'=> $dvps,
                'seriesDvps'=>[$soho,$pmePMi,$particulier],'dvei'=> $dvei,'seriesDvei'=>[$etat,$grandsCompte],
                'sonatel'=> $sonatel,'autre'=> $autre,'total'=> $dvps + $dvei + $sonatel + $autre,
            ];
        });

        return response()->json($clients,200);
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
