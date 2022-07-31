<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Facture\Http\Controllers\FactureController;


Route::group([
    'prefix' => 'api/factures'

], function ($router) {
    Route::get('/', [FactureController::class, 'index']);
    Route::get('/{id}', [FactureController::class, 'get']);
    Route::post('/create', [FactureController::class, 'create']);
    Route::post('/update', [FactureController::class, 'update']);
    Route::post('/delete', [FactureController::class, 'delete']);

});
