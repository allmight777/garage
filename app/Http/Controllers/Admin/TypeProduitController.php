<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeProduit;

class TypeProduitController extends Controller
{
    public function index()
    {
        $types = TypeProduit::paginate(10);
        $chartLabels = $types->pluck('nom');
        $chartValues = $types->map(fn($t) => 1);

        return view('admin.type_produit.index', compact('types', 'chartLabels', 'chartValues'));
    }

    public function create()
    {
        return view('admin.type_produit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|unique:type_produits',
            'nom' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg'
        ]);

        $filename = null;
        if ($request->image) {
            $filename = time().'_'.$request->image->getClientOriginalName();
            $request->image->storeAs('type_produits', $filename, 'public');
        }

        TypeProduit::create([
            'reference' => $request->reference,
            'nom' => $request->nom,
            'description' => $request->description,
            'image' => $filename,
        ]);

        return redirect()->route('type_produits.index')->with('success', 'Type ajouté avec succès');
    }

    public function edit(TypeProduit $typeProduit)
    {
        return view('admin.type_produit.edit', compact('typeProduit'));
    }

    public function update(Request $request, TypeProduit $typeProduit)
    {
        $request->validate([
            'nom' => 'required',
            'reference' => "required|unique:type_produits,reference,$typeProduit->id",
        ]);

        $filename = $typeProduit->image;

        if ($request->image) {
            $filename = time().'_'.$request->image->getClientOriginalName();
            $request->image->storeAs('type_produits', $filename, 'public');
        }

        $typeProduit->update([
            'reference' => $request->reference,
            'nom' => $request->nom,
            'description' => $request->description,
            'image' => $filename,
        ]);

        return redirect()->route('type_produits.index')->with('success', 'Modification effectuée avec succès');
    }

    public function destroy(TypeProduit $typeProduit)
    {
        try {
            $typeProduit->delete();
            return back()->with('success', 'Type supprimé avec succès');

        } catch (\Illuminate\Database\QueryException $e) {
            if (str_contains($e->getMessage(), 'foreign key constraint')) {
                return back()->with('error', 'Impossible de supprimer ce type car il est utilisé par des produits.');
            }
            return back()->with('error', 'Erreur lors de la suppression');

        } catch (\Exception $e) {
            \Log::error('Erreur suppression type: ' . $e->getMessage());
            return back()->with('error', 'Erreur lors de la suppression');
        }
    }
}
