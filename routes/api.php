<?php

use App\Http\Controllers\API\SpamFilterController;
use App\Http\Controllers\API\ZipCodeController;
use Illuminate\Support\Facades\Route;

Route::controller(ZipCodeController::class)
    ->prefix('zipcode')
    ->group(function () {
        Route::get('/', 'index');
    });

Route::controller(SpamFilterController::class)
    ->prefix('spam-filter')
    ->group(function(){
        Route::post('message', 'filterMessage');
    });
