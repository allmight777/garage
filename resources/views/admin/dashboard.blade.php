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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            padding: 25px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: var(--transition);
            background: white;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 900;
            margin: 0;
            color: var(--dark);
            line-height: 1;
        }

        .stat-label {
            color: var(--gray);
            margin: 8px 0 12px 0;
            font-size: 0.9rem;
        }

        .stat-trend {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .trend-up {
            background: rgba(6, 214, 160, 0.1);
            color: var(--success);
        }

        .trend-down {
            background: rgba(239, 71, 111, 0.1);
            color: var(--danger);
        }

        .chart-card {
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.2rem;
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

        .chart-container-small {
            position: relative;
            height: 250px;
            width: 100%;
        }

        .lists-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 40px;
        }

        @media (max-width: 1200px) {
            .lists-grid {
                grid-template-columns: 1fr;
            }
        }

        .list-card {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .list-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
        }

        .list-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .list-body {
            max-height: 400px;
            overflow-y: auto;
        }

        .list-item {
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            transition: var(--transition);
        }

        .list-item:hover {
            background: rgba(0, 0, 0, 0.02);
        }

        .item-content {
            display: flex;
            flex-direction: column;
        }

        .item-title {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .item-subtitle {
            color: var(--gray);
            font-size: 0.85rem;
        }

        .item-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
        }

        .item-date {
            color: var(--gray);
            font-size: 0.8rem;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .badge-success {
            background: var(--gradient-success);
            color: white;
        }

        .badge-warning {
            background: var(--gradient-warning);
            color: white;
        }

        .badge-danger {
            background: var(--gradient-danger);
            color: white;
        }

        .badge-info {
            background: linear-gradient(135deg, var(--info), var(--info-dark));
            color: white;
        }

        .mini-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-top: 15px;
        }

        .mini-stat {
            background: rgba(0, 0, 0, 0.03);
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }

        .mini-stat-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
        }

        .mini-stat-label {
            font-size: 0.75rem;
            color: var(--gray);
            margin-top: 5px;
        }
    </style>

    <!-- Navbar -->
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
        navbar-main navbar-scroll="true">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
            <nav>
                <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                    <li class="text-sm leading-normal">
                        <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
                    </li>
                    <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                        aria-current="page">
                        Dashboard
                    </li>
                </ol>
                <h6 class="mb-0 font-bold capitalize">Dashboard</h6>
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
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- cards -->
    <div class="w-full px-6 py-6 mx-auto">
        <!-- row 1 - Cartes statistiques -->
        <div class="stats-grid">
            <!-- Chiffre d'affaires -->
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--gradient-1);">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ number_format($statistiques['total_ca'], 0, ',', ' ') }} FCFA</h3>
                    <p class="stat-label">Chiffre d'affaires total</p>
                    <div class="stat-trend {{ $statistiques['pourcentage_ca'] >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="fas fa-arrow-{{ $statistiques['pourcentage_ca'] >= 0 ? 'up' : 'down' }}"></i>
                        {{ abs($statistiques['pourcentage_ca']) }}% aujourd'hui
                    </div>
                </div>
            </div>

            <!-- Ventes -->
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--gradient-2);">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $statistiques['total_ventes'] }}</h3>
                    <p class="stat-label">Ventes totales</p>
                    <div class="d-flex align-items-center">
                        <span class="text-success me-2">
                            <i class="fas fa-check-circle"></i> {{ $statistiques['ventes_aujourdhui'] }} aujourd'hui
                        </span>
                    </div>
                </div>
            </div>

            <!-- Clients -->
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--gradient-3);">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $statistiques['total_clients'] }}</h3>
                    <p class="stat-label">Clients enregistrés</p>
                    <div class="text-success">
                        <i class="fas fa-user-plus"></i> {{ $statistiques['nouveaux_clients'] }} nouveaux aujourd'hui
                    </div>
                </div>
            </div>

            <!-- Stock -->
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--gradient-4);">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $statistiques['total_produits'] }}</h3>
                    <p class="stat-label">Produits en stock</p>
                    <div class="d-flex gap-2">
                        <span class="badge badge-danger">{{ $statistiques['produits_rupture'] }} rupture</span>
                        <span class="badge badge-warning">{{ $statistiques['produits_faible'] }} faible</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- cards row 2 - Graphiques -->
        <div class="flex flex-wrap mt-6 -mx-3">
            <!-- Left side - Grand graphique -->
            <div class="w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap -mx-3">
                            <div class="max-w-full px-3 lg:w-1/2 lg:flex-none"
                                style="
        background-image: url('{{ asset('images/11.webp') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border-radius: 12px;
     ">
                                <div class="flex flex-col h-full p-6"
                                    style="
            background-color: rgba(0, 0, 0, 0.55);
            border-radius: 12px;
            color: #ffffff;
         ">

                                    <p class="pt-2 mb-1 font-semibold">
                                        Activité du mois
                                    </p>

                                    <h5 class="font-bold text-lg">
                                        Performance des ventes
                                    </h5>

                                    <p class="mb-12 text-sm">
                                        Analyse détaillée de votre chiffre d'affaires et tendances des ventes.
                                    </p>

                                    <div class="mt-auto">
                                        <span class="text-sm text-slate-300">
                                            Mis à jour : {{ now()->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="max-w-full px-3 mt-12 ml-auto text-center lg:mt-0 lg:w-5/12 lg:flex-none">
                                <div class="h-full rounded-xl">
                                    <div class="chart-container-large">
                                        <canvas id="caMensuelChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side - Diagramme circulaire statut stocks -->
            <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                <div
                    class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border p-4">
                    <div class="relative h-full overflow-hidden bg-cover rounded-xl"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%)">
                        <div class="relative z-10 flex flex-col flex-auto h-full p-4">
                            <h5 class="pt-2 mb-4 font-bold text-white">
                                Statut des stocks
                            </h5>
                            <p class="text-white mb-4">
                                Répartition des produits par niveau de stock
                            </p>

                            <div class="chart-container-small">
                                <canvas id="statutStocksChart"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- cards row 3 - Graphiques supplémentaires -->
        <div class="flex flex-wrap mt-6 -mx-3">
            <!-- Graphique Ventes quotidiennes -->
            <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-5/12 lg:flex-none">
                <div
                    class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="py-4 pr-1 mb-4 bg-gradient-to-tl from-gray-900 to-slate-800 rounded-xl">
                            <div>
                                <canvas id="ventesJourChart" height="170"></canvas>
                            </div>
                        </div>
                        <h6 class="mt-6 mb-0 ml-2">Ventes quotidiennes (7 derniers jours)</h6>
                        <p class="ml-2 text-sm leading-normal">
                            Aujourd'hui ({{ now()->format('d/m') }}): <span
                                class="font-bold">{{ $statistiques['ventes_aujourdhui'] }} ventes</span>
                        </p>
                        <div class="w-full px-6 mx-auto max-w-screen-2xl rounded-xl">
                            <div class="flex flex-wrap mt-0 -mx-3">
                                <div class="flex-none w-1/4 max-w-full py-4 pl-0 pr-3 mt-0">
                                    <div class="flex mb-2">
                                        <div
                                            class="flex items-center justify-center w-5 h-5 mr-2 text-center bg-center rounded fill-current shadow-soft-2xl bg-gradient-to-tl from-purple-700 to-pink-500 text-neutral-900">
                                            <i class="fas fa-shopping-cart text-xs text-white"></i>
                                        </div>
                                        <p class="mt-1 mb-0 text-xs font-semibold leading-tight">
                                            Ventes
                                        </p>
                                    </div>
                                    <h4 class="font-bold">{{ $statistiques['total_ventes'] }}</h4>
                                    <div class="text-xs h-0.75 flex w-3/4 overflow-visible rounded-lg bg-gray-200">
                                        @php
                                            $progress =
                                                $statistiques['total_ventes'] > 0
                                                    ? min(100, ($statistiques['total_ventes'] / 100) * 100)
                                                    : 0;
                                        @endphp
                                        <div class="duration-600 ease-soft -mt-0.38 -ml-px flex h-1.5 w-{{ min(100, $progress) }}/100 flex-col justify-center overflow-hidden whitespace-nowrap rounded-lg bg-slate-700 text-center text-white transition-all"
                                            role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="flex-none w-1/4 max-w-full py-4 pl-0 pr-3 mt-0">
                                    <div class="flex mb-2">
                                        <div
                                            class="flex items-center justify-center w-5 h-5 mr-2 text-center bg-center rounded fill-current shadow-soft-2xl bg-gradient-to-tl from-blue-600 to-cyan-400 text-neutral-900">
                                            <i class="fas fa-users text-xs text-white"></i>
                                        </div>
                                        <p class="mt-1 mb-0 text-xs font-semibold leading-tight">
                                            Clients
                                        </p>
                                    </div>
                                    <h4 class="font-bold">{{ $statistiques['total_clients'] }}</h4>
                                    <div class="text-xs h-0.75 flex w-3/4 overflow-visible rounded-lg bg-gray-200">
                                        @php
                                            $progress =
                                                $statistiques['total_clients'] > 0
                                                    ? min(100, ($statistiques['total_clients'] / 50) * 100)
                                                    : 0;
                                        @endphp
                                        <div class="duration-600 ease-soft -mt-0.38 w-{{ min(100, $progress) }}/100 -ml-px flex h-1.5 flex-col justify-center overflow-hidden whitespace-nowrap rounded-lg bg-slate-700 text-center text-white transition-all"
                                            role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="flex-none w-1/4 max-w-full py-4 pl-0 pr-3 mt-0">
                                    <div class="flex mb-2">
                                        <div
                                            class="flex items-center justify-center w-5 h-5 mr-2 text-center bg-center rounded fill-current shadow-soft-2xl bg-gradient-to-tl from-red-500 to-yellow-400 text-neutral-900">
                                            <i class="fas fa-box text-xs text-white"></i>
                                        </div>
                                        <p class="mt-1 mb-0 text-xs font-semibold leading-tight">
                                            Produits
                                        </p>
                                    </div>
                                    <h4 class="font-bold">{{ $statistiques['total_produits'] }}</h4>
                                    <div class="text-xs h-0.75 flex w-3/4 overflow-visible rounded-lg bg-gray-200">
                                        @php
                                            $progress =
                                                $statistiques['total_produits'] > 0
                                                    ? min(100, ($statistiques['total_produits'] / 50) * 100)
                                                    : 0;
                                        @endphp
                                        <div class="duration-600 ease-soft -mt-0.38 w-{{ min(100, $progress) }}/100 -ml-px flex h-1.5 flex-col justify-center overflow-hidden whitespace-nowrap rounded-lg bg-slate-700 text-center text-white transition-all"
                                            role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="flex-none w-1/4 max-w-full py-4 pl-0 pr-3 mt-0">
                                    <div class="flex mb-2">
                                        <div
                                            class="flex items-center justify-center w-5 h-5 mr-2 text-center bg-center rounded fill-current shadow-soft-2xl bg-gradient-to-tl from-red-600 to-rose-400 text-neutral-900">
                                            <i class="fas fa-exclamation-triangle text-xs text-white"></i>
                                        </div>
                                        <p class="mt-1 mb-0 text-xs font-semibold leading-tight">
                                            Rupture
                                        </p>
                                    </div>
                                    <h4 class="font-bold">{{ $statistiques['produits_rupture'] }}</h4>
                                    <div class="text-xs h-0.75 flex w-3/4 overflow-visible rounded-lg bg-gray-200">
                                        @php
                                            $progress =
                                                $statistiques['produits_rupture'] > 0
                                                    ? min(
                                                        100,
                                                        ($statistiques['produits_rupture'] /
                                                            $statistiques['total_produits']) *
                                                            100,
                                                    )
                                                    : 0;
                                        @endphp
                                        <div class="duration-600 ease-soft -mt-0.38 -ml-px flex h-1.5 w-{{ min(100, $progress) }}/100 flex-col justify-center overflow-hidden whitespace-nowrap rounded-lg bg-slate-700 text-center text-white transition-all"
                                            role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphique Top produits -->
            <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
                <div
                    class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                        <h6>Top 5 produits les plus vendus</h6>
                        <p class="text-sm leading-normal">
                            <i class="fa fa-star text-warning"></i>
                            Produits avec les meilleures ventes
                        </p>
                    </div>
                    <div class="flex-auto p-4">
                        <div>
                            <canvas id="topProduitsChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listes (cartes row 4) -->
        <div class="lists-grid">
            <!-- Dernières ventes -->
            <div class="list-card">
                <div class="list-header">
                    <h3 class="list-title">
                        <i class="fas fa-history"></i> Dernières Ventes
                    </h3>
                </div>
                <div class="list-body">
                    @forelse($dernieresVentes as $vente)
                        <div class="list-item"
                            style="
        background-image: url('{{ asset('images/10.webp') }}');
        background-size: cover;
        background-position: center;
        border-radius: 10px;
        margin-bottom: 10px;
     ">
                            <div class="item-content"
                                style="
            background: rgba(255,255,255,0.88);
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 10px;
         ">

                                <div>
                                    <div class="item-title" style="font-weight: 600; font-size: 15px;">
                                        {{ $vente->numero_vente }}
                                    </div>

                                    <div class="item-subtitle" style="font-size: 13px; color: #6c757d;">
                                        @if ($vente->client)
                                            {{ $vente->client->nom }} {{ $vente->client->prenom }}
                                        @else
                                            Client non enregistré
                                        @endif
                                    </div>
                                </div>

                                <div class="item-meta" style="text-align: right;">
                                    <span class="text-success fw-bold" style="display:block; font-size:15px;">
                                        {{ number_format($vente->montant_total, 0, ',', ' ') }} FCFA
                                    </span>
                                    <span class="item-date" style="font-size:12px; color:#6c757d;">
                                        {{ $vente->created_at->format('d/m H:i') }}
                                    </span>
                                </div>

                            </div>
                        </div>

                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-cart text-gray-400 text-2xl mb-2"></i>
                            <p class="text-gray-500">Aucune vente récente</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Produits récents -->
            <div class="list-card">
                <div class="list-header">
                    <h3 class="list-title">
                        <i class="fas fa-box-open"></i> Nouveaux Produits
                    </h3>
                </div>
                <div class="list-body"
                    style="
        background-image: url('{{ asset('images/12.webp') }}');
        background-size: cover;
        background-position: center;
        border-radius: 10px;
        margin-bottom: 10px;
     ">
                    @forelse($produitsRecents as $produit)
                        <div class="list-item">
                            <div class="item-content">
                                <div class="item-title" style="color: #fff; font-size: 1.1rem; font-weight: 700;">
                                    <strong>{{ $produit->nom }}</strong>
                                </div>

                                <div class="item-subtitle" style="color: #f12828; font-size: 0.9rem;">
                                    <strong>Ref :</strong> {{ $produit->reference }}
                                </div>

                                <div class="item-meta">
                                    <span class="fw-bold" style="color: #fff; font-size: 1rem;">
                                        <strong>{{ number_format($produit->prix_vente, 0, ',', ' ') }} FCFA</strong>
                                    </span>

                                    <span
                                        class="badge badge-{{ $produit->stock_status == 'normal' ? 'success' : ($produit->stock_status == 'faible' ? 'warning' : ($produit->stock_status == 'rupture' ? 'danger' : 'info')) }}"
                                        style="font-size: 0.75rem;">
                                        {{ ucfirst($produit->stock_status) }}
                                    </span>
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-box text-gray-400 text-2xl mb-2"></i>
                            <p class="text-gray-500">Aucun produit récent</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Produits en rupture -->
            <div class="list-card">
                <div class="list-header">
                    <h3 class="list-title text-danger">
                        <i class="fas fa-exclamation-triangle"></i> Produits en Rupture
                    </h3>
                </div>
                <div class="list-body">
                    @forelse($produitsRuptureListe as $produit)
                        <div class="list-item">
                            <div class="item-content">
                                <div class="item-title">{{ $produit->nom }}</div>
                                <div class="item-subtitle"
                                    style=" display: inline-block;
    padding: 4px 10px;
    background-color: #5435dc;
    color: #ffffff;
    font-weight: 700;
    font-size: 0.75rem;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 6px rgba(220, 53, 69, 0.5);">
                                    Seuil: {{ $produit->seuil_alerte }}</div>
                                <div class="item-meta">
                                    <span class="stock-epuise"
                                        style=" display: inline-block;
    padding: 4px 10px;
    background-color: #dc3545; /* rouge */
    color: #ffffff;
    font-weight: 700;
    font-size: 0.75rem;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 6px rgba(220, 53, 69, 0.5);
">STOCK
                                        ÉPUISÉ</span>
                                    <span class="item-date">
                                        {{ $produit->updated_at->format('d/m') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle text-success text-2xl mb-2"></i>
                            <p class="text-success">Aucun produit en rupture</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Dashboard loaded, initializing charts...');

            const colors = {
                primary: '#4361ee',
                secondary: '#7209b7',
                success: '#06d6a0',
                danger: '#ef476f',
                warning: '#ffd166',
                info: '#4cc9f0',
                gray: '#6c757d'
            };

            const chartData = @json($chartData);
            console.log('Chart data:', chartData);

            // 1. Graphique CA Mensuel
            const caMensuelChart = document.getElementById('caMensuelChart');
            if (caMensuelChart) {
                console.log('Creating CA mensuel chart');
                try {
                    new Chart(caMensuelChart, {
                        type: 'bar',
                        data: {
                            labels: chartData.ca_labels,
                            datasets: [{
                                label: 'Chiffre d\'affaires (FCFA)',
                                data: chartData.ca_data,
                                backgroundColor: colors.primary + '80',
                                borderColor: colors.primary,
                                borderWidth: 2,
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
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return new Intl.NumberFormat('fr-FR').format(value) +
                                                ' FCFA';
                                        }
                                    }
                                }
                            }
                        }
                    });
                } catch (error) {
                    console.error('Error creating CA chart:', error);
                }
            }

            // 2. Graphique Ventes par Jour
            const ventesJourChart = document.getElementById('ventesJourChart');
            if (ventesJourChart) {
                console.log('Creating ventes par jour chart');
                try {
                    new Chart(ventesJourChart, {
                        type: 'bar',
                        data: {
                            labels: chartData.ventes_labels,
                            datasets: [{
                                label: 'Nombre de ventes',
                                data: chartData.ventes_data,
                                backgroundColor: colors.secondary + '80',
                                borderColor: colors.secondary,
                                borderWidth: 1,
                                borderRadius: 6
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
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                } catch (error) {
                    console.error('Error creating ventes jour chart:', error);
                }
            }

            // 3. Graphique Top Produits
            const topProduitsChart = document.getElementById('topProduitsChart');
            if (topProduitsChart) {
                console.log('Creating top produits chart');
                try {
                    new Chart(topProduitsChart, {
                        type: 'bar',
                        data: {
                            labels: chartData.top_produits_labels,
                            datasets: [{
                                label: 'Quantités vendues',
                                data: chartData.top_produits_data,
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
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                } catch (error) {
                    console.error('Error creating top produits chart:', error);
                }
            }

            // 4. Graphique Statut des Stocks
            const statutStocksChart = document.getElementById('statutStocksChart');
            if (statutStocksChart) {
                console.log('Creating statut stocks chart');
                try {
                    // Traduire les labels
                    const labelsTraduits = chartData.statut_stocks_labels.map(label => {
                        const traductions = {
                            'normal': 'Normal',
                            'faible': 'Faible',
                            'rupture': 'Rupture',
                            'alerte': 'Alerte'
                        };
                        return traductions[label] || label;
                    });

                    // Couleurs pour chaque statut
                    const backgroundColors = chartData.statut_stocks_labels.map(label => {
                        const couleurs = {
                            'normal': colors.success,
                            'faible': colors.warning,
                            'rupture': colors.danger,
                            'alerte': colors.info
                        };
                        return couleurs[label] || colors.gray;
                    });

                    new Chart(statutStocksChart, {
                        type: 'doughnut',
                        data: {
                            labels: labelsTraduits,
                            datasets: [{
                                data: chartData.statut_stocks_data,
                                backgroundColor: backgroundColors,
                                borderWidth: 2,
                                borderColor: 'white'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 20,
                                        usePointStyle: true,
                                        color: 'white'
                                    }
                                }
                            },
                            cutout: '70%'
                        }
                    });
                } catch (error) {
                    console.error('Error creating statut stocks chart:', error);
                }
            }

            // Animation des valeurs statistiques
            const statValues = document.querySelectorAll('.stat-value');
            statValues.forEach(stat => {
                const text = stat.textContent;
                const match = text.match(/([\d\s]+)/);
                if (match) {
                    const finalValue = parseInt(match[1].replace(/\s/g, ''));
                    if (!isNaN(finalValue) && finalValue > 0) {
                        let current = 0;
                        const increment = finalValue / 30;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= finalValue) {
                                current = finalValue;
                                clearInterval(timer);
                            }
                            const formatted = new Intl.NumberFormat('fr-FR').format(Math.floor(
                                current));
                            stat.textContent = text.replace(match[1], formatted);
                        }, 50);
                    }
                }
            });

            console.log('All charts initialized');
        });
    </script>
@endsection
