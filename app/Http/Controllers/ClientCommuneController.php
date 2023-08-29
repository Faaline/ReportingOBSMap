<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientCommune;
use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClientCommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cacheKey = 'clients_data';
        $cacheDuration = 60; // Durée de mise en cache en minutes

        $clientsCommune = Cache::remember($cacheKey, $cacheDuration, function () {

            //Clents by communes
            $dakar = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', [
                    'BOPP', 'CAMBERENE-PARCELLES ASSAINIES', 'CENTENAIRE - GIBRALTAR', 'CASTORS - DERKLE',
                    'COLOBANE','DIAMNIADIO', 'FANN', 'FANN HOCK', 'FASS', 'FASS MBAO', 'FOIRE', 'G1-DAKAR',
                    'GRAND DAKAR - USINE','GUEDIAWAYE', 'GRAND YOFF','GUELE TAPEE','H.L.M. - CITE PORT - SODIDA',
                    'HANN', 'ILE DE GOREE','KEUR MASSAR','KEUR MBAYE FALL','MBAO','MEDINA',
                    'NGOR - ALMADIES', 'NORD LIBERTE 6', 'OUAGOU NIAYES', 'OUAKAM','PATTE D OIE BUILDERS - SOPRIM',
                    'POINT E','POSTE DAKAR - RP','PIKINE','RUFISQUE','SICAP','SICAP MBAO', 'THIAROYE','THIAROYE SUR MER',
                    'YEUMBEUL','YOFF','ZONE A - ZONE B','ZONE FRANCHE INDUSTRIELLE', 'ZONE INDUSTRIELLE','ZONE PORTUAIRE'])
                ->count();
            $diourbel = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['DIOURBEL', 'DIOURBEL_NDOULO'])
                ->count();

            $kaolack = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['KAOLACK'])
                ->count();


            $fatick = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['FATICK'])
                ->count();
            $kaffrine = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['KAFFRINE'])
                ->count();
            $kolda = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['KOLDA', 'KOLDA_DIOULACOLON', 'KOLDA_MEDINA YORO FOULAH',
                 ])
                ->count();
            $saintLouis = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['SAINT LOUIS','DAGANA'])
                ->count();
/*
            $bakel = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['BAKEL_COMMUNE', 'BAKEL_KIDIRA', 'BAKEL_DIAWARA', 'BAKEL_MOUDERY', 'BAKEL_GOUDIRY'])
                ->count();
            $bambey = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['Bambey'])
                ->count();
            $bambibor_gorom_bayakh = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['BAMBYLORE-GOROM-BAYAKH'])
                ->count();
            $bargny = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['BARGNY'])
                ->count();
            $bignona = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['BIGNONA_COMMUNE', 'BIGNONA_SINDIAN', 'BIGNONA_DIOULOULOU', 'BIGNONA_TENDOUCK'])
                ->count();
            $birkilane = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['BIRKELANE'])
                ->count();
            $bopp = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['BOPP'])
                ->count();
            $camberene = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['CAMBERENE-PARCELLES ASSAINIES'])
                ->count();
            $parcellesAssainies = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['CAMBERENE-PARCELLES ASSAINIES'])
                ->count();
            $castor_derkle = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['CASTORS - DERKLE'])
                ->count();
            $centenaire_gibraltard = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['CENTENAIRE - GIBRALTAR'])
                ->count();
            $tivaouaneMbapal = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['TIVAOUANE_PAMBAL'])
                ->count();
            $grandYoff = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['GRAND YOFF'])
                ->count();
            $kounguel = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['KOUNGHEUL'])
                ->count();
            $sicap = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['SICAP'])
                ->count();
            $sicapMbao = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['SICAP MBAO'])
                ->count();

            $sibassor = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['SIBASSOR'])
                ->count();
            $posteDakarRp = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['POSTE DAKAR-RP'])
                ->count();
            $kayar = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['KAYAR'])
                ->count();
            $tivaouane = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['TIVAOUANE'])
                ->count();
            $guediawaye = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['GUEDIAWAYE'])
                ->count();*/


            return [Commune::with(['clients'])->orderBy('created_at', 'desc')->paginate(10),
                'diourbel' => $diourbel, 'kaolack' => $kaolack, 'dakar' => $dakar, 'fatick' => $fatick,
                'kaffrine' => $kaffrine,'kolda' => $kolda, 'saint-louis' => $saintLouis
            ];
        });

        return response()->json($clientsCommune, 200);

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
