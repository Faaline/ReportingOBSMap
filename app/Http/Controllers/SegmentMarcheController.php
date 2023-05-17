<?php

namespace App\Http\Controllers;

use App\Models\SegmentMarche;
use Illuminate\Http\Request;

class SegmentMarcheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function insertMultiple()
    {
        $data = [
            [
                'libelle' => 'SONATEL',
            ],
            [
                'libelle' => 'SOHO',
            ],
            [
                'libelle' => 'PARTICULIER',
            ],
            [
                'libelle' => 'PME-PMI',
            ],
            [
                'libelle' => 'ETAT',
            ],
            [
                'libelle' => 'DVEI',
            ],
            [
                'libelle' => 'AUTRE',
            ],

            // Ajoutez les autres lignes à insérer ici
        ];

       SegmentMarche::insert($data);

        // Autres étapes ou réponse de succès
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
