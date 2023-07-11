<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\OffreFibre;
use Illuminate\Http\Request;

class OffreFibreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offreFibre= OffreFibre::orderBy('created_at','desc')->paginate(10);
        return response()->json($offreFibre,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        OffreFibre::create(array_merge([
            'offre_id'=>$request->all()['offre_id'],
            'fibre_id'=>$request->all()['fibre_id'],
        ]));
        return response()->json([
            'succes'=>'cree avec succes'
        ],201);
    }

    public function storeMultiple()
    {
        $offreId = 6; // ID de l'offre que vous souhaitez associer
        $fibresIds = [8, 15]; // Tableau d'IDs de fibres à associer

        $offreFibres = [];
        $dateTime=new \DateTime();

        foreach ($fibresIds as $fibreId) {
            $offreFibres[] = [
                'offre_id' => $offreId,
                'fibre_id' => $fibreId,
                'created_at'=>$dateTime,
                'updated_at'=>$dateTime
            ];
        }
        //dd($offreFibres);
        OffreFibre::insert($offreFibres);

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
