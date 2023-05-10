<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReportingImport implements ToModel, WithHeadingRow
{
    private static int $rows = 0;
    /**
     * @param array $client
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $client)
    {
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
            'categorie_id'=> $client['categorie_id'],
            'conctact_mob'=> $client['conctact_mob'],
            'contact'=> $client['contact_email'],
            'segment_id'=> $client['segment_id'],
            'seg'=> $client['seg'],
            'reseau_bis'=> $client['reseau_bis'],
        ]);

    }
    public function getRowCount(): int
    {
        return self::$rows;
    }
}
