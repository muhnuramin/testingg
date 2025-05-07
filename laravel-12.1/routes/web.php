<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard'); // Ganti sesuai dashboard kamu
})->middleware('guest');


Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/add-produk',[ProdukController::class, 'store'])->name('add.produk');
    Route::put('/update-produk/{id}',[ProdukController::class, 'update'])->name('update.produk');
    Route::delete('/delete-produk/{id}',[ProdukController::class, 'destroy'])->name('delete.produk');
});

require __DIR__.'/auth.php';
