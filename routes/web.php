<?php

use App\Http\Controllers\RecordController;
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

Route::get('/', [RecordController::class, 'index'])->name('record.index');
Route::post('/', [RecordController::class, 'store'])->name('record.store');
Route::get('/record/new', [RecordController::class, 'create'])->name('record.create');
Route::get('/{record}', [RecordController::class, 'show'])->name('record.view');
Route::patch('/{record}', [RecordController::class, 'update'])->name('record.update');
Route::delete('/{record}', [RecordController::class, 'destroy'])->name('record.delete');
Route::delete('/', [RecordController::class, 'destroy'])->name('record.delete-all');

