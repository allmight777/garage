{{-- resources/views/ventes/create.blade.php --}}
@extends('layouts.admin')

@section('content')
    <!-- Styles -->
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --danger: #ef476f;
            --success: #06d6a0;
            --warning: #ffd166;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --gray: #6c757d;
            --border: #e0e0e0;
            --shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            --radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .animate-slide-down {
            animation: slideDown 0.6s ease-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.5s ease-out forwards;
            opacity: 0;
        }

        /* Header */
        .admin-container {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 30px;
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .admin-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .admin-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark);
            margin: 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .admin-subtitle {
            color: var(--gray);
            font-size: 1.1rem;
            margin-top: 10px;
        }

        .header-actions {
            display: flex;
            gap: 15px;
        }

        .btn-action {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .btn-view {
            background: linear-gradient(135deg, var(--success), #00b894);
            color: white;
            box-shadow: 0 4px 15px rgba(6, 214, 160, 0.3);
        }

        .btn-view:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(6, 214, 160, 0.4);
        }

        /* Messages flash */
        .success-message,
        .error-message {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 350px;
            max-width: 500px;
        }

        .alert-success,
        .alert-error {
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 15px;
            animation: slideInRight 0.5s ease-out;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #06d6a0, #00b894);
            color: white;
            border-left: 5px solid #00a085;
        }

        .alert-error {
            background: linear-gradient(135deg, #ef476f, #d00000);
            color: white;
            border-left: 5px solid #b00000;
        }

        .close-alert {
            margin-left: auto;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .close-alert:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        /* Cartes */
        .main-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            overflow: hidden;
            transition: var(--transition);
            height: 100%;
        }

        .main-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            padding: 20px 25px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(90deg, #f8f9fa, white);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-body {
            padding: 25px;
        }

        /* Badges */
        .badge-optional {
            background: var(--warning);
            color: var(--dark);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .badge-panier {
            background: var(--primary);
            color: white;
            padding: 4px 10px;
            border-radius: 50%;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: 10px;
        }

        /* Recherche */
        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            z-index: 1;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 2px solid var(--border);
            border-radius: 50px;
            font-size: 0.9rem;
            transition: var(--transition);
            background: #f8f9fa;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        /* Grid produits */
        .produits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .produit-card {
            background: white;
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            transition: var(--transition);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .produit-card:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .produit-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .produit-ref {
            font-size: 0.85rem;
            color: var(--gray);
            font-weight: 600;
        }

        .badge-stock {
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        .badge-stock.normal {
            background: var(--success);
            color: white;
        }

        .badge-stock.alerte {
            background: var(--warning);
            color: var(--dark);
        }

        .badge-stock.rupture {
            background: var(--danger);
            color: white;
        }

        .produit-body {
            margin-bottom: 15px;
        }

        .produit-nom {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
            margin: 0 0 5px 0;
        }

        .produit-marque {
            font-size: 0.9rem;
            color: var(--gray);
            margin: 0 0 10px 0;
        }

        .produit-prix {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .produit-footer {
            text-align: center;
        }

        .btn-ajouter {
            width: 100%;
            padding: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-ajouter:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        /* Résultats recherche */
        .search-results {
            border: 2px solid var(--border);
            border-radius: 12px;
            max-height: 400px;
            overflow-y: auto;
            margin-top: 10px;
            display: none;
        }

        /* Tableau panier */
        .table-container {
            overflow-x: auto;
        }

        .styled-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .styled-table thead th {
            padding: 15px 20px;
            background: linear-gradient(90deg, #f8f9fa, white);
            color: var(--dark);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            white-space: nowrap;
        }

        .table-row {
            background: white;
            border-radius: 12px;
            transition: var(--transition);
        }

        .table-row:hover {
            background: #f8f9fa;
            transform: translateX(5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .table-row td {
            padding: 15px;
            border: none;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .table-row td:first-child {
            border-left: 1px solid var(--border);
            border-radius: 12px 0 0 12px;
        }

        .table-row td:last-child {
            border-right: 1px solid var(--border);
            border-radius: 0 12px 12px 0;
        }

        .empty-panier {
            padding: 40px 20px;
            text-align: center;
        }

        .empty-state {
            color: var(--gray);
        }

        .empty-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--border);
        }

        .empty-state h4 {
            margin: 10px 0;
            color: var(--dark);
        }

        /* Contrôle quantité */
        .qty-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-qty {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            border: 2px solid var(--border);
            background: white;
            color: var(--dark);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-qty:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-qty:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .qty-input {
            width: 60px;
            text-align: center;
            padding: 8px;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-weight: 600;
        }

        .qty-input:focus {
            outline: none;
            border-color: var(--primary);
        }

        /* Actions produits */
        .btn-remove {
            background: linear-gradient(135deg, var(--danger), #d00000);
            color: white;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-remove:hover {
            transform: scale(1.1);
        }

        /* Total */
        .total-row {
            background: linear-gradient(90deg, #f8f9fa, white);
        }

        .total-amount {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            padding: 15px 20px;
        }

        /* Formulaire client */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control,
        .styled-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 0.95rem;
            transition: var(--transition);
            background: #f8f9fa;
        }

        .styled-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236c757d' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
            padding-right: 40px;
        }

        .form-control:focus,
        .styled-select:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .client-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .client-form-grid .full-width {
            grid-column: 1 / -1;
        }

        /* Carte récapitulatif */
        .summary-card {
            background: linear-gradient(135deg, #f8f9fa, white);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border);
            margin-top: 20px;
        }

        .summary-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .summary-items {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.2rem;
            padding-top: 15px;
            border-top: 2px solid var(--border);
        }

        .total-final {
            color: var(--primary);
            font-size: 1.3rem;
            font-weight: 800;
        }

        /* Bouton finaliser */
        .btn-finaliser {
            width: 100%;
            padding: 18px;
            background: #0B9EF3;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(6, 214, 160, 0.3);
        }

        .btn-finaliser:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(6, 214, 160, 0.4);
        }

        .btn-finaliser:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Modal chargement */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }

        .modal-container {
            background: white;
            border-radius: var(--radius);
            padding: 40px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: modalSlideDown 0.5s ease-out;
        }

        @keyframes modalSlideDown {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .spinner-container {
            margin-bottom: 20px;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .modal-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .modal-text {
            color: var(--gray);
            font-size: 0.95rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .admin-container {
                padding: 15px;
            }

            .admin-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
                padding: 20px;
            }

            .admin-title {
                font-size: 2rem;
            }

            .produits-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .client-form-grid {
                grid-template-columns: 1fr;
            }

            .card-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .search-box {
                width: 100%;
            }

            .produits-grid {
                grid-template-columns: 1fr;
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


    <div class="admin-container">

        <!-- Header avec animation -->
        <div class="admin-header">
            <div class="header-content animate-slide-down">
                <h1 class="admin-title">💰 Nouvelle Vente</h1>
                <p class="admin-subtitle">Enregistrez une nouvelle vente</p>
            </div>

            <div class="header-actions">
                <a href="{{ route('ventes.index') }}" class="btn-action btn-view">
                    <i class="fas fa-list"></i> Liste des ventes
                </a>
            </div>
        </div>

        <!-- Messages flash -->
        @if (session('success'))
            <div class="success-message animate__animated animate__fadeInDown">
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                    <button type="button" class="close-alert" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="error-message animate__animated animate__fadeInDown">
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                    <button type="button" class="close-alert" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <div class="row animate-fade-in">
            <div class="col-md-8">
                <!-- Carte produits disponibles -->
                <div class="main-card mb-4">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-box"></i> Produits en Stock
                        </h2>
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchProduit" placeholder="Rechercher produit...">
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Liste initiale des produits -->
                        <div id="produitsListe" class="produits-grid">
                            @foreach ($produits as $produit)
                                <div class="produit-card" data-id="{{ $produit->id }}" data-nom="{{ $produit->nom }}"
                                    data-reference="{{ $produit->reference }}" data-prix="{{ $produit->prix_vente }}"
                                    data-stock="{{ $produit->stock_actuel }}" data-marque="{{ $produit->marque }}"
                                    onclick="ajouterAuPanier(this)">
                                    <div class="produit-header">
                                        <span class="produit-ref">#{{ $produit->reference }}</span>
                                        <span
                                            class="badge-stock {{ $produit->stock_actuel <= 0 ? 'rupture' : ($produit->stock_actuel <= $produit->seuil_alerte ? 'alerte' : 'normal') }}">
                                            {{ $produit->stock_actuel }} en stock
                                        </span>
                                    </div>
                                    <div class="produit-body">
                                        <h4 class="produit-nom">{{ $produit->nom }}</h4>
                                        <p class="produit-marque">{{ $produit->marque }}</p>
                                        <div class="produit-prix">{{ number_format($produit->prix_vente, 0, ',', ' ') }}
                                            FCFA</div>
                                    </div>
                                    <div class="produit-footer">
                                        <button class="btn-ajouter">
                                            <i class="fas fa-plus"></i> Ajouter
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Résultats recherche -->
                        <div id="searchResults" class="search-results" style="display:none;"></div>
                    </div>
                </div>

                <!-- Carte Panier -->
                <div class="main-card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-shopping-cart"></i> Panier
                            <span class="badge-panier" id="countPanier">0</span>
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="table-container">
                            <table class="styled-table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th width="120">Prix Unitaire</th>
                                        <th width="150">Quantité</th>
                                        <th width="120">Sous-total</th>
                                        <th width="80">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="panierBody">
                                    <tr id="panierVide">
                                        <td colspan="5" class="empty-panier">
                                            <div class="empty-state">
                                                <div class="empty-icon">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </div>
                                                <h4>Panier vide</h4>
                                                <p>Ajoutez des produits depuis la liste</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot id="panierFooter" style="display:none;">
                                    <tr class="total-row">
                                        <td colspan="2" class="text-end">
                                            <strong>TOTAL</strong>
                                        </td>
                                        <td colspan="3" class="total-amount">
                                            <span id="totalVente">0</span> FCFA
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Carte Client -->
                <div class="main-card mb-4">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-user"></i> Informations Client
                            <span class="badge-optional">Optionnel</span>
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-search"></i> Client existant
                            </label>
                            <select id="selectClient" class="form-select styled-select">
                                <option value="">Sélectionner un client...</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" data-nom="{{ $client->nom }}"
                                        data-prenom="{{ $client->prenom }}" data-telephone="{{ $client->telephone }}"
                                        data-adresse="{{ $client->adresse }}">
                                        {{ $client->nom_complet }}
                                        {{ $client->telephone ? "- {$client->telephone}" : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-user-plus"></i> Nouveau client
                            </label>
                            <div class="client-form-grid">
                                <div class="form-group">
                                    <input type="text" id="clientPrenom" class="form-control" placeholder="Prénom">
                                </div>
                                <div class="form-group">
                                    <input type="text" id="clientNom" class="form-control" placeholder="Nom">
                                </div>
                                <div class="form-group full-width">
                                    <input type="text" id="clientTelephone" class="form-control"
                                        placeholder="Téléphone">
                                </div>
                                <div class="form-group full-width">
                                    <textarea id="clientAdresse" class="form-control" rows="2" placeholder="Adresse"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte Paiement -->
                <div class="main-card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-money-bill-wave"></i> Paiement
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-credit-card"></i> Mode de paiement *
                            </label>
                            <select id="modePaiement" class="form-select styled-select" required>
                                <option value="especes">💵 Espèces</option>
                                <option value="mobile_money">📱 Mobile Money</option>
                                <option value="carte">💳 Carte bancaire</option>
                                <option value="cheque">📄 Chèque</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-sticky-note"></i> Notes
                            </label>
                            <textarea id="notes" class="form-control" rows="3" placeholder="Notes sur la vente..."></textarea>
                        </div>

                        <div class="summary-card">
                            <h4 class="summary-title">
                                <i class="fas fa-receipt"></i> Récapitulatif
                            </h4>
                            <div class="summary-items">
                                <div class="summary-item">
                                    <span>Articles :</span>
                                    <strong id="nombreArticles">0</strong>
                                </div>
                                <div class="summary-item">
                                    <span>Total :</span>
                                    <strong id="totalFinal">0 FCFA</strong>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button id="btnFinaliser" class="btn-finaliser" disabled>
                                <i class="fas fa-check-circle"></i> FINALISER LA VENTE
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chargement -->
    <div class="modal-overlay" id="loadingModal" style="display: none;">
        <div class="modal-container">
            <div class="modal-content text-center">
                <div class="spinner-container">
                    <div class="spinner"></div>
                </div>
                <h3 class="modal-title">Enregistrement en cours...</h3>
                <p class="modal-text">Veuillez patienter</p>
            </div>
        </div>
    </div>



    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        let panier = [];
        let clientId = null;

        // Fonction pour ajouter au panier
        function ajouterAuPanier(element) {
            let produit = {
                id: $(element).data('id'),
                nom: $(element).data('nom'),
                reference: $(element).data('reference'),
                prix: $(element).data('prix'),
                stock: $(element).data('stock'),
                marque: $(element).data('marque'),
                quantite: 1
            };

            // Vérifier stock
            if (produit.stock <= 0) {
                Swal.fire({
                    title: 'Stock épuisé',
                    text: 'Ce produit est en rupture de stock',
                    icon: 'warning',
                    timer: 2000,
                    showConfirmButton: false
                });
                return;
            }

            // Vérifier si déjà dans panier
            let index = panier.findIndex(p => p.id === produit.id);
            if (index !== -1) {
                if (panier[index].quantite < panier[index].stock) {
                    panier[index].quantite++;
                } else {
                    Swal.fire({
                        title: 'Stock maximum',
                        text: `Stock maximum atteint pour ${produit.nom}`,
                        icon: 'warning',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return;
                }
            } else {
                panier.push(produit);
            }

            mettreAJourPanier();

            // Animation d'ajout
            $(element).addClass('added');
            setTimeout(() => $(element).removeClass('added'), 500);
        }

        // Recherche produit
        let searchTimeout;
        $('#searchProduit').on('input', function() {
            clearTimeout(searchTimeout);
            let query = $(this).val();

            if (query.length === 0) {
                $('#searchResults').hide();
                $('#produitsListe').show();
                return;
            }

            searchTimeout = setTimeout(() => {
                if (query.length < 2) return;

                $.ajax({
                    url: '{{ route('ventes.search.produits') }}',
                    data: {
                        q: query
                    },
                    success: function(produits) {
                        let html = '';

                        if (produits.length > 0) {
                            produits.forEach(p => {
                                let badgeClass = p.stock_actuel <= 0 ? 'rupture' :
                                    (p.stock_actuel <= 5 ? 'alerte' : 'normal');

                                html += `
                        <div class="produit-card"
                             data-id="${p.id}"
                             data-nom="${p.nom}"
                             data-reference="${p.reference}"
                             data-prix="${p.prix_vente}"
                             data-stock="${p.stock_actuel}"
                             onclick="ajouterAuPanier(this)">
                            <div class="produit-header">
                                <span class="produit-ref">#${p.reference}</span>
                                <span class="badge-stock ${badgeClass}">
                                    ${p.stock_actuel} en stock
                                </span>
                            </div>
                            <div class="produit-body">
                                <h4 class="produit-nom">${p.nom}</h4>
                                <div class="produit-prix">${formatPrix(p.prix_vente)}</div>
                            </div>
                            <div class="produit-footer">
                                <button class="btn-ajouter">
                                    <i class="fas fa-plus"></i> Ajouter
                                </button>
                            </div>
                        </div>`;
                            });
                        } else {
                            html =
                                '<div class="text-center p-4 text-muted">Aucun produit trouvé</div>';
                        }

                        $('#searchResults').html(html).show();
                        $('#produitsListe').hide();
                    }
                });
            }, 300);
        });

        // Mettre à jour panier
        function mettreAJourPanier() {
            let html = '';
            let total = 0;
            let nombreArticles = 0;

            panier.forEach((p, index) => {
                let sousTotal = p.prix * p.quantite;
                total += sousTotal;
                nombreArticles += p.quantite;

                html += `
        <tr class="table-row animate-slide-up" data-index="${index}">
            <td>
                <div class="produit-info">
                    <div class="produit-nom">${p.nom}</div>
                    <div class="produit-ref">${p.reference} - ${p.marque}</div>
                </div>
            </td>
            <td class="text-center">
                <span class="produit-prix">${formatPrix(p.prix)}</span>
            </td>
            <td>
                <div class="qty-control">
                    <button class="btn-qty btn-decrement" onclick="modifierQuantite(${index}, -1)" ${p.quantite <= 1 ? 'disabled' : ''}>
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" min="1" max="${p.stock}"
                           value="${p.quantite}" class="qty-input"
                           onchange="modifierQuantiteInput(${index}, this.value)">
                    <button class="btn-qty btn-increment" onclick="modifierQuantite(${index}, 1)" ${p.quantite >= p.stock ? 'disabled' : ''}>
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </td>
            <td class="text-center">
                <strong>${formatPrix(sousTotal)}</strong>
            </td>
            <td class="text-center">
                <button class="btn-remove" onclick="retirerProduit(${index})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>`;
            });

            if (panier.length === 0) {
                $('#panierVide').show();
                $('#panierFooter').hide();
            } else {
                $('#panierVide').hide();
                $('#panierFooter').show();
                $('#panierBody').html(html);
            }

            $('#totalVente').text(formatPrix(total));
            $('#nombreArticles').text(nombreArticles);
            $('#totalFinal').text(formatPrix(total));
            $('#countPanier').text(panier.length);

            $('#btnFinaliser').prop('disabled', panier.length === 0);
        }

        // Formater le prix
        function formatPrix(prix) {
            return new Intl.NumberFormat('fr-FR').format(prix) + ' FCFA';
        }

        // Modifier quantité
        function modifierQuantite(index, delta) {
            if (panier[index]) {
                let nouvelleQuantite = panier[index].quantite + delta;
                if (nouvelleQuantite >= 1 && nouvelleQuantite <= panier[index].stock) {
                    panier[index].quantite = nouvelleQuantite;
                    mettreAJourPanier();
                }
            }
        }

        function modifierQuantiteInput(index, valeur) {
            let quantite = parseInt(valeur);
            if (!isNaN(quantite) && panier[index]) {
                if (quantite < 1) quantite = 1;
                if (quantite > panier[index].stock) {
                    Swal.fire({
                        title: 'Stock insuffisant',
                        text: `Stock maximum: ${panier[index].stock}`,
                        icon: 'warning',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    quantite = panier[index].stock;
                }
                panier[index].quantite = quantite;
                mettreAJourPanier();
            }
        }

        // Retirer produit
        function retirerProduit(index) {
            Swal.fire({
                title: 'Retirer du panier',
                text: `Retirer ${panier[index].nom} ?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ef476f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Retirer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    panier.splice(index, 1);
                    mettreAJourPanier();
                }
            });
        }

        // Gestion client
        $('#selectClient').on('change', function() {
            let selected = $(this).find('option:selected');
            clientId = $(this).val();

            if (clientId) {
                $('#clientPrenom').val(selected.data('prenom')).prop('disabled', true);
                $('#clientNom').val(selected.data('nom')).prop('disabled', true);
                $('#clientTelephone').val(selected.data('telephone')).prop('disabled', true);
                $('#clientAdresse').val(selected.data('adresse')).prop('disabled', true);
            } else {
                $('#clientPrenom, #clientNom, #clientTelephone, #clientAdresse')
                    .val('')
                    .prop('disabled', false);
            }
        });

        // Finaliser vente
        $('#btnFinaliser').click(function() {
            if (panier.length === 0) {
                Swal.fire({
                    title: 'Panier vide',
                    text: 'Ajoutez au moins un produit',
                    icon: 'warning',
                    timer: 2000,
                    showConfirmButton: false
                });
                return;
            }

            if (!$('#modePaiement').val()) {
                Swal.fire({
                    title: 'Mode de paiement',
                    text: 'Sélectionnez un mode de paiement',
                    icon: 'warning',
                    timer: 2000,
                    showConfirmButton: false
                });
                return;
            }

            Swal.fire({
                title: 'Confirmer la vente',
                html: `
            <div class="text-start">
                <p>Voulez-vous finaliser cette vente ?</p>
                <div class="mt-3 p-3 bg-light rounded">
                    <strong>Récapitulatif :</strong>
                    <div class="mt-2">Articles : <strong>${panier.reduce((sum, p) => sum + p.quantite, 0)}</strong></div>
                    <div>Total : <strong>${formatPrix(panier.reduce((sum, p) => sum + (p.prix * p.quantite), 0))}</strong></div>
                    <div>Client : <strong>${$('#clientNom').val() || 'Non spécifié'}</strong></div>
                </div>
            </div>
        `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#06d6a0',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Confirmer',
                cancelButtonText: 'Annuler',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    $('#loadingModal').show();

                    let data = {
                        client_id: clientId || null,
                        client_nom: $('#clientNom').val() || null,
                        client_prenom: $('#clientPrenom').val() || null,
                        client_telephone: $('#clientTelephone').val() || null,
                        client_adresse: $('#clientAdresse').val() || null,
                        produits: panier.map(p => ({
                            id: p.id,
                            quantite: p.quantite
                        })),
                        mode_paiement: $('#modePaiement').val(),
                        notes: $('#notes').val(),
                        _token: '{{ csrf_token() }}'
                    };

                    return $.ajax({
                        url: '{{ route('ventes.store') }}',
                        method: 'POST',
                        data: data,
                        success: function(response) {
                            $('#loadingModal').hide();

                            if (response.success) {
                                Swal.fire({
                                    title: 'Succès !',
                                    html: `
                                <div class="text-center">
                                    <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                                    <h4 class="mt-3">Vente enregistrée</h4>
                                    <div class="mt-3">
                                        <p><strong>Numéro :</strong> ${response.numero_vente}</p>
                                        <p><strong>Total :</strong> ${response.total}</p>
                                    </div>
                                </div>
                            `,
                                    icon: 'success',
                                    showCancelButton: true,
                                    confirmButtonText: 'Nouvelle vente',
                                    cancelButtonText: 'Liste des ventes'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    } else {
                                        window.location.href =
                                            '{{ route('ventes.index') }}';
                                    }
                                });
                            } else {
                                Swal.fire('Erreur', response.message, 'error');
                            }
                        },
                        error: function(xhr) {
                            $('#loadingModal').hide();
                            let message = 'Une erreur est survenue';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }
                            Swal.fire('Erreur', message, 'error');
                        }
                    });
                }
            });
        });

        // Initialiser
        mettreAJourPanier();
    </script>
@endsection
