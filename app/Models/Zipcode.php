<?php

namespace App\Models;

use App\Models\Filters\CityMunicipalityFilter;
use App\Models\Filters\ZipcodeCityMunicipalityFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Lacodix\LaravelModelFilter\Traits\HasFilters;

class Zipcode extends Model
{
    use HasFilters;
    use HasFactory;

    protected $fillable = [
        'region',
        'provinces',
        'city_municipality',
        'zip_code',
    ];

    protected $filters =[
        CityMunicipalityFilter::class
    ];
}
