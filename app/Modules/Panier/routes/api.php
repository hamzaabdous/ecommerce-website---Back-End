<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Modules\Panier\Http\Controllers\PanierController;

Route::group([
    'prefix' => 'api/paniers'

], function ($router) {
    Route::get('/', [PanierController::class, 'index']);
    Route::get('/{id}', [PanierController::class, 'get']);
    Route::post('/create', [PanierController::class, 'create']);
    Route::post('/update', [PanierController::class, 'update']);
    Route::post('/delete', [PanierController::class, 'delete']);

});
