<?php
// app/Http/Controllers/ClientController.php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Liste clients
    public function index()
    {
        $clients = Client::orderBy('nom')
            ->paginate(20);

        return view('clients.index', compact('clients'));
    }

    // Créer client rapide
    public function storeRapide(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'nullable|string|max:100',
            'telephone' => 'nullable|string|max:20|unique:clients,telephone',
            'adresse' => 'nullable|string'
        ]);

        $client = Client::create($request->all());

        return response()->json([
            'success' => true,
            'client' => [
                'id' => $client->id,
                'nom_complet' => $client->nom_complet,
                'telephone' => $client->telephone,
                'adresse' => $client->adresse
            ]
        ]);
    }
}
