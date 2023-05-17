<?php

namespace App\Imports;

use App\Models\Adsl;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Fibre;
use App\Models\Offre;
use App\Models\Statut;
use http\Client\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReportingImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    private static int $rows = 0;
    /**
     * @param Collection $client
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $client)
    {
        $client = array_filter($client, function ($key) {
            return !is_int($key) || $key < 26 || $key > 45;
        }, ARRAY_FILTER_USE_KEY);
        dd($client);
        //dd($libelle);
        $libelle=$client['adsl'];
        $idStatut = DB::table('adsls')
            ->select('id')
            ->where('type', '=', $libelle)
            ->get()
            ->first();

        if ($idStatut === null){
            //dd('n\existe pas dans la base de donnée');
            return new Adsl([
                'type'=> $client['adsl']
            ]);
        }else{
            return $idStatut;
        }
        dd($client);
        ++self::$rows;
        return new Client([
            'ncli'=> $client['ncli'],
            'ndos'=> $client['ndos'],
            'produit'=> $client['produit'],
            'nd'=> $client['nd'],
            'bouquet_tv'=> $client['bouquet_tv'],
            'service_fal'=> $client['service_fal'],
            'statut_id'=> $client['statut_id'],
            'nd_smm'=> $client['nd_smm'],
            'login_smm'=> $client['login_smm'],
            'code_por'=> $client['code_por'],
            'date_msv'=> $client['date_msv'],
            'datms_ac'=> $client['datms_ac'],
            'prenom'=> $client['prenom'],
            'nom'=> $client['nom'],
            'categorie_id' => $client['categorie_id'],
            'conctact_mob' => $client['conctact_mob'],
            'contact' => $client['contact_email'],
            'segment_id' => $client['segment_id'],
            'segment_marche' => $client['segment_marche'],
            'offre' => $client['offre'],
        ]);

    }
    public function getRowCount(): int
    {
        return self::$rows;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

}
