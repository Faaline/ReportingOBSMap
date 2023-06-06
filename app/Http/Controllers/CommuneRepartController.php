<?php

namespace App\Http\Controllers;

use App\Models\CommuneRepart;
use Illuminate\Http\Request;

class CommuneRepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients=CommuneRepart::orderBy('created_at','desc')->paginate(10);
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

    public function storeMultiple()
    {
        $offreId = 94; // ID de l'offre que vous souhaitez associer
        //$fibresIds = [23,9,54,55,58,59,33,11,12,60,48,34,37,13,22,17]; // Tableau d'IDs de fibres à associer
        $fibresIds = [9,55,59,48,56]; // Ta55bleau d'IDs de fibres à associer
        //$fibresIds = [50,76,51,52,2,55,34,75,77,78,59,11,42,38,60,48,29,36]; // Tableau d'IDs de fibres à associer

        $offreFibres = [];
        $dateTime=new \DateTime();

        foreach ($fibresIds as $fibreId) {
            $offreFibres[] = [
                'commune_id' => $offreId,
                'repart_id' => $fibreId,
                'created_at'=>$dateTime,
                'updated_at'=>$dateTime
            ];
        }
        //dd($offreFibres);
        CommuneRepart::insert($offreFibres);

        // Autres étapes ou réponse de succès
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
