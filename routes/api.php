<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\ProdutoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/lojas', [LojaController::class, 'index'])->name('lojas.index');
Route::post('/lojas-store', [LojaController::class, 'store'])->name('lojas.store');
Route::get('/lojas-show/{id}', [LojaController::class, 'show'])->name('lojas.show');
Route::put('/lojas-update/{id}', [LojaController::class, 'update'])->name('lojas.update');
Route::delete('/lojas-delete/{id}', [LojaController::class, 'destroy'])->name('lojas.destroy');

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::post('/produtos-store', [ProdutoController::class, 'store'])->name('produtos.store');
Route::get('/produtos-show/{id}', [ProdutoController::class, 'show'])->name('produtos.show');
Route::put('/produtos-update/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
Route::delete('/produtos-delete/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');