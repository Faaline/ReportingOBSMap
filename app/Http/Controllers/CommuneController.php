<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commune= Commune::with('reparts')->orderBy('created_at','desc')->paginate(10);
        return response()->json($commune,200);
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
        Commune::create(array_merge(
            [
                'libelle'=>strtoupper($request->all()['libelle']),
            ]));
        return response()->json([
            'success'=>'Commune ajoutée avec succes',
        ],201);
    }

    public function insertMultiple()
    {
        $data = [
            [
                'libelle' => 'BAMBYLORE-GOROM-BAYAKH',
            ],
            [
                'libelle' => 'BARGNY',
            ],
            [
                'libelle' => 'BIGNONA_COMMUNE',
            ],
            [
                'libelle' => 'CAMBERENE-PARCELLES ASSAINIES',
            ],
            [
                'libelle' => 'CASTORS-DERKLE',
            ],
            [
                'libelle' => 'CENTENAIRE-GIBRALTAR',
            ],
            [
                'libelle' => 'COLOBANE',
            ],[
                'libelle' => 'DAROU KHOUDOSS',
            ],[
                'libelle' => 'DIAMAGUENE-DIACKSAO',
            ],
            [
                'libelle' => 'DIAMNIADIO',
            ],
            [
                'libelle' => 'DIOURBEL',
            ],
            [
                'libelle' => 'FANN',
            ],
            [
                'libelle' => 'FANN HOCK',
            ],[
                'libelle' => 'FASS',
            ],[
                'libelle' => 'FOIRE',
            ],[
                'libelle' => 'FASS MBAO',
            ],[
                'libelle' => 'G1-DAKAR MEDINA',
            ],[
                'libelle' => 'GRAND DAKAR-USINE',
            ],[
                'libelle' => 'GRAND YOFF',
            ],[
                'libelle' => 'GUEDIAWAYE',
            ],[
                'libelle' => 'GUEULE TAPEE',
            ],[
                'libelle' => 'H.L.M.-CITE PORT-SODIDA ',
            ],[
                'libelle' => 'HANN',
            ],[
                'libelle' => 'HLM PATTE D OIE  ',
            ],[
                'libelle' => 'KAHONE ',
            ],[
                'libelle' => 'KAOLACK ',
            ],[
                'libelle' => 'KAOLACK_KOUMBALE ',
            ],[
                'libelle' => 'KAOLACK_SIBASSOR ',
            ],[
                'libelle' => 'KEUR MASSAR   ',
            ],[
                'libelle' => 'KEUR MBAYE FALL   ',
            ],[
                'libelle' => 'KHOMBOLE  ',
            ],[
                'libelle' => 'LOUGA ',
            ],[
                'libelle' => 'MADYANA ',
            ],[
                'libelle' => 'MALIKA ',
            ],[
                'libelle' => 'MBACKE_NDAME ',
            ],[
                'libelle' => 'MBAO',
            ],[
                'libelle' => 'MBORO ',
            ],[
                'libelle' => 'MBOUR ',
            ],[
                'libelle' => 'MBOUR_SINDIA ',
            ],[
                'libelle' => 'MEDINA ',
            ],[
                'libelle' => 'MERMOZ ',
            ],[
                'libelle' => 'NDAME MBACKE  ',
            ],[
                'libelle' => 'NGOR-ALMADIES ',
            ],[
                'libelle' => 'NIORO ',
            ],[
                'libelle' => 'NORD LIBERTE 6 ',
            ],[
                'libelle' => 'OUAGOU NIAYES ',
            ],[
                'libelle' => 'OUAKAM ',
            ],[
                'libelle' => 'OUSSOUYE ',
            ],[
                'libelle' => 'OUSSOUYE_KABROUSSE ',
            ],[
                'libelle' => 'PATTE D OIE BUILDERS - SOPRIM ',
            ],[
                'libelle' => 'PIKINE ',
            ],[
                'libelle' => 'PLATEAU ',
            ],[
                'libelle' => 'POINT E   ',
            ],[
                'libelle' => 'POSTCHANCE PARCELLES-ASSAINIES ',
            ],[
                'libelle' => 'POSTCHANCE SOUMBEDIOUNE',
            ],[
                'libelle' => 'POSTE DAKAR-COLOBANE',
            ],[
                'libelle' => 'POSTE DAKAR-FANN  ',
            ],[
                'libelle' => 'POSTE DAKAR-GRAND YOFF ',
            ],[
                'libelle' => 'POSTE DAKAR-HLM 5  ',
            ],[
                'libelle' => 'POSTE DAKAR-LIBERTE ',
            ],[
                'libelle' => 'POSTE DAKAR-MEDINA',
            ],[
                'libelle' => 'POSTE DAKAR-PEYTAVIN ',
            ],[
                'libelle' => 'POSTE DAKAR-PONTY  ',
            ],[
                'libelle' => 'POSTE DAKAR-RP ',
            ],[
                'libelle' => 'POSTE DAKAR-SOUMBEDIOUNE ',
            ],[
                'libelle' => 'POSTE PARCELLES ASSAINIES ',
            ],[
                'libelle' => 'POSTE RUFISQUE ',
            ],[
                'libelle' => 'POSTE THIAROYE ',
            ],[
                'libelle' => 'RICHARD TOLL ',
            ],[
                'libelle' => 'RUFISQUE ',
            ],[
                'libelle' => 'RUFUSQUE_DIAMNIADIO  ',
            ],[
                'libelle' => 'SAINT LOUIS ',
            ],[
                'libelle' => 'SAINT LOUIS_NGALLELE  ',
            ],[
                'libelle' => 'SAINT LOUIS_RAO ',
            ],[
                'libelle' => 'SANGALKAM ',
            ],[
                'libelle' => 'SICAP ',
            ],[
                'libelle' => 'SICAP MBAO ',
            ],[
                'libelle' => 'THIAROYE ',
            ],[
                'libelle' => 'THIAROYE AZUR ',
            ],[
                'libelle' => 'THIAROYE SUR MER ',
            ],[
                'libelle' => 'THIES ',
            ],[
                'libelle' => 'TIVAOUANE ',
            ],[
                'libelle' => 'TIVAOUNE PEULH  ',
            ],[
                'libelle' => 'TOUBA MOSQUEE ',
            ],[
                'libelle' => 'VELINGARA ',
            ],[
                'libelle' => 'YEUMBEUL ',
            ],[
                'libelle' => 'YOFF ',
            ],[
                'libelle' => 'ZIGUINCHOR ',
            ],[
                'libelle' => 'ZIGUINCHOR_NIAGUIS ',
            ],[
                'libelle' => 'ZONE A-ZONE B  ',
            ],[
                'libelle' => 'ZONE FRANCHE INDUSTRIELLE',
            ],[
                'libelle' => 'ZONE INDUSTRIELLE',
            ],[
                'libelle' => 'ZONE PORTUAIRE',
            ],[
                'libelle' => 'BOPP  ',
            ],

            // Ajoutez les autres lignes à insérer ici
        ];

        Commune::insert($data);

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
