<?php

namespace App\PSGC;

use Illuminate\Support\Facades\Http;

class GeographicService implements GeographicContract
{
    protected $url = 'https://psgc.gitlab.io/api';

    public function getGeoDetail($geoName, $geoCode)
    {
        return Http::get("$this->url/{$geoName}/{$geoCode}")->json();
    }

    public function getGeoList($geoName)
    {
        return Http::get("$this->url/{$geoName}")->json();
    }

    public function getGeoByCodeList($geoName, $geoCode, $toGeoName)
    {
        return Http::get("$this->url/{$geoName}/{$geoCode}/{$toGeoName}")->json();
    }
}
