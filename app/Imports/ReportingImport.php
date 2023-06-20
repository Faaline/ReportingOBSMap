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

    public function model(array $client)
    {
        // Obtenez ou créez les modèles associés en une seule opération
        $relatedModels = $this->getRelatedModels($client);
        $client = array_merge($client, $relatedModels);

        // Récupérez la valeur de date et convertissez-la
        $dateMsv = $this->getDateFromFormat($client['date_msv'], 'd/m/y', 'y/m/d');
        $dateMsAc = $this->getDateFromFormat($client['datms_ac'], 'd/m/y', 'Y-m-d');

        DB::transaction(function () use ($client, $dateMsv, $dateMsAc) {

            $clientModel = new Client([
                'ncli' => $client['ncli'],
                'ndos' => $client['ndos'],
                'produit' => $client['produit'],
                'nd' => $client['nd'],
                'bouquet_tv' => $client['bouquet_tv'],
                'service_fal' => $client['service_fal'],
                'statut_id' => $client['statut']->id,
                'nd_smm' => $client['nd_smm'],
                'login_smm' => $client['login_smm'],
                'code_por' => $client['code_por'],
                'date_msv' => $dateMsv,
                'datms_ac' => $dateMsAc,
                'prenom' => $client['prenom'],
                'nom' => $client['nom'],
                'categorie_id' => $client['categorie']->id,
                'contact_mob' => $client['contact_mob'],
                'contact_email' => $client['contact_email'],
                'segment_id' => $client['segment']->id
            ]);

            $clientModel->save();
            // Associez les modèles via les relations définies
            if ($client['offre'] !== null) {
                $clientModel->offres()->attach($client['offre']->id);
            }
            if ($client['adsl'] !== null) {
                $clientModel->adsls()->attach($client['adsl']->id);
            }
            if ($client['offre_adsl'] !== null){
                $this->getOrCreateModel(OffreAdsl::class, 'type', $client['offre_adsl'])
                    ->adsls()->attach($client['adsl']->id);
            }
            if ($client['repart'] !== null) {
                $clientModel->reparts()->attach($client['repart']->id);
                $this->getOrCreateModel(Commune::class, 'libelle', $client['commune'])
                    ->reparts()->attach($client['repart']->id);
            }
            if ($client['commune'] !== null) {
                $clientModel->communes()->attach($client['commune']->id);
            }
            if ($client['fibre'] !== null){
                $this->getOrCreateModel(Offre::class, 'type', $client['offre_fibre'])
                    ->fibres()->attach($client['fibre']->id);
            }
            $clientModel->agences()->attach($client['agence']->id);

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

    private function getRelatedModels(array $client): array
    {
        $relatedModels = [];

        $relatedModels['offre'] = $this->getOrCreateModel(Offre::class, 'type', $client['offre_fibre']);
        $relatedModels['statut'] = $this->getOrCreateModel(Statut::class, 'libelle', $client['statut']);
        $relatedModels['adsl'] = $this->getOrCreateModel(Adsl::class, 'type', $client['adsl']);
        $relatedModels['commune'] = $this->getOrCreateModel(Commune::class, 'libelle', $client['commune']);
        $relatedModels['repart'] = $this->getOrCreateModel(Repart::class, 'libelle', $client['repart']);
        $relatedModels['agence'] = $this->getOrCreateModel(Agence::class, 'libelle', $client['agence']);
        $relatedModels['segmentMarche'] = $this->getOrCreateModel(SegmentMarche::class, 'libelle', $client['segment_marche']);
        $relatedModels['offreAdsl'] = $this->getOrCreateModel(OffreAdsl::class, 'type', $client['offre_adsl']);
        $relatedModels['categorie'] = $this->getOrCreateModel(Categorie::class, 'libelle', $client['categorie']);
        $relatedModels['fibre'] = $this->getOrCreateModel(Fibre::class, 'type', $client['fibre']);
        $relatedModels['voixFixe'] = $this->getOrCreateModel(VoixFixe::class, 'libelle', $client['voix_fixe']);
        if ($relatedModels['voixFixe'] !== null) {
            $relatedModels['accesReseau'] = $this->getOrCreateModel2(AccesReseau::class, 'libelle', $client['acces_reseau'], 'voix_fixe_id', $relatedModels['voixFixe']->id);
        }

            $relatedModels['segment'] = Segment::firstOrCreate(['libelle' => $client['segment']]);
            $relatedModels['segment']->segment_marche_id=$relatedModels['segmentMarche']->id;
            $relatedModels['segment']->save();

        return $relatedModels;
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
            $model = $modelClass::firstOrCreate([$column => $value, $relatedColumn => $relatedValue]);
        }
        return $model;

    }

    private function getDateFromFormat($dateString, $currentFormat, $targetFormat)
    {
        if ($dateString === null) {
            return null;
        }

        $date = Carbon::createFromFormat($currentFormat, $dateString)->format($targetFormat);

        return $date;
    }
}
