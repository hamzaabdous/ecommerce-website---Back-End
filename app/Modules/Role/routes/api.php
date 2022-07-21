<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Role\Http\Controllers\RoleController;

Route::group([
    'prefix' => 'api/role'

], function ($router) {
    Route::get('/', [RoleController::class, 'index']);
    Route::get('/{id}', [RoleController::class, 'get']);
    Route::post('/create', [RoleController::class, 'create']);
    Route::post('/update', [RoleController::class, 'update']);
    Route::post('/delete', [RoleController::class, 'delete']);

});
