<?php

namespace App\PSGC;

use Illuminate\Support\Facades\Cache;

class GeographicCacheService implements GeographicContract
{
    protected $geographicContract;

    public function __construct(GeographicContract $geographicContract)
    {
        $this->geographicContract = $geographicContract;
    }

    public function getGeoList($geoName)
    {
        return Cache::remember(
            "geocodes-list.{$geoName}", 5800,
            function () use ($geoName) {
                return $this->geographicContract
                    ->getGeoList($geoName);
            }
        );
    }

    public function getGeoByCodeList($geoName, $geoCode, $toGeoName)
    {
        return Cache::remember(
            "geocodes-list-by-code.{$geoName}.{$geoCode}.{$toGeoName}", 5800,
            function () use ($geoName, $geoCode, $toGeoName) {
                return $this->geographicContract
                    ->getGeoByCodeList($geoName, $geoCode, $toGeoName);
            }
        );
    }

    public function getGeoDetail($geoName, $geoCode)
    {
        return Cache::remember(
            "geocodes-detail.{$geoName}.{$geoCode}", 5800,
            function () use ($geoName, $geoCode) {
                return $this->geographicContract
                    ->getGeoDetail($geoName, $geoCode);
            }
        );
    }
}
