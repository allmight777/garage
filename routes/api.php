<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Produit;

Route::get('/products/{id}/quick-view', function ($id) {
    $produit = Produit::with('typeProduit')->findOrFail($id);

    return response()->json([
        'id' => $produit->id,
        'nom' => $produit->nom,
        'description' => $produit->description,
        'image' => $produit->image ? asset('storage/produits/' . $produit->image) : null,
        'prix_vente' => number_format($produit->prix_vente, 2) . ' €',
        'prix_achat' => $produit->prix_achat,
        'marge' => number_format($produit->marge, 2),
        'marge_pourcentage' => number_format($produit->marge_pourcentage, 1),
        'stock_actuel' => $produit->stock_actuel,
        'stock_status' => $produit->stock_status,
        'unite_mesure' => $produit->unite_mesure,
        'marque' => $produit->marque,
        'modele' => $produit->modele,
        'typeProduit' => $produit->typeProduit,
        'rating' => 4,
        'reviews' => 12 
    ]);
});
