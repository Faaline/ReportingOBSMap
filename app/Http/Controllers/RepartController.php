<?php

namespace App\Http\Controllers;

use App\Models\Repart;
use Illuminate\Http\Request;

class RepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reparts=Repart::orderBy('created_at','desc')->paginate(10);
        return response()->json($reparts,200);
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
        Repart::create(array_merge(
            [
                'libelle'=>strtoupper($request->all()['libelle']),
            ]));
        return response()->json([
            'success'=>'Repartition ajoutée avec succes',
        ],201);
    }


    public function insertMultiple()
    {
        $data = [
            [
                'libelle' => 'GOM',
            ],
            [
                'libelle' => 'O_DMD_7',
            ],[
                'libelle' => 'O_SGK_7',
            ],
            [
                'libelle' => 'RUF',
            ],
            [
                'libelle' => 'SGK',
            ],
            [
                'libelle' => 'BGY',
            ],[
                'libelle' => 'O_BGY_7',
            ],[
                'libelle' => 'O_ZIG_7 ',
            ],[
                'libelle' => 'GDK',
            ],[
                'libelle' => 'GDW ',
            ],[
                'libelle' => 'O_NFO_7',
            ],[
                'libelle' => 'O_REP_7',
            ],[
                'libelle' => 'SDF',
            ],[
                'libelle' => 'O_TBM_7',
            ],[
                'libelle' => 'TBM',
            ],[
                'libelle' => 'O_SEB_7',
            ],[
                //KHOMBOLE
                'libelle' => 'OKM',
            ],[
                'libelle' => 'TIA',
            ],[
                'libelle' => 'FBOX',
            ],[
                'libelle' => 'NFO',
            ],[
                'libelle' => 'YOF',
            ],[
                'libelle' => 'SVD',
            ],[
                'libelle' => 'ACA',
            ],[
                'libelle' => 'HAN',
            ],[
                'libelle' => 'HMA',
            ],[
                'libelle' => 'O_TEC_7',
            ],[
                'libelle' => 'TEC',
            ],
            /*KAOLACK*/
            [
                'libelle' => 'KLK',
            ],[
                'libelle' => 'O_THS_7',
            ],
            /*KAOLACK - KAOLACK_KOUMBALE - KAOLACK_SIBASSOR - KAHONE*/
            [
                'libelle' => 'O_KLK_7',
            ],
            /*KEUR MASSAR*/
            [
                //KEUR MBAYE FALL - MALIKA
                'libelle' => 'KMR
',
            ],[
                //KEUR MBAYE FALL
                'libelle' => 'MBW',
            ],[
                'libelle' => 'O_ALM_7',
            ],[
                //KEUR MBAYE FALL
                'libelle' => 'O_GDW_7',
            ],[
                //KEUR MBAYE FALL
                'libelle' => 'O_KMR_7',
            ],[
                'libelle' => 'O_MBR_7',
            ],[
                //KEUR MBATE FALL
                'libelle' => 'O_MBW_7',
            ],
            //KEUR MBAYE FALL
            [
                'libelle' => 'O_SMN_7',
            ],
            /*KEUR MBAYE FALL*/
            [
                'libelle' => 'NIG'
            ],
            /*LOUGA*/
            [
                'libelle' => 'LGA',
            ],[
                'libelle' => 'O_LGA_7',
            ],[
                'libelle' => 'O_NGA_7',
            ],
            /*MADYANA*/
            [
                'libelle' => 'DKH',
            ],[
                'libelle' => 'MAD',
            ],[
                'libelle' => 'O_DKH_7',
            ],
            /*MALIKA*/
            [
                'libelle' => 'O_CAM_7',
            ],
            /*MBACKE_NDAME*/
            [
                'libelle' => 'O_NDA_7',
            ],
            /*MBAO*/
           [
                'libelle' => 'O_SVD_7',
            ],[
                'libelle' => 'O_TIA_7',
            ],[
                'libelle' => 'GMB',
            ],[
                'libelle' => 'MBR',
            ],[
                'libelle' => 'NNG',
            ],[
                'libelle' => 'SMNO_GMB_7',
            ],[
                'libelle' => 'MED',
            ],[
                'libelle' => 'O_ACA_7',
            ],[
                'libelle' => 'O_YOF_7',
            ],[
                'libelle' => 'O_MAD_7',
            ],[
                'libelle' => 'O_HAN_7',
            ],[
                'libelle' => 'O_MED_7',
            ],[
                'libelle' => 'O_SDF_7',
            ],[
                'libelle' => 'NDA',
            ],[
                'libelle' => 'ALM',
            ],[
                'libelle' => 'O_TIV_7',
            ],[
                'libelle' => 'CAP',
            ],[
                'libelle' => 'O_CAP_7',
            ],[
                'libelle' => 'OUS',
            ],[
                'libelle' => 'CAM',
            ],[
                'libelle' => 'O_RTL_7',
            ],[
                'libelle' => 'RTL',
            ],[
                'libelle' => 'O_SL1_7',
            ],[
                'libelle' => 'SL1',
            ],[
                'libelle' => 'STL',
            ],[
                'libelle' => 'NGL',
            ],

            // Ajoutez les autres lignes à insérer ici
        ];

        Repart::insert($data);

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
