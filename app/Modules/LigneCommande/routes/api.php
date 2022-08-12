<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\LigneCommande\Http\Controllers\LigneCommandeController;


Route::group([
    'prefix' => 'api/ligneCommandes'

], function ($router) {
    Route::get('/', [LigneCommandeController::class, 'index']);
    Route::get('/{id}', [LigneCommandeController::class, 'get']);
    Route::post('/create', [LigneCommandeController::class, 'create']);
    Route::post('/update', [LigneCommandeController::class, 'update']);
    Route::post('/delete', [LigneCommandeController::class, 'delete']);

});
