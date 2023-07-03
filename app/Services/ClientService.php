<?php

namespace App\Services;

use App\Models\Client;

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

    public function countClientsByOffreAndSegmentGlobal($offres, $offreType)
    {
        return Client::whereHas($offres, function ($query) use ($offreType) {
            $query->where('type', $offreType);
        })->count();
    }
    public function countClientsByOffreAndSegmentVoixFixeGlobal($offres, $offreType)
    {
        return Client::whereHas($offres, function ($query) use ($offreType) {
            $query->where('libelle', $offreType);
        })->count();
    }

}
