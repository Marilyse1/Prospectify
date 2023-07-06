<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProspectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route d'authentification
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // Route pour la page d'accueil après l'authentification
    Route::get('/home', [HomeController::class, 'index'])->name('homel');

    // Routes pour la gestion des prospects
    Route::get('/', [ProspectController::class, 'index'])->name('home');
    Route::post('/', [ProspectController::class, 'store'])->name('prospects.store');
    Route::put('/home/{id}', [ProspectController::class, 'update'])->name('prospect_update');
    Route::delete('/home/{id}', [ProspectController::class, 'destroy'])->name('prospect_destroy');

    // Routes pour la génération de rapports/synthèses
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/filter', [ReportController::class, 'filter'])->name('reports.filter');
    Route::post('/reports/export', [ReportController::class, 'export'])->name('reports.export');
});

