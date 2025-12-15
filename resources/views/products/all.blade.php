@extends('layouts.welcomeLayout')
@section('content')
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tous nos produits - Garage Pro</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            /* Styles généraux */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
                color: #fff;
                min-height: 100vh;
            }

            /* Header */
            .page-header {
                background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
                padding: 3rem 2rem;
                text-align: center;
                border-bottom: 3px solid #e50914;
                position: relative;
                overflow: hidden;
            }

            .page-header::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle at 50% 0%, rgba(229, 9, 20, 0.1) 0%, transparent 50%);
            }

            .page-header h1 {
                font-size: 3.5rem;
                background: linear-gradient(90deg, #e50914, #ff1620);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
                margin-bottom: 1rem;
                text-shadow: 0 0 30px rgba(229, 9, 20, 0.5);
                position: relative;
                z-index: 2;
            }

            .page-header p {
                font-size: 1.2rem;
                color: #ccc;
                max-width: 600px;
                margin: 0 auto;
                line-height: 1.6;
                position: relative;
                z-index: 2;
            }

            .back-home {
                position: absolute;
                top: 20px;
                left: 20px;
                color: #e50914;
                text-decoration: none;
                font-size: 1.1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.3s ease;
                z-index: 2;
            }

            .back-home:hover {
                color: #ff1620;
                transform: translateX(-5px);
            }

            /* Conteneur principal */
            .main-container {
                max-width: 1400px;
                margin: 0 auto;
                padding: 2rem;
            }

            /* Stats produits */
            .products-stats {
                background: rgba(20, 20, 20, 0.8);
                border: 1px solid rgba(229, 9, 20, 0.3);
                border-radius: 12px;
                padding: 1.5rem 2rem;
                margin-bottom: 3rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 1rem;
                backdrop-filter: blur(10px);
            }

            .stat-item {
                display: flex;
                align-items: center;
                gap: 1rem;
            }


            .stat-icon {
                width: 40px;
                height: 40px;
                background: rgba(229, 9, 20, 0.1);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #e50914;
                font-size: 1.2rem;
            }

            .stat-content span {
                display: block;
            }



            .stat-label {
                font-size: 0.9rem;
                color: #aaa;
            }

            .stat-value {
                font-size: 1.5rem;
                font-weight: bold;
                color: #fff;
            }

            /* Filtres */
            .filters-container {
                background: rgba(20, 20, 20, 0.8);
                border: 1px solid rgba(229, 9, 20, 0.3);
                border-radius: 12px;
                padding: 1.5rem;
                margin-bottom: 2rem;
                backdrop-filter: blur(10px);
            }

            .filters-title {
                color: #e50914;
                margin-bottom: 1rem;
                font-size: 1.2rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .filter-options {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
            }

            .filter-btn {
                padding: 0.6rem 1.2rem;
                background: rgba(40, 40, 40, 0.9);
                border: 1px solid rgba(229, 9, 20, 0.3);
                border-radius: 25px;
                color: #ccc;
                cursor: pointer;
                transition: all 0.3s ease;
                font-size: 0.95rem;
            }

            .filter-btn:hover {
                background: rgba(229, 9, 20, 0.1);
                color: #fff;
            }

            .filter-btn.active {
                background: linear-gradient(135deg, #e50914 0%, #ff1620 100%);
                color: white;
                border-color: transparent;
            }

            /* Grille des produits */
            .products-grid-full {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 2rem;
                margin-bottom: 3rem;
            }

            /* Carte produit améliorée */
            .product-card-full {
                background: linear-gradient(145deg, #1a1a1a 0%, #0f0f0f 100%);
                border-radius: 16px;
                overflow: hidden;
                border: 1px solid rgba(229, 9, 20, 0.2);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                position: relative;
                opacity: 0;
                transform: translateY(20px);
                animation: cardAppear 0.6s ease forwards;
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            @keyframes cardAppear {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .product-card-full:hover {
                transform: translateY(-10px) scale(1.02);
                border-color: rgba(229, 9, 20, 0.5);
                box-shadow:
                    0 20px 40px rgba(229, 9, 20, 0.2),
                    0 0 30px rgba(229, 9, 20, 0.1);
            }

            /* Badges */
            .product-badge-container {
                position: absolute;
                top: 15px;
                left: 15px;
                right: 15px;
                display: flex;
                justify-content: space-between;
                z-index: 2;
            }

            .badge {
                padding: 0.5rem 1rem;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                backdrop-filter: blur(10px);
                border: 1px solid;
            }

            .badge-stock {
                background: rgba(40, 167, 69, 0.2);
                border-color: rgba(40, 167, 69, 0.3);
                color: #27ae60;
            }

            .badge-type {
                background: rgba(52, 152, 219, 0.2);
                border-color: rgba(52, 152, 219, 0.3);
                color: #3498db;
            }

            .badge-promo {
                background: rgba(229, 9, 20, 0.2);
                border-color: rgba(229, 9, 20, 0.3);
                color: #e50914;
            }

            /* Image produit */
            .product-image-container {
                height: 220px;
                position: relative;
                overflow: hidden;
                background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            }

            .product-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.6s ease;
            }

            .product-card-full:hover .product-image {
                transform: scale(1.1);
            }

            .image-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to bottom, transparent 50%, rgba(0, 0, 0, 0.8) 100%);
                display: flex;
                align-items: flex-end;
                justify-content: flex-end;
                padding: 1rem;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .product-card-full:hover .image-overlay {
                opacity: 1;
            }

            .image-actions {
                display: flex;
                gap: 0.5rem;
            }

            .image-btn {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                border: none;
                background: rgba(229, 9, 20, 0.8);
                color: white;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }

            .image-btn:hover {
                background: #e50914;
                transform: scale(1.1);
            }

            /* Contenu produit */
            .product-content {
                padding: 1.5rem;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
            }

            .product-header-full {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 1rem;
            }

            .product-title-full {
                font-size: 1.3rem;
                font-weight: 700;
                color: #fff;
                margin: 0;
                line-height: 1.3;
                flex: 1;
            }

            .product-price-full {
                text-align: right;
            }

            .current-price-full {
                font-size: 1.6rem;
                font-weight: 800;
                color: #e50914;
                display: block;
                line-height: 1;
            }

            .price-ttc-full {
                font-size: 0.8rem;
                color: #7f8c8d;
                font-weight: 500;
            }

            .product-description-full {
                color: #aaa;
                font-size: 0.95rem;
                line-height: 1.5;
                margin: 1rem 0;
                flex-grow: 1;
            }

            /* Spécifications */
            .specs-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 0.8rem;
                margin: 1.5rem 0;
            }

            .spec-item-full {
                background: rgba(40, 40, 40, 0.5);
                padding: 0.8rem;
                border-radius: 8px;
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .spec-label-full {
                font-size: 0.75rem;
                color: #777;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                display: block;
                margin-bottom: 0.3rem;
            }

            .spec-value-full {
                font-size: 0.9rem;
                color: #fff;
                font-weight: 600;
                display: block;
            }

            .stock-indicator {
                display: inline-flex;
                align-items: center;
                gap: 0.3rem;
            }

            .stock-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
            }

            .stock-bon .stock-dot {
                background: #27ae60;
                box-shadow: 0 0 10px #27ae60;
            }

            .stock-faible .stock-dot {
                background: #f39c12;
                box-shadow: 0 0 10px #f39c12;
            }

            .stock-rupture .stock-dot {
                background: #e74c3c;
                box-shadow: 0 0 10px #e74c3c;
            }

            /* Actions */
            .product-actions-full {
                display: flex;
                gap: 0.8rem;
                margin-top: auto;
            }

            .btn-action {
                flex: 1;
                padding: 0.8rem 1rem;
                border: none;
                border-radius: 10px;
                font-weight: 600;
                font-size: 0.9rem;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
            }

            .btn-details-full {
                background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
                color: white;
            }

            .btn-details-full:hover {
                background: linear-gradient(135deg, #2980b9 0%, #1f639b 100%);
                transform: translateY(-2px);
                box-shadow: 0 5px 20px rgba(52, 152, 219, 0.4);
            }

            .btn-cart-full {
                background: linear-gradient(135deg, #e50914 0%, #ff1620 100%);
                color: white;
            }

            .btn-cart-full:hover {
                background: linear-gradient(135deg, #ff1620 0%, #ff4757 100%);
                transform: translateY(-2px);
                box-shadow: 0 5px 20px rgba(229, 9, 20, 0.4);
            }

            /* Pagination/Chargement */
            .loading-container {
                text-align: center;
                padding: 2rem;
            }

            .loading-spinner {
                width: 50px;
                height: 50px;
                border: 3px solid rgba(229, 9, 20, 0.3);
                border-top-color: #e50914;
                border-radius: 50%;
                animation: spin 1s linear infinite;
                margin: 0 auto 1rem;
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }

            .load-more-btn {
                padding: 1rem 2rem;
                background: linear-gradient(135deg, #e50914 0%, #ff1620 100%);
                color: white;
                border: none;
                border-radius: 10px;
                font-size: 1.1rem;
                font-weight: 600;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 1rem;
                margin: 2rem auto;
                transition: all 0.3s ease;
            }

            .load-more-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(229, 9, 20, 0.4);
            }

            .load-more-btn.hidden {
                display: none;
            }

            /* Modal détails */
            .product-detail-modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 9999;
                padding: 2rem;
            }

            .modal-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.9);
                backdrop-filter: blur(10px);
            }

            .modal-container-full {
                position: relative;
                background: linear-gradient(145deg, #1a1a1a 0%, #0f0f0f 100%);
                max-width: 1000px;
                max-height: 90vh;
                margin: 0 auto;
                border-radius: 20px;
                overflow: hidden;
                border: 1px solid rgba(229, 9, 20, 0.3);
                animation: modalSlideIn 0.4s ease;
            }

            @keyframes modalSlideIn {
                from {
                    opacity: 0;
                    transform: translateY(-30px) scale(0.95);
                }

                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }

            .modal-header-full {
                padding: 1.5rem 2rem;
                background: linear-gradient(135deg, #e50914 0%, #ff1620 100%);
                color: white;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .modal-header-full h3 {
                margin: 0;
                font-size: 1.5rem;
                font-weight: 600;
            }

            .btn-close-modal-full {
                background: rgba(255, 255, 255, 0.1);
                border: none;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                color: white;
                font-size: 1.2rem;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .btn-close-modal-full:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: rotate(90deg);
            }

            .modal-body-full {
                padding: 2rem;
                overflow-y: auto;
                max-height: calc(90vh - 70px);
            }

            .detail-content-full {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
            }

            .detail-image-container-full {
                position: relative;
                border-radius: 15px;
                overflow: hidden;
                background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
                min-height: 400px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .detail-image-full {
                width: 100%;
                height: 100%;
                object-fit: contain;
                padding: 2rem;
            }

            .detail-info-full {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .detail-title-full {
                font-size: 2.2rem;
                font-weight: 700;
                color: #fff;
                margin: 0 0 0.5rem 0;
            }

            .detail-price-full {
                font-size: 2.5rem;
                font-weight: 800;
                color: #e50914;
                margin-bottom: 1rem;
            }

            .detail-description-full {
                background: rgba(40, 40, 40, 0.5);
                padding: 1.5rem;
                border-radius: 12px;
                border-left: 4px solid #3498db;
            }

            .detail-description-full h4 {
                color: #fff;
                margin: 0 0 1rem 0;
                font-size: 1.1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .detail-description-full p {
                color: #ccc;
                line-height: 1.6;
                margin: 0;
            }

            .detail-specs-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .spec-card-full {
                background: rgba(40, 40, 40, 0.5);
                padding: 1rem;
                border-radius: 10px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                transition: all 0.3s ease;
            }

            .spec-card-full:hover {
                background: rgba(229, 9, 20, 0.1);
                border-color: rgba(229, 9, 20, 0.3);
                transform: translateY(-2px);
            }

            /* Responsive */
            @media (max-width: 768px) {
                .page-header h1 {
                    font-size: 2.5rem;
                }

                .products-stats {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .products-grid-full {
                    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                    gap: 1.5rem;
                }

                .detail-content-full {
                    grid-template-columns: 1fr;
                }

                .detail-specs-grid {
                    grid-template-columns: 1fr;
                }

                .product-actions-full {
                    flex-direction: column;
                }
            }

            /* Animation scroll */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .fade-in {
                animation: fadeIn 0.6s ease forwards;
            }

            /* Toast notification */
            .toast {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: linear-gradient(135deg, #27ae60 0%, #219653 100%);
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 10px;
                display: flex;
                align-items: center;
                gap: 0.8rem;
                box-shadow: 0 10px 30px rgba(39, 174, 96, 0.3);
                transform: translateY(100px);
                opacity: 0;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                z-index: 99999;
            }

            .toast.show {
                transform: translateY(0);
                opacity: 1;
            }

            .toast.error {
                background: linear-gradient(135deg, #e50914 0%, #ff1620 100%);
            }
        </style>
    </head>



    <body>
        <!-- Header -->
        <header class="page-header">

            <h1 data-aos="fade-down">Tous nos produits</h1>
            <p data-aos="fade-up" data-aos-delay="200">Découvrez notre gamme complète de produits et accessoires pour votre
                véhicule</p>
        </header>

        <!-- Contenu principal -->
        <main class="main-container">
            <!-- Stats produits -->
            <div class="products-stats" data-aos="fade-up">

                <a href="{{ route('welcome') }}" style="text-decoration: none;">
                    <div class="stat-item"
                        style="display: flex; align-items: center; gap: 10px; padding: 10px 15px; border-radius: 8px; background-color: #d60d0d; transition: background 0.2s;">
                        <div class="stat-icon" style="font-size: 1.5rem; color: #ffffff;">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-label" style="color: #ffffff; font-weight: 600;">Retour à l'accueil</span>
                        </div>
                    </div>
                </a>

                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Produits disponibles</span>
                        <span class="stat-value">{{ $produits->total() }}</span>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Catégories</span>
                        <span class="stat-value">{{ \App\Models\TypeProduit::count() }}</span>
                    </div>
                </div>

                <!-- RECHERCHE PRODUITS -->

                <style>
                    .product-search {
                        margin: 5px 0;
                        width: 100%;
                        display: flex;
                        justify-content: center;
                    }

                    .product-search .search-wrapper {
                        position: relative;
                        width: 100%;
                       
                    }

                    .product-search input {
                        width: 100%;
                        padding: 12px 50px 12px 20px;
                        border-radius: 30px;
                        border: 2px solid #e50914;
                        /* Rouge lumineux */
                        background-color: #111;
                        /* Fond noir */
                        color: #fff;
                        /* Texte blanc */
                        font-size: 1rem;
                        transition: all 0.3s ease;
                        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
                    }

                    .product-search input::placeholder {
                        color: #ffffff;
                        /* Placeholder rouge */
                        opacity: 0.8;
                    }

                    .product-search input:focus {
                        outline: none;
                        border-color: #ff1a1a;
                        box-shadow: 0 0 10px rgba(229, 9, 20, 0.6);
                    }

                    .product-search i {
                        position: absolute;
                        right: 15px;
                        top: 50%;
                        transform: translateY(-50%);
                        color: #e50914;
                        /* Rouge lumineux */
                        font-size: 1.2rem;
                        pointer-events: none;
                    }
                </style>


                <div class="product-search">
                    <div class="search-wrapper">
                        <input type="text" id="productSearchInput" placeholder="Rechercher un produit...">
                        <i class="fas fa-search"></i>
                    </div>
                </div>



                <script>
                    document.getElementById('productSearchInput').addEventListener('keyup', function() {
                        const value = this.value.toLowerCase();
                        const products = document.querySelectorAll('.products-grid-full .product-card-full');

                        products.forEach(product => {
                            const text = product.textContent.toLowerCase();
                            product.style.display = text.includes(value) ? 'block' : 'none';
                        });
                    });
                </script>
            </div>


            <!-- Grille des produits -->
            <div id="products-container">
                <div class="products-grid-full">
                    @foreach ($produits as $index => $produit)
                        <div class="product-card-full" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <!-- Badges -->
                            <div class="product-badge-container">

                                @if ($produit->typeProduit)
                                    <span class="badge badge-type">
                                        <i class="fas fa-tag"></i> {{ $produit->typeProduit->nom }}
                                    </span>
                                @endif
                            </div>

                            <!-- Image -->
                            <div class="product-image-container">
                                @if ($produit->image)
                                    <img src="{{ asset('storage/produits/' . $produit->image) }}" alt="{{ $produit->nom }}"
                                        class="product-image"
                                        onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIyMjAiIHZpZXdCb3g9IjAgMCAzMDAgMjIwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIzMDAiIGhlaWdodD0iMjIwIiBmaWxsPSIjMUExQTFBIi8+PHBhdGggZD0iTTE1MCA4MEwxNjAgMTAwTDE0MCAxMDBMMTUwIDgwWiIgZmlsbD0iIzQxNDE0MSIvPjxwYXRoIGQ9Ik0xNTAgMTAwQzE1OC4yODQgMTAwIDE2NSA5My4yODQzIDE2NSA4NUMxNjUgNzYuNzE1NyAxNTguMjg0IDcwIDE1MCA3MEMxNDEuNzE2IDcwIDEzNSA3Ni43MTU3IDEzNSA4NUMxMzUgOTMuMjg0MyAxNDEuNzE2IDEwMCAxNTAgMTAwWiIgZmlsbD0iIzQxNDE0MSIvPjwvc3ZnPg=='">
                                @else
                                    <div
                                        style="width:100%;height:100%;background:linear-gradient(135deg,#0a0a0a,#1a1a1a);display:flex;align-items:center;justify-content:center;color:#666;">
                                        <i class="fas fa-box-open fa-3x"></i>
                                    </div>
                                @endif
                                <div class="image-overlay">
                                    <div class="image-actions">
                                        <button class="image-btn zoom-btn-full"
                                            data-image="{{ $produit->image ? asset('storage/produits/' . $produit->image) : '' }}">
                                            <i class="fas fa-expand"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>

                            <!-- Contenu -->
                            <div class="product-content">
                                <div class="product-header-full">
                                    <h3 class="product-title-full">{{ $produit->nom }}</h3>
                                    <div class="product-price-full">
                                        <span
                                            class="current-price-full">{{ number_format($produit->prix_vente, 2, ',', ' ') }}FCFA</span>
                                        @if ($produit->taux_tva > 0)
                                            <span class="price-ttc-full">TTC</span>
                                        @endif
                                    </div>
                                </div>

                                <p class="product-description-full">
                                    {{ $produit->description ? Str::limit($produit->description, 100) : 'Description non disponible' }}
                                </p>

                                <div class="specs-grid">
                                    <div class="spec-item-full">
                                        <span class="spec-label-full">Marque</span>
                                        <span class="spec-value-full">{{ $produit->marque ?? 'Non spécifiée' }}</span>
                                    </div>
                                    <div class="spec-item-full">
                                        <span class="spec-label-full">Modèle</span>
                                        <span class="spec-value-full">{{ $produit->modele ?? 'Standard' }}</span>
                                    </div>
                                    <div class="spec-item-full">
                                        <span class="spec-label-full">Stock</span>
                                        <span class="spec-value-full stock-indicator stock-{{ $produit->stock_status }}">
                                            <span class="stock-dot"></span>
                                            {{ $produit->stock_actuel }} {{ $produit->unite_mesure }}
                                        </span>
                                    </div>
                                    <div class="spec-item-full">
                                        <span class="spec-label-full">Référence</span>
                                        <span class="spec-value-full">{{ $produit->reference }}</span>
                                    </div>
                                </div>

                                <div class="product-actions-full">
                                    <button class="btn-action btn-details-full" data-product-id="{{ $produit->id }}"
                                        style="background: linear-gradient(135deg, #120ef0 0%, #e60f0f 100%);">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Détails</span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination/Chargement -->
                @if ($produits->hasMorePages())
                    <div class="loading-container" id="loading-container">
                        <button class="load-more-btn" id="load-more-btn">
                            <i class="fas fa-sync-alt"></i>
                            <span>Charger plus de produits</span>
                        </button>
                    </div>
                @endif
            </div>
        </main>

        <!-- Modal détails produit -->
        <div class="product-detail-modal" id="product-detail-modal">
            <div class="modal-overlay"></div>
            <div class="modal-container-full">
                <div class="modal-header-full">
                    <h3 id="detail-title-full">Détails du produit</h3>
                    <button class="btn-close-modal-full" id="close-detail-modal-full">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body-full" id="product-detail-content-full">
                    <!-- Contenu chargé dynamiquement -->
                </div>
            </div>
        </div>

        <!-- Modal image zoom -->
        <div class="product-detail-modal" id="image-zoom-modal">
            <div class="modal-overlay"></div>
            <div class="modal-container-full" style="background:transparent;border:none;">
                <button class="btn-close-modal-full" id="close-zoom-modal" style="top:10px;right:10px;">
                    <i class="fas fa-times"></i>
                </button>
                <img id="zoomed-image-full" src="" alt="Image zoomée"
                    style="max-width:90%;max-height:90%;object-fit:contain;">
            </div>
        </div>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialisation AOS
                AOS.init({
                    duration: 800,
                    once: true,
                    offset: 100
                });

                // Variables globales
                let currentPage = 1;
                let isLoading = false;
                let allProductsLoaded = false;

                // Bouton "Charger plus"
                const loadMoreBtn = document.getElementById('load-more-btn');
                const productsContainer = document.getElementById('products-container');
                const detailModal = document.getElementById('product-detail-modal');
                const detailContent = document.getElementById('product-detail-content-full');
                const zoomModal = document.getElementById('image-zoom-modal');
                const zoomedImage = document.getElementById('zoomed-image-full');

                // Chargement des produits supplémentaires
                if (loadMoreBtn) {
                    loadMoreBtn.addEventListener('click', function() {
                        if (isLoading || allProductsLoaded) return;

                        loadMoreProducts();
                    });

                    // Scroll infini
                    window.addEventListener('scroll', function() {
                        if (isLoading || allProductsLoaded) return;

                        const {
                            scrollTop,
                            scrollHeight,
                            clientHeight
                        } = document.documentElement;

                        if (scrollTop + clientHeight >= scrollHeight - 500) {
                            loadMoreProducts();
                        }
                    });
                }

                // Fonction pour charger plus de produits
                async function loadMoreProducts() {
                    if (isLoading || allProductsLoaded) return;

                    isLoading = true;
                    currentPage++;

                    // Afficher le loader
                    if (loadMoreBtn) {
                        loadMoreBtn.innerHTML = '<div class="loading-spinner"></div><span>Chargement...</span>';
                    }

                    try {
                        const response = await fetch(`/produits/tous/ajax?page=${currentPage}`);
                        const data = await response.json();

                        if (data.html) {
                            // Créer un élément temporaire pour parser le HTML
                            const tempDiv = document.createElement('div');
                            tempDiv.innerHTML = data.html;

                            // Récupérer les cartes produits
                            const newProducts = tempDiv.querySelector('.products-grid-full');

                            // Ajouter les nouveaux produits avec animation
                            if (newProducts) {
                                const productsGrid = document.querySelector('.products-grid-full');
                                const newCards = Array.from(newProducts.children);

                                newCards.forEach((card, index) => {
                                    card.style.opacity = '0';
                                    card.style.transform = 'translateY(20px)';
                                    productsGrid.appendChild(card);

                                    // Animation d'apparition
                                    setTimeout(() => {
                                        card.style.transition = 'all 0.6s ease';
                                        card.style.opacity = '1';
                                        card.style.transform = 'translateY(0)';
                                    }, index * 50);
                                });
                            }

                            // Vérifier s'il y a encore des pages
                            if (!data.next_page) {
                                allProductsLoaded = true;
                                if (loadMoreBtn) {
                                    loadMoreBtn.classList.add('hidden');
                                }
                            }
                        }
                    } catch (error) {
                        console.error('Erreur de chargement:', error);
                        showToast('Erreur de chargement des produits', 'error');
                    } finally {
                        isLoading = false;
                        if (loadMoreBtn && !allProductsLoaded) {
                            loadMoreBtn.innerHTML =
                                '<i class="fas fa-sync-alt"></i><span>Charger plus de produits</span>';
                        }
                    }
                }

                // Gestion des détails produit
                document.addEventListener('click', function(e) {
                    // Détails produit
                    if (e.target.closest('.btn-details-full') || e.target.closest('.btn-details')) {
                        const btn = e.target.closest('.btn-details-full') || e.target.closest('.btn-details');
                        const productId = btn.getAttribute('data-product-id');
                        showProductDetails(productId);
                    }

                    // Zoom image
                    if (e.target.closest('.zoom-btn-full') || e.target.closest('.zoom-btn')) {
                        const btn = e.target.closest('.zoom-btn-full') || e.target.closest('.zoom-btn');
                        const imageUrl = btn.getAttribute('data-image');
                        if (imageUrl) {
                            zoomedImage.src = imageUrl;
                            zoomModal.style.display = 'block';
                            document.body.style.overflow = 'hidden';
                        }
                    }

                    // Ajouter au panier
                    if (e.target.closest('.btn-cart-full') || e.target.closest('.btn-cart') || e.target.closest(
                            '.cart-btn')) {
                        const btn = e.target.closest('.btn-cart-full') || e.target.closest('.btn-cart') || e
                            .target.closest('.cart-btn');
                        const productId = btn.getAttribute('data-product-id');
                        const productCard = btn.closest('.product-card-full') || btn.closest('.product-card');
                        const productName = productCard.querySelector('.product-title-full')?.textContent ||
                            productCard.querySelector('.product-title')?.textContent;

                        addToCart(productId, productName, btn);
                    }

                    // Fermer modals
                    if (e.target.closest('#close-detail-modal-full') || e.target.closest('.modal-overlay')) {
                        detailModal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }
                    if (e.target.closest('#close-zoom-modal') || (e.target.classList.contains(
                            'modal-overlay') && zoomModal.style.display === 'block')) {
                        zoomModal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }
                });

                // Fonction pour afficher les détails
                async function showProductDetails(productId) {
                    try {
                        const response = await fetch(`/produit/${productId}/details`);
                        const data = await response.json();

                        detailContent.innerHTML = `
                        <div class="detail-content-full">
                            <div class="detail-image-container-full">
                                ${data.image ?
                                    `<img src="${data.image}" alt="${data.nom}" class="detail-image-full">` :
                                    `<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#666;">
                                                                            <i class="fas fa-box-open fa-5x"></i>
                                                                        </div>`
                                }
                            </div>
                            <div class="detail-info-full">
                                <h2 class="detail-title-full">${data.nom}</h2>
                                <div class="detail-price-full">${data.prix_vente}FCFA</div>

                                <div class="detail-description-full">
                                    <h4><i class="fas fa-file-alt"></i> Description</h4>
                                    <p>${data.description || 'Aucune description disponible pour ce produit.'}</p>
                                </div>

                                <div class="detail-specs-grid">
                                    <div class="spec-card-full">
                                        <span class="spec-label-full">Référence</span>
                                        <span class="spec-value-full">${data.reference}</span>
                                    </div>
                                    <div class="spec-card-full">
                                        <span class="spec-label-full">Marque</span>
                                        <span class="spec-value-full">${data.marque || 'Non spécifiée'}</span>
                                    </div>
                                    <div class="spec-card-full">
                                        <span class="spec-label-full">Modèle</span>
                                        <span class="spec-value-full">${data.modele || 'Standard'}</span>
                                    </div>
                                    <div class="spec-card-full">
                                        <span class="spec-label-full">Type</span>
                                        <span class="spec-value-full">${data.type_produit}</span>
                                    </div>
                                    <div class="spec-card-full">
                                        <span class="spec-label-full">Stock</span>
                                        <span class="spec-value-full">${data.stock_actuel} ${data.unite_mesure}</span>
                                    </div>
                                    <div class="spec-card-full">
                                        <span class="spec-label-full">Prix TTC</span>
                                        <span class="spec-value-full">${data.prix_ttc || data.prix_vente}FCFA</span>
                                    </div>
                                    <div class="spec-card-full">
                                        <span class="spec-label-full">TVA</span>
                                        <span class="spec-value-full">${data.taux_tva}%</span>
                                    </div>
                                    <div class="spec-card-full">
                                        <span class="spec-label-full">Unité</span>
                                        <span class="spec-value-full">${data.unite_mesure}</span>
                                    </div>
                                    <div class="spec-card-full">
                                        <span class="spec-label-full">Statut stock</span>
                                        <span class="spec-value-full stock-indicator stock-${data.stock_status}">
                                            <span class="stock-dot"></span>
                                            ${data.stock_status === 'bon' ? 'Disponible' : data.stock_status === 'faible' ? 'Stock faible' : 'Rupture'}
                                        </span>
                                    </div>
                                    <div class="spec-card-full">
                                        <span class="spec-label-full">Ajouté le</span>
                                        <span class="spec-value-full">${data.created_at}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                        detailModal.style.display = 'block';
                        document.body.style.overflow = 'hidden';

                    } catch (error) {
                        console.error('Erreur:', error);
                        detailContent.innerHTML = `
                        <div style="text-align:center;padding:4rem;">
                            <i class="fas fa-exclamation-triangle fa-3x" style="color:#e50914;"></i>
                            <h3 style="margin:1rem 0;">Erreur de chargement</h3>
                            <p style="color:#ccc;">Impossible de charger les détails du produit.</p>
                        </div>
                    `;
                        detailModal.style.display = 'block';
                        document.body.style.overflow = 'hidden';
                    }
                }

                // Fonction ajouter au panier
                function addToCart(productId, productName, button) {
                    // Animation du bouton
                    const originalHTML = button.innerHTML;
                    const originalBg = button.style.background;

                    button.innerHTML = '<i class="fas fa-check"></i><span>Ajouté</span>';
                    button.style.background = 'linear-gradient(135deg, #27ae60 0%, #219653 100%)';
                    button.disabled = true;

                    // Simuler l'ajout au panier (à remplacer par votre logique réelle)
                    setTimeout(() => {
                        showToast(`${productName} ajouté au panier`);
                    }, 300);

                    // Réinitialiser après 2 secondes
                    setTimeout(() => {
                        button.innerHTML = originalHTML;
                        button.style.background = originalBg;
                        button.disabled = false;
                    }, 2000);
                }

                // Fonction toast
                function showToast(message, type = 'success') {
                    const toast = document.createElement('div');
                    toast.className = `toast ${type === 'error' ? 'error' : ''}`;
                    toast.innerHTML = `
                    <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'}"></i>
                    <span>${message}</span>
                `;
                    document.body.appendChild(toast);

                    setTimeout(() => {
                        toast.classList.add('show');
                    }, 10);

                    setTimeout(() => {
                        toast.classList.remove('show');
                        setTimeout(() => {
                            toast.remove();
                        }, 300);
                    }, 3000);
                }

                // Fermer avec ESC
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        if (detailModal.style.display === 'block') {
                            detailModal.style.display = 'none';
                            document.body.style.overflow = 'auto';
                        }
                        if (zoomModal.style.display === 'block') {
                            zoomModal.style.display = 'none';
                            document.body.style.overflow = 'auto';
                        }
                    }
                });
            });
        </script>
    </body>

    <!-- Google Map Section -->
    <section class="map" id="map">
        <style>
            html,
            body {
                margin: 0;
                padding: 0;
                height: 100%;
            }

            #map {
                background: #0a0a0a;
                padding: 0;
                color: #fff;
                width: 100%;
                height: 500px;
                position: relative;
            }

            #map iframe {
                width: 100%;
                height: 100%;
                border: 0;
            }


            #map h2,
            #map h3,
            #map p {
                position: absolute;
                top: 10px;
                left: 20px;
                color: #fff;
                z-index: 2;
            }
        </style>

        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.121823171401!2d2.335174475785061!3d6.378271824832322!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023576c47850fe9%3A0xc67088be44709da7!2sLE%20CH%C3%82TEAU%20-%20MAISON%20DES%20JEUNES!5e0!3m2!1sfr!2sbj!4v1765830156397!5m2!1sfr!2sbj"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>

    </html>
@endsection
