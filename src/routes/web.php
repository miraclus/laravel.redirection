<?php

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('link')->group(function (){
    Route::post('/save', [\App\Http\Controllers\LinkController::class, 'save'])->name('link.save');
    Route::get('/redirect/{url}', [\App\Http\Controllers\LinkController::class, 'redirect'])->name('link.redirect');
    Route::get('/all', [\App\Http\Controllers\LinkController::class, 'showAll'])->name('link.all');
});

