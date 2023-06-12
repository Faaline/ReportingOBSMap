<?php

namespace App\Imports;

use App\Models\AccesReseau;
use App\Models\AccesReseauFibre;
use App\Models\Adsl;
use App\Models\Agence;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\ClientAdsl;
use App\Models\ClientAgence;
use App\Models\ClientCommune;
use App\Models\ClientRepart;
use App\Models\Commune;
use App\Models\CommuneRepart;
use App\Models\Offre;
use App\Models\ClientOffre;
use App\Models\Fibre;
use App\Models\OffreAdsl;
use App\Models\OffreAdslAdsl;
use App\Models\OffreFibre;
use App\Models\Repart;
use App\Models\Segment;
use App\Models\SegmentMarche;
use App\Models\SegmentSegmentMarche;
use App\Models\Statut;
use App\Models\VoixFixe;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use http\Client\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ReportingImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    private static int $rows = 0;
    /**
     * @param Collection $client
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    private function getOrCreateModel($modelClass, $column, $value)
    {
        if ($value === null){
            return ;
        }else {
            $model = $modelClass::where($column, $value)->first();
            if(!$model){
                $model = $modelClass::firstOrCreate([
                    $column => $value,
                ]);
            }
            return $model;
        }


    }

    private function getOrCreateModel2($modelClass, $column1, $value1, $column2, $value2)
    {
        if ($value1 === null || $value2 === null) {
            return null;
        }

        $model = $modelClass::where($column1, $value1)->first();
        if (!$model) {
            $model = $modelClass::firstOrCreate([
                $column1 => $value1,
                $column2 => $value2
            ]);
        }

        return $model;
    }

    private function insertIntoAssociationTable($modelClass, $column1, $column2, $value1, $value2)
    {
        // Vérifier si l'une des valeurs est null
        if ($value1 === null || $value2 === null) {
            // Une des valeurs est null, éviter l'insertion
            return;
        }

        // Vérifier si une entrée similaire existe déjà
        $existingEntry = $modelClass::where($column1, $value1)
            ->where($column2, $value2)
            ->first();

        if ($existingEntry) {
            // Une entrée similaire existe déjà, éviter l'insertion
            return $existingEntry;
        }
        // Créer une nouvelle instance du modèle d'association
        $associationModel = new $modelClass();

        // Définir les valeurs des colonnes
        $associationModel->$column1 = $value1;
        $associationModel->$column2 = $value2;

        // Enregistrer l'entrée dans la table d'association
        $associationModel->save();
        //dd($associationModel);

    }

    public function model(array $client)
    {
        $offre = $this->getOrCreateModel(Offre::class, 'type', $client['offre_fibre']);
        $statut = $this->getOrCreateModel(Statut::class, 'libelle', $client['statut']);
        $adsl = $this->getOrCreateModel(Adsl::class, 'type', $client['adsl']);
        $commune = $this->getOrCreateModel(Commune::class, 'libelle', $client['commune']);
        $repart = $this->getOrCreateModel(Repart::class, 'libelle', $client['repart']);
        $agence = $this->getOrCreateModel(Agence::class, 'libelle', $client['agence']);
        $accesReseau = $this->getOrCreateModel(AccesReseau::class, 'libelle', $client['acces_reseau']);
        $segmentMarche = $this->getOrCreateModel(SegmentMarche::class, 'libelle', $client['segment_marche']);
        $offreAdsl = $this->getOrCreateModel(OffreAdsl::class, 'type', $client['offre_adsl']);
        $categorie = $this->getOrCreateModel(Categorie::class, 'libelle', $client['categorie']);
        $fibre = $this->getOrCreateModel(Fibre::class, 'type', $client['fibre']);
        $voixFixe = $this->getOrCreateModel2(VoixFixe::class, 'libelle', $client['voix_fixe'], 'acces_reseau_id', $accesReseau->id);


        DB::transaction(function () use ($client, $offre, $statut, $adsl, $commune, $repart, $agence, $accesReseau, $segmentMarche, $offreAdsl, $categorie, $fibre, $voixFixe) {
            $client = array_filter($client, function ($key) {
                return !is_int($key) || $key < 26 || $key > 45;
            }, ARRAY_FILTER_USE_KEY);

            // Récupérer la valeur de date sous forme de nombre
            $dateMsvNumeric = $client['date_msv'];
            // Convertir le nombre en date PHP valide
            $dateMsv = Carbon::createFromFormat('d/m/y', $dateMsvNumeric)->format('y/m/d');
            // Convertir le nombre en date PHP valide
            $dateMsAc = Carbon::createFromFormat('d/m/y', $dateMsvNumeric)->format('Y-m-d');

            $this->insertIntoAssociationTable(Segment::class, 'libelle', 'segmentmarche_id', $client['segment'], $segmentMarche->id);

            if($voixFixe != null){

                $voixFixe->save();
            }

            $segment = $this->insertIntoAssociationTable(Segment::class, 'libelle', 'segmentmarche_id', $client['segment'], $segmentMarche->id);

            $client = new Client([
                'ncli' => $client['ncli'],
                'ndos' => $client['ndos'],
                'produit' => $client['produit'],
                'nd' => $client['nd'],
                'bouquet_tv' => $client['bouquet_tv'],
                'service_fal' => $client['service_fal'],
                'statut_id' => $statut->id,
                'nd_smm' => $client['nd_smm'],
                'login_smm' => $client['login_smm'],
                'code_por' => $client['code_por'],
                'date_msv' => $dateMsv,
                'datms_ac' => $dateMsAc,
                'prenom' => $client['prenom'],
                'nom' => $client['nom'],
                'categorie_id' => $categorie->id,
                'contact_mob' => $client['contact_mob'],
                'contact_email' => $client['contact_email'],
                'segment_id' =>$segment->id,
            ]);

            $client->save();

            if ($offre != null) {
                $this->insertIntoAssociationTable(ClientOffre::class, 'client_id', 'offre_id', $client->id, $offre->id);
                $this->insertIntoAssociationTable(OffreFibre::class, 'offre_id', 'fibre_id', $offre->id, $fibre->id);
            }

            if ($fibre != null) {
                $this->insertIntoAssociationTable(AccesReseauFibre::class, 'acces_reseau_id', 'fibre_id', $accesReseau->id, $fibre->id);
            }

            if ($adsl != null) {
                $this->insertIntoAssociationTable(ClientAdsl::class, 'client_id', 'adsl_id', $client->id, $adsl->id);
            }

            if ($offreAdsl != null && $adsl != null) {
                $this->insertIntoAssociationTable(OffreAdslAdsl::class, 'offre_adsl_id', 'adsl_id', $offreAdsl->id, $adsl->id);
            }
            if ($repart != null && $commune != null){
                $this->insertIntoAssociationTable(CommuneRepart::class, 'commune_id', 'repart_id', $commune->id, $repart->id);
            }
            if ($repart != null){
                $this->insertIntoAssociationTable(ClientRepart::class, 'client_id', 'repart_id', $client->id, $repart->id);
            }
            if($commune != null){
                $this->insertIntoAssociationTable(ClientCommune::class, 'client_id', 'commune_id', $client->id, $commune->id);
            }
            $this->insertIntoAssociationTable(ClientAgence::class, 'client_id', 'agence_id', $client->id, $agence->id);
        });

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
