<?php

use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\TypeProduitController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VenteController;
use App\Http\Controllers\Admin\ClientController;




// Route pour authentification
Route::middleware('guest')->group(function () {


    Route::get('/register', function () {
        abort(404);
    });

    Route::post('/register', function () {
        abort(404);
    });



});

// Route pour les utilisateurs simples

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/produit/{id}/details', [HomeController::class, 'getProductDetails']);

// Tous les produits (pages)
Route::get('/produits/tous', [HomeController::class, 'allProducts'])->name('products.all');
Route::get('/produits/tous/ajax', [HomeController::class, 'allProducts'])->name('products.all.ajax');

// Route protégée

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route pour l'administrateur

    Route::get('/admin_garage/kengen', [AdminController::class, 'home'])->name('home.admin');

    // Routes pour les types de produits
    Route::resource('type_produits', TypeProduitController::class);

    // Routes pour les produits
    Route::resource('produits', ProduitController::class);

    Route::get('/produits/search', [ProduitController::class, 'search'])->name('produits.search');

    // Routes supplémentaires
    Route::get('/produits/search', [ProduitController::class, 'search'])->name('produits.search');
    Route::get('/produits/export', [ProduitController::class, 'export'])->name('produits.export');



    //Routes pour la gestion des ventes

        Route::resource('ventes', VenteController::class);
Route::post('ventes/{vente}/annuler', [VenteController::class, 'annuler'])
     ->name('ventes.annuler');

    Route::get('ventes/{vente}/imprimer', [VenteController::class, 'imprimer'])->name('ventes.imprimer');
    Route::get('ventes/search/produits', [VenteController::class, 'searchProduits'])->name('ventes.search.produits');
    Route::get('ventes/search/clients', [VenteController::class, 'searchClients'])->name('ventes.search.clients');

    // Clients
    Route::resource('clients', ClientController::class)->only(['index', 'store']);
    Route::post('clients/rapide', [ClientController::class, 'storeRapide'])->name('clients.rapide.store');

        // Routes principales

    // Routes de recherche (AJAX)
    Route::get('ventes/search/produits', [VenteController::class, 'searchProduits'])->name('ventes.search.produits');
    Route::get('ventes/search/clients', [VenteController::class, 'searchClients'])->name('ventes.search.clients');
    Route::get('ventes/chart/data', [VenteController::class, 'getChartDataApi'])->name('ventes.chart.data');

    // Routes d'export
    Route::get('ventes/export/csv', [VenteController::class, 'exportCsv'])->name('ventes.export.csv');

    // Dashboard
    Route::get('ventes/dashboard', [VenteController::class, 'dashboard'])->name('ventes.dashboard');

});
