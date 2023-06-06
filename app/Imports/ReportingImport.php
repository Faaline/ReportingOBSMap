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
        $model = $modelClass::where($column, $value)->first();
        //dd($model[$column]);
         if($model === null){
             $model = $modelClass::firstOrCreate([
                 $column => '',
             ]);
         }
         if(!$model){
             $model = $modelClass::firstOrCreate([
                 $column => $value,
             ]);
         }
        return $model;
    }
    private function getOrCreateModel2($modelClass, $column1,$value1, $column2,$value2)
    {
        $model = $modelClass::where($column1, $value1)->first();
        //dd($model);
         if($model === null){
             $model = $modelClass::firstOrCreate([
                 $column1 => '',
                 $column2 => $value2
             ]);
         }
         if(!$model){
             $model = $modelClass::firstOrCreate([
                 $column1 => $value1,
                 $column1 => $value2
             ]);
         }
        return $model;
    }
    public function model(array $client)
    {
        $client = array_filter($client, function ($key) {
            return !is_int($key) || $key < 26 || $key > 45;
        }, ARRAY_FILTER_USE_KEY);
        // Récupérer la valeur de date sous forme de nombre
        $dateMsvNumeric = $client['date_msv'];
        // Convertir le nombre en date PHP valide
        $dateMsv = Carbon::createFromFormat('d/m/y', $dateMsvNumeric)->format('y/m/d');
        //dd($dateMsv->date);
        $dateMsAcNumeric = $client['datms_ac'];
        // Convertir le nombre en date PHP valide
        $dateMsAc = Carbon::createFromFormat('d/m/y', $dateMsvNumeric)->format('Y-m-d');
        $statut = $this->getOrCreateModel(Statut::class, 'libelle', $client['statut']);
        $adsl = $this->getOrCreateModel(Adsl::class, 'type', $client['adsl']);
        $offre = $this->getOrCreateModel(Offre::class, 'type', $client['offre_fibre']);
        //dd($offre);
        $commune = $this->getOrCreateModel(Commune::class, 'libelle', $client['commune']);
        $repart = $this->getOrCreateModel(Repart::class, 'libelle', $client['repart']);
        $agence = $this->getOrCreateModel(Agence::class, 'libelle', $client['agence']);
        $accesReseau = $this->getOrCreateModel(AccesReseau::class, 'libelle', $client['acces_reseau']);
        $offreAdsl = $this->getOrCreateModel(OffreAdsl::class, 'type', $client['offre_adsl']);
        $categorie = $this->getOrCreateModel(Categorie::class, 'libelle', $client['categorie']);
        $fibre = $this->getOrCreateModel(Fibre::class, 'type', $client['fibre']);

        //dd($client['offre_adsl']);
        $segmentMarche = $this->getOrCreateModel(SegmentMarche::class, 'libelle', $client['segment_marche']);
        //dd($segmentMarche);
        $segment = new Segment();
        $segment->libelle = $client['segment'];
        $segment->segmentmarche_id = $segmentMarche->id;
        $segment->save();

        //dd($client);

        //$segmentMarche = $this->getOrCreateModel(SegmentMarche::class, 'libelle', $client['segment_marche']);
        $voixfixe = $this->getOrCreateModel2(VoixFixe::class, 'libelle', $client['voix_fixe'], 'acces_reseau_id', $accesReseau->id);
        //dd($voixfixe->libelle);
        //$voixfixe = new VoixFixe();
        //$voixfixe->libelle = $client['voix_fixe'];
        //dd($voixfixe);
        //$voixfixe->acces_reseau_id = $accesReseau->id;
        $voixfixe->save();

        $offreCell = $client['offre_fibre'];
        $spreadsheet = IOFactory::load(request()->file('fileupload'));
        $worksheet = $spreadsheet->getActiveSheet();

        // Extract the first cell from the range
        preg_match('/[A-Z]+\d+/', $offreCell, $matches);
        //$cell = $matches[0];

        //$offreValue = $worksheet->getCell($cell)->getCalculatedValue();

        // Retrieve the corresponding Offre based on the Fibre association
        //$fibre = Fibre::where('type', $offreValue)->first();
        ++self::$rows;
        $client = new Client([
            'ncli'=> $client['ncli'],
            'ndos'=> $client['ndos'],
            'produit'=> $client['produit'],
            'nd'=> $client['nd'],
            'bouquet_tv'=> $client['bouquet_tv'],
            'service_fal'=> $client['service_fal'],
            'statut_id'=> $statut->id,
            'nd_smm'=> $client['nd_smm'],
            'login_smm'=> $client['login_smm'],
            'code_por'=> $client['code_por'],
            'date_msv'=> $dateMsv,
            'datms_ac'=> $dateMsAc,
            'prenom'=> $client['prenom'],
            'nom'=> $client['nom'],
            'categorie_id' => $categorie->id,
            'contact_mob' => $client['contact_mob'],
            'contact_email' => $client['contact_email'],
            'segment_id' => $segment->id,
        ]);

        $client->save();

        //insertion dans ClientOffre
        $clientOffre = new ClientOffre([
            'client_id' => $client->id,
            'offre_id' => $offre->id
        ]);
        // Enregistrer l'entrée dans la table d'association
        $clientOffre->save();
        //dd($offreId);

         //insertion dans ClientAdsl
        $clientAdsl = new ClientAdsl([
            'client_id' => $client->id,
            'adsl_id' => $adsl->id
        ]);
        // Enregistrer l'entrée dans la table d'association
        $clientAdsl->save();

        //insertion dans ClientRepart
        $clientRepart = new ClientRepart([
            'client_id' => $client->id,
            'repart_id' => $repart->id
        ]);
        // Enregistrer l'entrée dans la table d'association
        $clientRepart->save();


        //insertion dans ClientCommune
        $clientCommune = new ClientCommune([
            'client_id' => $client->id,
            'commune_id' => $commune->id
        ]);
        // Enregistrer l'entrée dans la table d'association
        $clientCommune->save();

        //insertion dans ClientAgence
        $clientAgence = new ClientAgence([
            'client_id' => $client->id,
            'agence_id' => $agence->id
        ]);
        // Enregistrer l'entrée dans la table d'association
        $clientAgence->save();

        //insertion dans OffreFibre
        $offreFibre = new OffreFibre([
            'offre_id' => $offre->id,
            'fibre_id' => $fibre->id
        ]);
        // Enregistrer l'entrée dans la table d'association
        $offreFibre->save();

        //insertion dans AccesReseauFibre
        $accesReseauFibre = new AccesReseauFibre([
            'acces_reseau_id' => $accesReseau->id,
            'fibre_id' => $fibre->id
        ]);
        // Enregistrer l'entrée dans la table d'association
        $accesReseauFibre->save();

        //insertion dans CommuneRepart
        $communeRepart = new CommuneRepart([
            'commune_id' => $commune->id,
            'repart_id' => $repart->id
        ]);
        // Enregistrer l'entrée dans la table d'association
        $communeRepart->save();

        //insertion dans OffreAdslAdsl
        $OffreAdslAdsl = new OffreAdslAdsl([
            'offre_adsl_id' => $offreAdsl->id,
            'adsl_id' => $adsl->id
        ]);
        // Enregistrer l'entrée dans la table d'association
        $OffreAdslAdsl->save();

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
