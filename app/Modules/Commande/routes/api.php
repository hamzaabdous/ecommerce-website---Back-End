<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Commande\Http\Controllers\CommandeController;


Route::group([
    'prefix' => 'api/commandes'

], function ($router) {
    Route::get('/', [CommandeController::class, 'index']);
    Route::get('/{id}', [CommandeController::class, 'get']);
    Route::post('/create', [CommandeController::class, 'create']);
    Route::post('/update', [CommandeController::class, 'update']);
    Route::post('/delete', [CommandeController::class, 'delete']);

});
