<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Offre;

class ClientService
{

    public function countClientsByOffreAndSegment($offreType, $segmentLibelles)
    {
        return Client::whereHas('offres', function ($query) use ($offreType) {
            $query->where('type', $offreType);
        })->whereHas('segment', function ($query) use ($segmentLibelles) {
            $query->whereIn('libelle', $segmentLibelles);
        })->count();
    }
    public function countClientsByOffreAdslAndSegment($offreAdslType, $segmentLibelles)
    {
        return Client::whereHas('offreAdsl', function ($query) use ($offreAdslType) {
            $query->where('type', $offreAdslType);
        })->whereHas('segment', function ($query) use ($segmentLibelles) {
            $query->whereIn('libelle', $segmentLibelles);
        })->count();
    }
    public function countClientsByVoixFixeAndSegment($voixFixeType, $segmentLibelles)
    {
        return Client::whereHas('voixFixes', function ($query) use ($voixFixeType) {
            $query->where('libelle', $voixFixeType);
        })->whereHas('segment', function ($query) use ($segmentLibelles) {
            $query->whereIn('libelle', $segmentLibelles);
        })->count();
    }
    public function getTabLibelleSohos(): array
    {
        return [
            'SOHO', 'OBO', 'PPR', 'SGM', 'TPE', 'VPP3', 'SOH', 'PROS PRESTIGES', 'PRO', 'VPP', 'VPP2', 'STARTUP', 'TAM'
        ];
    }

    public function getTabLibellePmePmi(): array
    {
        return ['ORG', 'PEI', 'PEI2', 'PME/PMI', 'ORGANISME'];
    }

    public function getTabLibelleParticulier(): array
    {
        return ['PA1', 'PA2', 'PA3', 'VIP', 'PARTICULIER 2', 'PARTICULIER 1'];
    }

    public function getTabLibelleDVPS(): array
    {
        return ['SOHO', 'OBO', 'PPR', 'SGM', 'TPE', 'VPP3', 'SOH', 'PROS PRESTIGES', 'PRO', 'VPP', 'VPP2', 'STARTUP', 'TAM',
            'ORG', 'PEI', 'PEI2', 'PME/PMI', 'ORGANISME','PA1', 'PA2', 'PA3', 'VIP', 'PARTICULIER 2', 'PARTICULIER 1'];
    }

    public function getTabLibelleDVEI(): array
    {
        return ['ADMINISTRATION', 'COP', 'ETA', 'FONCTIONNAIRE', 'ETAT', 'COLLECTIVITES PUBLIQUES', 'EGO','GRANDS COMPTES'];
    }

    public function getTabLibelleEtat(): array
    {
        return ['ADMINISTRATION', 'COP', 'ETA', 'FONCTIONNAIRE', 'ETAT', 'COLLECTIVITES PUBLIQUES', 'EGO'];
    }

    public function getTabLibelleGC(): array
    {
        return ['GRANDS COMPTES'];
    }

    public function countClientsByOffreFibreGlobal($offres, $offreType)
    {
        return Client::whereHas($offres, function ($query) use ($offreType) {
            $query->where('type', $offreType);
        })->count();
    }
    public function countClientsByOffreVoixFixeGlobal($offres, $offreType)
    {
        return Client::whereHas($offres, function ($query) use ($offreType) {
            $query->where('libelle', $offreType);
        })->count();
    }

    public function countClientsByOffres($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreFibreGlobal('offres', $offreType);
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffreAdsls($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreFibreGlobal('offreAdsl', $offreType);
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffreVoixFixe($offres)
    {
        $offreTypes = $offres->pluck('libelle')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreVoixFixeGlobal('voixFixes', $offreType);
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }

    public function countClientsByOffresAndSegmentDVEI($offres)
    {
        $offreTypes = $offres->pluck('libelle')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByVoixFixeAndSegment($offreType, $this->getTabLibelleDVEI());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffresAndSegmentDVPS($offres)
    {
        $offreTypes = $offres->pluck('libelle')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByVoixFixeAndSegment($offreType, $this->getTabLibelleDVPS());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffresAndSegmentSoho($offres)
    {
        $offreTypes = $offres->pluck('libelle')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByVoixFixeAndSegment($offreType, $this->getTabLibelleSohos());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffresAndSegmentPmePMi($offres)
    {
        $offreTypes = $offres->pluck('libelle')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByVoixFixeAndSegment($offreType, $this->getTabLibellePmePmi());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffresAndSegmentParticulier($offres)
    {
        $offreTypes = $offres->pluck('libelle')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByVoixFixeAndSegment($offreType, $this->getTabLibelleParticulier());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffresAndSegmentEtat($offres)
    {
        $offreTypes = $offres->pluck('libelle')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByVoixFixeAndSegment($offreType, $this->getTabLibelleEtat());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffresAndSegmentGc($offres)
    {
        $offreTypes = $offres->pluck('libelle')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByVoixFixeAndSegment($offreType, $this->getTabLibelleGC());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }

    public function countClientsByOffresTypeAndSegmentDVEI($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAdslAndSegment($offreType, $this->getTabLibelleDVEI());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffresTypeAndSegmentDVPS($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAdslAndSegment($offreType, $this->getTabLibelleDVPS());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffresTypeAndSegmentSoho($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAdslAndSegment($offreType, $this->getTabLibelleSohos());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffresTypeAndSegmentPmePmi($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAdslAndSegment($offreType, $this->getTabLibellePmePmi());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffresTypeAndSegmentParticulier($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAdslAndSegment($offreType, $this->getTabLibelleParticulier());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffresTypeAndSegmentEtat($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAdslAndSegment($offreType, $this->getTabLibelleEtat());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffresTypeAndSegmentGC($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAdslAndSegment($offreType, $this->getTabLibelleGC());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffreFibreAndSegmentDVEI($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAndSegment($offreType, $this->getTabLibelleDVEI());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffreFibreAndSegmentDVPS($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAndSegment($offreType, $this->getTabLibelleDVPS());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffreFibreAndSegmentSoho($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAndSegment($offreType, $this->getTabLibelleSohos());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffreFibreAndSegmentPmePmi($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAndSegment($offreType, $this->getTabLibellePmePmi());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffreFibreAndSegmentParticulier($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAndSegment($offreType, $this->getTabLibelleParticulier());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffreFibreAndSegmentEtat($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAndSegment($offreType, $this->getTabLibelleEtat());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }
    public function countClientsByOffreFibreAndSegmentGC($offres)
    {
        $offreTypes = $offres->pluck('type')->toArray();
        $counts = array_reduce($offreTypes, function ($result, $offreType) {
            $count = $this->countClientsByOffreAndSegment($offreType, $this->getTabLibelleGC());
            $result[$offreType] = $count;
            return $result;
        }, []);

        return $counts;
    }

}
