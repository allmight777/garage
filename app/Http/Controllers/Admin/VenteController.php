<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vente;
use App\Models\Client;
use App\Models\Produit;
use App\Models\LigneVente;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class VenteController extends Controller
{
    // Liste des ventes avec statistiques
  public function index(Request $request)
    {
        $query = Vente::with(['client', 'vendeur', 'ligneVentes.produit'])
            ->latest();

        // Filtres
        if ($request->filled('numero')) {
            $query->where('numero_vente', 'like', "%{$request->numero}%");
        }
        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $ventes = $query->paginate(20);

        // Calcul des statistiques RÉELLES
        $ventesTerminees = Vente::where('statut', 'terminee');
        $ventesAujourdhui = Vente::where('statut', 'terminee')
            ->whereDate('created_at', today());

        $statistiques = [
            'total' => $ventesTerminees->sum('montant_total'),
            'aujourdhui' => $ventesAujourdhui->sum('montant_total'),
            'nombre' => $ventesTerminees->count(),
            'nombre_aujourdhui' => $ventesAujourdhui->count()
        ];

        // Données RÉELLES pour les graphiques
        $chartData = $this->getRealChartData();

        return view('ventes.index', compact('ventes', 'statistiques', 'chartData'));
    }

    // Méthode pour récupérer les données RÉELLES des graphiques
    private function getRealChartData()
    {
        $now = Carbon::now();

        // 1. Ventes par jour (7 derniers jours)
        $ventesParJour = Vente::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(montant_total) as total')
            )
            ->where('statut', 'terminee')
            ->where('created_at', '>=', $now->copy()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Formatage pour le graphique
        $joursLabels = [];
        $joursData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i)->format('Y-m-d');
            $jourNom = $now->copy()->subDays($i)->locale('fr')->dayName;
            $joursLabels[] = ucfirst($jourNom);

            $vente = $ventesParJour->firstWhere('date', $date);
            $joursData[] = $vente ? $vente->total : 0;
        }

        // 2. Mode de paiement
        $modePaiement = Vente::select(
                'mode_paiement',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(montant_total) as total')
            )
            ->where('statut', 'terminee')
            ->where('created_at', '>=', $now->copy()->subDays(30))
            ->groupBy('mode_paiement')
            ->get();

        $modeLabels = [];
        $modeData = [];
        foreach ($modePaiement as $mode) {
            $modeLabels[] = $mode->mode_paiement_text;
            $modeData[] = $mode->count;
        }

        // 3. Top 5 produits (depuis 30 jours)
        $topProduits = LigneVente::select(
                'produits.nom',
                DB::raw('SUM(ligne_ventes.quantite) as total_quantite')
            )
            ->join('produits', 'ligne_ventes.produit_id', '=', 'produits.id')
            ->join('ventes', 'ligne_ventes.vente_id', '=', 'ventes.id')
            ->where('ventes.statut', 'terminee')
            ->where('ventes.created_at', '>=', $now->copy()->subDays(30))
            ->groupBy('produits.id', 'produits.nom')
            ->orderByDesc('total_quantite')
            ->limit(5)
            ->get();

        $produitsLabels = [];
        $produitsData = [];
        foreach ($topProduits as $produit) {
            $produitsLabels[] = $produit->nom;
            $produitsData[] = $produit->total_quantite;
        }

        // 4. Évolution CA mensuel (12 derniers mois)
        $evolutionCA = Vente::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as mois"),
                DB::raw('SUM(montant_total) as total')
            )
            ->where('statut', 'terminee')
            ->where('created_at', '>=', $now->copy()->subMonths(12))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $caLabels = [];
        $caData = [];
        for ($i = 11; $i >= 0; $i--) {
            $mois = $now->copy()->subMonths($i)->format('Y-m');
            $moisNom = $now->copy()->subMonths($i)->locale('fr')->monthName;
            $caLabels[] = ucfirst($moisNom);

            $ca = $evolutionCA->firstWhere('mois', $mois);
            $caData[] = $ca ? $ca->total : 0;
        }

        // 5. Heures de vente
        $heuresVente = Vente::select(
                DB::raw('HOUR(created_at) as heure'),
                DB::raw('COUNT(*) as count')
            )
            ->where('statut', 'terminee')
            ->groupBy('heure')
            ->orderBy('heure')
            ->get();

        $heuresLabels = [];
        $heuresData = [];
        for ($h = 8; $h <= 20; $h += 2) {
            $heuresLabels[] = $h . 'h';

            $venteHeure = $heuresVente->firstWhere('heure', $h);
            $heuresData[] = $venteHeure ? $venteHeure->count : 0;
        }

        return [
            'ventes_par_jour' => [
                'labels' => $joursLabels,
                'data' => $joursData
            ],
            'mode_paiement' => [
                'labels' => $modeLabels,
                'data' => $modeData,
                'totaux' => $modePaiement->pluck('total')->toArray()
            ],
            'top_produits' => [
                'labels' => $produitsLabels,
                'data' => $produitsData
            ],
            'evolution_ca' => [
                'labels' => $caLabels,
                'data' => $caData
            ],
            'heures_vente' => [
                'labels' => $heuresLabels,
                'data' => $heuresData
            ]
        ];
    }


    // Page création vente
    public function create()
    {
        $clients = Client::orderBy('nom')->get();
        $produits = Produit::where('stock_actuel', '>', 0)
            ->orderBy('nom')
            ->get();

        return view('ventes.create', compact('clients', 'produits'));
    }

    // Enregistrer vente
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'client_nom' => 'nullable|string|max:100',
            'client_prenom' => 'nullable|string|max:100',
            'client_telephone' => 'nullable|string|max:20',
            'client_adresse' => 'nullable|string',
            'produits' => 'required|array|min:1',
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
            'mode_paiement' => 'required|in:especes,mobile_money,carte,cheque',
            'notes' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            // Créer client si nouveau
            $clientId = $request->client_id;
            if (!$clientId && $request->client_nom) {
                $client = Client::create([
                    'nom' => $request->client_nom,
                    'prenom' => $request->client_prenom ?? null,
                    'telephone' => $request->client_telephone,
                    'adresse' => $request->client_adresse
                ]);
                $clientId = $client->id;
            }

            // Créer vente
            $vente = Vente::create([
                'client_id' => $clientId,
                'client_nom' => $request->client_nom,
                'client_telephone' => $request->client_telephone,
                'client_adresse' => $request->client_adresse,
                'mode_paiement' => $request->mode_paiement,
                'notes' => $request->notes,
                'user_id' => Auth::id(),
                'statut' => 'terminee' // Vente terminée par défaut
            ]);

            $montantTotal = 0;

            // Ajouter les lignes de vente
            foreach ($request->produits as $item) {
                $produit = Produit::find($item['id']);

                // Vérifier stock
                if ($produit->stock_actuel < $item['quantite']) {
                    throw new \Exception("Stock insuffisant pour {$produit->nom}. Disponible: {$produit->stock_actuel}");
                }

                LigneVente::create([
                    'vente_id' => $vente->id,
                    'produit_id' => $produit->id,
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $produit->prix_vente
                ]);

                $montantTotal += $item['quantite'] * $produit->prix_vente;
            }

            // Mettre à jour total
            $vente->update(['montant_total' => $montantTotal]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vente enregistrée avec succès!',
                'vente_id' => $vente->id,
                'numero_vente' => $vente->numero_vente,
                'total' => number_format($montantTotal, 0, ',', ' ') . ' FCFA'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    // Afficher une vente
    public function show(Vente $vente)
    {
        $vente->load(['client', 'vendeur', 'ligneVentes.produit']);
        return view('ventes.show', compact('vente'));
    }

    // Page modification vente
    public function edit(Vente $vente)
    {
        if ($vente->statut === 'annulee') {
            return redirect()->route('ventes.show', $vente)
                ->with('error', 'Vente annulée, modification impossible.');
        }

        $vente->load(['ligneVentes.produit', 'client']);
        $clients = Client::orderBy('nom')->get();
        $produits = Produit::where('stock_actuel', '>', 0)->get();

        return view('ventes.edit', compact('vente', 'clients', 'produits'));
    }

    // Mettre à jour vente
    public function update(Request $request, Vente $vente)
    {
        if ($vente->statut === 'annulee') {
            return back()->with('error', 'Vente annulée, modification impossible.');
        }

        $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'client_nom' => 'nullable|string|max:100',
            'client_prenom' => 'nullable|string|max:100',
            'client_telephone' => 'nullable|string|max:20',
            'client_adresse' => 'nullable|string',
            'produits' => 'required|array|min:1',
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
            'produits.*.prix' => 'required|numeric|min:0',
            'mode_paiement' => 'required|in:especes,mobile_money,carte,cheque',
            'notes' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            // Mettre à jour client
            $clientId = $request->client_id;
            if (!$clientId && $request->client_nom) {
                $client = Client::create([
                    'nom' => $request->client_nom,
                    'prenom' => $request->client_prenom ?? null,
                    'telephone' => $request->client_telephone,
                    'adresse' => $request->client_adresse
                ]);
                $clientId = $client->id;
            }

            // Mettre à jour infos vente
            $vente->update([
                'client_id' => $clientId,
                'client_nom' => $request->client_nom,
                'client_telephone' => $request->client_telephone,
                'client_adresse' => $request->client_adresse,
                'mode_paiement' => $request->mode_paiement,
                'notes' => $request->notes
            ]);

            // Supprimer toutes les anciennes lignes
            $vente->ligneVentes()->delete();

            $montantTotal = 0;

            // Ajouter les nouvelles lignes
            foreach ($request->produits as $item) {
                $produit = Produit::find($item['id']);

                // Vérifier stock disponible (stock actuel + quantités précédentes)
                $quantiteAncienne = $vente->ligneVentes()
                    ->where('produit_id', $produit->id)
                    ->sum('quantite');

                $stockDisponible = $produit->stock_actuel + $quantiteAncienne;

                if ($stockDisponible < $item['quantite']) {
                    throw new \Exception("Stock insuffisant pour {$produit->nom}. Disponible: {$stockDisponible}");
                }

                LigneVente::create([
                    'vente_id' => $vente->id,
                    'produit_id' => $produit->id,
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $item['prix']
                ]);

                $montantTotal += $item['quantite'] * $item['prix'];
            }

            // Mettre à jour total
            $vente->update(['montant_total' => $montantTotal]);

            DB::commit();

            return redirect()->route('ventes.show', $vente)
                ->with('success', 'Vente modifiée avec succès!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    // Annuler une vente
    public function annuler(Vente $vente)
    {
        if ($vente->statut === 'annulee') {
            return back()->with('error', 'Vente déjà annulée.');
        }

        DB::beginTransaction();

        try {
            // Restaurer le stock
            foreach ($vente->ligneVentes as $ligne) {
                $ligne->produit->increment('stock_actuel', $ligne->quantite);

                // Mettre à jour le statut du stock
                $produit = $ligne->produit;
                if ($produit->stock_actuel <= 0) {
                    $produit->stock_status = 'rupture';
                } elseif ($produit->stock_actuel <= $produit->seuil_alerte) {
                    $produit->stock_status = 'alerte';
                } else {
                    $produit->stock_status = 'normal';
                }
                $produit->save();
            }

            $vente->update([
                'statut' => 'annulee',
                'notes' => ($vente->notes ?? '') . "\n[ANNULÉE le " . now()->format('d/m/Y H:i') . ']'
            ]);

            DB::commit();

            return back()->with('success', 'Vente annulée et stock restauré.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    // Recherche clients AJAX
    public function searchClients(Request $request)
    {
        $search = $request->get('q');

        $clients = Client::where(function($query) use ($search) {
                $query->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%")
                      ->orWhere('telephone', 'like', "%{$search}%");
            })
            ->limit(10)
            ->get()
            ->map(function($client) {
                return [
                    'id' => $client->id,
                    'text' => $client->nom_complet . ($client->telephone ? " - {$client->telephone}" : ''),
                    'nom' => $client->nom,
                    'prenom' => $client->prenom,
                    'telephone' => $client->telephone,
                    'adresse' => $client->adresse,
                    'nom_complet' => $client->nom_complet
                ];
            });

        return response()->json($clients);
    }

    // Recherche produits AJAX
    public function searchProduits(Request $request)
    {
        $search = $request->get('q');

        $produits = Produit::where('stock_actuel', '>', 0)
            ->where(function($query) use ($search) {
                $query->where('nom', 'like', "%{$search}%")
                      ->orWhere('reference', 'like', "%{$search}%")
                      ->orWhere('marque', 'like', "%{$search}%");
            })
            ->limit(10)
            ->get()
            ->map(function($produit) {
                return [
                    'id' => $produit->id,
                    'nom' => $produit->nom,
                    'reference' => $produit->reference,
                    'marque' => $produit->marque,
                    'prix_vente' => $produit->prix_vente,
                    'stock_actuel' => $produit->stock_actuel,
                    'seuil_alerte' => $produit->seuil_alerte,
                    'prix_formatted' => number_format($produit->prix_vente, 0, ',', ' ') . ' FCFA'
                ];
            });

        return response()->json($produits);
    }

    // Imprimer facture
    public function imprimer(Vente $vente)
    {
        $vente->load(['client', 'vendeur', 'ligneVentes.produit']);
        return view('ventes.facture', compact('vente'));
    }

    // Récupérer les données pour les graphiques
    private function getChartData()
    {
        // Ventes des 30 derniers jours
        $startDate = now()->subDays(30);
        $ventesParJour = Vente::where('statut', 'terminee')
            ->where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, SUM(montant_total) as total, COUNT(*) as nombre')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Mode de paiement
        $modePaiement = Vente::where('statut', 'terminee')
            ->selectRaw('mode_paiement, COUNT(*) as nombre, SUM(montant_total) as total')
            ->groupBy('mode_paiement')
            ->get();

        // Top 5 produits
        $topProduits = LigneVente::join('produits', 'ligne_ventes.produit_id', '=', 'produits.id')
            ->selectRaw('produits.nom, SUM(ligne_ventes.quantite) as quantite_vendue, SUM(ligne_ventes.quantite * ligne_ventes.prix_unitaire) as total')
            ->groupBy('produits.id', 'produits.nom')
            ->orderByDesc('quantite_vendue')
            ->limit(5)
            ->get();

        // Ventes par heure
        $ventesParHeure = Vente::where('statut', 'terminee')
            ->selectRaw('HOUR(created_at) as heure, COUNT(*) as nombre')
            ->groupBy('heure')
            ->orderBy('heure')
            ->get();

        return [
            'ventesParJour' => $ventesParJour,
            'modePaiement' => $modePaiement,
            'topProduits' => $topProduits,
            'ventesParHeure' => $ventesParHeure
        ];
    }

    // API pour récupérer les données des graphiques
    public function getChartDataApi(Request $request)
    {
        $periode = $request->get('periode', 30);
        $startDate = now()->subDays($periode);

        // Ventes par jour
        $ventesParJour = Vente::where('statut', 'terminee')
            ->where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, SUM(montant_total) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Données formatées pour Chart.js
        $labels = $ventesParJour->pluck('date')->map(function($date) {
            return date('d/m', strtotime($date));
        });

        $data = $ventesParJour->pluck('total');

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    // Export CSV des ventes
    public function exportCsv(Request $request)
    {
        $query = Vente::with(['client', 'vendeur'])
            ->where('statut', 'terminee');

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        $ventes = $query->get();

        $fileName = 'ventes_' . date('Y-m-d_H-i') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($ventes) {
            $file = fopen('php://output', 'w');

            // En-tête
            fputcsv($file, [
                'Numéro',
                'Date',
                'Client',
                'Téléphone',
                'Articles',
                'Montant (FCFA)',
                'Mode Paiement',
                'Vendeur'
            ]);

            // Données
            foreach ($ventes as $vente) {
                fputcsv($file, [
                    $vente->numero_vente,
                    $vente->created_at->format('d/m/Y H:i'),
                    $vente->client ? $vente->client->nom_complet : $vente->client_nom,
                    $vente->client ? $vente->client->telephone : $vente->client_telephone,
                    $vente->ligneVentes->sum('quantite'),
                    $vente->montant_total,
                    $vente->mode_paiement_text,
                    $vente->vendeur->name
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Dashboard statistiques
    public function dashboard()
    {
        $aujourdhui = now()->format('Y-m-d');
        $hier = now()->subDay()->format('Y-m-d');
        $ceMois = now()->format('Y-m');

        // Ventes aujourd'hui
        $ventesAujourdhui = Vente::where('statut', 'terminee')
            ->whereDate('created_at', $aujourdhui)
            ->count();

        $caAujourdhui = Vente::where('statut', 'terminee')
            ->whereDate('created_at', $aujourdhui)
            ->sum('montant_total');

        // Ventes hier
        $caHier = Vente::where('statut', 'terminee')
            ->whereDate('created_at', $hier)
            ->sum('montant_total');

        // Évolution
        $evolution = $caHier > 0 ? (($caAujourdhui - $caHier) / $caHier * 100) : 0;

        // Ventes ce mois
        $ventesCeMois = Vente::where('statut', 'terminee')
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$ceMois])
            ->count();

        $caCeMois = Vente::where('statut', 'terminee')
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$ceMois])
            ->sum('montant_total');

        // Top produits du mois
        $topProduitsMois = LigneVente::join('produits', 'ligne_ventes.produit_id', '=', 'produits.id')
            ->join('ventes', 'ligne_ventes.vente_id', '=', 'ventes.id')
            ->where('ventes.statut', 'terminee')
            ->whereRaw("DATE_FORMAT(ventes.created_at, '%Y-%m') = ?", [$ceMois])
            ->selectRaw('produits.nom, SUM(ligne_ventes.quantite) as quantite')
            ->groupBy('produits.id', 'produits.nom')
            ->orderByDesc('quantite')
            ->limit(5)
            ->get();

        // Alertes stock
        $alertesStock = Produit::where('stock_actuel', '<=', DB::raw('seuil_alerte'))
            ->where('stock_actuel', '>', 0)
            ->orderBy('stock_actuel')
            ->limit(10)
            ->get();

        $rupturesStock = Produit::where('stock_actuel', '<=', 0)
            ->count();

        return view('ventes.dashboard', compact(
            'ventesAujourdhui',
            'caAujourdhui',
            'evolution',
            'ventesCeMois',
            'caCeMois',
            'topProduitsMois',
            'alertesStock',
            'rupturesStock'
        ));
    }
}
