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

    Route::get('/getProduitsByPanier/{id}', [PanierController::class, 'getProduitsByPanier']);
    Route::get('/getProduitsByUser/{id}', [PanierController::class, 'getProduitsByUser']);
    Route::get('/makePanierEmptyByUser/{id}', [PanierController::class, 'makePanierEmptyByUser']);
    Route::post('/addProduitToPanier', [PanierController::class, 'addProduitToPanier']);
    Route::post('/deleteProduitFromPanier', [PanierController::class, 'deleteProduitFromPanier']);

});
