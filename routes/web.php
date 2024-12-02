<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;


Route::get('/', function () {
    return view('welcome');
});
// Route::get('/file/create', [FileController::class, 'create'])->name('file.create');
// Route::post('/file/store', [FileController::class, 'store'])->name('file.store');
Route::get('files', [FileController::class, 'index'])->name('files.index');
Route::get('files/create', [FileController::class, 'create'])->name('files.create');
Route::post('files', [FileController::class, 'store'])->name('files.store');
Route::get('files/{id}/edit', [FileController::class, 'edit'])->name('files.edit');
Route::put('files/{id}', [FileController::class, 'update'])->name('files.update');
Route::delete('files/{id}', [FileController::class, 'destroy'])->name('files.destroy');


