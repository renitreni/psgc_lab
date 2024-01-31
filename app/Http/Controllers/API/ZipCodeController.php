<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ZipCodeRequest;
use App\Http\Resources\ZipcodeResource;
use App\Models\Zipcode;
use Illuminate\Support\Facades\Cache;

class ZipCodeController extends Controller
{
    public function index(ZipCodeRequest $request)
    {
        $param = $request->validated();

        $result = Cache::remember('zipcode_index_'.$param['search'], 10080, function () use ($param) {
            return Zipcode::filter(['city_municipality_filter' => $param['search']])->get();
        });

        return ZipcodeResource::collection($result);
    }
}
