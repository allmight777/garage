{{-- resources/views/ventes/edit.blade.php --}}
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
    }

    .edit-vente-container {
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
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
        color: white;
    }

    .admin-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg,
            rgba(255,255,255,0.1) 0%,
            rgba(255,255,255,0.05) 100%);
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .admin-title {
        font-size: 2.8rem;
        font-weight: 900;
        margin: 0;
        color: white;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .admin-subtitle {
        color: rgba(255,255,255,0.9);
        font-size: 1.2rem;
        margin-top: 8px;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 15px;
        position: relative;
        z-index: 2;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 14px 28px;
        background: rgba(255,255,255,0.15);
        color: white;
        text-decoration: none;
        border-radius: var(--radius);
        font-weight: 600;
        transition: var(--transition);
        border: 2px solid rgba(255,255,255,0.2);
    }

    .btn-back:hover {
        background: rgba(255,255,255,0.25);
        transform: translateY(-2px);
    }

    /* Cartes */
    .main-card {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 1px solid var(--glass-border);
        box-shadow: var(--shadow);
        transition: var(--transition);
        margin-bottom: 25px;
    }

    .main-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }

    .card-header {
        padding: 25px 30px;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(114, 9, 183, 0.1));
        border-bottom: 1px solid var(--glass-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .card-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 15px;
        margin: 0;
    }

    .card-title i {
        color: var(--primary);
        font-size: 1.3rem;
    }

    /* Barre de recherche */
    .search-container {
        position: relative;
        width: 100%;
        max-width: 400px;
    }

    .search-box {
        position: relative;
        background: white;
        border-radius: var(--radius);
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .search-box i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
        font-size: 1.1rem;
    }

    .search-box input {
        width: 100%;
        padding: 14px 20px 14px 50px;
        border: 2px solid transparent;
        border-radius: var(--radius);
        font-size: 1rem;
        transition: var(--transition);
        background: transparent;
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
    }

    /* Résultats recherche */
    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border-radius: var(--radius);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        z-index: 1000;
        max-height: 400px;
        overflow-y: auto;
        margin-top: 10px;
    }

    .produit-item {
        padding: 15px 20px;
        border-bottom: 1px solid var(--border);
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .produit-item:hover {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.05), rgba(114, 9, 183, 0.05));
    }

    .produit-item strong {
        color: var(--dark);
        font-size: 1.1rem;
    }

    .produit-item small {
        color: var(--gray);
        font-size: 0.9rem;
    }

    .badge-stock {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-left: 10px;
    }

    .badge-stock.normal {
        background: rgba(6, 214, 160, 0.1);
        color: var(--success);
        border: 1px solid rgba(6, 214, 160, 0.2);
    }

    .badge-stock.rupture {
        background: rgba(239, 71, 111, 0.1);
        color: var(--danger);
        border: 1px solid rgba(239, 71, 111, 0.2);
    }

    /* Tableau produits */
    .table-responsive {
        padding: 25px 30px;
    }

    .produits-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .produits-table thead th {
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(114, 9, 183, 0.1));
        color: var(--gray);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9rem;
        padding: 18px 15px;
        border: none;
    }

    .produits-table thead th:first-child {
        border-radius: 12px 0 0 12px;
    }

    .produits-table thead th:last-child {
        border-radius: 0 12px 12px 0;
    }

    .table-row {
        background: white;
        border-radius: 12px;
        transition: var(--transition);
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    }

    .table-row:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .table-row td {
        padding: 20px 15px;
        border: none;
        vertical-align: middle;
        background: transparent;
    }

    .produit-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .produit-info strong {
        color: var(--dark);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .produit-info small {
        color: var(--gray);
        font-size: 0.9rem;
    }

    /* Contrôles quantité */
    .qty-control {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .qty-input {
        width: 70px;
        text-align: center;
        padding: 8px;
        border: 2px solid var(--border);
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--dark);
    }

    .qty-input:focus {
        outline: none;
        border-color: var(--primary);
    }

    .btn-qty {
        width: 40px;
        height: 40px;
        border: none;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border-radius: 50%;
        font-size: 1.2rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-qty:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    }

    /* Input prix */
    .prix-input {
        width: 140px;
        padding: 10px;
        border: 2px solid var(--border);
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        color: var(--dark);
        transition: var(--transition);
    }

    .prix-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    /* Bouton supprimer */
    .btn-remove {
        width: 45px;
        height: 45px;
        border: none;
        background: linear-gradient(135deg, rgba(239, 71, 111, 0.1), rgba(208, 0, 0, 0.1));
        color: var(--danger);
        border-radius: 50%;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    .btn-remove:hover {
        background: linear-gradient(135deg, var(--danger), var(--danger-dark));
        color: white;
        transform: scale(1.1);
    }

    /* Sous-total et total */
    .sous-total {
        font-weight: 800;
        font-size: 1.2rem;
        color: var(--dark);
    }

    .total-row {
        background: linear-gradient(135deg, rgba(6, 214, 160, 0.05), rgba(0, 184, 148, 0.05));
        border: 2px solid rgba(6, 214, 160, 0.1);
    }

    .total-label {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--dark);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .total-amount {
        font-size: 2rem;
        font-weight: 900;
        color: var(--success);
        text-shadow: 0 2px 5px rgba(6, 214, 160, 0.2);
    }

    /* Formulaire */
    .card-body {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: var(--dark);
        font-size: 1rem;
    }

    .form-control {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid var(--border);
        border-radius: 10px;
        font-size: 1rem;
        transition: var(--transition);
        background: white;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%234361ee' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px;
        padding-right: 40px;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    /* Bouton final */
    .btn-finaliser {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, var(--success), var(--success-dark));
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.2rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-finaliser:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(6, 214, 160, 0.3);
    }

    .btn-outline-secondary {
        width: 100%;
        padding: 15px;
        background: transparent;
        border: 2px solid var(--gray);
        color: var(--gray);
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .btn-outline-secondary:hover {
        background: var(--gray);
        color: white;
        transform: translateY(-2px);
    }

    /* Messages d'erreur */
    .error-message {
        position: fixed;
        top: 25px;
        right: 25px;
        z-index: 9999;
        min-width: 400px;
        animation: slideInRight 0.5s ease-out;
    }

    .alert-error {
        padding: 20px 25px;
        background: linear-gradient(135deg, var(--danger), var(--danger-dark));
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 8px 25px rgba(239, 71, 111, 0.3);
    }

    .alert-error i {
        font-size: 1.5rem;
    }

    .close-alert {
        margin-left: auto;
        background: transparent;
        border: none;
        color: white;
        cursor: pointer;
        font-size: 1.1rem;
    }

    /* Animations */
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

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .edit-vente-container {
            padding: 20px;
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

        .search-container {
            max-width: 100%;
        }
    }

    @media (max-width: 768px) {
        .produits-table {
            font-size: 0.9rem;
        }

        .qty-input {
            width: 50px;
        }

        .btn-qty {
            width: 35px;
            height: 35px;
        }

        .prix-input {
            width: 100px;
        }

        .admin-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 576px) {
        .edit-vente-container {
            padding: 15px;
        }

        .produits-table thead {
            display: none;
        }

        .produits-table .table-row {
            display: block;
            margin-bottom: 20px;
        }

        .produits-table .table-row td {
            display: block;
            text-align: right;
            padding: 15px 20px;
            position: relative;
        }

        .produits-table .table-row td::before {
            content: attr(data-label);
            position: absolute;
            left: 20px;
            top: 15px;
            font-weight: 600;
            color: var(--gray);
        }

        .produits-table .table-row td:first-child {
            border-radius: 12px 12px 0 0;
        }

        .produits-table .table-row td:last-child {
            border-radius: 0 0 12px 12px;
        }

        .qty-control {
            justify-content: flex-end;
        }

        .error-message {
            min-width: 90%;
            left: 5%;
            right: 5%;
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
                        <span
                            class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text"
                            class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="Type here..." />
                    </div>
                </div>
                <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                    <!-- online builder btn  -->
                    <!-- <li class="flex items-center">
                        <a class="inline-block px-8 py-2 mb-0 mr-4 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro border-fuchsia-500 ease-soft-in hover:scale-102 active:shadow-soft-xs text-fuchsia-500 hover:border-fuchsia-500 active:bg-fuchsia-500 active:hover:text-fuchsia-500 hover:text-fuchsia-500 tracking-tight-soft hover:bg-transparent hover:opacity-75 hover:shadow-none active:text-white active:hover:bg-transparent" target="_blank" href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053">Online Builder</a>
                      </li> -->
                    <li class="flex items-center">
                        <a href="./pages/sign-in.html"
                            class="block px-0 py-2 text-sm font-semibold transition-all ease-nav-brand text-slate-500">
                            <i class="fa fa-user sm:mr-1"></i>
                            <span class="hidden sm:inline">Sign In</span>
                        </a>
                    </li>
                    <li class="flex items-center pl-4 xl:hidden">
                        <a href="javascript:;" class="block p-0 text-sm transition-all ease-nav-brand text-slate-500"
                            sidenav-trigger>
                            <div class="w-4.5 overflow-hidden">
                                <i
                                    class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                <i
                                    class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            </div>
                        </a>
                    </li>
                    <li class="flex items-center px-4">
                        <a href="javascript:;" class="p-0 text-sm transition-all ease-nav-brand text-slate-500">
                            <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog"></i>
                            <!-- fixed-plugin-button-nav  -->
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>

<div class="edit-vente-container">
    <!-- Header -->
    <div class="admin-header animate-slide-down">
        <div class="header-content">
            <h1 class="admin-title">✏️ Modifier la Vente</h1>
            <p class="admin-subtitle">Transaction {{ $vente->numero_vente }}</p>
        </div>

        <div class="header-actions">
            <a href="{{ route('ventes.show', $vente) }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour aux détails
            </a>
        </div>
    </div>

    @if(session('error'))
    <div class="error-message">
        <div class="alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <div style="flex: 1;">
                <strong>Erreur</strong>
                <p style="margin: 5px 0 0 0; font-size: 0.95rem;">{{ session('error') }}</p>
            </div>
            <button type="button" class="close-alert" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    <form action="{{ route('ventes.update', $vente) }}" method="POST" id="editVenteForm">
        @csrf @method('PUT')

        <div class="row">
            <!-- Colonne produits -->
            <div class="col-lg-8">
                <div class="main-card mb-4 animate-fade-in">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-shopping-bag"></i> Produits de la vente
                        </h2>

                        <div class="search-container">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text"
                                       id="searchProduit"
                                       placeholder="Rechercher un produit à ajouter..."
                                       autocomplete="off">
                            </div>
                            <div id="searchResults" class="search-results"></div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="produits-table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th width="140">Prix unitaire</th>
                                    <th width="150">Quantité</th>
                                    <th width="140">Sous-total</th>
                                    <th width="80">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="panierBody">
                                @foreach($vente->ligneVentes as $ligne)
                                <tr class="table-row" data-index="{{ $loop->index }}">
                                    <td data-label="Produit">
                                        <div class="produit-info">
                                            <strong>{{ $ligne->produit->nom }}</strong>
                                            <small>Réf: {{ $ligne->produit->reference }}</small>
                                            <input type="hidden" name="produits[{{ $loop->index }}][ligne_id]" value="{{ $ligne->id }}">
                                            <input type="hidden" name="produits[{{ $loop->index }}][id]" value="{{ $ligne->produit_id }}">
                                        </div>
                                    </td>
                                    <td data-label="Prix unitaire">
                                        <input type="number"
                                               name="produits[{{ $loop->index }}][prix]"
                                               value="{{ $ligne->prix_unitaire }}"
                                               class="prix-input"
                                               min="0"
                                               step="10"
                                               onchange="calculerTotal()">
                                    </td>
                                    <td data-label="Quantité">
                                        <div class="qty-control">
                                            <button type="button" class="btn-qty btn-decrement" onclick="modifierQty(this, -1)">-</button>
                                            <input type="number"
                                                   name="produits[{{ $loop->index }}][quantite]"
                                                   value="{{ $ligne->quantite }}"
                                                   class="qty-input"
                                                   min="1"
                                                   max="{{ $ligne->produit->stock_actuel + $ligne->quantite }}"
                                                   onchange="calculerTotal()">
                                            <button type="button" class="btn-qty btn-increment" onclick="modifierQty(this, 1)">+</button>
                                        </div>
                                    </td>
                                    <td data-label="Sous-total" class="sous-total">
                                        {{ number_format($ligne->sous_total, 0, ',', ' ') }} FCFA
                                    </td>
                                    <td data-label="Actions" class="text-center">
                                        <button type="button" class="btn-remove" onclick="supprimerLigne(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-row total-row">
                                    <td colspan="3" class="text-right total-label">
                                        TOTAL GÉNÉRAL
                                    </td>
                                    <td colspan="2" class="text-right total-amount" id="totalVente">
                                        {{ number_format($vente->montant_total, 0, ',', ' ') }} FCFA
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Colonne paramètres -->
            <div class="col-lg-4">
                <!-- Informations de paiement -->
                <div class="main-card mb-4 animate-fade-in" style="animation-delay: 0.1s">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-credit-card"></i> Paiement
                        </h2>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Mode de paiement *</label>
                            <select name="mode_paiement" class="form-control" required>
                                <option value="especes" {{ $vente->mode_paiement == 'especes' ? 'selected' : '' }}>
                                    💵 Espèces
                                </option>
                                <option value="mobile_money" {{ $vente->mode_paiement == 'mobile_money' ? 'selected' : '' }}>
                                    📱 Mobile Money
                                </option>
                                <option value="carte" {{ $vente->mode_paiement == 'carte' ? 'selected' : '' }}>
                                    💳 Carte bancaire
                                </option>
                                <option value="cheque" {{ $vente->mode_paiement == 'cheque' ? 'selected' : '' }}>
                                    📄 Chèque
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Notes additionnelles</label>
                            <textarea name="notes" class="form-control" rows="5" placeholder="Ajouter des notes concernant cette vente...">{{ $vente->notes }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Informations client -->
                <div class="main-card mb-4 animate-fade-in" style="animation-delay: 0.2s">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-user-tie"></i> Client
                        </h2>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Client existant</label>
                            <select name="client_id" id="selectClient" class="form-control">
                                <option value="">👤 Nouveau client</option>
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ $vente->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->nom_complet }} {{ $client->telephone ? "- {$client->telephone}" : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nom complet *</label>
                            <input type="text"
                                   name="client_nom"
                                   class="form-control"
                                   value="{{ $vente->client_nom ?? ($vente->client->nom_complet ?? '') }}"
                                   placeholder="Ex: Jean Dupont"
                                   required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Téléphone</label>
                            <input type="text"
                                   name="client_telephone"
                                   class="form-control"
                                   value="{{ $vente->client_telephone ?? ($vente->client->telephone ?? '') }}"
                                   placeholder="Ex: +229 01 23 45 67">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Adresse</label>
                            <textarea name="client_adresse"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Adresse complète du client">{{ $vente->client_adresse ?? ($vente->client->adresse ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
          <div class="main-card animate-fade-in" style="animation-delay: 0.3s">
    <div class="card-body" style="display: flex; gap: 10px;">
        <button type="submit" class="btn-finaliser mb-3" style="flex: 1;">
            <i class="fas fa-save"></i> ENREGISTRER
        </button>

        <a href="{{ route('ventes.show', $vente) }}" class="btn-outline-secondary" style="flex: 1; text-align: center;">
            <i class="fas fa-times"></i> ANNULER
        </a>
    </div>
</div>

            </div>
        </div>
    </form>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes
    const cards = document.querySelectorAll('.animate-fade-in');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // Initialiser les totaux
    calculerTotal();
});

// Gestion quantité
function modifierQty(btn, delta) {
    const row = btn.closest('tr');
    const input = row.querySelector('.qty-input');
    let qty = parseInt(input.value) + delta;
    const max = parseInt(input.max);

    if (qty < parseInt(input.min)) qty = parseInt(input.min);
    if (qty > max) qty = max;

    input.value = qty;
    calculerSousTotal(row);
    calculerTotal();
}

// Calculer sous-total d'une ligne
function calculerSousTotal(row) {
    const prix = parseFloat(row.querySelector('.prix-input').value) || 0;
    const qty = parseInt(row.querySelector('.qty-input').value) || 0;
    const sousTotal = prix * qty;

    row.querySelector('.sous-total').textContent =
        new Intl.NumberFormat('fr-FR').format(sousTotal) + ' FCFA';
}

// Calculer total général
function calculerTotal() {
    let total = 0;
    document.querySelectorAll('.table-row[data-index]').forEach(row => {
        calculerSousTotal(row);
        const prix = parseFloat(row.querySelector('.prix-input').value) || 0;
        const qty = parseInt(row.querySelector('.qty-input').value) || 0;
        total += prix * qty;
    });

    document.getElementById('totalVente').textContent =
        new Intl.NumberFormat('fr-FR').format(total) + ' FCFA';
}

// Supprimer une ligne
function supprimerLigne(btn) {
    Swal.fire({
        title: 'Supprimer ce produit ?',
        html: `
            <div style="text-align: center;">
                <div style="font-size: 4rem; color: #ef476f; margin-bottom: 20px;">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <p style="color: #6c757d;">
                    Ce produit sera retiré de la vente
                </p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Supprimer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#ef476f',
        cancelButtonColor: '#6c757d',
        backdrop: 'rgba(0,0,0,0.8)'
    }).then((result) => {
        if (result.isConfirmed) {
            const row = btn.closest('tr');
            row.style.transition = 'all 0.3s ease';
            row.style.opacity = '0';
            row.style.transform = 'translateX(100px)';

            setTimeout(() => {
                row.remove();
                reindexerLignes();
                calculerTotal();
            }, 300);
        }
    });
}

// Réindexer les lignes
function reindexerLignes() {
    const rows = document.querySelectorAll('.table-row[data-index]');
    rows.forEach((row, index) => {
        row.setAttribute('data-index', index);

        // Mettre à jour les noms des inputs
        row.querySelectorAll('input[name*="produits"]').forEach(input => {
            const oldName = input.name;
            const newName = oldName.replace(/produits\[\d+\]/, `produits[${index}]`);
            input.name = newName;
        });
    });
}

// Recherche produit
let searchTimeout;
$('#searchProduit').on('input', function() {
    clearTimeout(searchTimeout);
    const query = $(this).val();

    if (query.length < 2) {
        $('#searchResults').html('').hide();
        return;
    }

    searchTimeout = setTimeout(() => {
        $.ajax({
            url: '{{ route("ventes.search.produits") }}',
            data: { q: query },
            success: function(produits) {
                let html = '';

                if (produits.length > 0) {
                    produits.forEach(p => {
                        const stockClass = p.stock_actuel <= 0 ? 'rupture' : 'normal';
                        html += `
                        <div class="produit-item"
                             onclick="ajouterProduit(${p.id}, '${p.nom.replace(/'/g, "\\'")}',
                                     '${p.reference}', ${p.prix_vente}, ${p.stock_actuel})">
                            <div>
                                <strong>${p.nom}</strong>
                                <br>
                                <small>${p.reference}</small>
                            </div>
                            <div style="text-align: right;">
                                <div>${new Intl.NumberFormat('fr-FR').format(p.prix_vente)} FCFA</div>
                                <span class="badge-stock ${stockClass}">
                                    Stock: ${p.stock_actuel}
                                </span>
                            </div>
                        </div>`;
                    });
                } else {
                    html = `
                    <div class="produit-item" style="justify-content: center; color: var(--gray);">
                        <i class="fas fa-search" style="margin-right: 10px;"></i>
                        Aucun produit trouvé
                    </div>`;
                }

                $('#searchResults').html(html).show();
            }
        });
    }, 300);
});

// Fermer les résultats en cliquant ailleurs
$(document).on('click', function(e) {
    if (!$(e.target).closest('#searchProduit, #searchResults').length) {
        $('#searchResults').hide();
    }
});

// Ajouter un produit
function ajouterProduit(id, nom, reference, prix, stock) {
    const index = document.querySelectorAll('.table-row[data-index]').length;

    // Vérifier si le produit est déjà dans le panier
    const existingRow = document.querySelector(`input[value="${id}"][name*="[id]"]`);
    if (existingRow) {
        Swal.fire({
            title: 'Produit déjà ajouté',
            text: 'Ce produit est déjà dans la vente',
            icon: 'info',
            timer: 2000
        });
        return;
    }

    const html = `
    <tr class="table-row" data-index="${index}">
        <td data-label="Produit">
            <div class="produit-info">
                <strong>${nom}</strong>
                <small>Réf: ${reference}</small>
                <input type="hidden" name="produits[${index}][id]" value="${id}">
            </div>
        </td>
        <td data-label="Prix unitaire">
            <input type="number"
                   name="produits[${index}][prix]"
                   value="${prix}"
                   class="prix-input"
                   min="0"
                   step="10"
                   onchange="calculerTotal()">
        </td>
        <td data-label="Quantité">
            <div class="qty-control">
                <button type="button" class="btn-qty btn-decrement" onclick="modifierQty(this, -1)">-</button>
                <input type="number"
                       name="produits[${index}][quantite]"
                       value="1"
                       class="qty-input"
                       min="1"
                       max="${stock}"
                       onchange="calculerTotal()">
                <button type="button" class="btn-qty btn-increment" onclick="modifierQty(this, 1)">+</button>
            </div>
        </td>
        <td data-label="Sous-total" class="sous-total">
            ${new Intl.NumberFormat('fr-FR').format(prix)} FCFA
        </td>
        <td data-label="Actions" class="text-center">
            <button type="button" class="btn-remove" onclick="supprimerLigne(this)">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>`;

    $('#panierBody').append(html);
    $('#searchProduit').val('');
    $('#searchResults').hide().empty();
    calculerTotal();

    // Animation d'ajout
    const newRow = $('#panierBody tr:last');
    newRow.css('opacity', '0').css('transform', 'translateY(-20px)');
    setTimeout(() => {
        newRow.css('transition', 'all 0.5s ease');
        newRow.css('opacity', '1').css('transform', 'translateY(0)');
    }, 10);
}

// Validation formulaire
document.getElementById('editVenteForm').addEventListener('submit', function(e) {
    const produits = document.querySelectorAll('.table-row[data-index]').length;

    if (produits === 0) {
        e.preventDefault();
        Swal.fire({
            title: 'Vente vide',
            text: 'Ajoutez au moins un produit à la vente',
            icon: 'error',
            confirmButtonColor: '#4361ee'
        });
        return;
    }

    const clientNom = document.querySelector('input[name="client_nom"]').value;
    if (!clientNom.trim()) {
        e.preventDefault();
        Swal.fire({
            title: 'Client requis',
            text: 'Le nom du client est obligatoire',
            icon: 'error',
            confirmButtonColor: '#4361ee'
        });
        return;
    }

    // Confirmation
    e.preventDefault();
    Swal.fire({
        title: 'Confirmer les modifications ?',
        html: `
            <div style="text-align: center;">
                <div style="font-size: 4rem; color: #4361ee; margin-bottom: 20px;">
                    <i class="fas fa-save"></i>
                </div>
                <p>Vous êtes sur le point de modifier la vente <strong>${'{{ $vente->numero_vente }}'}</strong></p>
                <div style="background: rgba(67, 97, 238, 0.1); padding: 15px; border-radius: 10px; margin-top: 20px;">
                    <i class="fas fa-info-circle" style="color: #4361ee; margin-right: 10px;"></i>
                    Les stocks seront automatiquement ajustés
                </div>
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Oui, enregistrer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#4361ee',
        cancelButtonColor: '#6c757d',
        backdrop: 'rgba(0,0,0,0.8)'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});
</script>
@endsection
