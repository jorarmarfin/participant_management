<?php

use App\Http\Controllers\Admin\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('token',[ApiController::class,'getToken'])
    ->name('api.token');

Route::middleware('auth:sanctum')->group(function () {

    Route::post('add-participant-signature', [ApiController::class, 'addParticipantSignature']);

});
