{{-- resources/views/ventes/index.blade.php --}}
@extends('layouts.admin')

@section('content')
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --secondary-dark: #5a08a1;
            --success: #06d6a0;
            --success-dark: #00b894;
            --danger: #ef476f;
            --danger-dark: #d00000;
            --warning: #ffd166;
            --warning-dark: #ff9e00;
            --info: #4cc9f0;
            --info-dark: #4895ef;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --gray: #6c757d;
            --gray-light: #adb5bd;
            --border: #e0e0e0;
            --glass-bg: rgba(255, 255, 255, 0.9);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 16px 48px rgba(0, 0, 0, 0.12);
            --radius: 16px;
            --radius-sm: 8px;
            --radius-lg: 24px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --gradient-4: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --gradient-success: linear-gradient(135deg, #06d6a0, #00b894);
            --gradient-warning: linear-gradient(135deg, #ffd166, #ff9e00);
            --gradient-danger: linear-gradient(135deg, #ef476f, #d00000);
        }

        /* Conteneur principal */
        .ventes-container {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        /* Header */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding: 35px 40px;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            border: 1px solid var(--glass-border);
        }

        .admin-title {
            font-size: 2.8rem;
            font-weight: 900;
            margin: 0;
            background: linear-gradient(135deg,
                    var(--primary) 0%,
                    var(--secondary) 25%,
                    var(--success) 50%,
                    var(--info) 75%,
                    var(--warning) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .admin-subtitle {
            color: var(--gray);
            font-size: 1.2rem;
            margin-top: 8px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 32px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            text-decoration: none;
            border-radius: var(--radius);
            font-weight: 700;
            font-size: 1.1rem;
            transition: var(--transition);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(67, 97, 238, 0.4);
        }

        /* Statistiques */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            padding: 30px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            gap: 25px;
            transition: var(--transition);
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            flex-shrink: 0;
        }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 900;
            margin: 0;
            color: var(--dark);
        }

        .stat-label {
            color: var(--gray);
            margin: 8px 0 12px 0;
            font-size: 1rem;
        }

        /* Section Graphiques */
        .charts-section {
            margin-bottom: 40px;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 25px;
        }

        .chart-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            padding: 25px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .chart-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chart-title i {
            color: var(--primary);
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        .chart-container-large {
            position: relative;
            height: 350px;
            width: 100%;
        }

        /* Carte principale */
        .main-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow);
            margin-top: 30px;
        }

        .card-header {
            padding: 25px 30px;
            background: var(--glass-bg);
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Filtres */
        .filtres-form {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filtre-group {
            position: relative;
        }

        .filtre-group .form-control {
            padding: 10px 15px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.95rem;
            min-width: 150px;
            background: white;
        }

        .btn-filtre {
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-filtre:hover {
            background: var(--primary-dark);
        }

        .btn-reset {
            background: var(--gray);
        }

        /* Tableau */
        .table-responsive {
            overflow-x: auto;
            padding: 20px;
        }

        .styled-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
            min-width: 1200px;
        }

        .styled-table thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .styled-table th {
            color: white;
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-row {
            background: white;
            border-radius: 12px;
            transition: var(--transition);
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
        }

        .table-row:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .table-row td {
            padding: 20px;
            border: none;
            vertical-align: middle;
            background: transparent;
        }

        /* Styles spécifiques vente */
        .vente-numero {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .vente-date {
            display: flex;
            flex-direction: column;
            font-size: 0.95rem;
        }

        .vente-date small {
            font-size: 0.85rem;
            color: var(--gray);
        }

        .client-info {
            max-width: 200px;
        }

        .client-info strong {
            font-weight: 600;
            color: var(--dark);
        }

        .client-info small {
            color: var(--gray);
            font-size: 0.85rem;
        }

        .badge-articles {
            display: inline-block;
            padding: 6px 12px;
            background: var(--secondary);
            color: white;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .vente-montant {
            color: var(--success);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .badge-paiement {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .badge-especes {
            background: #28a745;
            color: white;
        }

        .badge-mobile_money {
            background: #17a2b8;
            color: white;
        }

        .badge-carte {
            background: #007bff;
            color: white;
        }

        .badge-cheque {
            background: #6c757d;
            color: white;
        }

        .badge-statut {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .badge-terminee {
            background: #28a745;
            color: white;
        }

        .badge-annulee {
            background: #dc3545;
            color: white;
        }

        .vendeur-info {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--dark);
        }

        /* Boutons actions */
        .actions-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-size: 1rem;
            background: white;
            border: 1px solid var(--border);
        }

        .btn-view {
            color: var(--success);
        }

        .btn-view:hover {
            background: var(--success);
            color: white;
            border-color: var(--success);
        }

        .btn-edit {
            color: var(--warning-dark);
        }

        .btn-edit:hover {
            background: var(--warning-dark);
            color: white;
            border-color: var(--warning-dark);
        }

        .btn-print {
            color: var(--info);
        }

        .btn-print:hover {
            background: var(--info);
            color: white;
            border-color: var(--info);
        }

        .btn-cancel {
            color: var(--danger);
        }

        .btn-cancel:hover {
            background: var(--danger);
            color: white;
            border-color: var(--danger);
        }

        /* Pagination */
        .pagination {
            padding: 25px 30px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: center;
        }

        .pagination ul {
            display: flex;
            gap: 8px;
            list-style: none;
            padding: 0;
        }

        .pagination li a,
        .pagination li span {
            padding: 10px 16px;
            border-radius: 8px;
            background: white;
            color: var(--dark);
            text-decoration: none;
            border: 1px solid var(--border);
            transition: var(--transition);
        }

        .pagination li.active span {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination li a:hover {
            background: #f8f9fa;
            border-color: var(--primary);
        }

        /* État vide */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--gray-light);
            margin-bottom: 20px;
        }

        .empty-state h4 {
            color: var(--dark);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--gray);
            margin-bottom: 25px;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }

            .admin-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .card-header {
                flex-direction: column;
                text-align: center;
            }

            .filtres-form {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .ventes-container {
                padding: 15px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .chart-container {
                height: 250px;
            }

            .chart-container-large {
                height: 300px;
            }

            .btn-filtre,
            .btn-reset {
                width: 100%;
                justify-content: center;
            }

            .filtres-form {
                flex-direction: column;
                width: 100%;
            }

            .filtre-group {
                width: 100%;
            }

            .filtre-group .form-control {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .admin-title {
                font-size: 2rem;
            }

            .chart-card {
                padding: 15px;
            }

            .table-responsive {
                padding: 10px;
            }

            .actions-buttons {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>


    <!-- Navbar -->
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
        navbar-main navbar-scroll="true">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
            <nav>
                <!-- breadcrumb -->
                <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                    <li class="text-sm leading-normal">
                        <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
                    </li>
                    <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                        aria-current="page">
                        Dashboard
                    </li>
                </ol>
                <h6 class="mb-0 font-bold capitalize">Gestion des ventes</h6>
            </nav>

            <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                <div class="flex items-center md:ml-auto md:pr-4">
                    <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">

                    </div>
                </div>

                <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                    <li class="flex items-center">
                        @auth
                            @php
                                $user = Auth::user();
                                $initiales = collect(explode(' ', $user->name))
                                    ->map(fn($part) => strtoupper(substr($part, 0, 1)))
                                    ->join('');
                            @endphp

                            <!-- Icône avec initiales -->
                            <div
                                class="user-icon flex items-center justify-center rounded-full bg-red-600 text-white w-10 h-10 mr-2 font-bold">
                                {{ $initiales }}
                            </div>
                            <span class="text-sm font-semibold text-slate-700">{{ $user->name }}</span>
                        @else
                            <a href="{{ route('login') }}" class="block px-0 py-2 text-sm font-semibold text-slate-500">
                                <i class="fa fa-user sm:mr-1"></i>
                                <span class="hidden sm:inline">Sign In</span>
                            </a>
                        @endauth
                    </li>
                </ul>

                <style>
                    .user-icon {
                        font-size: 0.9rem;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                        background-color: #0B9EF3;
                        color: rgb(255, 255, 255);
                    }
                </style>
            </div>
        </div>
    </nav>

    <div class="ventes-container">
        <!-- Header -->
        <div class="admin-header">
            <div class="header-content">
                <h1 class="admin-title">
                    <i class="fas fa-chart-line"></i> Historique des Ventes
                </h1>

                <p class="admin-subtitle">Suivez toutes vos transactions</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('ventes.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i> Nouvelle vente
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif


        <!-- Statistiques -->
        <div class="stats-grid"
            style="
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* 2 colonnes */
    gap: 20px; /* espace entre les cartes */
">
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--gradient-1);">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ number_format($statistiques['total'] ?? 0, 0, ',', ' ') }} FCFA</h3>
                    <p class="stat-label">Chiffre d'affaires total</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: var(--gradient-4);">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ number_format($statistiques['aujourdhui'] ?? 0, 0, ',', ' ') }} FCFA</h3>
                    <p class="stat-label">Ventes aujourd'hui</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: var(--gradient-2);">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $statistiques['nombre'] ?? 0 }}</h3>
                    <p class="stat-label">Ventes totales</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: var(--gradient-3);">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ App\Models\Client::count() }}</h3>
                    <p class="stat-label">Clients enregistrés</p>
                </div>
            </div>
        </div>


        <!-- Section Graphiques -->
        <div class="charts-section">
            <!-- Grille de graphiques -->
            <div class="charts-grid">
                <!-- Ventes par jour -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title"><i class="fas fa-calendar-alt"></i> Ventes quotidiennes</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="ventesParJourChart"></canvas>
                    </div>
                </div>

                <!-- Mode de paiement -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title"><i class="fas fa-credit-card"></i> Mode de paiement</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="modePaiementChart"></canvas>
                    </div>
                </div>

                <!-- Top produits -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title"><i class="fas fa-star"></i> Top 5 produits</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="topProduitsChart"></canvas>
                    </div>
                </div>

                <!-- Heures de vente -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title"><i class="fas fa-clock"></i> Heures de vente</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="heuresVenteChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Graphique large en bas -->
            <div class="chart-card" style="margin-top: 25px;">
                <div class="chart-header">
                    <h3 class="chart-title"><i class="fas fa-chart-bar"></i> Évolution du chiffre d'affaires</h3>
                    <div class="chart-controls">
                        {{-- <select id="periodeChart" class="form-control" style="width: auto;">
                            <option value="7">7 derniers jours</option>
                            <option value="30" selected>30 derniers jours</option>
                            <option value="90">3 derniers mois</option>
                        </select>  --}}
                    </div>
                </div>
                <div class="chart-container-large">
                    <canvas id="evolutionCAChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Liste des ventes -->
        <div class="main-card">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-list"></i> Dernières Ventes</h2>

                <!-- Filtres -->
                <div class="filtres">
                    <form method="GET" class="filtres-form">
                        <div class="filtre-group">
                            <input type="text" name="numero" class="form-control" placeholder="Numéro vente"
                                value="{{ request('numero') }}">
                        </div>
                        <div class="filtre-group">
                            <input type="date" name="date_debut" class="form-control"
                                value="{{ request('date_debut') }}">
                        </div>
                        <div class="filtre-group">
                            <input type="date" name="date_fin" class="form-control"
                                value="{{ request('date_fin') }}">
                        </div>
                        <div class="filtre-group">
                            <select name="statut" class="form-control">
                                <option value="">Tous statuts</option>
                                <option value="terminee" {{ request('statut') == 'terminee' ? 'selected' : '' }}>Terminées
                                </option>
                                <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>Annulées
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn-filtre">
                            <i class="fas fa-filter"></i> Filtrer
                        </button>
                        <a href="{{ route('ventes.index') }}" class="btn-filtre btn-reset">
                            <i class="fas fa-redo"></i>
                        </a>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Articles</th>
                            <th>Montant</th>
                            <th>Paiement</th>
                            <th>Statut</th>
                            <th>Vendeur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ventes as $vente)
                            <tr class="table-row">
                                <td>
                                    <strong class="vente-numero">{{ $vente->numero_vente }}</strong>
                                </td>
                                <td>
                                    <div class="vente-date">
                                        {{ $vente->created_at->format('d/m/Y') }}
                                        <small>{{ $vente->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if ($vente->client)
                                        <div class="client-info">
                                            <strong>{{ $vente->client->nom_complet }}</strong>
                                            @if ($vente->client->telephone)
                                                <br><small>{{ $vente->client->telephone }}</small>
                                            @endif
                                        </div>
                                    @elseif($vente->client_nom)
                                        <div class="client-info">
                                            <strong>{{ $vente->client_nom }}</strong>
                                            @if ($vente->client_telephone)
                                                <br><small>{{ $vente->client_telephone }}</small>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">Client non enregistré</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge-articles">
                                        {{ $vente->ligneVentes->sum('quantite') }} articles
                                    </span>
                                </td>
                                <td>
                                    <strong class="vente-montant" style="color: rgb(4, 0, 255);">
                                        {{ number_format($vente->montant_total, 0, ',', ' ') }} FCFA
                                    </strong>
                                </td>
                                <td>
                                    <span class="badge-paiement badge-{{ $vente->mode_paiement }}">
                                        @switch($vente->mode_paiement)
                                            @case('especes')
                                                💵
                                            @break

                                            @case('mobile_money')
                                                📱
                                            @break

                                            @case('carte')
                                                💳
                                            @break

                                            @case('cheque')
                                                📄
                                            @break
                                        @endswitch
                                        {{ $vente->mode_paiement_text }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-statut badge-{{ $vente->statut }}">
                                        @if ($vente->statut == 'terminee')
                                            <i class="fas fa-check-circle"></i>
                                        @elseif($vente->statut == 'annulee')
                                            <i class="fas fa-times-circle"></i>
                                        @endif
                                        {{ $vente->statut_text }}
                                    </span>
                                </td>
                                <td>
                                    <div class="vendeur-info">
                                        <i class="fas fa-user"></i>
                                        <span>{{ $vente->vendeur->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="actions-buttons">
                                        <a href="{{ route('ventes.show', $vente) }}" class="btn-action btn-view"
                                            title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if ($vente->statut != 'annulee')
                                            <a href="{{ route('ventes.edit', $vente) }}" class="btn-action btn-edit"
                                                title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="{{ route('ventes.imprimer', $vente) }}" class="btn-action btn-print"
                                                title="Imprimer" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        @endif

                                        @if ($vente->statut != 'annulee')
                                            <form action="{{ route('ventes.annuler', $vente) }}" method="POST"
                                                class="d-inline annuler-form">
                                                @csrf
                                                <button type="button" class="btn-action btn-cancel annuler-btn"
                                                    title="Annuler" data-numero="{{ $vente->numero_vente }}">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="empty-state">
                                            <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                            <h4>Aucune vente trouvée</h4>
                                            <p>Commencez par créer votre première vente</p>
                                            <a href="{{ route('ventes.create') }}" class="btn-add">
                                                <i class="fas fa-plus"></i> Créer une vente
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($ventes->hasPages())
                    <div class="pagination">
                        {{ $ventes->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Couleurs pour les graphiques
                const colors = {
                    primary: '#4361ee',
                    secondary: '#7209b7',
                    success: '#06d6a0',
                    danger: '#ef476f',
                    warning: '#ffd166',
                    info: '#4cc9f0',
                    dark: '#1a1a2e',
                    gray: '#6c757d'
                };

                // Données réelles depuis le contrôleur
                const chartData = @json($chartData);

                // 1. Graphique Ventes par jour
                if (document.getElementById('ventesParJourChart')) {
                    const ctx1 = document.getElementById('ventesParJourChart').getContext('2d');
                    new Chart(ctx1, {
                        type: 'line',
                        data: {
                            labels: chartData.ventes_par_jour?.labels || ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven',
                                'Sam', 'Dim'
                            ],
                            datasets: [{
                                label: 'Ventes (FCFA)',
                                data: chartData.ventes_par_jour?.data || [0, 0, 0, 0, 0, 0, 0],
                                borderColor: colors.primary,
                                backgroundColor: colors.primary + '20',
                                borderWidth: 3,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                // 2. Graphique Mode de paiement
                if (document.getElementById('modePaiementChart')) {
                    const ctx2 = document.getElementById('modePaiementChart').getContext('2d');
                    new Chart(ctx2, {
                        type: 'doughnut',
                        data: {
                            labels: chartData.mode_paiement?.labels || ['Espèces', 'Mobile Money', 'Carte',
                                'Chèque'
                            ],
                            datasets: [{
                                data: chartData.mode_paiement?.data || [25, 30, 20, 5],
                                backgroundColor: [
                                    colors.success,
                                    colors.info,
                                    colors.primary,
                                    colors.gray
                                ],
                                borderWidth: 2,
                                borderColor: 'white'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right'
                                }
                            }
                        }
                    });
                }

                // 3. Graphique Top produits
                if (document.getElementById('topProduitsChart')) {
                    const ctx3 = document.getElementById('topProduitsChart').getContext('2d');
                    new Chart(ctx3, {
                        type: 'bar',
                        data: {
                            labels: chartData.top_produits?.labels || ['Produit 1', 'Produit 2', 'Produit 3',
                                'Produit 4', 'Produit 5'
                            ],
                            datasets: [{
                                label: 'Quantités vendues',
                                data: chartData.top_produits?.data || [10, 8, 6, 4, 2],
                                backgroundColor: [
                                    colors.primary,
                                    colors.secondary,
                                    colors.success,
                                    colors.warning,
                                    colors.info
                                ],
                                borderWidth: 0,
                                borderRadius: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                // 4. Graphique Évolution CA
                if (document.getElementById('evolutionCAChart')) {
                    const ctx4 = document.getElementById('evolutionCAChart').getContext('2d');
                    new Chart(ctx4, {
                        type: 'bar',
                        data: {
                            labels: chartData.evolution_ca?.labels || ['Jan', 'Fév', 'Mar', 'Avr', 'Mai',
                                'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'
                            ],
                            datasets: [{
                                label: 'Chiffre d\'affaires',
                                data: chartData.evolution_ca?.data || [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                                    0
                                ],
                                backgroundColor: colors.primary + '80',
                                borderColor: colors.primary,
                                borderWidth: 2,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                // 5. Graphique Heures de vente
                if (document.getElementById('heuresVenteChart')) {
                    const ctx5 = document.getElementById('heuresVenteChart').getContext('2d');
                    new Chart(ctx5, {
                        type: 'radar',
                        data: {
                            labels: chartData.heures_vente?.labels || ['8h', '10h', '12h', '14h', '16h', '18h',
                                '20h'
                            ],
                            datasets: [{
                                label: 'Nombre de ventes',
                                data: chartData.heures_vente?.data || [5, 12, 8, 15, 10, 7, 3],
                                backgroundColor: colors.secondary + '40',
                                borderColor: colors.secondary,
                                borderWidth: 3
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                }

                // Gestion de l'annulation
                document.querySelectorAll('.annuler-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const form = this.closest('form');
                        const numero = this.getAttribute('data-numero');

                        Swal.fire({
                            title: 'Annuler cette vente ?',
                            html: `
                    <div class="text-start">
                        <p>Voulez-vous annuler la vente <strong>${numero}</strong> ?</p>
                          <div style="background: rgba(239, 71, 111, 0.1); padding: 15px; border-radius: 12px; margin-top: 20px;">
                            <i class="fas fa-box" style="color: #ef476f; margin-right: 10px;"></i>
                            <strong style="color: #ef476f;">Attention :</strong>
                            <span style="color: #6c757d;">Le stock sera restauré pour chaque produit vendu.</span>
                        </div>
                    </div>
                `,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: colors.danger,
                            cancelButtonColor: colors.gray,
                            confirmButtonText: 'Oui, annuler',
                            cancelButtonText: 'Non, garder'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });

                // Animation des statistiques
                const statValues = document.querySelectorAll('.stat-value');
                statValues.forEach(stat => {
                    const text = stat.textContent;
                    const match = text.match(/([\d\s]+)/);
                    if (match) {
                        const finalValue = parseInt(match[1].replace(/\s/g, ''));
                        let current = 0;
                        const increment = finalValue / 50;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= finalValue) {
                                current = finalValue;
                                clearInterval(timer);
                            }
                            const formatted = new Intl.NumberFormat('fr-FR').format(Math.floor(
                                current));
                            stat.textContent = text.replace(match[1], formatted);
                        }, 30);
                    }
                });
            });
        </script>
    @endsection
