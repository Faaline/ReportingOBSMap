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
        ++self::$rows;
        DB::transaction(function () use ($client, $dateMsv, $dateMsAc) {
                $clientModel = new Client([
                    'ncli' => $client['ncli'],
                    'ndos' => $client['ndos'],
                    'produit' => $client['produit'],
                    'nd' => $client['nd'],
                    'bouquet_tv' => $client['bouquet_tv'],
                    'service_fal' => $client['service_fal'],
                    'statut_id' => $client['statut'] !== null ? $client['statut']->id : null,
                    'nd_smm' => $client['nd_smm'],
                    'login_smm' => $client['login_smm'],
                    'code_por' => $client['code_por'],
                    'date_msv' => $dateMsv,
                    'datms_ac' => $dateMsAc,
                    'prenom' => $client['prenom'],
                    'nom' => $client['nom'],
                    'categorie_id' => $client['categorie'] !== null ? $client['categorie']->id : null,
                    'contact_mob' => $client['contact_mob'],
                    'contact_email' => $client['contact_email'],
                    'segment_id' =>  $client['segment'] !== null ? $client['segment']->id : null
                ]);

            $clientModel->save();

            // Associez les modèles via les relations définies
            if ($client['offre_fibre'] != null) {
                $clientModel->offres()->attach($this->getOrCreateModel(Offre::class, 'type', $client['offre_fibre'])->id);
                $this->getOrCreateModel(Segment::class, 'libelle', $client['segment'])
                    ->offreFibres()->attach($this->getOrCreateModel(Offre::class, 'type', $client['offre_fibre'])->id);
            }
            if ($client['adsl'] !== null) {
                $clientModel->adsls()->attach($client['adsl']->id);
                $this->getOrCreateModel(OffreAdsl::class, 'type', $client['offre_adsl'])
                    ->adsls()->attach($client['adsl']->id);
            }
            if ($client['offre_adsl'] !== null){
                $clientModel->offreAdsl()->attach($this->getOrCreateModel(OffreAdsl::class, 'type', $client['offre_adsl'])->id);
                $this->getOrCreateModel(Segment::class, 'libelle', $client['segment'])
                    ->offreadsl()->attach($this->getOrCreateModel(OffreAdsl::class, 'type', $client['offre_adsl'])->id);
            }
            if ($client['fibre'] !== null){
                $clientModel->fibres()->attach($client['fibre']->id);
                $this->getOrCreateModel(Offre::class, 'type', $client['offre_fibre'])
                    ->fibres()->attach($client['fibre']->id);
            }
            if ($client['repart'] !== null) {
                $clientModel->reparts()->attach($client['repart']->id);
                $this->getOrCreateModel(Commune::class, 'libelle', $client['commune'])
                    ->reparts()->attach($client['repart']->id);
            }
            if ($client['commune'] !== null) {
                $clientModel->communes()->attach($client['commune']->id);
            }
            if ($client['voix_fixe'] !== null) {
                $clientModel->voixFixes()->attach($this->getOrCreateModel(VoixFixe::class, 'libelle', $client['voix_fixe'])->id);
            }
            if ($client['agence'] !== null){
                $clientModel->agences()->attach($client['agence']->id);
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
        $relatedModels['segment'] = $this->getOrCreateModel2(Segment::class, 'libelle', $client['segment'], 'segment_marche_id', $relatedModels['segmentMarche']->id);
        /*$relatedModels['segment'] = new Segment();
        $relatedModels['segment']-> libelle = $client['segment'];
        $relatedModels['segment']-> segment_marche_id = $relatedModels['segmentMarche']->id;
        $relatedModels['segment']->save();*/


        return $relatedModels;
   }

//    private function getRelatedModels(array $client): array
//    {
//        $relatedModels = [];
//        $relatedModels['offre'] = Offre::where('type', $client['offre_fibre'])->first();
//        $relatedModels['statut'] = Statut::where('libelle', $client['statut'])->first();
//        $relatedModels['adsl'] = Adsl::where('type', $client['adsl'])->first();
//        $relatedModels['commune'] = Commune::where('libelle', $client['commune'])->first();
//        $relatedModels['repart'] = Repart::where('libelle', $client['repart'])->first();
//        $relatedModels['agence'] = Agence::where('libelle', $client['agence'])->first();
//        $relatedModels['segmentMarche'] = SegmentMarche::where('libelle', $client['segment_marche'])->first();
//        $relatedModels['offreAdsl'] = OffreAdsl::where('type', $client['offre_adsl'])->first();
//        $relatedModels['categorie'] = Categorie::where('libelle', $client['categorie'])->first();
//        $relatedModels['fibre'] = Fibre::where('type', $client['fibre'])->first();
//        $relatedModels['voixFixe'] = VoixFixe::where('libelle', $client['voix_fixe'])->first();
//        if ($relatedModels['voixFixe'] !== null) {
//            $relatedModels['accesReseau'] = AccesReseau::where('libelle', $client['acces_reseau'])
//                ->where('voix_fixe_id', $relatedModels['voixFixe']->id)
//                ->first();
//        }
//        if ($relatedModels['segmentMarche'] !== null){
//            $relatedModels['segment'] = Segment::where('libelle', $client['segment'])
//                ->where('segment_marche_id', $relatedModels['segmentMarche']->id)
//                ->first();
//        }
//        return $relatedModels;
//    }


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

        $model = $modelClass::firstOrCreate([$column => $value], [$relatedColumn => $relatedValue]);

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
