<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use Illuminate\Http\Request;

class SegmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $segment= Segment::orderBy('created_at','desc')->paginate(10);
        return response()->json($segment,200);
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
        Segment::create(array_merge(
            [
                'libelle'=>strtoupper($request->all()['libelle']),
            ]));

        return response()->json([
            'success'=>'Segment ajoutée avec succes',
        ],201);
    }

    public function insertMultiple()
    {
        $data = [
            [
                'libelle' => 'RSN','segmentmarche_id' => 1,
            ],
            [
                'libelle' => 'XSB','segmentmarche_id' => 1,
            ],
            [
                'libelle' => 'XSM','segmentmarche_id' => 1,
            ],
            [
                'libelle' => 'XSN','segmentmarche_id' => 1,
            ],
            [
                'libelle' => 'XSR','segmentmarche_id' => 1,
            ],
            [
                'libelle' => 'ESN','segmentmarche_id' => 1,
            ],
            [
                'libelle' => 'XSE','segmentmarche_id' => 1,
            ],
            [
                'libelle' => 'EOR','segmentmarche_id' => 1,
            ], [
                'libelle' => 'EXPOITATION SONATEL','segmentmarche_id' => 1,
            ], [
                'libelle' => 'RETRAITE GROUPE SONATEL','segmentmarche_id' => 1,
            ],[
                'libelle' => 'EXPOITATION SONATEL MOBILES','segmentmarche_id' => 1,
            ],

            [
                'libelle' => 'OBO','segmentmarche_id' => 2,
            ],
            [
                'libelle' => 'PPR','segmentmarche_id' => 2,
            ],
            [
                'libelle' => 'SGM','segmentmarche_id' => 2,
            ],
            [
                'libelle' => 'TPE','segmentmarche_id' => 2,
            ],
            [
                'libelle' => 'VPP3','segmentmarche_id' => 2,
            ],
            [
                'libelle' => 'SOH','segmentmarche_id' => 2,
            ],
            [
                'libelle' => 'PRO','segmentmarche_id' => 2,
            ],
            [
                'libelle' => 'VPP','segmentmarche_id' => 2,
            ],
            [
                'libelle' => 'VPP2','segmentmarche_id' => 2,
            ],[
                'libelle' => 'PROS PRESTIGE','segmentmarche_id' => 2,
            ],[
                'libelle' => 'SRARTUP','segmentmarche_id' => 2,
            ],[
                'libelle' => 'SOHO','segmentmarche_id' => 2,
            ],[
                'libelle' => 'TAM','segmentmarche_id' => 2,
            ],
            [
                'libelle' => 'ORG','segmentmarche_id' => 4,
            ],
            [
                'libelle' => 'PEI','segmentmarche_id' => 4,
            ],[
                'libelle' => 'PEI2','segmentmarche_id' => 4,
            ],
            [
                'libelle' => 'PME-PMI','segmentmarche_id' => 4,
            ],[
                'libelle' => 'ORGANISME','segmentmarche_id' => 4,
            ],
            [
                'libelle' => 'PA1','segmentmarche_id' => 3,
            ],
            [
                'libelle' => 'PA2','segmentmarche_id' => 3,
            ],
            [
                'libelle' => 'PA3','segmentmarche_id' => 3,
            ],[
                'libelle' => 'PARTICULIER 1','segmentmarche_id' => 3,
            ],[
                'libelle' => 'PARTICULIER 2','segmentmarche_id' => 3,
            ],[
                'libelle' => 'VIP','segmentmarche_id' => 3,
            ],
            [
                'libelle' => 'ADMINISTRATION','segmentmarche_id' => 5,
            ],            [
                'libelle' => 'COP','segmentmarche_id' => 5,
            ],            [
                'libelle' => 'ETA','segmentmarche_id' => 5,
            ],
            [
                'libelle' => 'FONCTIONNAIRE','segmentmarche_id' => 5,
            ],[
                'libelle' => 'EGO','segmentmarche_id' => 5,
            ],[
                'libelle' => 'ETAT','segmentmarche_id' => 5,
            ],[
                'libelle' => 'COLLECTIVITES PUBLIQUES','segmentmarche_id' => 5,
            ],[
                'libelle' => 'AFFAIRES','segmentmarche_id' => 6,
            ],[
                'libelle' => 'ENT','segmentmarche_id' => 6,
            ],[
                'libelle' => 'GCO','segmentmarche_id' => 6,
            ],[
                'libelle' => 'COMPTE CLE','segmentmarche_id' => 6,
            ],[
                'libelle' => 'GRAND COMPTES','segmentmarche_id' => 6,
            ],[
                'libelle' => 'ENTREPRISES','segmentmarche_id' => 6,
            ],[
                'libelle' => 'OPE','segmentmarche_id' => 7,
            ],
[
                'libelle' => 'OPERATEURS','segmentmarche_id' => 7,
            ],

        ];

        Segment::insert($data);

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
