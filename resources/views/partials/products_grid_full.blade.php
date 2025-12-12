<div class="products-grid-full">
    @foreach($produits as $index => $produit)
    <div class="product-card-full" style="opacity:0;transform:translateY(20px);">
        <!-- Badges -->
        <div class="product-badge-container">
            <span class="badge badge-stock">
                @if($produit->stock_status === 'rupture')
                    <i class="fas fa-times-circle"></i> Rupture
                @elseif($produit->stock_status === 'faible')
                    <i class="fas fa-exclamation-triangle"></i> Stock faible
                @else
                    <i class="fas fa-check-circle"></i> Disponible
                @endif
            </span>
            @if($produit->typeProduit)
            <span class="badge badge-type">
                <i class="fas fa-tag"></i> {{ $produit->typeProduit->nom }}
            </span>
            @endif
        </div>

        <!-- Image -->
        <div class="product-image-container">
            @if($produit->image)
                <img src="{{ asset('storage/produits/' . $produit->image) }}"
                     alt="{{ $produit->nom }}"
                     class="product-image"
                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIyMjAiIHZpZXdCb3g9IjAgMCAzMDAgMjIwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIzMDAiIGhlaWdodD0iMjIwIiBmaWxsPSIjMUExQTFBIi8+PHBhdGggZD0iTTE1MCA4MEwxNjAgMTAwTDE0MCAxMDBMMTUwIDgwWiIgZmlsbD0iIzQxNDE0MSIvPjxwYXRoIGQ9Ik0xNTAgMTAwQzE1OC4yODQgMTAwIDE2NSA5My4yODQzIDE2NSA4NUMxNjUgNzYuNzE1NyAxNTguMjg0IDcwIDE1MCA3MEMxNDEuNzE2IDcwIDEzNSA3Ni43MTU3IDEzNSA4NUMxMzUgOTMuMjg0MyAxNDEuNzE2IDEwMCAxNTAgMTAwWiIgZmlsbD0iIzQxNDE0MSIvPjwvc3ZnPg=='">
            @else
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#0a0a0a,#1a1a1a);display:flex;align-items:center;justify-content:center;color:#666;">
                    <i class="fas fa-box-open fa-3x"></i>
                </div>
            @endif
            <div class="image-overlay">
                <div class="image-actions">
                    <button class="image-btn zoom-btn-full" data-image="{{ $produit->image ? asset('storage/produits/' . $produit->image) : '' }}">
                        <i class="fas fa-expand"></i>
                    </button>
                    <button class="image-btn cart-btn" data-product-id="{{ $produit->id }}">
                        <i class="fas fa-cart-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Contenu -->
        <div class="product-content">
            <div class="product-header-full">
                <h3 class="product-title-full">{{ $produit->nom }}</h3>
                <div class="product-price-full">
                    <span class="current-price-full">{{ number_format($produit->prix_vente, 2, ',', ' ') }}€</span>
                    @if($produit->taux_tva > 0)
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
                <button class="btn-action btn-details-full" data-product-id="{{ $produit->id }}">
                    <i class="fas fa-info-circle"></i>
                    <span>Détails</span>
                </button>
                <button class="btn-action btn-cart-full" data-product-id="{{ $produit->id }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Ajouter</span>
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>
