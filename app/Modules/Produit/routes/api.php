<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Produit\Http\Controllers\ProduitController;
use App\Modules\Produit\Http\Controllers\scrapingController;


Route::group([
    'prefix' => 'api/produits'

], function ($router) {
    Route::get('/', [ProduitController::class, 'index']);
    Route::get('/{id}', [ProduitController::class, 'get']);
    Route::post('/create', [ProduitController::class, 'create']);
    Route::post('/update', [ProduitController::class, 'update']);
    Route::post('/delete', [ProduitController::class, 'delete']);
    Route::post('/addProduitToPanier', [ProduitController::class, 'addProduitToPanier']);

});

Route::group([
    'prefix' => 'api/scraping'

], function ($router) {
    Route::get('/ebay', [scrapingController::class, 'scrapingFromEbay']);
    Route::post('/jumia', [scrapingController::class, 'scrapingFromJumia']);


});
