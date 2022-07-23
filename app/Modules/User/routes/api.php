<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Modules\User\Http\Controllers\UserController;

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/users'

], function ($router) {
    Route::post('/logout', [UserController::class, 'logout']);
});


Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/users'

], function ($router) {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'get']);
    Route::get('/getUsersProduit/{id}', [UserController::class, 'getUsersProduit']);
    Route::post('/create', [UserController::class, 'create']);
    Route::post('/update', [UserController::class, 'update']);
    Route::post('/delete', [UserController::class, 'delete']);

});


Route::group([
    'middleware' => 'api',
    'prefix' => 'api/users'

], function ($router) {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'create']);


});
