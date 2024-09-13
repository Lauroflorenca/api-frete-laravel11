<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViagemController;


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth:api');


Route::middleware('auth:api')->group(function () {
    Route::get('/viagens', [ViagemController::class, 'index']);
    Route::get('/viagens/{id}', [ViagemController::class, 'show']);
});


Route::apiResource('checkpoints', CheckpointController::class)->middleware('auth:api');
Route::put('/checkpoints/{id}/chegada', [CheckpointController::class, 'updateChegada'])
    ->middleware('auth:api');
