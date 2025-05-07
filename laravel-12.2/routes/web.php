<?php

use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProdukController::class,'index'])->name('index');
Route::get('/add-produk',[ProdukController::class,'create'])->name('add');
Route::post('/add-produk/add',[ProdukController::class,'store'])->name('add.produk');
Route::post('/edit-produk/{id}',[ProdukController::class,'edit'])->name('edit');
Route::put('/edit-produk/{id}',[ProdukController::class,'update'])->name('edit.produk');
Route::delete('/delete-produk/{id}',[ProdukController::class, 'destroy'])->name('delete.produk');