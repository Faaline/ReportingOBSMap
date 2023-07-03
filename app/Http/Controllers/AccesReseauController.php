<?php

namespace App\Http\Controllers;

use App\Models\AccesReseau;
use Illuminate\Http\Request;

class AccesReseauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voixFixe=AccesReseau::with(['voixFixe'])->orderBy('created_at','desc')->paginate(10);
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
        AccesReseau::create(array_merge(
            [
                'type'=>strtoupper($request->all()['type']),
            ]));

        return response()->json([
            'success'=>'Acces reseau ajoutée avec succes',
        ],201);
    }

    public function insertMultiple(){
        $data=[
            [
                'libelle'=>'Fibre Mega Plus'
            ],[
                'libelle'=>'Fibre Off. Intense_Domino4G_15Go Bloque'
            ],[
                'libelle'=>'La Ligne_Grand Public'
            ],[
                'libelle'=>'Fibre_Mega'
            ],[
                'libelle'=>'Fibre Off. Intense_Domino4G_15Go Ouvert'
            ],[
                'libelle'=>'Fibre Office Bloque'
            ],[
                'libelle'=>'Fibre Office Intense_Flybox_20Go_Bloque'
            ],[
                'libelle'=>'OFFRE HOME'
            ],[
                'libelle'=>'Fibre Office Intense Bloque'
            ]
        ];
        AccesReseau::insert($data);
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
