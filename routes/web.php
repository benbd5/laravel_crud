<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FilmController;

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

Route::get('/', function () {
    return view('welcome');
});

// Création de toutes les routes du CRUD avec Route::ressource
Route::resource('films', FilmController::class);

// Soft Delete (corbeille)
Route::delete('films/force/{film}', [FilmController::class, 'forceDestroy'])->name('films.force.destroy');
Route::put('films/restore/{film}', [FilmController::class, 'restore'])->name('films.restore');

// Aller chercher les films par catégorie
Route::get('category/{slug}/films', [FilmController::class, 'index'])->name('films.category');
