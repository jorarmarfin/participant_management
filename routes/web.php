<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/participants', function () {
        return view('participant');
    })->name('participants');

    Route::get('/events', function () {
        return view('events.index');
    })->name('events');

    Route::get('/events-details/{event_id}', function () {
        return view('events.details',[
            'event_id' => request()->event_id
        ]);
    })->name('events.details');

});

Route::get('/form/{event_id}', function () {
    return view('form.form-web', [
        'event_id' => request()->event_id
    ]);
})->name('form.web');
