<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BukberController;

Route::get('/', [BukberController::class, 'index']);
Route::post('/rsvp', [BukberController::class, 'store'])->name('rsvp.store');
Route::get('/admin-izzatishot', [BukberController::class, 'admin']); // Ganti URL ini agar rahasia