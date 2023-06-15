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


//    public function model(array $client)
//    {
//
//        //$segment = $this->getOrCreateModel2(Segment::class, 'libelle', $client['segment'], 'segment_marche_id', $segmentMarche->id);
//
//
//        //$segment = $this->getOrCreateModel2(Segment::class, 'libelle', $client['segment'], 'segment_marche_id', $segmentMarche->id);
//        DB::transaction(function () use ($client) {
//
//            $offre = $this->getOrCreateModel(Offre::class, 'type', $client['offre_fibre']);
//            $statut = $this->getOrCreateModel(Statut::class, 'libelle', $client['statut']);
//            $adsl = $this->getOrCreateModel(Adsl::class, 'type', $client['adsl']);
//            $commune = $this->getOrCreateModel(Commune::class, 'libelle', $client['commune']);
//            $repart = $this->getOrCreateModel(Repart::class, 'libelle', $client['repart']);
//            $agence = $this->getOrCreateModel(Agence::class, 'libelle', $client['agence']);
//            $voixFixe = $this->getOrCreateModel(VoixFixe::class, 'libelle', $client['voix_fixe']);
//            $segmentMarche = $this->getOrCreateModel(SegmentMarche::class, 'libelle', $client['segment_marche']);
//            $offreAdsl = $this->getOrCreateModel(OffreAdsl::class, 'type', $client['offre_adsl']);
//            $categorie = $this->getOrCreateModel(Categorie::class, 'libelle', $client['categorie']);
//            $fibre = $this->getOrCreateModel(Fibre::class, 'type', $client['fibre']);
//            if ($voixFixe !== null){
//
//                $this->getOrCreateModel2(AccesReseau::class, 'libelle', $client['acces_reseau'], 'voix_fixe_id', $voixFixe->id);
//            }
//            $client = array_filter($client, function ($key) {
//                return !is_int($key) || $key < 26 || $key > 45;
//            }, ARRAY_FILTER_USE_KEY);
//
//            // Récupérer la valeur de date sous forme de nombre
//            $dateMsvNumeric = $client['date_msv'];
//            // Convertir le nombre en date PHP valide
//            $dateMsv = Carbon::createFromFormat('d/m/y', $dateMsvNumeric)->format('y/m/d');
//            // Convertir le nombre en date PHP valide
//            $dateMsAc = Carbon::createFromFormat('d/m/y', $dateMsvNumeric)->format('Y-m-d');
//
//            $segment = Segment::firstOrCreate(['libelle' => $client['segment']]);
//            $segment->segment_marche_id=$segmentMarche->id;
//            $segment->save();
//            //dd($segment);
//            // $segment->segmentmarche()->associate($segmentMarche)->save();
//
//            /*if ($voixFixe != null) {
//                $voixFixe->save();
//            }*/
//
//            $client = new Client([
//                'ncli' => $client['ncli'],
//                'ndos' => $client['ndos'],
//                'produit' => $client['produit'],
//                'nd' => $client['nd'],
//                'bouquet_tv' => $client['bouquet_tv'],
//                'service_fal' => $client['service_fal'],
//                'statut_id' => $statut->id,
//                'nd_smm' => $client['nd_smm'],
//                'login_smm' => $client['login_smm'],
//                'code_por' => $client['code_por'],
//                'date_msv' => $dateMsv,
//                'datms_ac' => $dateMsAc,
//                'prenom' => $client['prenom'],
//                'nom' => $client['nom'],
//                'categorie_id' => $categorie->id,
//                'contact_mob' => $client['contact_mob'],
//                'contact_email' => $client['contact_email'],
//                'segment_id' => $segment->id
//            ]);
//
//            //$client->segment()->associate($segment);
//            $client->save();
//
//            if ($offre != null) {
//                $this->getOrCreateModel2(ClientOffre::class, 'client_id', $client->id, 'offre_id', $offre->id);
//                $this->getOrCreateModel2(OffreFibre::class, 'offre_id', $offre->id, 'fibre_id', $fibre->id);
//            }
//
//            if ($adsl != null) {
//                $this->getOrCreateModel2(ClientAdsl::class, 'client_id', $client->id, 'adsl_id', $adsl->id);
//            }
//
//            if ($offreAdsl != null && $adsl != null) {
//                $this->getOrCreateModel2(OffreAdslAdsl::class, 'offre_adsl_id', $offreAdsl->id, 'adsl_id', $adsl->id);
//            }
//
//            if ($repart != null && $commune != null) {
//                $this->getOrCreateModel2(CommuneRepart::class, 'repart_id', $repart->id, 'commune_id', $commune->id);
//            }
//
//            if ($repart != null) {
//                $this->getOrCreateModel2(ClientRepart::class, 'client_id', $client->id, 'repart_id', $repart->id);
//            }
//
//            if ($commune != null) {
//                $this->getOrCreateModel2(ClientCommune::class, 'client_id', $client->id, 'commune_id', $commune->id);
//            }
//
//            $this->getOrCreateModel2(ClientAgence::class, 'client_id', $client->id, 'agence_id', $agence->id);
//        });
//    }

    public function model(array $client)
    {
        DB::transaction(function () use ($client) {
            // Obtenez ou créez les modèles associés
            $offre = $this->getOrCreateModel(Offre::class, 'type', $client['offre_fibre']);

            $statut = $this->getOrCreateModel(Statut::class, 'libelle', $client['statut']);
            $adsl = $this->getOrCreateModel(Adsl::class, 'type', $client['adsl']);
            $commune = $this->getOrCreateModel(Commune::class, 'libelle', $client['commune']);
            $repart = $this->getOrCreateModel(Repart::class, 'libelle', $client['repart']);
            $agence = $this->getOrCreateModel(Agence::class, 'libelle', $client['agence']);
            $segmentMarche = $this->getOrCreateModel(SegmentMarche::class, 'libelle', $client['segment_marche']);
            $offreAdsl = $this->getOrCreateModel(OffreAdsl::class, 'type', $client['offre_adsl']);
            if ($client['categorie'] !== null){
                $categorie = $this->getOrCreateModel(Categorie::class, 'libelle', $client['categorie']);
            }
            $fibre = $this->getOrCreateModel(Fibre::class, 'type', $client['fibre']);
            $voixFixe = $this->getOrCreateModel(VoixFixe::class, 'libelle', $client['voix_fixe']);
            if ($voixFixe !== null){
                $this->getOrCreateModel2(AccesReseau::class, 'libelle', $client['acces_reseau'],'voix_fixe_id', $voixFixe->id);
            }

            if ($client['segment'] !== null){
                $segment = Segment::firstOrCreate(['libelle' => $client['segment']]);
                $segment->segment_marche_id=$segmentMarche->id;
                $segment->save();
            }
            // Créez les modèles associés en une seule opération
            $relatedModels = compact('offre', 'adsl', 'commune', 'repart', 'agence', 'segmentMarche', 'offreAdsl', 'fibre', 'voixFixe');
            $client = array_merge($client, $relatedModels);

            // Récupérez la valeur de date et convertissez-la
            if ($client['date_msv'] !== null){
                $dateMsvNumeric = $client['date_msv'];
                $dateMsv = Carbon::createFromFormat('d/m/y', $dateMsvNumeric)->format('y/m/d');
                //$client['date_msv'] = $dateMsv;
            }
            if ($client['date_msv'] !== null){
                $dateMsAcNumeric = $client['date_msv'];
                $dateMsAc = Carbon::createFromFormat('d/m/y', $dateMsAcNumeric)->format('Y-m-d');
                //$client['datms_ac'] = $dateMsAc;
            }

            if ($client['statut'] != null){
            // Créez le modèle Client
            $clientModel = new Client([
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
                'segment_id' => $segment->id
            ]);
            //$client->segment()->associate($segment);
            $clientModel->save();

            // Associez les modèles via les relations définies
            if ($offre !==null){
                $clientModel->offres()->attach($offre->id);
            }
            if ($adsl != null){
                $clientModel->adsls()->attach($adsl->id);
            }
            if ($repart !== null){
                $clientModel->reparts()->attach($repart->id);
            }
            if ($commune !== null){
                $clientModel->communes()->attach($commune->id);
            }
            $clientModel->agences()->attach($agence->id);
            }
        });
    }

    public function getRowCount(): int
    {
        return self::$rows;
    }

    public function batchSize(): int
    {
        return 3000;
    }

    public function chunkSize(): int
    {
        return 3000;
    }

    private function getOrCreateModel($modelClass, $column, $value)
    {
        if ($value === null) {
            return null;
        }

        $model = $modelClass::where($column, $value)->first();

        if (!$model) {
            $model = new $modelClass([$column => $value]);
            $model->save();
        }

        return $model;
    }


    private function getOrCreateModel2($modelClass, $column, $value, $relatedColumn, $relatedValue)
    {
        if ($value === null) {
            return null;
        }

        $model = $modelClass::where($column, $value)->where($relatedColumn, $relatedValue)->first();
        if (!$model) {
            $model = $modelClass::create([$column => $value, $relatedColumn => $relatedValue]);
        }
        return $model;

    }

}
