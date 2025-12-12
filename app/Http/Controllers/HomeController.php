<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer les produits actifs avec stock > 0
        $produits = Produit::with('typeProduit')
            ->where('est_actif', true)
            ->where('stock_actuel', '>', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(9); // 9 produits par page

        // Si c'est une requête AJAX (pour le scroll infini)
        if ($request->ajax()) {
            $view = view('partials.products_grid', compact('produits'))->render();
            return response()->json(['html' => $view, 'next_page' => $produits->nextPageUrl()]);
        }

        return view('welcome', compact('produits'));
    }

    public function getProductDetails($id)
    {
        $produit = Produit::with('typeProduit')->findOrFail($id);

        return response()->json([
            'nom' => $produit->nom,
            'description' => $produit->description,
            'image' => $produit->image ? asset('storage/produits/' . $produit->image) : null,
            'marque' => $produit->marque,
            'modele' => $produit->modele,
            'reference' => $produit->reference,
            'prix_vente' => number_format($produit->prix_vente, 2, ',', ' '),
            'stock_actuel' => $produit->stock_actuel,
            'stock_status' => $produit->stock_status,
            'taux_tva' => $produit->taux_tva,
            'unite_mesure' => $produit->unite_mesure,
            'type_produit' => $produit->typeProduit->nom ?? 'Général',
            'created_at' => $produit->created_at->format('d/m/Y'),
            'prix_ttc' => number_format($produit->prix_vente + ($produit->prix_vente * $produit->taux_tva / 100), 2, ',', ' ')
        ]);
    }

    public function allProducts(Request $request)
    {
        // Récupérer TOUS les produits actifs avec stock > 0
        $produits = Produit::with('typeProduit')
            ->where('est_actif', true)
            ->where('stock_actuel', '>', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(12); // 12 produits par page pour la vue complète

        // Si c'est une requête AJAX (pour le scroll infini)
        if ($request->ajax()) {
            $view = view('partials.products_grid_full', compact('produits'))->render();
            return response()->json(['html' => $view, 'next_page' => $produits->nextPageUrl()]);
        }

        return view('products.all', compact('produits'));
    }
}
