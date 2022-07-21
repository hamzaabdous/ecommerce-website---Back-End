<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Categorie\Http\Controllers\CategorieController;


Route::group([
    'prefix' => 'api/categories'

], function ($router) {
    Route::get('/', [CategorieController::class, 'index']);
    Route::get('/{id}', [CategorieController::class, 'get']);
    Route::post('/create', [CategorieController::class, 'create']);
    Route::post('/update', [CategorieController::class, 'update']);
    Route::post('/delete', [CategorieController::class, 'delete']);

});
