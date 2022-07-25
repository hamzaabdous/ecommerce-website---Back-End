<?php

use App\Http\Controllers\CommandeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'api/commande'

], function ($router) {
    Route::get('/', [CommandeController::class, 'index']);
    Route::get('/{id}', [CommandeController::class, 'get']);
    Route::post('/create', [CommandeController::class, 'create']);
    Route::post('/update', [CommandeController::class, 'update']);
    Route::post('/delete', [CommandeController::class, 'delete']);

});


