<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientCommune;
use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClientCommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cacheKey = 'clients_data';
        $cacheDuration = 60; // Durée de mise en cache en minutes

        $clientsCommune = Cache::remember($cacheKey, $cacheDuration, function () {

            //Clents by communes
            $dakar = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', [
                    'BOPP', 'CAMBERENE-PARCELLES ASSAINIES', 'CENTENAIRE - GIBRALTAR', 'CASTORS - DERKLE',
                    'COLOBANE','DIAMNIADIO', 'FANN', 'FANN HOCK', 'FASS', 'FASS MBAO', 'FOIRE', 'G1-DAKAR','G1-DAKAR MEDINA','G1-RUFISQUE','G1-GUEDIAWAYE PIKINE',
                    'GRAND DAKAR - USINE','GUEDIAWAYE', 'GRAND YOFF','GUELE TAPEE','H.L.M. - CITE PORT - SODIDA', 'HANN', 'ILE DE GOREE','HLM PATTE D OIE',
                    'KEUR MASSAR','KEUR MBAYE FALL','MBAO','MEDINA', 'NGOR - ALMADIES', 'NORD LIBERTE 6', 'OUAGOU NIAYES', 'OUAKAM',
                    'PATTE D OIE BUILDERS - SOPRIM', 'POINT E','POSTE DAKAR - RP','POSTCHANCE DAKAR-RP','POSTCHANCE PARCELLES-ASSAINIES','POSTE BARGNY','POSTCHANCE SOUMBEDIOUNE',
                    'POSTE MEDINA GOUNASS','POSTE DAKAR-FANN','POSTE DAKAR-LIBERTE','POSTE DAKAR-PONTY','POSTE DAKAR-PEYTAVIN','POSTE DAKAR-HLM 5','POSTE DAKAR-YOFF','POSTE DAKAR-GRAND YOFF',
                    'POSTE DAKAR-MEDINA','POSTE DAKAR VDN','POSTE DAKAR-COLOBANE','POSTE PARCELLES-ASSAINIES','POSTE PARCELLES ASSAINIES','POSTE RUFISQUE','POSTE THIAROYE','POSTE SEBIKHOTANE','SEBIKHOTANE','SANGALKAM',
                    'PIKINE','RUFISQUE','SICAP','SICAP MBAO', 'THIAROYE','THIAROYE SUR MER','THIAROYE AZUR', 'YEUMBEUL','YOFF','ZONE A - ZONE B','ZONE FRANCHE INDUSTRIELLE', 'ZONE INDUSTRIELLE','ZONE PORTUAIRE','BAMBYLORE - GOROM - BAYAKH',
                    'BARGNY','DIAMAGUENE - DIACKSAO','DIAMNIADIO','MALIKA','MERMOZ','NIAGA - NIACOURAB','RUFUSQUE_DIAMNIADIO','ROSSO SENEGAL_COMMUNE','YENN-NIANGHAL-TOUBAB DIALAO'])
                ->count();
            $diourbel = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['DIOURBEL', 'DIOURBEL_NDOULO','DIOURBEL_NDINDY','BAMBEY','BAMBEY_NGOYE','BAMBEY_BABA GARAGE','BAMBEY_LAMBAYE',
                    'DAROU MOUSTY','DAROU KHOUDOSS','TOUBA MOSQUEE','MBACKE_NDAME','MBACKE_TAIF','MBACKE_KAEL','MADYANA','NDAME MBACKE',
                    'POSTE TOUBA'])
                ->count();

            $fatick = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['FATICK','DIOFFIOR','POSTE FIMELA','FATICK_FIMELA','FATICK_TATTAGUINE','FATICK_DIAKHAO','FATICK_NIAKHAR',
                    'FOUNDIOUGNE','FOUNDIOUGNE_TOUBACOUTA','FOUNDIOUGNE_NIODIOR','FOUNDIOUGNE_DJILOR','GOSSAS','GOSSAS_COLOBANE','GOSSAS_MBADAKHOUME','GOSSAS_OUADIOUR',
                    'NIAKHAR','PASSY','POSTE FIMELA','SOKONE','TOUBACOUTA'])
                ->count();
            $kaolack = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['KAOLACK','GANDIAYE','GUINGUENEO','KAHONE','KAOLACK_SIBASSOR','KAOLACK_NDIEDIENG','KAOLACK_KOUMBALE',
                    'NDOFFANE','NIORO','NIORO_PAOSKOTO','NIORO_WACK NGOUNA','NIORO_MEDINA SABAKH','SIBASSOR'])
                ->count();
            $kaffrine = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['KAFFRINE','KAFFRINE_BIRKELANE','KAFFRINE_NGANDA','KAFFRINE_MAKA YOB','KAFFRINE_MALEM HODAR','KOUNGHEUL',])
                ->count();
            $kedougou = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->where('communes.libelle', ['KEDOUGOU', 'KEDOUGOU_BANDAFASSI', 'KEDOUGOU_SARAYA', 'KEDOUGOU_SALEMATA','KEDOUGOU_FONGOLIMBI',])
                ->count();
            $kolda = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['KOLDA', 'KOLDA_DIOULACOLON', 'KOLDA_MEDINA YORO FOULAH', 'KOLDA_DABO'])
                ->count();
            $louga = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['LOUGA', 'LOUGA_SAKAL', 'LOUGA_COKI','LOUGA_MBEDIENE','LOUGA_KEUR MOMAR SARR','LINGUERE',
                    'LINGUERE_BARKEDJI','LINGUERE_SAGATTA DJOLOFF','LINGUERE_YANG YANG','LINGUERE_DODJI','DAHRA','KEBEMER',
                    'KEBEMER_SAGATTA','KEBEMER_DAROU MOUSTY','KEBEMER_NDANDE','KEBEMER_GEOUL','POSTE GUEOUL'])
                ->count();
            $matam = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['MATAM','MATAM_AGNAM CIVOL','MATAM_OGO','KANEL_SINTHIOU BAMAMBE','KANEL_COMMUNE','KANEL_ORKADIERE',
                    'OUROSSOGUI_COMMUNE','RANEROU_COMMUNE','VELINGARA','VELINGARA_BONCONTO','VELINGARA_KOUNKANE','VELINGARA_PAKOUR',
                    'RANEROU FERLO_VELINGARA','RANEROU_COMMUNE','SEMME_COMMUNE','WAOUNDE_COMMUNE'])
                ->count();

            $saintLouis = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['SAINT LOUIS','SAINT LOUIS_NGALLELE','SAINT LOUIS_RAO','DAGANA','DAGANA_ROSS BETHIO','DAGANA_MBANE','NDIOUM_COMMUNE','PODOR','PODOR_SALDE',
                    'PODOR_GAMADJI SARRE','PODOR_CAS CAS','PODOR_THILLE BOUBACAR','POSTE ROSS BETHIO','POSTE SAINT LOUIS SOR','RICHARD TOLL',''])
                ->count();
            $sedhiou = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['SEDHIOU','SEDHIOU_BOUNKILING','SEDHIOU_DIATTACOUNDA','SEDHIOU_TANAFF','SEDHIOU_DIENDE','SEDHIOU_DJIBABOUYA',
                    'GOUDOMP_COMMUNE','MARSASSOUM_COMMUNE'])
                ->count();
            $tambacounda = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['BAKEL_COMMUNE', 'BAKEL_KIDIRA', 'BAKEL_DIAWARA', 'BAKEL_MOUDERY', 'BAKEL_GOUDIRY','BAKEL_BALA', 'BAKEL_KENIEBA',
                    'TAMBACOUNDA', 'TAMBACOUNDA_KOUMPENTOUM', 'TAMBACOUNDA_MISSIRAH', 'TAMBACOUNDA_KOUSSANAR','TAMBACOUNDA_MAKACOULIBANTANG',
                    'POSTE TAMBACOUNDA'])
                ->count();
            $thies = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['THIES','THIES_TIENABA','THIES_PIRE','THIES_KEUR MOUSSA','THIES_NOTTO','MEKHE', 'KAYAR','TIVAOUANE',
                    'TIVAOUANE_MERINA DAKHAR','TIVAOUANE_MEOUANE', 'TIVAOUANE_PAMBAL','TIVAOUANE_PEULH','TIVAOUANE_MEKHE','TIVAOUANE_NIAKHENE', 'POUT',
                    'JOAL-FADIOUTH_COMMUNE','POSTE JOAL','POSTE MBOUR VILLE','POSTE NGAPAROU','MBOUR','MBOUR_SINDIA','MBOUR_SESSENE','MBOUR_FISSEL','KHOMBOLE','MBORO','NGUEKHOKH_COMMUNE',
                    'POSTE POPENGUINE','POSTE POPONGUINE','POSTE SALY','POSTE THIES ESCALE','THIADIAYE_COMMUNE'])
                ->count();

            $ziguinchor = Client::join('client_commune as cc1', 'clients.id', '=', 'cc1.client_id')
                ->join('communes', 'cc1.commune_id', '=', 'communes.id')
                ->whereIn('communes.libelle', ['ZIGUINCHOR','ZIGUINCHOR_NIASSIA','ZIGUINCHOR_NIAGUIS','',
                    'BIGNONA_COMMUNE','BIGNONA_SINDIAN','BIGNONA_DIOULOULOU','BIGNONA_TENDOUCK','BIGNONA_TENGHORY','THIONCK ESSYL',
                    'OUSSOUYE','OUSSOUYE_KABROUSSE','OUSSOUYE_LOUDIA OUOLOFF','POSTE CABROUSSE'])
                ->count();



            return [Commune::with(['clients'])->orderBy('created_at', 'desc')->paginate(10),
                'diourbel' => $diourbel, 'kaolack' => $kaolack, 'dakar' => $dakar, 'fatick' => $fatick,
                'kaffrine' => $kaffrine,'kédougou' => $kedougou,'kolda' => $kolda, 'louga' =>$louga,'matam'=>$matam,
                'saint-louis' => $saintLouis, 'sédhiou'=> $sedhiou, 'tambacounda' =>$tambacounda, 'thiès' =>$thies,
                'ziguinchor' =>$ziguinchor,
            ];
        });

        return response()->json($clientsCommune, 200);

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
        //
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
