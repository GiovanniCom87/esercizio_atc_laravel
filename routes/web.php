<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PublicController::class, 'index'])->name('index');
Route::post('/filter', [PublicController::class, 'filter'])->name('filter');
