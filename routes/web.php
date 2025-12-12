<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TypeProduitController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/produit/{id}/details', [HomeController::class, 'getProductDetails']);


Route::get('/produits/tous', [HomeController::class, 'allProducts'])->name('products.all');
Route::get('/produits/tous/ajax', [HomeController::class, 'allProducts'])->name('products.all.ajax');



Route::get('/admin_garage/kengen', [AdminController::class, 'home'])->name('home.admin');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::resource('type_produits', TypeProduitController::class);
// Routes pour les produits
Route::resource('produits', ProduitController::class);


// Routes supplémentaires
Route::get('/produits/search', [ProduitController::class, 'search'])->name('produits.search');

// Routes supplémentaires
Route::get('/produits/search', [ProduitController::class, 'search'])->name('produits.search');
Route::get('/produits/export', [ProduitController::class, 'export'])->name('produits.export');

// Mettre à jour le menu dans le layout admin
