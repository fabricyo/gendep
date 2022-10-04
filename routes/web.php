<?php

use App\Http\Controllers\ItensController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [ItensController::class , 'index'])->name('index');
Route::get('/create', [ItensController::class , 'create'])->name('create');
Route::post('/store', [ItensController::class , 'store'])->name('store');
Route::get('/destroy', [ItensController::class , 'destroy'])->name('destroy');
Route::get('/show', [ItensController::class , 'show'])->name('show');
Route::get('/edit', [ItensController::class , 'edit'])->name('edit');
Route::post('/update', [ItensController::class , 'update'])->name('update');
Route::get('/fluxo', [ItensController::class , 'fluxo'])->name('fluxo');
