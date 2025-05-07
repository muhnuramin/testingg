<?php

use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::resource('produk', ProdukController::class);
Route::post('produk/search', [ProdukController::class, 'search'])->name('produk.search');
