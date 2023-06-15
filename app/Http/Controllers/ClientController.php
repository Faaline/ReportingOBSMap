<?php

namespace App\Http\Controllers;

use App\Imports\ReportingImport;
use App\Models\Client;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    public function __construct()
    {
        set_time_limit(300000);
        ini_set('post_max_size', '5000M');
        ini_set('upload_max_filesize', '5000M');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $clients=Client::with(['categorie','segment','statut','offres','reparts','agences','communes','adsls'])->orderBy('created_at','desc')->paginate(10);
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

    public function reportingImport(Request $request){
        $reportingImport = new ReportingImport();
        Excel::import($reportingImport, $request->file('fileupload'));
        $nombre_de_ligne = $reportingImport ? $reportingImport->getRowCount() : 0;
        //dd($nombre_de_ligne);
        return response()->json(['message'=> 'Fichier importe avec succes'], 200);
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
