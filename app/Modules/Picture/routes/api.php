<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Modules\Picture\Http\Controllers\PictureController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/picture'

], function ($router) {


    Route::post('/photoprofile', [PictureController::class, 'photoprofile']);
    Route::post('/PhotosStoragePath', [PictureController::class, 'PhotosStoragePath']);


});
