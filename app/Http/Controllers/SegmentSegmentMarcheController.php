<?php

namespace App\Http\Controllers;

use App\Models\SegmentSegmentMarche;
use Illuminate\Http\Request;

class SegmentSegmentMarcheController extends Controller
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
        $segment = 1; // ID de l'offre que vous souhaitez associer
        $offreIds = [6, 15]; // Tableau d'IDs de fibres à associer

        $segmentOffre = [];
        $dateTime=new \DateTime();

        foreach ($offreIds as $offreId) {
            $segmentOffre[] = [
                'segment_id' => $segment,
                'offre_id' => $offreId,
                'created_at'=>$dateTime,
                'updated_at'=>$dateTime
            ];
        }
        //dd($segmentOffre);
        SegmentSegmentMarche::insert($segmentOffre);

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
