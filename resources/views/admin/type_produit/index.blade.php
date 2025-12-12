@extends('layouts.admin')

@section('content')

<!-- Modal pour afficher les détails -->
<div id="detailModal" class="modal-overlay">
    <div class="modal-container animate-slide-down">
        <div class="modal-header">
            <h2 class="modal-title" style="color: white;">
                <i class="fas fa-info-circle"></i>
                Détails du Type de Produit
            </h2>
            <button class="modal-close" onclick="closeModal()">X
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="modal-content">
            <div class="modal-grid">
                <!-- Colonne gauche : Image -->
                <div class="modal-left">
                    <div class="image-section">
                        <div class="image-wrapper" id="modalImageWrapper">
                            <img src="" alt="" id="modalImage" class="detail-image">
                            <div class="image-actions">
                                <button class="btn-zoom" onclick="zoomImage()">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                                <button class="btn-download" onclick="downloadImage()">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                        <div class="image-info">
                            <div class="info-item">
                                <span class="info-label">Format :</span>
                                <span class="info-value" id="imageFormat">PNG</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Dimensions :</span>
                                <span class="info-value" id="imageDimensions">800x600px</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Taille :</span>
                                <span class="info-value" id="imageSize">1.2 MB</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite : Informations -->
                <div class="modal-right">
                    <div class="details-section">
                        <h3 class="section-title">
                            <i class="fas fa-cube"></i>
                            Informations du Type
                        </h3>

                        <div class="details-grid">
                            <div class="detail-card">
                                <div class="detail-icon">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                                <div class="detail-content">
                                    <h4 class="detail-label">ID</h4>
                                    <p class="detail-value" id="detailId">-</p>
                                </div>
                            </div>

                            <div class="detail-card">
                                <div class="detail-icon">
                                    <i class="fas fa-barcode"></i>
                                </div>
                                <div class="detail-content">
                                    <h4 class="detail-label">Référence</h4>
                                    <p class="detail-value" id="detailReference">-</p>
                                </div>
                            </div>

                            <div class="detail-card">
                                <div class="detail-icon">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <div class="detail-content">
                                    <h4 class="detail-label">Nom</h4>
                                    <p class="detail-value" id="detailNom">-</p>
                                </div>
                            </div>

                            <div class="detail-card full-width">
                                <div class="detail-icon">
                                    <i class="fas fa-align-left"></i>
                                </div>
                                <div class="detail-content">
                                    <h4 class="detail-label">Description</h4>
                                    <p class="detail-value" id="detailDescription">-</p>
                                </div>
                            </div>

                            <div class="detail-card">
                                <div class="detail-icon">
                                    <i class="fas fa-calendar-plus"></i>
                                </div>
                                <div class="detail-content">
                                    <h4 class="detail-label">Créé le</h4>
                                    <p class="detail-value" id="detailCreatedAt">-</p>
                                </div>
                            </div>

                            <div class="detail-card">
                                <div class="detail-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="detail-content">
                                    <h4 class="detail-label">Mis à jour le</h4>
                                    <p class="detail-value" id="detailUpdatedAt">-</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="actions-section">
                        <h3 class="section-title">
                            <i class="fas fa-bolt"></i>
                            Actions Rapides
                        </h3>
                        <br>
                        <div class="action-buttons">
                            <button class="btn-action-edit" onclick="editItem()">
                                <i class="fas fa-edit"></i>
                                Éditer
                            </button>
                            <button class="btn-action-copy" onclick="copyItem()">
                                <i class="fas fa-copy"></i>
                                Copier
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inclure SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

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
                <h6 class="mb-0 font-bold capitalize">Type de produit</h6>
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

    <!-- Header avec animation -->
    <div class="admin-header">
        <div class="header-content animate-slide-down">
            <h1 class="admin-title">📦 Types de Produits</h1>
            <p class="admin-subtitle">Gérez vos catégories de produits avec style</p>
        </div>

        <a href="{{ route('type_produits.create') }}" class="btn-add animate-bounce-in">
            <span class="btn-icon">+</span>
            Nouveau Type
        </a>
    </div>


    @if(session('success'))
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

    @if(session('error'))
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

    <!-- Carte principale -->
    <div class="main-card animate-fade-in">
        <!-- En-tête de la carte -->
        <div class="card-header">
            <div class="header-info">
                <h2 class="card-title">Liste des Types</h2>
                <p class="card-subtitle">{{ $types->total() }} types disponibles</p>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher un type..." id="searchInput">
                </div>
            </div>
        </div>

        <!-- Tableau -->
        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th class="image-col">
                            <i class="fas fa-image"></i> Image
                        </th>
                        <th class="ref-col">
                            <i class="fas fa-hashtag"></i> Référence
                        </th>
                        <th class="name-col">
                            <i class="fas fa-tag"></i> Nom
                        </th>
                        <th class="actions-col">
                            <i class="fas fa-cogs"></i> Actions
                        </th>
                    </tr>
                </thead>

                <tbody id="tableBody">
                    @forelse($types as $index => $t)
                    <tr class="table-row animate-slide-up" style="animation-delay: {{ $index * 0.05 }}s">
                        <!-- Image -->
                        <td class="image-cell">
                            @if($t->image)
                            <div class="image-preview">
                                <img src="{{ asset('storage/type_produits/'.$t->image) }}"
                                     alt="{{ $t->nom }}"
                                     class="product-image"
                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHJ4PSI4IiBmaWxsPSIjRjBGMEYxIi8+PHBhdGggZD0iTTMwIDI1TDM1IDM1TDI1IDM1TDMwIDI1WiIgZmlsbD0iIzYxNjE2QiIvPjxwYXRoIGQ9Ik0zMCAzNUMzMi43NjE0IDM1IDM1IDMyLjc2MTQgMzUgMzBDMzUgMjcuMjM4NiAzMi43NjE0IDI1IDMwIDI1QzI3LjIzODYgMjUgMjUgMjcuMjM4NiAyNSAzMEMyNSAzMi43NjE0IDI3LjIzODYgMzUgMzAgMzVaIiBmaWxsPSIjNjE2MTZCIi8+PC9zdmc+'>
                                <div class="image-hover">
                                    <i class="fas fa-expand"></i>
                                </div>
                            </div>
                            @else
                            <div class="no-image">
                                <i class="fas fa-image"></i>
                                <span>Aucune image</span>
                            </div>
                            @endif
                        </td>

                        <!-- Référence -->
                        <td class="ref-cell">
                            <span class="badge-ref">
                                #{{ $t->reference }}
                            </span>
                        </td>

                        <!-- Nom -->
                        <td class="name-cell">
                            <div class="name-content">
                                <h3 class="product-name">{{ $t->nom }}</h3>
                                <p class="product-desc">Type de produit</p>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="actions-cell">
                            <div class="actions-buttons">
                                <a href="{{ route('type_produits.edit', $t) }}"
                                   class="btn-action btn-edit"
                                   data-tooltip="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('type_produits.destroy', $t) }}"
                                      method="POST"
                                      class="delete-form">
                                    @csrf @method('DELETE')
                                    <button type="button"
                                            class="btn-action btn-delete delete-btn"
                                            data-name="{{ $t->nom }}"
                                            data-tooltip="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                                <a href="#"
                                   class="btn-action btn-view view-btn"
                                   data-tooltip="Voir détails"
                                   data-id="{{ $t->id }}"
                                   data-reference="{{ $t->reference }}"
                                   data-nom="{{ $t->nom }}"
                                   data-description="{{ $t->description }}"
                                   data-image="{{ $t->image ? asset('storage/type_produits/'.$t->image) : '' }}"
                                   data-created_at="{{ $t->created_at }}"
                                   data-updated_at="{{ $t->updated_at }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="4">
                            <div class="empty-state animate-pulse">
                                <div class="empty-icon">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <h3>Aucun type de produit</h3>
                                <p>Commencez par créer votre premier type</p>
                                <a href="{{ route('type_produits.create') }}" class="btn-create-first">
                                    <i class="fas fa-plus"></i> Créer le premier
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($types->hasPages())
        <div class="pagination">
            {{ $types->links() }}
        </div>
        @endif
    </div>

    <!-- Carte statistiques -->
    <div class="stats-card animate-fade-in" style="animation-delay: 0.2s">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fas fa-chart-pie"></i> Statistiques
            </h2>
            <div class="stats-toggle">
                <span class="toggle-label">Vue :</span>
                <button class="toggle-btn active" data-chart="pie">Camembert</button>
                <button class="toggle-btn" data-chart="bar">Barres</button>
            </div>
        </div>

        <div class="stats-content">
            <div class="chart-container">
                <canvas id="typesChart"></canvas>
            </div>

            <div class="stats-details">
                <h3 class="details-title">Détails par catégorie</h3>
                <div class="details-list">
                    @foreach($types as $t)
                    <div class="detail-item">
                        <div class="detail-color" style="background-color: {{ getColor($loop->index) }}"></div>
                        <div class="detail-info">
                            <span class="detail-name">{{ $t->nom }}</span>
                            <span class="detail-ref">{{ $t->reference }}</span>
                        </div>
                        <div class="detail-percent">
                            <span class="percent-value">25%</span>
                            <div class="percent-bar">
                                <div class="percent-fill" style="width: 25%; background-color: {{ getColor($loop->index) }}"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>

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

    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(5px);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 10000;
        padding: 20px;
    }

    .modal-container {
        background: white;
        border-radius: var(--radius);
        width: 90%;
        max-width: 1200px;
        max-height: 90vh;
        overflow-y: auto;
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

    .modal-header {
        padding: 25px 30px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(90deg, #4361ee, #7209b7);
        color: white;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .modal-title {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-close {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }

    .modal-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .modal-content {
        padding: 30px;
    }

    .modal-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 40px;
    }

    @media (max-width: 1024px) {
        .modal-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
    }

    /* Colonne gauche : Image */
    .modal-left {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .image-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .image-wrapper {
        position: relative;
        width: 100%;
        height: 300px;
        border-radius: 12px;
        overflow: hidden;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .detail-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: var(--transition);
    }

    .image-actions {
        position: absolute;
        bottom: 15px;
        right: 15px;
        display: flex;
        gap: 10px;
        opacity: 0;
        transition: var(--transition);
    }

    .image-wrapper:hover .image-actions {
        opacity: 1;
    }

    .btn-zoom, .btn-download {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        border: none;
        background: rgba(255, 255, 255, 0.9);
        color: var(--dark);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }

    .btn-zoom:hover, .btn-download:hover {
        background: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .image-info {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 8px;
        border-bottom: 1px solid var(--border);
    }

    .info-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-label {
        font-weight: 600;
        color: var(--dark);
    }

    .info-value {
        color: var(--gray);
        font-size: 0.9rem;
    }

    /* Colonne droite : Informations */
    .modal-right {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .details-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .detail-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        gap: 15px;
        align-items: flex-start;
        transition: var(--transition);
    }

    .detail-card:hover {
        background: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .detail-card.full-width {
        grid-column: 1 / -1;
    }

    .detail-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .detail-content {
        flex: 1;
    }

    .detail-label {
        font-size: 0.85rem;
        color: var(--gray);
        margin: 0 0 5px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-value {
        font-size: 1rem;
        color: var(--dark);
        margin: 0;
        font-weight: 600;
        word-break: break-word;
    }

    #detailDescription {
        font-weight: normal;
        line-height: 1.5;
        color: var(--gray);
    }

    /* Actions Section */
    .actions-section {
        background: linear-gradient(135deg, #f8f9fa, white);
        border-radius: 12px;
        padding: 25px;
        border: 1px solid var(--border);
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-action-edit,
    .btn-action-copy,
    .btn-action-delete {
        padding: 12px 24px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: var(--transition);
        flex: 1;
        min-width: 120px;
        justify-content: center;
    }

    .btn-action-edit {
        background: linear-gradient(135deg, var(--warning), #ff9e00);
        color: white;
    }

    .btn-action-copy {
        background: linear-gradient(135deg, var(--success), #00b894);
        color: white;
    }

    .btn-action-delete {
        background: linear-gradient(135deg, var(--danger), #d00000);
        color: white;
    }

    .btn-action-edit:hover,
    .btn-action-copy:hover,
    .btn-action-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Styles existants */
    .admin-container {
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    /* Messages flash */
    .success-message, .error-message {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 350px;
        max-width: 500px;
    }

    .alert-success, .alert-error {
        padding: 15px 20px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
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

    .alert-success i:first-child, .alert-error i:first-child {
        font-size: 1.5rem;
    }

    .close-alert {
        margin-left: auto;
        background: rgba(255,255,255,0.2);
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .close-alert:hover {
        background: rgba(255,255,255,0.3);
        transform: rotate(90deg);
    }

    /* Auto-hide après 5 secondes */
    .success-message, .error-message {
        animation: slideInRight 0.5s ease-out, fadeOut 0.5s ease-out 4.5s forwards;
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
            transform: translateX(100%);
        }
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

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes pulse {
        0%, 100% {
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

    .animate-bounce-in {
        animation: bounceIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .animate-pulse {
        animation: pulse 2s infinite;
    }

    /* Header */
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

    /* Boutons */
    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 16px 28px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-add:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
    }

    .btn-add::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 0;
        border-radius: 100%;
        transform: scale(1, 1) translate(-50%);
        transform-origin: 50% 50%;
    }

    .btn-add:focus:not(:active)::after {
        animation: ripple 1s ease-out;
    }

    @keyframes ripple {
        0% {
            transform: scale(0, 0);
            opacity: 0.5;
        }
        100% {
            transform: scale(20, 20);
            opacity: 0;
        }
    }

    .btn-icon {
        font-size: 1.5rem;
        font-weight: bold;
    }

    /* Cartes */
    .main-card, .stats-card {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        margin-bottom: 30px;
        overflow: hidden;
        transition: var(--transition);
    }

    .main-card:hover, .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        padding: 25px 30px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(90deg, #f8f9fa, white);
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-subtitle {
        color: var(--gray);
        font-size: 0.9rem;
        margin-top: 5px;
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
    }

    .search-box input {
        width: 100%;
        padding: 12px 20px 12px 45px;
        border: 2px solid var(--border);
        border-radius: 50px;
        font-size: 0.95rem;
        transition: var(--transition);
        background: #f8f9fa;
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    /* Tableau */
    .table-container {
        overflow-x: auto;
        padding: 20px;
    }

    .styled-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .styled-table thead th {
        padding: 20px;
        background: linear-gradient(90deg, #f8f9fa, white);
        color: var(--dark);
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        white-space: nowrap;
    }

    .styled-table thead th i {
        margin-right: 8px;
        color: var(--primary);
    }

    .table-row {
        background: white;
        border-radius: 12px;
        transition: var(--transition);
        position: relative;
    }

    .table-row:hover {
        background: linear-gradient(90deg, #f8f9fa, white);
        transform: translateX(5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .table-row td {
        padding: 25px 20px;
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

    /* Cellules spécifiques */
    .image-preview {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .image-preview:hover .product-image {
        transform: scale(1.1);
    }

    .image-hover {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: var(--transition);
        color: white;
    }

    .image-preview:hover .image-hover {
        opacity: 1;
    }

    .no-image {
        width: 70px;
        height: 70px;
        border: 2px dashed var(--border);
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--gray);
        font-size: 0.8rem;
    }

    .no-image i {
        font-size: 1.5rem;
        margin-bottom: 5px;
    }

    .badge-ref {
        display: inline-block;
        padding: 8px 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
    }

    .product-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 5px 0;
    }

    .product-desc {
        font-size: 0.85rem;
        color: var(--gray);
        margin: 0;
    }

    /* Boutons d'action */
    .actions-buttons {
        display: flex;
        gap: 10px;
    }

    .btn-action {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: var(--transition);
        position: relative;
        border: none;
        cursor: pointer;
    }

    .btn-action i {
        font-size: 1rem;
    }

    .btn-edit {
        background: linear-gradient(135deg, var(--warning), #ff9e00);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, var(--danger), #d00000);
        color: white;
    }

    .btn-view {
        background: linear-gradient(135deg, var(--success), #00b894);
        color: white;
    }

    .btn-action:hover {
        transform: translateY(-3px) scale(1.1);
    }

    .btn-action[data-tooltip]::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        padding: 5px 10px;
        background: var(--dark);
        color: white;
        font-size: 0.8rem;
        border-radius: 6px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
        margin-bottom: 10px;
    }

    .btn-action:hover::after {
        opacity: 1;
        visibility: visible;
    }

    /* État vide */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--border);
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: var(--dark);
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: var(--gray);
        margin-bottom: 30px;
    }

    .btn-create-first {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        background: var(--primary);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-create-first:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    /* Pagination */
    .pagination {
        padding: 20px;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: center;
    }

    /* Section statistiques */
    .stats-toggle {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .toggle-label {
        color: var(--gray);
        font-size: 0.9rem;
    }

    .toggle-btn {
        padding: 8px 16px;
        border: 2px solid var(--border);
        background: white;
        color: var(--gray);
        border-radius: 20px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
    }

    .toggle-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .toggle-btn:not(.active):hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .stats-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        padding: 30px;
    }

    .chart-container {
        height: 300px;
        position: relative;
    }

    .stats-details {
        padding: 10px;
    }

    .details-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 20px;
    }

    .details-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        transition: var(--transition);
    }

    .detail-item:hover {
        background: white;
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .detail-color {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .detail-info {
        flex: 1;
    }

    .detail-name {
        display: block;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 2px;
    }

    .detail-ref {
        font-size: 0.8rem;
        color: var(--gray);
    }

    .detail-percent {
        text-align: right;
        min-width: 80px;
    }

    .percent-value {
        display: block;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .percent-bar {
        width: 100%;
        height: 6px;
        background: var(--border);
        border-radius: 3px;
        overflow: hidden;
    }

    .percent-fill {
        height: 100%;
        border-radius: 3px;
        transition: width 1s ease-out;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .stats-content {
            grid-template-columns: 1fr;
        }

        .admin-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }
    }

    @media (max-width: 768px) {
        .admin-container {
            padding: 15px;
        }

        .card-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .search-box {
            width: 100%;
        }

        .actions-buttons {
            flex-direction: column;
        }

        .table-row td {
            padding: 15px 10px;
        }

        .admin-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 480px) {
        .stats-toggle {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-add {
            width: 100%;
            justify-content: center;
        }

        .modal-container {
            width: 95%;
            padding: 15px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action-edit,
        .btn-action-copy,
        .btn-action-delete {
            width: 100%;
        }
    }
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Palette de couleurs
        const colors = [
            '#4361ee', '#7209b7', '#3a0ca3', '#f72585',
            '#4cc9f0', '#4895ef', '#560bad', '#b5179e'
        ];

        // Fonction pour générer une couleur
        window.getColor = function(index) {
            return colors[index % colors.length];
        }

        // Initialisation du graphique
        const ctx = document.getElementById('typesChart').getContext('2d');
        let currentChart = null;

        function initChart(type = 'pie') {
            if (currentChart) {
                currentChart.destroy();
            }

            const labels = @json($chartLabels);
            const data = @json($chartValues);
            const backgroundColor = labels.map((_, i) => getColor(i));

            const config = {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColor,
                        borderColor: 'white',
                        borderWidth: 2,
                        hoverOffset: 15,
                        hoverBackgroundColor: backgroundColor.map(color => color + 'CC')
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 14
                            },
                            padding: 12
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true,
                        duration: 2000,
                        easing: 'easeOutQuart'
                    }
                }
            };

            currentChart = new Chart(ctx, config);
        }

        // Initialiser avec pie chart
        initChart('pie');

        // Gestion du toggle de graphique
        document.querySelectorAll('.toggle-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                initChart(this.dataset.chart);
            });
        });

        // Recherche en temps réel
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');

        if (searchInput && tableBody) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = tableBody.querySelectorAll('.table-row');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }

        // Gestion des boutons de suppression
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const form = this.closest('form');
                const typeName = this.getAttribute('data-name') || 'ce type';
                const row = form.closest('tr');
                const typeRef = row.querySelector('.badge-ref')?.textContent || '';

                Swal.fire({
                    title: 'Supprimer ce type ?',
                    html: `
                        <div style="text-align: left; padding: 10px;">
                            <p>Vous allez supprimer :</p>
                            <div style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px; padding: 15px; margin: 15px 0; color: #856404;">
                                <strong>${typeRef}</strong><br>
                                <span style="font-size: 1.1em;">${typeName}</span>
                            </div>
                            <div style="display: flex; align-items: start; gap: 10px; margin-bottom: 10px;">
                                <i class="fas fa-exclamation-circle" style="color: #ef476f; font-size: 1.2em;"></i>
                                <div>
                                    <strong style="color: #ef476f;">Action irréversible</strong><br>
                                    <small>Cette suppression ne peut pas être annulée</small>
                                </div>
                            </div>
                            <div style="display: flex; align-items: start; gap: 10px; margin-top: 15px;">
                                <i class="fas fa-info-circle" style="color: #4361ee; font-size: 1.2em;"></i>
                                <div>
                                    <strong style="color: #4361ee;">Information</strong><br>
                                    <small>Les produits associés seront conservés sans type</small>
                                </div>
                            </div>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef476f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Supprimer',
                    cancelButtonText: 'Annuler',
                    background: 'white',
                    backdrop: 'rgba(0,0,0,0.5)',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Animation de chargement
                        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                        this.disabled = true;
                        this.style.opacity = '0.7';

                        // Animation sur la ligne
                        if (row) {
                            row.style.transition = 'all 0.5s ease';
                            row.style.opacity = '0.5';
                            row.style.transform = 'scale(0.98)';
                        }

                        // Soumettre le formulaire
                        form.submit();
                    }
                });
            });
        });

        // Animation des pourcentages
        document.querySelectorAll('.percent-fill').forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 500);
        });

        // Gestion de la modal de détails
        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                // Récupérer les données
                const id = this.getAttribute('data-id');
                const reference = this.getAttribute('data-reference');
                const nom = this.getAttribute('data-nom');
                const description = this.getAttribute('data-description');
                const image = this.getAttribute('data-image');
                const createdAt = this.getAttribute('data-created_at');
                const updatedAt = this.getAttribute('data-updated_at');

                // Remplir la modal
                document.getElementById('detailId').textContent = id;
                document.getElementById('detailReference').textContent = reference;
                document.getElementById('detailNom').textContent = nom;
                document.getElementById('detailDescription').textContent = description || 'Aucune description';

                // Formater les dates
                const formatDate = (dateString) => {
                    const date = new Date(dateString);
                    return date.toLocaleDateString('fr-FR', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                };

                document.getElementById('detailCreatedAt').textContent = formatDate(createdAt);
                document.getElementById('detailUpdatedAt').textContent = formatDate(updatedAt);

                // Gérer l'image
                const modalImage = document.getElementById('modalImage');
                const imageWrapper = document.getElementById('modalImageWrapper');

                if (image) {
                    modalImage.src = image;
                    modalImage.alt = nom;

                    // Simuler les informations d'image
                    document.getElementById('imageFormat').textContent = 'PNG';
                    document.getElementById('imageDimensions').textContent = '800x600px';
                    document.getElementById('imageSize').textContent = '1.2 MB';
                } else {
                    modalImage.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHJ4PSI4IiBmaWxsPSIjRjBGMEYxIi8+PHBhdGggZD0iTTMwIDI1TDM1IDM1TDI1IDM1TDMwIDI1WiIgZmlsbD0iIzYxNjE2QiIvPjxwYXRoIGQ9Ik0zMCAzNUMzMi43NjE0IDM1IDM1IDMyLjc2MTQgMzUgMzBDMzUgMjcuMjM4NiAzMi43NjE0IDI1IDMwIDI1QzI3LjIzODYgMjUgMjUgMjcuMjM4NiAyNSAzMEMyNSAzMi43NjE0IDI3LjIzODYgMzUgMzAgMzVaIiBmaWxsPSIjNjE2MTZCIi8+PC9zdmc+';
                    modalImage.alt = 'Aucune image';
                    document.getElementById('imageFormat').textContent = '-';
                    document.getElementById('imageDimensions').textContent = '-';
                    document.getElementById('imageSize').textContent = '-';
                }

                // Ouvrir la modal
                openModal();
            });
        });

        // Fonctions de la modal
        window.openModal = function() {
            document.getElementById('detailModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        };

        window.closeModal = function() {
            document.getElementById('detailModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        };

        window.zoomImage = function() {
            const modal = document.getElementById('detailModal');
            modal.classList.toggle('zoomed');
        };

        window.downloadImage = function() {
            const imageUrl = document.getElementById('modalImage').src;
            const fileName = document.getElementById('detailNom').textContent + '.png';

            const link = document.createElement('a');
            link.href = imageUrl;
            link.download = fileName;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        };

        window.editItem = function() {
            const id = document.getElementById('detailId').textContent;
            window.location.href = `/type_produits/${id}/edit`;
        };

        window.copyItem = function() {
            const textToCopy = `ID: ${document.getElementById('detailId').textContent}
Référence: ${document.getElementById('detailReference').textContent}
Nom: ${document.getElementById('detailNom').textContent}
Description: ${document.getElementById('detailDescription').textContent}`;

            navigator.clipboard.writeText(textToCopy).then(() => {
                Swal.fire({
                    title: 'Copié !',
                    text: 'Les informations ont été copiées dans le presse-papier',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        };

        window.deleteItem = function() {
            const id = document.getElementById('detailId').textContent;
            const name = document.getElementById('detailNom').textContent;

            Swal.fire({
                title: 'Supprimer ce type ?',
                html: `Voulez-vous vraiment supprimer le type <strong>${name}</strong> ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef476f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Fermer la modal d'abord
                    closeModal();

                    // Trouver et déclencher le bouton de suppression correspondant
                    const deleteBtn = document.querySelector(`.delete-btn[data-id="${id}"]`);
                    if (deleteBtn) {
                        deleteBtn.click();
                    }
                }
            });
        };

        // Fermer la modal en cliquant à l'extérieur
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Fermer la modal avec la touche ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Effet ripple
        document.querySelectorAll('.btn-add, .btn-action').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const x = e.clientX - e.target.getBoundingClientRect().left;
                const y = e.clientY - e.target.getBoundingClientRect().top;

                const ripple = document.createElement('span');
                ripple.classList.add('ripple-effect');
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';

                this.appendChild(ripple);

                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Style pour l'effet ripple
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = `
            .ripple-effect {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.6);
                transform: scale(0);
                animation: ripple-animation 0.6s linear;
            }

            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }

            .btn-action {
                position: relative;
                overflow: hidden;
            }
        `;
        document.head.appendChild(rippleStyle);
    });
</script>

@endsection
