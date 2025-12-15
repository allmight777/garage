<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\LigneVente;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function home()
    {
        // Données pour les 4 cartes principales
        $totalVentes = Vente::where('statut', 'terminee')->count();
        $chiffreAffairesTotal = Vente::where('statut', 'terminee')->sum('montant_total');

        // Calcul pour aujourd'hui
        $ventesAujourdhui = Vente::where('statut', 'terminee')
            ->whereDate('created_at', today())
            ->count();

        $caAujourdhui = Vente::where('statut', 'terminee')
            ->whereDate('created_at', today())
            ->sum('montant_total');

        // Calcul pour hier (pourcentage)
        $dateHier = today()->subDay();
        $caHier = Vente::where('statut', 'terminee')
            ->whereDate('created_at', $dateHier)
            ->sum('montant_total');

        $pourcentageCA = $caHier > 0 ? round((($caAujourdhui - $caHier) / $caHier) * 100, 1) : ($caAujourdhui > 0 ? 100 : 0);

        // Clients
        $totalClients = Client::count();
        $nouveauxClients = Client::whereDate('created_at', today())->count();

        // Stocks
        $totalProduits = Produit::where('est_actif', 1)->count();
        $produitsEnStock = Produit::where('est_actif', 1)->sum('stock_actuel');
        $produitsRupture = Produit::where('stock_status', 'rupture')->where('est_actif', 1)->count();
        $produitsFaible = Produit::where('stock_status', 'faible')->where('est_actif', 1)->count();
        $produitsNormal = Produit::where('stock_status', 'normal')->where('est_actif', 1)->count();
        $produitsAlerte = Produit::where('stock_status', 'alerte')->where('est_actif', 1)->count();

        // Données pour graphiques
        // Chiffre d'affaires par mois (6 derniers mois)
        $caParMois = Vente::select(
                DB::raw('DATE_FORMAT(created_at, "%b") as mois'),
                DB::raw('SUM(montant_total) as total')
            )
            ->where('statut', 'terminee')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), 'mois')
            ->orderBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->get();

        // Ventes par jour (7 derniers jours) - CORRECTION : avec les bons jours
        $ventesParJour = [];
        $joursLabels = [];
        $joursFrancais = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];

        // Aujourd'hui est le 15 décembre 2025 (dimanche selon votre tableau)
        // On va afficher les 7 derniers jours à partir d'aujourd'hui
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $jourIndex = $date->dayOfWeek; // 0 pour dimanche, 1 pour lundi, etc.
            $joursLabels[] = $joursFrancais[$jourIndex];

            $ventesDuJour = Vente::where('statut', 'terminee')
                ->whereDate('created_at', $date)
                ->count();
            $ventesParJour[] = $ventesDuJour;
        }

        // Mode de paiement
        $modePaiementData = Vente::where('statut', 'terminee')
            ->select('mode_paiement', DB::raw('COUNT(*) as count'))
            ->groupBy('mode_paiement')
            ->get();

        // Top produits (plus vendus)
        $topProduits = LigneVente::select(
                'produits.nom',
                DB::raw('SUM(ligne_ventes.quantite) as total_vendu')
            )
            ->join('produits', 'ligne_ventes.produit_id', '=', 'produits.id')
            ->join('ventes', 'ligne_ventes.vente_id', '=', 'ventes.id')
            ->where('ventes.statut', 'terminee')
            ->groupBy('produits.id', 'produits.nom')
            ->orderByDesc('total_vendu')
            ->limit(5)
            ->get();

        // Statut des stocks pour diagramme circulaire
        $statutStocks = Produit::where('est_actif', 1)
            ->select('stock_status', DB::raw('COUNT(*) as count'))
            ->groupBy('stock_status')
            ->get();

        // Heures de vente
        $heuresVente = [];
        $heuresLabels = [];
        for ($i = 8; $i <= 20; $i++) {
            $heureDebut = Carbon::today()->setHour($i);
            $heureFin = Carbon::today()->setHour($i + 1);

            $ventesHeure = Vente::where('statut', 'terminee')
                ->whereTime('created_at', '>=', $heureDebut->format('H:i:s'))
                ->whereTime('created_at', '<', $heureFin->format('H:i:s'))
                ->count();

            $heuresVente[] = $ventesHeure;
            $heuresLabels[] = $i . 'h';
        }

        // Dernières ventes
        $dernieresVentes = Vente::with(['client', 'vendeur', 'ligneVentes'])
            ->where('statut', 'terminee')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Produits récemment ajoutés
        $produitsRecents = Produit::where('est_actif', 1)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Clients récents
        $clientsRecents = Client::orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Produits en rupture
        $produitsRuptureListe = Produit::where('stock_status', 'rupture')
            ->where('est_actif', 1)
            ->orderBy('nom')
            ->limit(10)
            ->get();

        // Préparation des données pour les graphiques
        $chartData = [
            'ca_labels' => $caParMois->isNotEmpty() ? $caParMois->pluck('mois')->toArray() : ['Oct', 'Nov', 'Déc'],
            'ca_data' => $caParMois->isNotEmpty() ? $caParMois->pluck('total')->toArray() : [0, 0, 0],
            'ventes_labels' => $joursLabels,
            'ventes_data' => $ventesParJour,
            'mode_paiement_labels' => $modePaiementData->pluck('mode_paiement')->toArray(),
            'mode_paiement_data' => $modePaiementData->pluck('count')->toArray(),
            'top_produits_labels' => $topProduits->isNotEmpty() ? $topProduits->pluck('nom')->toArray() : ['Produit 1', 'Produit 2', 'Produit 3', 'Produit 4', 'Produit 5'],
            'top_produits_data' => $topProduits->isNotEmpty() ? $topProduits->pluck('total_vendu')->toArray() : [10, 8, 6, 4, 2],
            'statut_stocks_labels' => $statutStocks->pluck('stock_status')->toArray(),
            'statut_stocks_data' => $statutStocks->pluck('count')->toArray(),
            'heures_vente_labels' => $heuresLabels,
            'heures_vente_data' => $heuresVente,
        ];

        // Statistiques globales
        $statistiques = [
            'total_ca' => $chiffreAffairesTotal,
            'ca_aujourdhui' => $caAujourdhui,
            'pourcentage_ca' => $pourcentageCA,
            'total_ventes' => $totalVentes,
            'ventes_aujourdhui' => $ventesAujourdhui,
            'total_clients' => $totalClients,
            'nouveaux_clients' => $nouveauxClients,
            'total_produits' => $totalProduits,
            'produits_normal' => $produitsNormal,
            'produits_faible' => $produitsFaible,
            'produits_rupture' => $produitsRupture,
            'produits_alerte' => $produitsAlerte,
            'stock_total' => $produitsEnStock,
        ];

        return view('admin.dashboard', compact(
            'statistiques',
            'chartData',
            'dernieresVentes',
            'produitsRecents',
            'clientsRecents',
            'produitsRuptureListe'
        ));
    }
}
