<?php

use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\TypeProduitController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

});
