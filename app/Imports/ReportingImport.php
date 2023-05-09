<?php

namespace App\Imports;

use App\Models\Client;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
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
            'prenom'=> $client['prenom'],
            'nom'=> $client['nom'],
            'contact'=> $client['contact'],
            'ncli'=> $client['ncli'],
            'ndos'=> $client['ndos'],
            'nd'=> $client['nd'],
            'login_smm'=> $client['login_smm'],
            'bouquet_tv'=> $client['bouquet_tv'],
            'prenom'=> $client['prenom'],
            'prenom'=> $client['prenom'],
            'prenom'=> $client['prenom'],
            'prenom'=> $client['prenom'],
            'prenom'=> $client['prenom'],
            'prenom'=> $client['prenom'],
            'prenom'=> $client['prenom'],
            'prenom'=> $client['prenom'],
            'prenom'=> $client['prenom'],
            'prenom'=> $client['prenom'],
            'prenom'=> $client['prenom'],
            'prenom'=> $client['prenom'],
        ]);

    }
    public function getRowCount(): int
    {
        return self::$rows;
    }
}
