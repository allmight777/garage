{{-- resources/views/ventes/show.blade.php --}}
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

        .vente-detail-container {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        /* Header amélioré */
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
                    rgba(255, 255, 255, 0.1) 0%,
                    rgba(255, 255, 255, 0.05) 100%);
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
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .admin-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            margin-top: 8px;
            font-weight: 400;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 2;
        }

        /* Cartes améliorées */
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

        /* Badges améliorés */
        .badge-statut {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .badge-terminee {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            color: white;
        }

        .badge-annulee {
            background: linear-gradient(135deg, var(--danger), var(--danger-dark));
            color: white;
        }

        .badge-paiement {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .badge-especes {
            background: #28a745;
        }

        .badge-mobile_money {
            background: #17a2b8;
        }

        .badge-carte {
            background: #007bff;
        }

        .badge-cheque {
            background: #6c757d;
        }

        /* Grille d'informations */
        .info-grid {
            display: grid;
            gap: 20px;
            padding: 25px 30px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .info-item:hover {
            background: rgba(67, 97, 238, 0.02);
            padding: 15px;
            border-radius: 12px;
        }

        .info-label {
            font-weight: 600;
            color: var(--gray);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-value {
            font-weight: 700;
            color: var(--dark);
            font-size: 1.1rem;
        }

        .montant-total {
            font-size: 1.8rem;
            color: var(--success);
            font-weight: 900;
            text-shadow: 0 2px 5px rgba(6, 214, 160, 0.2);
        }

        /* Section client */
        .client-section {
            padding: 30px;
        }

        .client-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
        }

        .client-name {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .client-info-grid {
            display: grid;
            gap: 12px;
        }

        .client-info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 15px;
            background: rgba(0, 0, 0, 0.02);
            border-radius: 12px;
            transition: var(--transition);
        }

        .client-info-item:hover {
            background: rgba(67, 97, 238, 0.05);
            transform: translateX(5px);
        }

        .client-info-item i {
            color: var(--primary);
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        /* Tableau produits */
        .table-container {
            padding: 25px 30px;
        }

        .produits-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
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
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
        }

        .table-row:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .table-row td {
            padding: 20px 15px;
            border: none;
            vertical-align: middle;
            background: transparent;
        }

        .table-row td:first-child {
            border-radius: 12px 0 0 12px;
        }

        .table-row td:last-child {
            border-radius: 0 12px 12px 0;
        }

        .produit-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .produit-image {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 5px;
        }

        .produit-details h4 {
            margin: 0;
            font-weight: 700;
            color: var(--dark);
            font-size: 1.1rem;
        }

        .produit-details small {
            color: var(--gray);
            font-size: 0.85rem;
        }

        .badge-ref {
            display: inline-block;
            padding: 6px 12px;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(114, 9, 183, 0.1));
            color: var(--primary);
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            border: 1px solid rgba(67, 97, 238, 0.2);
        }

        .badge-qty {
            display: inline-block;
            padding: 8px 16px;
            background: linear-gradient(135deg, rgba(255, 209, 102, 0.1), rgba(255, 158, 0, 0.1));
            color: var(--warning-dark);
            border-radius: 20px;
            font-weight: 800;
            font-size: 1.1rem;
            min-width: 50px;
            text-align: center;
        }

        .text-currency {
            font-weight: 700;
            color: var(--dark);
        }

        /* Total row */
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

        /* Section notes */
        .notes-section {
            padding: 25px 30px;
            border-top: 1px solid var(--glass-border);
            background: rgba(67, 97, 238, 0.02);
        }

        .notes-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .notes-header i {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .notes-content {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid var(--primary);
            color: var(--gray);
            line-height: 1.6;
            font-style: italic;
            white-space: pre-line;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
        }

        /* Actions section */
        .actions-section {
            padding: 30px;
            border-top: 1px solid var(--glass-border);
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.02), rgba(114, 9, 183, 0.02));
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 16px 24px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            text-align: center;
            min-width: 180px;
        }

        .btn-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-back {
            background: linear-gradient(135deg, var(--gray), #5a6268);
            color: white;
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--warning), var(--warning-dark));
            color: var(--dark);
        }

        .btn-print {
            background: linear-gradient(135deg, var(--info), var(--info-dark));
            color: white;
        }

        .btn-new {
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            color: white;
        }

        .btn-cancel {
            background: linear-gradient(135deg, var(--danger), var(--danger-dark));
            color: white;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .vente-detail-container {
                padding: 20px;
            }

            .admin-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }

            .btn-action {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .produits-table {
                font-size: 0.9rem;
            }

            .produit-info {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }

            .client-name {
                font-size: 1.5rem;
            }

            .admin-title {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 576px) {
            .vente-detail-container {
                padding: 15px;
            }

            .card-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .info-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
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
                padding: 12px 20px;
                position: relative;
            }

            .produits-table .table-row td::before {
                content: attr(data-label);
                position: absolute;
                left: 20px;
                top: 12px;
                font-weight: 600;
                color: var(--gray);
            }

            .produits-table .table-row td:first-child {
                border-radius: 12px 12px 0 0;
            }

            .produits-table .table-row td:last-child {
                border-radius: 0 0 12px 12px;
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

    <div class="vente-detail-container">
        <!-- Header -->
        <div class="admin-header animate-slide-down">
            <div class="header-content">
                <h1 class="admin-title">🧾 Détails de la Vente</h1>
                <p class="admin-subtitle">Transaction {{ $vente->numero_vente }} •
                    {{ $vente->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="header-actions">
                <a href="{{ route('ventes.index') }}" class="btn-action" style="background-color: rgb(40, 157, 192);">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                @if ($vente->statut != 'annulee')
                    <a href="{{ route('ventes.edit', $vente) }}" class="btn-action btn-edit" style="color: white;">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                @endif
            </div>
        </div>

        @if (session('success'))
            <div class="alert-toast alert-success-toast" role="alert">
                <div class="toast-content">
                    <div class="toast-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="toast-message">
                        <strong>Succès !</strong>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button class="toast-close" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="toast-progress"></div>
            </div>
        @endif

        @if (session('error'))
            <div class="alert-toast alert-danger-toast" role="alert">
                <div class="toast-content">
                    <div class="toast-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="toast-message">
                        <strong>Erreur !</strong>
                        <p>{{ session('error') }}</p>
                    </div>
                    <button class="toast-close" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="toast-progress"></div>
            </div>
        @endif

        <style>
            /* Toast notification style */
            .alert-toast {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                max-width: 400px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
                overflow: hidden;
                animation: toastSlideIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
                transform-origin: top right;
            }

            @keyframes toastSlideIn {
                from {
                    transform: translateX(100%) scale(0.8);
                    opacity: 0;
                }

                to {
                    transform: translateX(0) scale(1);
                    opacity: 1;
                }
            }

            .toast-content {
                display: flex;
                align-items: flex-start;
                padding: 1rem;
                gap: 0.75rem;
            }

            .toast-icon {
                font-size: 1.5rem;
                margin-top: 2px;
                animation: iconBounce 0.6s ease;
            }

            @keyframes iconBounce {

                0%,
                20%,
                50%,
                80%,
                100% {
                    transform: translateY(0);
                }

                40% {
                    transform: translateY(-10px);
                }

                60% {
                    transform: translateY(-5px);
                }
            }

            .alert-success-toast .toast-icon {
                color: #10b981;
            }

            .alert-danger-toast .toast-icon {
                color: #ef4444;
            }

            .toast-message {
                flex: 1;
            }

            .toast-message strong {
                display: block;
                margin-bottom: 0.25rem;
                color: #1f2937;
            }

            .toast-message p {
                margin: 0;
                color: #6b7280;
                font-size: 0.9rem;
            }

            .toast-close {
                background: none;
                border: none;
                color: #9ca3af;
                cursor: pointer;
                padding: 0.25rem;
                border-radius: 4px;
                transition: all 0.2s;
            }

            .toast-close:hover {
                background: #f3f4f6;
                color: #374151;
            }

            /* Barre de progression */
            .toast-progress {
                height: 3px;
                width: 100%;
                background: #e5e7eb;
                overflow: hidden;
            }

            .toast-progress::after {
                content: '';
                display: block;
                height: 100%;
                width: 100%;
                animation: progressBar 5s linear forwards;
            }

            .alert-success-toast .toast-progress::after {
                background: linear-gradient(to right, #10b981, #34d399);
            }

            .alert-danger-toast .toast-progress::after {
                background: linear-gradient(to right, #ef4444, #f87171);
            }

            @keyframes progressBar {
                from {
                    transform: translateX(-100%);
                }

                to {
                    transform: translateX(0);
                }
            }

            /* Animation de sortie */
            .alert-toast.hiding {
                animation: toastSlideOut 0.4s ease-in forwards;
            }

            @keyframes toastSlideOut {
                to {
                    transform: translateX(100%) scale(0.8);
                    opacity: 0;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toasts = document.querySelectorAll('.alert-toast');

                toasts.forEach(toast => {
                    // Fermeture au clic
                    const closeBtn = toast.querySelector('.toast-close');
                    closeBtn.addEventListener('click', function() {
                        toast.classList.add('hiding');
                        setTimeout(() => toast.remove(), 400);
                    });

                    // Fermeture automatique après 5 secondes
                    setTimeout(() => {
                        if (toast.parentNode) {
                            toast.classList.add('hiding');
                            setTimeout(() => toast.remove(), 400);
                        }
                    }, 5000);
                });
            });
        </script>


        <div class="row">
            <!-- Colonne gauche : Infos vente et client -->
            <div class="col-lg-4">
                <!-- Carte informations vente -->
                <div class="main-card animate-fade-in">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-receipt"></i> Informations Transaction
                        </h2>
                        <span class="badge-statut badge-{{ $vente->statut }}">
                            @if ($vente->statut == 'terminee')
                                <i class="fas fa-check-circle"></i>
                            @else
                                <i class="fas fa-times-circle"></i>
                            @endif
                            {{ $vente->statut_text }}
                        </span>
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-hashtag"></i> Numéro
                            </span>
                            <span class="info-value">{{ $vente->numero_vente }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-calendar-alt"></i> Date
                            </span>
                            <span class="info-value">{{ $vente->created_at->format('d/m/Y H:i') }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-user-tie"></i> Vendeur
                            </span>
                            <span class="info-value">{{ $vente->vendeur->name }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-credit-card"></i> Paiement
                            </span>
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
                        </div>

                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-money-bill-wave"></i> Montant
                            </span>
                            <span class="montant-total">
                                {{ number_format($vente->montant_total, 0, ',', ' ') }} FCFA
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Carte client -->
                <div class="main-card animate-fade-in" style="animation-delay: 0.1s">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-user-circle"></i> Informations Client
                        </h2>
                    </div>

                    <div class="client-section">
                        @if ($vente->client || $vente->client_nom)
                            <div class="text-center mb-4">
                                <div class="client-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <h3 class="client-name">
                                    {{ $vente->client->nom_complet ?? $vente->client_nom }}
                                </h3>
                            </div>

                            <div class="client-info-grid">
                                @if (($vente->client && $vente->client->telephone) || $vente->client_telephone)
                                    <div class="client-info-item">
                                        <i class="fas fa-phone"></i>
                                        <span>{{ $vente->client->telephone ?? $vente->client_telephone }}</span>
                                    </div>
                                @endif

                                @if (($vente->client && $vente->client->adresse) || $vente->client_adresse)
                                    <div class="client-info-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $vente->client->adresse ?? $vente->client_adresse }}</span>
                                    </div>
                                @endif

                                <div class="client-info-item">
                                    <i class="fas fa-calendar-check"></i>
                                    <span>Client depuis {{ $vente->created_at->format('m/Y') }}</span>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <div class="client-avatar"
                                    style="background: linear-gradient(135deg, var(--gray), #5a6268);">
                                    <i class="fas fa-user-slash"></i>
                                </div>
                                <h3 class="client-name">Client non enregistré</h3>
                                <p class="text-muted mt-2">Aucune information client disponible</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Colonne droite : Produits et actions -->
            <div class="col-lg-8">
                <!-- Carte produits vendus -->
                <div class="main-card animate-fade-in" style="animation-delay: 0.2s">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-shopping-bag"></i> Produits Vendus
                            <span
                                style="background: var(--secondary); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.9rem;">
                                {{ $vente->ligneVentes->sum('quantite') }} articles
                            </span>
                        </h2>
                    </div>

                    <div class="table-container">
                        <table class="produits-table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Référence</th>
                                    <th>Prix Unitaire</th>
                                    <th>Quantité</th>
                                    <th>Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vente->ligneVentes as $ligne)
                                    <tr class="table-row">
                                        <td data-label="Produit">
                                            <div class="produit-info">
                                                <div class="produit-image">
                                                    @if ($ligne->produit->image)
                                                        <img src="{{ asset('storage/produits/' . $ligne->produit->image) }}"
                                                            alt="{{ $ligne->produit->nom }}"
                                                            style="width: 100%; height: 100%; border-radius: 8px; object-fit: cover;">
                                                    @else
                                                        <i class="fas fa-box"
                                                            style="font-size: 1.5rem; color: white; line-height: 40px; text-align: center; display: block;"></i>
                                                    @endif
                                                </div>
                                                <div class="produit-details">
                                                    <h4>{{ $ligne->produit->nom }}</h4>
                                                    @if ($ligne->produit->marque)
                                                        <small><i class="fas fa-tag"></i>
                                                            {{ $ligne->produit->marque }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Référence" class="text-center">
                                            <span class="badge-ref">{{ $ligne->produit->reference }}</span>
                                        </td>
                                        <td data-label="Prix Unitaire" class="text-center text-currency">
                                            {{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA
                                        </td>
                                        <td data-label="Quantité" class="text-center">
                                            <span class="badge-qty">{{ $ligne->quantite }}</span>
                                        </td>
                                        <td data-label="Sous-total" class="text-right text-currency">
                                            <strong>{{ number_format($ligne->sous_total, 0, ',', ' ') }} FCFA</strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-row total-row">
                                    <td colspan="4" class="text-right total-label">
                                        TOTAL GÉNÉRAL
                                    </td>
                                    <td class="text-right total-amount">
                                        {{ number_format($vente->montant_total, 0, ',', ' ') }} FCFA
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Notes -->
                    @if ($vente->notes)
                        <div class="notes-section">
                            <div class="notes-header">
                                <i class="fas fa-sticky-note"></i>
                                <h4 style="margin: 0; font-weight: 600; color: var(--dark);">Notes</h4>
                            </div>
                            <div class="notes-content">
                                {{ $vente->notes }}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="actions-section animate-fade-in" style="animation-delay: 0.3s">
                    <div class="actions-grid">
                        <a href="{{ route('ventes.imprimer', $vente) }}" class="btn-action btn-print" target="_blank">
                            <i class="fas fa-print"></i> Imprimer Facture
                        </a>

                        <a href="{{ route('ventes.create') }}" class="btn-action btn-new">
                            <i class="fas fa-plus-circle"></i> Nouvelle Vente
                        </a>

                        @if ($vente->statut !== 'annulee')
                            <form action="{{ route('ventes.annuler', $vente) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-action btn-cancel annuler-btn"
                                    data-numero="{{ $vente->numero_vente }}">
                                    <i class="fas fa-ban"></i> Annuler Vente
                                </button>
                            </form>
                        @endif


                        <a href="{{ route('ventes.index') }}" class="btn-action btn-back">
                            <i class="fas fa-list"></i> Liste des Ventes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des cartes
            const cards = document.querySelectorAll('.animate-fade-in');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Animation des lignes du tableau
            const rows = document.querySelectorAll('.table-row');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.style.animation = 'fadeInUp 0.5s ease-out forwards';
                row.style.opacity = '0';
            });

            // Gestion annulation vente
            const annulerBtn = document.querySelector('.annuler-btn');
            if (annulerBtn) {
                annulerBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const numero = this.getAttribute('data-numero');

                    Swal.fire({
                        title: '',
                        html: `
                    <div style="text-align: center;">

                        <h3 style="margin-bottom: 15px;">Vente ${numero}</h3>
                        <p style="color: #6c757d; margin-bottom: 25px;">
                            Cette action est irréversible. Tous les produits seront restockés.
                        </p>
                        <div style="background: rgba(239, 71, 111, 0.1); padding: 15px; border-radius: 12px; margin-top: 20px;">
                            <i class="fas fa-box" style="color: #ef476f; margin-right: 10px;"></i>
                            <strong style="color: #ef476f;">Attention :</strong>
                            <span style="color: #6c757d;">Le stock sera restauré pour chaque produit vendu.</span>
                        </div>
                    </div>
                `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Confirmer l\'annulation',
                        cancelButtonText: 'Conserver la vente',
                        confirmButtonColor: '#ef476f',
                        cancelButtonColor: '#6c757d',
                        backdrop: 'rgba(0,0,0,0.8)',
                        customClass: {
                            confirmButton: 'btn btn-danger',
                            cancelButton: 'btn btn-secondary'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            }

            // Animation CSS
            const style = document.createElement('style');
            style.textContent = `
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

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .animate-slide-down {
            animation: slideInRight 0.6s ease-out;
        }

        .animate-fade-in {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .montant-total {
            animation: pulse 2s ease-in-out infinite;
        }

        .client-avatar:hover {
            animation: pulse 1s ease-in-out;
        }
    `;
            document.head.appendChild(style);
        });
    </script>
@endsection
