<?php

use App\Http\Controllers\LoteController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Hola');
});

Route::middleware('auth')->group(function(){
    Route::resource('lote', LoteController::class)->except('show');
    Route::resource('seller', SellerController::class)->except('show');
});


require __DIR__.'/auth.php';