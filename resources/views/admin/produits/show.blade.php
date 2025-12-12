@extends('layouts.admin')

@section('content')
<style>
    /* Styles spécifiques à la vue show */
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

    .admin-container {
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        padding: 12px 20px;
        border-radius: var(--radius);
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        backdrop-filter: blur(10px);
    }

    .back-link:hover {
        transform: translateX(-5px);
        background: rgba(67, 97, 238, 0.1);
    }

    .product-detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        padding: 30px;
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        border-radius: var(--radius-lg);
        border: 1px solid var(--glass-border);
        box-shadow: var(--shadow);
    }

    .product-title {
        font-size: 2.5rem;
        font-weight: 900;
        margin: 0;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .product-subtitle {
        color: var(--gray);
        font-size: 1.1rem;
        margin-top: 8px;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 24px;
        border-radius: var(--radius);
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-edit {
        background: linear-gradient(135deg, var(--warning), var(--warning-dark));
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, var(--danger), var(--danger-dark));
        color: white;
    }

    .btn-back {
        background: var(--glass-bg);
        color: var(--dark);
        border: 1px solid var(--glass-border);
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 40px;
    }

    @media (max-width: 992px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }

    .detail-card {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        border-radius: var(--radius-lg);
        padding: 30px;
        border: 1px solid var(--glass-border);
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .detail-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }

    .card-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 25px;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-title i {
        color: var(--primary);
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    .info-item {
        padding: 15px;
        border-radius: var(--radius);
        background: rgba(255, 255, 255, 0.5);
        border: 1px solid var(--glass-border);
    }

    .info-label {
        font-size: 0.85rem;
        color: var(--gray);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .info-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--dark);
        word-break: break-word;
    }

    .stock-indicator {
        margin-top: 20px;
        padding: 20px;
        border-radius: var(--radius);
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(114, 9, 183, 0.1));
    }

    .stock-bar {
        height: 12px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 6px;
        overflow: hidden;
        margin: 15px 0;
    }

    .stock-fill {
        height: 100%;
        border-radius: 6px;
        transition: width 1s ease;
    }

    .stock-fill.high {
        background: linear-gradient(90deg, var(--success), var(--success-dark));
    }

    .stock-fill.medium {
        background: linear-gradient(90deg, var(--warning), var(--warning-dark));
    }

    .stock-fill.low {
        background: linear-gradient(90deg, var(--danger), var(--danger-dark));
    }

    .stock-numbers {
        display: flex;
        justify-content: space-between;
        font-weight: 600;
        color: var(--dark);
    }

    .image-container {
        text-align: center;
    }

    .product-image {
        max-width: 100%;
        height: auto;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        margin-bottom: 20px;
    }

    .no-image {
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: var(--gray);
        font-size: 4rem;
    }

    .price-card {
        background: linear-gradient(135deg, rgba(6, 214, 160, 0.1), rgba(0, 184, 148, 0.1));
    }

    .price-item {
        background: white;
        padding: 15px;
        border-radius: var(--radius);
        margin-bottom: 15px;
        border: 1px solid var(--border);
    }

    .price-item:last-child {
        margin-bottom: 0;
    }

    .price-label {
        color: var(--gray);
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .price-value {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--dark);
    }

    .price-value.profit {
        color: var(--success-dark);
    }

    .price-value.loss {
        color: var(--danger-dark);
    }

    .description-card {
        grid-column: 1 / -1;
    }

    .description-content {
        padding: 20px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: var(--radius);
        border: 1px solid var(--glass-border);
        line-height: 1.8;
        color: var(--dark);
        min-height: 150px;
        font-size: 1.05rem;
    }

    .empty-description {
        color: var(--gray);
        font-style: italic;
        text-align: center;
        padding: 40px 20px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .status-stock {
        background: rgba(6, 214, 160, 0.1);
        color: var(--success-dark);
    }

    .status-low {
        background: rgba(255, 209, 102, 0.1);
        color: var(--warning-dark);
    }

    .status-out {
        background: rgba(239, 71, 111, 0.1);
        color: var(--danger-dark);
    }

    /* Modal pour suppression */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(5px);
    }

    .modal-content {
        background: var(--glass-bg);
        border-radius: var(--radius-lg);
        padding: 40px;
        max-width: 500px;
        width: 90%;
        border: 1px solid var(--glass-border);
        box-shadow: var(--shadow-hover);
        text-align: center;
    }

    .modal-icon {
        font-size: 4rem;
        color: var(--danger);
        margin-bottom: 20px;
    }

    .modal-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 15px;
        color: var(--dark);
    }

    .modal-message {
        color: var(--gray);
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .modal-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .btn-modal {
        padding: 12px 30px;
        border-radius: var(--radius);
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        min-width: 120px;
    }

    .btn-modal-confirm {
        background: linear-gradient(135deg, var(--danger), var(--danger-dark));
        color: white;
    }

    .btn-modal-cancel {
        background: var(--glass-bg);
        color: var(--dark);
        border: 1px solid var(--glass-border);
    }

    .btn-modal:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
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
                <h6 class="mb-0 font-bold capitalize">Gestion des produits</h6>
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

<div class="admin-container">
    <!-- Lien retour -->
    <a href="{{ route('produits.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Retour à la liste
    </a>

    <!-- En-tête du produit -->
    <div class="product-detail-header">
        <div>
            <h1 class="product-title">{{ $produit->nom }}</h1>
            <p class="product-subtitle">Référence: #{{ $produit->reference }}</p>
        </div>
        <div class="action-buttons">
            <a href="{{ route('produits.edit', $produit) }}" class="btn-action btn-edit">
                <i class="fas fa-edit"></i>
                Modifier
            </a>
            <button onclick="openDeleteModal()" class="btn-action btn-delete">
                <i class="fas fa-trash"></i>
                Supprimer
            </button>
        </div>
    </div>

    <!-- Grille de détails -->
    <div class="detail-grid">
        <!-- Carte informations produit -->
        <div class="detail-card">
            <h2 class="card-title">
                <i class="fas fa-info-circle"></i>
                Informations produit
            </h2>

            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Référence</div>
                    <div class="info-value">#{{ $produit->reference }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Catégorie</div>
                    <div class="info-value">
                        @if($produit->typeProduit)
                            <span class="status-badge status-stock">
                                <i class="fas fa-tag"></i>
                                {{ $produit->typeProduit->nom }}
                            </span>
                        @else
                            <span style="color: var(--gray);">Non catégorisé</span>
                        @endif
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Marque</div>
                    <div class="info-value">{{ $produit->marque ?? 'Non spécifié' }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Modèle</div>
                    <div class="info-value">{{ $produit->modele ?? 'Non spécifié' }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Unité de mesure</div>
                    <div class="info-value">{{ $produit->unite_mesure ?? 'Unité' }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Taux TVA</div>
                    <div class="info-value">{{ $produit->taux_tva ?? 0 }}%</div>
                </div>
            </div>

            <!-- Indicateur de stock -->
            <div class="stock-indicator">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="info-label">Stock actuel</div>
                    @php
                        $statusClass = 'status-stock';
                        if($produit->stock_status == 'faible') $statusClass = 'status-low';
                        if($produit->stock_status == 'rupture') $statusClass = 'status-out';
                    @endphp
                    <span class="status-badge {{ $statusClass }}">
                        @if($produit->stock_status == 'normal')
                            <i class="fas fa-check-circle"></i> Stock suffisant
                        @elseif($produit->stock_status == 'faible')
                            <i class="fas fa-exclamation-triangle"></i> Stock faible
                        @else
                            <i class="fas fa-times-circle"></i> En rupture
                        @endif
                    </span>
                </div>

                <div class="stock-bar">
                    @php
                        $stockPercentage = ($produit->stock_actuel / $produit->seuil_alerte) * 100;
                        $stockClass = 'high';
                        if($stockPercentage < 30) $stockClass = 'low';
                        elseif($stockPercentage < 60) $stockClass = 'medium';
                    @endphp
                    <div class="stock-fill {{ $stockClass }}"
                         style="width: {{ min($stockPercentage, 100) }}%"></div>
                </div>

                <div class="stock-numbers">
                    <span>{{ $produit->stock_actuel }} {{ $produit->unite_mesure ?? '' }}</span>
                    <span>Seuil: {{ $produit->seuil_alerte }}</span>
                </div>
            </div>
        </div>

        <!-- Carte image et prix -->
        <div class="detail-card">
            <h2 class="card-title">
                <i class="fas fa-image"></i>
                Visuel & Prix
            </h2>

            <div class="image-container">
                @if($produit->image && Storage::exists('public/produits/' . $produit->image))
                    <img src="{{ asset('storage/produits/' . $produit->image) }}"
                         alt="{{ $produit->nom }}"
                         class="product-image"
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHJlY3Qgd2lkdGg9IjIwMCIgaGVpZ2h0PSIyMDAiIHJ4PSIyMCIgZmlsbD0iI0YwRjBGMSIvPjxwYXRoIGQ9Ik01MCA4MEwxMDAgMTM1TDUwIDEzNUw4MCA4MFoiIGZpbGw9IiM2MTYxNkIiLz48cGF0aCBkPSJNMTAwIDExNUMxMjAuNzYyIDExNSAxMzUgMTAwLjc2MiAxMzUgODBDMTM1IDU5LjIzODIgMTIwLjc2MiA0NSAxMDAgNDVDNzkuMjM4MiA0NSA2NSA1OS4yMzgyIDY1IDgwQzY1IDEwMC43NjIgNzkuMjM4MiAxMTUgMTAwIDExNVoiIGZpbGw9IiM2MTYxNkIiLz48L3N2Zz4='">
                @else
                    <div class="no-image">
                        <i class="fas fa-cube"></i>
                    </div>
                @endif
            </div>

            <div class="price-card" style="margin-top: 20px;">
                <div class="price-item">
                    <div class="price-label">Prix d'achat</div>
                    <div class="price-value">{{ number_format($produit->prix_achat, 2) }} FCFA</div>
                </div>

                <div class="price-item">
                    <div class="price-label">Prix de vente</div>
                    <div class="price-value">{{ number_format($produit->prix_vente, 2) }} FCFA</div>
                </div>

                <div class="price-item">
                    <div class="price-label">Marge</div>
                    @php
                        $marge = $produit->prix_vente - $produit->prix_achat;
                        $profitClass = $marge >= 0 ? 'profit' : 'loss';
                        $margePercentage = $produit->prix_achat > 0 ? ($marge / $produit->prix_achat) * 100 : 0;
                    @endphp
                    <div class="price-value {{ $profitClass }}">
                        {{ number_format($marge, 2) }} FCFA
                        <small style="font-size: 0.9rem; opacity: 0.8;">
                            ({{ number_format($margePercentage, 1) }}%)
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte description -->
        <div class="detail-card description-card">
            <h2 class="card-title">
                <i class="fas fa-align-left"></i>
                Description
            </h2>

            <div class="description-content">
                @if($produit->description)
                    {!! nl2br(e($produit->description)) !!}
                @else
                    <div class="empty-description">
                        <i class="fas fa-align-left" style="font-size: 3rem; margin-bottom: 15px;"></i>
                        <p>Aucune description disponible</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fas fa-trash-alt"></i>
        </div>
        <h3 class="modal-title">Confirmer la suppression</h3>
        <p class="modal-message">
            Êtes-vous sûr de vouloir supprimer le produit
            <strong>"{{ $produit->nom }}"</strong> ?<br>
            Cette action est irréversible.
        </p>
        <div class="modal-buttons">
            <form id="deleteForm" action="{{ route('produits.destroy', $produit) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-modal btn-modal-confirm">
                    Supprimer
                </button>
            </form>
            <button onclick="closeDeleteModal()" class="btn-modal btn-modal-cancel">
                Annuler
            </button>
        </div>
    </div>
</div>

<script>
    function openDeleteModal() {
        document.getElementById('deleteModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Fermer la modal en cliquant à l'extérieur
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // Fermer avec la touche ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
@endsection
