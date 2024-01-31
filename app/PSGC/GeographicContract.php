<?php

namespace App\PSGC;

interface GeographicContract
{
    public function getGeoDetail($geoName, $geoCode);

    public function getGeoList($geoName);

    public function getGeoByCodeList($geoName, $geoCode, $toGeoName);
}
