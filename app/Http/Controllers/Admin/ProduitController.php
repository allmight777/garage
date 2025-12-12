<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\TypeProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::with('typeProduit')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalProduits = Produit::count();
        $stockFaible = Produit::where('stock_status', 'faible')->count();
        $stockRupture = Produit::where('stock_status', 'rupture')->count();
        $stockNormal = Produit::where('stock_status', 'normal')->count();
        $valeurStockTotal = Produit::sum(DB::raw('stock_actuel * prix_achat'));
        $moyenneMarge = Produit::avg(DB::raw('prix_vente - prix_achat')) ?? 0;
        $totalMarge = Produit::sum(DB::raw('(prix_vente - prix_achat) * stock_actuel'));
        $topCategories = TypeProduit::withCount('produits')
            ->orderBy('produits_count', 'desc')
            ->take(5)
            ->get();

        // Préparer les données pour les graphiques
        $topProductsData = Produit::orderBy(DB::raw('stock_actuel * prix_achat'), 'desc')
            ->take(5)
            ->get()
            ->map(function($produit) {
                return [
                    'nom' => $produit->nom,
                    'valeur' => $produit->stock_actuel * $produit->prix_achat,
                    'stock' => $produit->stock_actuel,
                    'status' => $produit->stock_status,
                    'marge' => ($produit->prix_vente - $produit->prix_achat) * $produit->stock_actuel
                ];
            });

        // Données pour le graphique de répartition par catégorie
        $categoriesData = $topCategories->map(function($categorie) {
            return [
                'nom' => $categorie->nom,
                'count' => $categorie->produits_count,
                'valeur' => $categorie->produits->sum(function($produit) {
                    return $produit->stock_actuel * $produit->prix_achat;
                })
            ];
        });

        // Données pour le graphique circulaire des statuts
        $statusChartData = [
            'normal' => $stockNormal,
            'faible' => $stockFaible,
            'rupture' => $stockRupture
        ];

        // Calcul des tendances de marge
        $produitsAvecMarge = Produit::select('nom', DB::raw('(prix_vente - prix_achat) as marge_unitaire'))
            ->orderBy(DB::raw('(prix_vente - prix_achat)'), 'desc')
            ->take(5)
            ->get();

        return view('admin.produits.index', compact(
            'produits',
            'totalProduits',
            'stockFaible',
            'stockRupture',
            'stockNormal',
            'valeurStockTotal',
            'moyenneMarge',
            'totalMarge',
            'topProductsData',
            'categoriesData',
            'statusChartData',
            'produitsAvecMarge',
            'topCategories'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = TypeProduit::orderBy('nom')->get();
        return view('admin.produits.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reference' => 'required|unique:produits,reference',
            'nom' => 'required|max:255',
            'type_produit_id' => 'nullable|exists:type_produits,id',
            'marque' => 'nullable|max:100',
            'modele' => 'nullable|max:100',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0|gte:prix_achat',
            'stock_actuel' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
            'taux_tva' => 'nullable|numeric|min:0|max:100',
            'unite_mesure' => 'nullable|max:20',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ], [
            'prix_vente.gte' => 'Le prix de vente doit être supérieur ou égal au prix d\'achat.',
            'reference.unique' => 'Cette référence existe déjà.',
            'image.max' => 'L\'image ne doit pas dépasser 5MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Veuillez corriger les erreurs ci-dessous.');
        }

        $data = $request->all();

        // Calculer le statut de stock
        $data['stock_status'] = $this->calculerStatutStock(
            $data['stock_actuel'],
            $data['seuil_alerte']
        );

        // Gestion de l'image
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();

                // Stocker l'image dans storage/app/public/produits
                $image->storeAs('produits', $imageName, 'public');

                $data['image'] = $imageName;

            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Erreur lors du téléchargement de l\'image : ' . $e->getMessage());
            }
        }

        try {
            $produit = Produit::create($data);

            return redirect()->route('produits.index')
                ->with('success', 'Produit créé avec succès !');

        } catch (\Exception $e) {
            // Si erreur, supprimer l'image téléchargée
            if (isset($imageName) && Storage::exists('public/produits/' . $imageName)) {
                Storage::delete('public/produits/' . $imageName);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création du produit : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        $produit->load('typeProduit');
        $produit->image_url = $produit->image ? asset('storage/produits/' . $produit->image) : null;

        return view('admin.produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        $types = TypeProduit::orderBy('nom')->get();
        $produit->image_url = $produit->image ? asset('storage/produits/' . $produit->image) : null;

        return view('admin.produits.edit', compact('produit', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        $validator = Validator::make($request->all(), [
            'reference' => 'required|unique:produits,reference,' . $produit->id,
            'nom' => 'required|max:255',
            'type_produit_id' => 'nullable|exists:type_produits,id',
            'marque' => 'nullable|max:100',
            'modele' => 'nullable|max:100',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0|gte:prix_achat',
            'stock_actuel' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
            'taux_tva' => 'nullable|numeric|min:0|max:100',
            'unite_mesure' => 'nullable|max:20',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'remove_image' => 'nullable|boolean',
        ], [
            'prix_vente.gte' => 'Le prix de vente doit être supérieur ou égal au prix d\'achat.',
            'image.max' => 'L\'image ne doit pas dépasser 5MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Veuillez corriger les erreurs ci-dessous.');
        }

        $data = $request->except(['_token', '_method', 'remove_image']);
        $oldImage = $produit->image;
        $imageUploaded = false;

        // Calculer le statut de stock
        $data['stock_status'] = $this->calculerStatutStock(
            $data['stock_actuel'],
            $data['seuil_alerte']
        );

        // Gestion de la suppression d'image
        if ($request->has('remove_image') && $request->remove_image == '1') {
            if ($oldImage && Storage::exists('public/produits/' . $oldImage)) {
                Storage::delete('public/produits/' . $oldImage);
            }
            $data['image'] = null;
            $imageUploaded = true;
        }

        // Gestion de la nouvelle image
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();

                // Stocker la nouvelle image
                $image->storeAs('produits', $imageName, 'public');

                $data['image'] = $imageName;
                $imageUploaded = true;

                // Supprimer l'ancienne image après le succès du téléchargement
                if ($oldImage && Storage::exists('public/produits/' . $oldImage)) {
                    Storage::delete('public/produits/' . $oldImage);
                }

            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Erreur lors du téléchargement de l\'image : ' . $e->getMessage());
            }
        }

        try {
            $produit->update($data);

            return redirect()->route('produits.index')
                ->with('success', 'Produit mis à jour avec succès !');

        } catch (\Exception $e) {
            // En cas d'erreur, supprimer la nouvelle image téléchargée
            if ($imageUploaded && isset($imageName) && Storage::exists('public/produits/' . $imageName)) {
                Storage::delete('public/produits/' . $imageName);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour du produit : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        try {
            $imageName = $produit->image;

            // Supprimer l'image si elle existe
            if ($imageName && Storage::exists('public/produits/' . $imageName)) {
                Storage::delete('public/produits/' . $imageName);
            }

            $produit->delete();

            return redirect()->route('produits.index')
                ->with('success', 'Produit supprimé avec succès !');

        } catch (\Exception $e) {
            return redirect()->route('produits.index')
                ->with('error', 'Erreur lors de la suppression du produit : ' . $e->getMessage());
        }
    }

    /**
     * Recherche de produits
     */
    public function search(Request $request)
    {
        $search = $request->get('search');

        $produits = Produit::where(function($query) use ($search) {
                $query->where('reference', 'like', "%{$search}%")
                    ->orWhere('nom', 'like', "%{$search}%")
                    ->orWhere('marque', 'like', "%{$search}%")
                    ->orWhere('modele', 'like', "%{$search}%")
                    ->orWhereHas('typeProduit', function($q) use ($search) {
                        $q->where('nom', 'like', "%{$search}%");
                    });
            })
            ->with('typeProduit')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalProduits = Produit::count();
        $stockFaible = Produit::where('stock_status', 'faible')->count();
        $stockRupture = Produit::where('stock_status', 'rupture')->count();
        $stockNormal = Produit::where('stock_status', 'normal')->count();
        $valeurStockTotal = Produit::sum(DB::raw('stock_actuel * prix_achat'));
        $moyenneMarge = Produit::avg(DB::raw('prix_vente - prix_achat')) ?? 0;
        $totalMarge = Produit::sum(DB::raw('(prix_vente - prix_achat) * stock_actuel'));
        $topCategories = TypeProduit::withCount('produits')
            ->orderBy('produits_count', 'desc')
            ->take(5)
            ->get();

        // Préparer les données pour les graphiques
        $topProductsData = Produit::orderBy(DB::raw('stock_actuel * prix_achat'), 'desc')
            ->take(5)
            ->get()
            ->map(function($produit) {
                return [
                    'nom' => $produit->nom,
                    'valeur' => $produit->stock_actuel * $produit->prix_achat,
                    'stock' => $produit->stock_actuel,
                    'status' => $produit->stock_status,
                    'marge' => ($produit->prix_vente - $produit->prix_achat) * $produit->stock_actuel
                ];
            });

        // Données pour le graphique de répartition par catégorie
        $categoriesData = $topCategories->map(function($categorie) {
            return [
                'nom' => $categorie->nom,
                'count' => $categorie->produits_count,
                'valeur' => $categorie->produits->sum(function($produit) {
                    return $produit->stock_actuel * $produit->prix_achat;
                })
            ];
        });

        // Données pour le graphique circulaire des statuts
        $statusChartData = [
            'normal' => $stockNormal,
            'faible' => $stockFaible,
            'rupture' => $stockRupture
        ];

        // Calcul des tendances de marge
        $produitsAvecMarge = Produit::select('nom', DB::raw('(prix_vente - prix_achat) as marge_unitaire'))
            ->orderBy(DB::raw('(prix_vente - prix_achat)'), 'desc')
            ->take(5)
            ->get();

        return view('admin.produits.index', compact(
            'produits',
            'totalProduits',
            'stockFaible',
            'stockRupture',
            'stockNormal',
            'valeurStockTotal',
            'moyenneMarge',
            'totalMarge',
            'topProductsData',
            'categoriesData',
            'statusChartData',
            'produitsAvecMarge',
            'topCategories'
        ));
    }

    /**
     * Calculer le statut du stock
     */
    private function calculerStatutStock($stockActuel, $seuilAlerte)
    {
        if ($stockActuel == 0) {
            return 'rupture';
        } elseif ($stockActuel <= $seuilAlerte * 0.3) {
            return 'faible';
        } else {
            return 'normal';
        }
    }
}
