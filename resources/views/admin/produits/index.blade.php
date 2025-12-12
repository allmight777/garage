@extends('layouts.admin')

@section('content')
    <!-- Styles CSS améliorés -->
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

        /* Glass Effect */
        .glass-effect {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow);
        }

        .glass-effect-hover:hover {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: var(--shadow-hover);
        }

        /* Gradients */
        .gradient-1 {
            background: var(--gradient-1);
        }

        .gradient-2 {
            background: var(--gradient-2);
        }

        .gradient-3 {
            background: var(--gradient-3);
        }

        .gradient-4 {
            background: var(--gradient-4);
        }

        .bg-gradient-success {
            background: var(--gradient-success);
        }

        .bg-gradient-warning {
            background: var(--gradient-warning);
        }

        .bg-gradient-danger {
            background: var(--gradient-danger);
        }

        /* Animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% center;
            }

            100% {
                background-position: 200% center;
            }
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

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        .shimmer {
            background: linear-gradient(90deg,
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0.2) 50%,
                    rgba(255, 255, 255, 0) 100%);
            background-size: 200% auto;
            animation: shimmer 2s infinite linear;
        }

        /* Conteneur principal */
        .admin-container {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            position: relative;
        }

        /* Header amélioré */
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
            position: relative;
            overflow: hidden;
            border: 1px solid var(--glass-border);
        }

        .admin-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg,
                    var(--primary),
                    var(--secondary),
                    var(--success));
            background-size: 300% 100%;
            animation: shimmer 3s infinite linear;
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
            background-size: 200% auto;
            animation: shimmer 4s infinite linear;
            letter-spacing: -0.5px;
        }

        .admin-subtitle {
            color: var(--gray);
            font-size: 1.2rem;
            margin-top: 8px;
            font-weight: 400;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Boutons améliorés */
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
            position: relative;
            overflow: hidden;
            border: none;
            cursor: pointer;
        }

        .btn-add:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 35px rgba(67, 97, 238, 0.4);
        }

        /* Cartes statistiques améliorées */
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
            position: relative;
            overflow: hidden;
            border: 1px solid var(--glass-border);
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
        }

        .stat-card:hover {
            transform: translateY(-5px) scale(1.02);
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
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 900;
            margin: 0;
            color: var(--dark);
            line-height: 1;
        }

        .stat-label {
            color: var(--gray);
            margin: 8px 0 12px 0;
            font-size: 1rem;
            font-weight: 500;
        }

        /* Messages d'alerte */
        .success-message,
        .error-message {
            position: fixed;
            top: 25px;
            right: 25px;
            z-index: 9999;
            min-width: 400px;
            max-width: 500px;
        }

        .alert-success,
        .alert-error {
            padding: 20px 25px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            gap: 20px;
            animation: slideInRight 0.5s ease-out;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow);
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
        }

        /* Section Graphiques améliorée */
        .charts-section {
            margin: 40px 0;
        }

        /* Grille pour les 3 petits graphiques en haut */
        .charts-top-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 25px;
        }

        /* Conteneur pour le grand graphique en bas */
        .charts-bottom-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .chart-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            padding: 30px;
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
            margin-bottom: 25px;
        }

        .chart-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chart-title i {
            color: var(--primary);
            font-size: 1.2rem;
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

        /* Carte principale améliorée */
        .main-card {
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: var(--transition);
            border: 1px solid var(--glass-border);
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            margin-top: 40px;
        }

        /* Header de la carte */
        .card-header {
            padding: 30px 35px;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--glass-border);
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .card-title i {
            color: var(--primary);
            font-size: 1.5rem;
        }

        .card-subtitle {
            color: var(--gray);
            font-size: 1rem;
            margin-top: 8px;
            font-weight: 400;
        }

        /* Barre de recherche améliorée */
        .search-form {
            flex: 1;
            max-width: 450px;
            position: relative;
        }

        .search-box {
            position: relative;
            border-radius: var(--radius);
            overflow: hidden;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
        }

        .search-box i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 1.1rem;
            z-index: 2;
        }

        .search-box input {
            width: 100%;
            padding: 16px 25px 16px 55px;
            border: none;
            font-size: 1rem;
            transition: var(--transition);
            background: transparent;
            color: var(--dark);
        }

        .search-box input:focus {
            outline: none;
        }

        .search-box input::placeholder {
            color: var(--gray-light);
        }

        .search-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--gradient-1);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }

        .search-btn:hover {
            transform: translateY(-50%) scale(1.1);
        }

        /* Filtres améliorés */
        .filter-buttons {
            display: flex;
            gap: 12px;
            margin-left: 25px;
        }

        .filter-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border: none;
            background: var(--glass-bg);
            color: var(--gray);
            border-radius: var(--radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.95rem;
            border: 1px solid var(--glass-border);
        }

        .filter-btn.active {
            background: var(--gradient-1);
            color: white;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
            border-color: transparent;
        }

        .filter-btn:hover:not(.active) {
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            transform: translateY(-2px);
        }

        /* Tableau amélioré */
        .table-container {
            overflow-x: auto;
            padding: 10px;
        }

        .styled-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
            min-width: 1200px;
        }

        .styled-table thead th {
            padding: 20px 25px;
            background: transparent;
            color: var(--gray);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            white-space: nowrap;
            position: sticky;
            top: 0;
            z-index: 10;
            backdrop-filter: blur(10px);
        }

        .styled-table thead th i {
            margin-right: 10px;
            color: var(--primary);
            font-size: 1rem;
        }

        .table-row {
            border-radius: var(--radius);
            transition: var(--transition);
            position: relative;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
        }

        .table-row:hover {
            transform: translateX(8px);
            box-shadow: var(--shadow-hover);
        }

        .table-row td {
            padding: 25px;
            border: none;
            vertical-align: middle;
            position: relative;
            background: transparent;
        }

        .table-row td:first-child {
            border-radius: var(--radius) 0 0 var(--radius);
        }

        .table-row td:last-child {
            border-radius: 0 var(--radius) var(--radius) 0;
        }

        /* Image preview amélioré */
        .image-preview {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            transition: var(--transition);
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
        }

        .image-preview:hover {
            transform: scale(1.05) rotate(2deg);
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
            background: linear-gradient(135deg,
                    rgba(67, 97, 238, 0.8),
                    rgba(114, 9, 183, 0.8));
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
            width: 80px;
            height: 80px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            transition: var(--transition);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: 1px solid var(--glass-border);
        }

        .no-image:hover {
            transform: scale(1.05);
        }

        /* Badge référence amélioré */
        .badge-ref {
            display: inline-block;
            padding: 10px 18px;
            background: linear-gradient(135deg,
                    rgba(67, 97, 238, 0.1),
                    rgba(114, 9, 183, 0.1));
            color: var(--primary);
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            border: 1px solid rgba(67, 97, 238, 0.2);
            transition: var(--transition);
        }

        .badge-ref:hover {
            background: linear-gradient(135deg,
                    rgba(67, 97, 238, 0.2),
                    rgba(114, 9, 183, 0.2));
            transform: scale(1.05);
        }

        /* Contenu nom amélioré */
        .name-content {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
            line-height: 1.3;
        }

        .product-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: rgba(108, 117, 125, 0.1);
            color: var(--gray);
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            border: 1px solid rgba(108, 117, 125, 0.2);
        }

        .meta-item i {
            font-size: 0.8rem;
        }

        /* Badge type amélioré */
        .badge-type {
            --type-color: #4361ee;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: linear-gradient(135deg,
                    rgba(var(--type-color-rgb), 0.1),
                    rgba(var(--type-color-rgb), 0.05));
            color: var(--type-color);
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
            border: 1px solid rgba(var(--type-color-rgb), 0.2);
        }

        .badge-type i {
            font-size: 0.9rem;
        }

        .badge-type:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(var(--type-color-rgb), 0.2);
        }

        /* Widget stock amélioré */
        .stock-widget {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .stock-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stock-label {
            font-weight: 600;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .stock-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stock-ok {
            background: rgba(6, 214, 160, 0.1);
            color: var(--success-dark);
            border: 1px solid rgba(6, 214, 160, 0.2);
        }

        .stock-low {
            background: rgba(255, 209, 102, 0.1);
            color: var(--warning-dark);
            border: 1px solid rgba(255, 209, 102, 0.2);
        }

        .stock-rupture {
            background: rgba(239, 71, 111, 0.1);
            color: var(--danger-dark);
            border: 1px solid rgba(239, 71, 111, 0.2);
        }

        .stock-bar-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .stock-bar {
            height: 10px;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid var(--glass-border);
        }

        .stock-fill {
            height: 100%;
            border-radius: 5px;
            position: relative;
            transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stock-numbers {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stock-current {
            font-weight: 800;
            font-size: 1.2rem;
            color: var(--dark);
        }

        .stock-seuil {
            font-size: 0.9rem;
            color: var(--gray);
        }

        /* Widget prix amélioré */
        .price-widget {
            padding: 20px;
            border-radius: var(--radius);
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: var(--transition);
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
        }

        .price-widget:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price-row.highlight {
            padding-top: 12px;
            border-top: 1px solid var(--glass-border);
            margin-top: 4px;
        }

        .price-label {
            font-size: 0.9rem;
            color: var(--gray);
            font-weight: 500;
        }

        .price-value {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .price-achat {
            color: var(--gray);
            font-size: 0.95rem;
        }

        .price-vente {
            color: var(--primary);
            font-size: 1.1rem;
            font-weight: 700;
        }

        .price-marge {
            font-size: 1rem;
        }

        .text-profit {
            color: var(--success-dark);
        }

        .text-loss {
            color: var(--danger-dark);
        }

        .marge-percent {
            font-size: 0.85rem;
            opacity: 0.8;
        }

        /* Actions améliorées */
        .actions-buttons {
            display: flex;
            gap: 12px;
        }

        .btn-action {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
        }

        .btn-action i {
            transition: var(--transition);
        }

        .btn-action:hover i {
            transform: scale(1.2);
        }

        .btn-edit {
            color: var(--warning-dark);
        }

        .btn-edit:hover {
            background: linear-gradient(135deg,
                    var(--warning),
                    var(--warning-dark));
            color: white;
            border-color: transparent;
        }

        .btn-delete {
            color: var(--danger-dark);
        }

        .btn-delete:hover {
            background: linear-gradient(135deg,
                    var(--danger),
                    var(--danger-dark));
            color: white;
            border-color: transparent;
        }

        .btn-view {
            color: var(--success-dark);
        }

        .btn-view:hover {
            background: linear-gradient(135deg,
                    var(--success),
                    var(--success-dark));
            color: white;
            border-color: transparent;
        }

        /* État vide amélioré */
        .empty-state {
            text-align: center;
            padding: 80px 40px;
            border-radius: var(--radius);
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
        }

        .empty-icon {
            font-size: 5rem;
            color: var(--border);
            margin-bottom: 25px;
            opacity: 0.6;
        }

        .empty-state h3 {
            color: var(--dark);
            font-size: 1.8rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .empty-state p {
            color: var(--gray);
            margin-bottom: 35px;
            font-size: 1.1rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .btn-create-first {
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
            border: none;
        }

        .btn-create-first:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 35px rgba(67, 97, 238, 0.4);
        }

        /* Pagination améliorée */
        .pagination-container {
            padding: 30px;
            border-top: 1px solid var(--glass-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--glass-bg);
        }

        .pagination-info {
            color: var(--gray);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .pagination {
            display: flex;
            gap: 8px;
        }

        .pagination .page-link {
            padding: 10px 18px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--gray);
            text-decoration: none;
            border-radius: var(--radius-sm);
            transition: var(--transition);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .pagination .page-link:hover {
            background: var(--gradient-1);
            color: white;
            transform: translateY(-2px);
            border-color: transparent;
        }

        .pagination .active .page-link {
            background: var(--gradient-1);
            color: white;
            border-color: transparent;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        /* Modal améliorée */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 10000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
        }

        .modal-container {
            background: var(--glass-bg);
            border-radius: var(--radius-lg);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-hover);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .admin-container {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .charts-top-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .admin-header {
                flex-direction: column;
                gap: 25px;
                text-align: center;
            }

            .header-actions {
                width: 100%;
                justify-content: center;
            }

            .card-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .filter-buttons {
                margin-left: 0;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .charts-top-grid {
                grid-template-columns: 1fr;
            }

            .search-form {
                max-width: 100%;
            }

            .pagination-container {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .admin-title {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 480px) {
            .admin-container {
                padding: 15px;
            }

            .admin-header {
                padding: 25px 20px;
            }

            .btn-add {
                width: 100%;
                justify-content: center;
            }

            .stat-card {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .success-message,
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
        <!-- Header -->
        <div class="admin-header">
            <div class="header-content">
                <h1 class="admin-title">🛒 Gestion des Produits</h1>
                <p class="admin-subtitle">Gérez votre inventaire de produits avec précision</p>
            </div>

            <div class="header-actions">
                <a href="{{ route('produits.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i>
                    Nouveau Produit
                </a>
            </div>
        </div>

        <!-- Cartes statistiques améliorées -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon gradient-1">
                    <i class="fas fa-cubes"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $totalProduits }}</h3>
                    <p class="stat-label">Produits Total</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon gradient-2">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $stockFaible }}</h3>
                    <p class="stat-label">Stock Faible</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon gradient-3">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ number_format($valeurStockTotal, 0) }} FCFA</h3>
                    <p class="stat-label">Valeur Stock</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon gradient-4">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ number_format($moyenneMarge, 2) }} FCFA</h3>
                    <p class="stat-label">Marge Moyenne</p>
                </div>
            </div>
        </div>

        <!-- Section Graphiques - 3 petits en haut, 1 grand en bas -->
        <div class="charts-section">
            <!-- 3 petits graphiques en haut -->
            <div class="charts-top-grid">
                <!-- Chart 1: Répartition par Statut (Doughnut) -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">
                            <i class="fas fa-chart-pie"></i>
                            Répartition par Statut
                        </h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>

                <!-- Chart 2: Répartition par Catégorie (Polar Area) -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">
                            <i class="fas fa-tags"></i>
                            Par Catégorie
                        </h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="categoriesChart"></canvas>
                    </div>
                </div>

                <!-- Chart 3: Top Marges (Line Chart) -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">
                            <i class="fas fa-chart-line"></i>
                            Top Marges
                        </h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="margesChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- 1 grand graphique en bas -->
            <div class="charts-bottom-grid">
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">
                            <i class="fas fa-chart-bar"></i>
                            Top Produits (Valeur Stock)
                        </h3>
                    </div>
                    <div class="chart-container-large">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="success-message">
                <div class="alert-success">
                    <div class="alert-icon"
                        style="background: var(--gradient-success); color: white; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="alert-content">
                        <h4>Succès !</h4>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button type="button" class="btn-action" onclick="this.parentElement.parentElement.remove()"
                        style="background: transparent; border: none; color: var(--gray);">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="error-message">
                <div class="alert-error">
                    <div class="alert-icon"
                        style="background: var(--gradient-danger); color: white; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="alert-content">
                        <h4>Erreur !</h4>
                        <p>{{ session('error') }}</p>
                    </div>
                    <button type="button" class="btn-action" onclick="this.parentElement.parentElement.remove()"
                        style="background: transparent; border: none; color: var(--gray);">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Carte principale avec tableau -->
        <div class="main-card">
            <!-- En-tête avec recherche -->
            <div class="card-header">
                <div class="header-info">
                    <h2 class="card-title">
                        <i class="fas fa-boxes"></i>
                        Liste des Produits
                    </h2>
                    <p class="card-subtitle">{{ $produits->total() }} produits dans votre inventaire</p>
                </div>
                <div class="header-actions">
                    <div class="input-group" style="max-width: 300px; margin-bottom: 15px;">
                        <input type="text" class="form-control" placeholder="Rechercher un produit..."
                            id="productSearchInput" style="border-radius: 8px 0 0 8px; ">
                        <button class="btn btn-outline-secondary" type="button" style="border-radius: 0 8px 8px 0;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                    <script>
                        document.getElementById('productSearchInput').addEventListener('keyup', function() {
                            const value = this.value.toLowerCase();
                            const rows = document.querySelectorAll('#productsTable tbody tr');

                            rows.forEach(row => {
                                const text = row.textContent.toLowerCase();
                                row.style.display = text.includes(value) ? '' : 'none';
                            });
                        });
                    </script>

                    <div class="filter-buttons">
                        <button class="filter-btn active" data-filter="all">
                            <i class="fas fa-layer-group"></i>
                            Tous
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tableau amélioré -->
            <div class="table-container">
                <table class="styled-table" id="productsTable">
                    <thead>
                        <tr>
                            <th class="image-col">
                                <i class="fas fa-image"></i>
                            </th>
                            <th class="ref-col">
                                <i class="fas fa-hashtag"></i> Référence
                            </th>
                            <th>
                                <i class="fas fa-cube"></i> Produit
                            </th>
                            <th>
                                <i class="fas fa-tag"></i> Catégorie
                            </th>
                            <th>
                                <i class="fas fa-box"></i> Stock
                            </th>
                            <th>
                                <i class="fas fa-money-bill-wave"></i> Prix
                            </th>
                            <th class="actions-col">
                                <i class="fas fa-sliders-h"></i> Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">
                        @forelse($produits as $index => $produit)
                            @php
                                $marge = $produit->prix_vente - $produit->prix_achat;
                                $stockPercentage = ($produit->stock_actuel / $produit->seuil_alerte) * 100;
                                $stockClass = 'stock-ok';
                                if ($produit->stock_status == 'faible') {
                                    $stockClass = 'stock-low';
                                }
                                if ($produit->stock_status == 'rupture') {
                                    $stockClass = 'stock-rupture';
                                }
                            @endphp
                            <tr class="table-row produit-row" data-stock-status="{{ $produit->stock_status }}"
                                data-index="{{ $index }}">
                                <!-- Image -->
                                <td class="image-cell">
                                    @if ($produit->image && Storage::exists('public/produits/' . $produit->image))
                                        <div class="image-preview">
                                            <img src="{{ asset('storage/produits/' . $produit->image) }}"
                                                alt="{{ $produit->nom }}" class="product-image"
                                                onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHJ4PSI4IiBmaWxsPSIjRjBGMEYxIi8+PHBhdGggZD0iTTMwIDI1TDM1IDM1TDI1IDM1TDMwIDI1WiIgZmlsbD0iIzYxNjE2QiIvPjxwYXRoIGQ9Ik0zMCAzNUMzMi43NjE4IDM1IDM1IDMyLjc2MTggMzUgMzBDMzUgMjcuMjM4MiAzMi43NjE4IDI1IDMwIDI1QzI3LjIzODIgMjUgMjUgMjcuMjM4MiAyNSAzMEMyNSAzMi43NjE4IDI3LjIzODIgMzUgMzAgMzVaIiBmaWxsPSIjNjE2MTZCIi8+PC9zdmc+';">
                                            <div class="image-hover">
                                                <i class="fas fa-expand"></i>
                                            </div>
                                        </div>
                                    @else
                                        <div class="no-image">
                                            <i class="fas fa-cube"></i>
                                        </div>
                                    @endif
                                </td>

                                <!-- Référence -->
                                <td class="ref-cell">
                                    <span class="badge-ref">
                                        #{{ $produit->reference }}
                                    </span>
                                </td>

                                <!-- Nom et informations -->
                                <td>
                                    <div class="name-content">
                                        <h3 class="product-name">{{ $produit->nom }}</h3>

                                        <div class="product-meta" style="display: flex; gap: 8px; margin-top: 4px;">

                                            @if ($produit->marque)
                                                <span
                                                    style="
                    background-color: #0d6efd;
                    color: white;
                    padding: 4px 8px;
                    border-radius: 6px;
                    font-size: 13px;
                    display: inline-flex;
                    align-items: center;
                    gap: 4px;
                ">
                                                    <i class="fas fa-industry"></i>
                                                    {{ $produit->marque }}
                                                </span>
                                            @endif

                                            @if ($produit->modele)
                                                <span
                                                    style="
                    background-color: #198754;
                    color: white;
                    padding: 4px 8px;
                    border-radius: 6px;
                    font-size: 13px;
                    display: inline-flex;
                    align-items: center;
                    gap: 4px;
                ">
                                                    <i class="fas fa-cogs"></i>
                                                    {{ $produit->modele }}
                                                </span>
                                            @endif

                                        </div>
                                    </div>
                                </td>


                                <!-- Type -->
                                <td>
                                    @if ($produit->typeProduit)
                                        <span class="badge-type" style="--type-color: #4361ee">
                                            <i class="fas fa-tag"></i>
                                            {{ $produit->typeProduit->nom }}
                                        </span>
                                    @else
                                        <span class="badge-type" style="--type-color: #6c757d">
                                            <i class="fas fa-times"></i>
                                            Non catégorisé
                                        </span>
                                    @endif
                                </td>

                                <!-- Stock avec indicateur visuel -->
                                <td>
                                    <div class="stock-widget">
                                        <div class="stock-header">
                                            <span class="stock-label">Stock</span>
                                            <span class="stock-badge {{ $stockClass }}">
                                                {{ $produit->stock_status }}
                                            </span>
                                        </div>
                                        <div class="stock-bar-container">
                                            <div class="stock-bar">
                                                <div class="stock-fill
                                            @if ($produit->stock_status == 'rupture') bg-gradient-danger
                                            @elseif($produit->stock_status == 'faible') bg-gradient-warning
                                            @else bg-gradient-success @endif"
                                                    style="width: {{ min($stockPercentage, 100) }}%">
                                                </div>
                                            </div>
                                            <div class="stock-numbers">
                                                <span class="stock-current">{{ $produit->stock_actuel }}</span>
                                                <span class="stock-seuil">/{{ $produit->seuil_alerte }}
                                                    {{ $produit->unite_mesure ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Prix avec indicateur de marge -->
                                <td>
                                    <div class="price-widget" style="display: flex; flex-direction: column; gap: 6px;">

                                        <div class="price-row"
                                            style="
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
        ">
                                            <span class="price-label" style="font-weight: 600;">Achat</span>
                                            <span class="price-value price-achat" style="margin-left: 10px;">
                                                {{ number_format($produit->prix_achat, 2) }} FCFA
                                            </span>
                                        </div>

                                        <div class="price-row"
                                            style="
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
        ">
                                            <span class="price-label" style="font-weight: 600;">Vente</span>
                                            <span class="price-value price-vente" style="margin-left: 10px;">
                                                {{ number_format($produit->prix_vente, 2) }} FCFA
                                            </span>
                                        </div>

                                    </div>
                                </td>


                                <!-- Actions améliorées -->
                                <td class="actions-cell">
                                    <div class="actions-buttons">
                                        <a href="{{ route('produits.edit', $produit) }}" class="btn-action btn-edit"
                                            title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="button" class="btn-action btn-delete delete-btn" title="Supprimer"
                                            data-id="{{ $produit->id }}" data-name="{{ $produit->nom }}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <a href="{{ route('produits.show', $produit) }}" class="btn-action btn-view"
                                            title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="7">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-box-open"></i>
                                        </div>
                                        <h3>Aucun produit trouvé</h3>
                                        <p>Commencez par enrichir votre catalogue</p>
                                        <a href="{{ route('produits.create') }}" class="btn-create-first">
                                            <i class="fas fa-plus"></i> Ajouter le premier produit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination améliorée -->
            @if ($produits->hasPages())
                <div class="pagination-container">
                    <div class="pagination-info">
                        Affichage de {{ $produits->firstItem() }} à {{ $produits->lastItem() }} sur
                        {{ $produits->total() }} produits
                    </div>
                    <div class="pagination">
                        {{ $produits->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal pour afficher les détails -->
    <div id="detailModal" class="modal">
        <div class="modal-container">
            <div class="modal-header"
                style="background: var(--gradient-1); color: white; padding: 25px 30px; border-radius: var(--radius-lg) var(--radius-lg) 0 0;">
                <h3 class="modal-title">
                    <i class="fas fa-info-circle"></i>
                    Détails du Produit
                </h3>
                <button class="btn-action" onclick="closeModal()"
                    style="background: rgba(255, 255, 255, 0.2); border: none; color: white;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Contenu chargé dynamiquement -->
            </div>
            <div class="modal-footer"
                style="padding: 25px 30px; border-top: 1px solid var(--glass-border); display: flex; justify-content: flex-end; gap: 15px;">
                <button class="btn-action btn-edit" onclick="editItem()">
                    <i class="fas fa-edit"></i> Modifier
                </button>
                <button class="btn-action" onclick="closeModal()" style="background: var(--gray); color: white;">
                    <i class="fas fa-times"></i> Fermer
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM chargé, Chart.js disponible:', typeof Chart !== 'undefined');

            // 1. Graphique circulaire des statuts
            const statusCtx = document.getElementById('statusChart');
            if (statusCtx) {
                const statusChart = new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Stock Normal', 'Stock Faible', 'En Rupture'],
                        datasets: [{
                            data: [
                                {{ $statusChartData['normal'] ?? 0 }},
                                {{ $statusChartData['faible'] ?? 0 }},
                                {{ $statusChartData['rupture'] ?? 0 }}
                            ],
                            backgroundColor: [
                                'rgba(6, 214, 160, 0.8)',
                                'rgba(255, 209, 102, 0.8)',
                                'rgba(239, 71, 111, 0.8)'
                            ],
                            borderColor: [
                                'rgb(6, 214, 160)',
                                'rgb(255, 209, 102)',
                                'rgb(239, 71, 111)'
                            ],
                            borderWidth: 2
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
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = total > 0 ? Math.round((value / total) *
                                            100) : 0;
                                        return `${label}: ${value} produits (${percentage}%)`;
                                    }
                                }
                            }
                        },
                        cutout: '60%'
                    }
                });
                console.log('Graphique Statut créé');
            }

            // 2. Graphique des catégories (Polar Area)
            const categoriesCtx = document.getElementById('categoriesChart');
            if (categoriesCtx && @json($categoriesData ?? []).length > 0) {
                const categoriesData = @json($categoriesData ?? []);
                const categoriesChart = new Chart(categoriesCtx, {
                    type: 'polarArea',
                    data: {
                        labels: categoriesData.map(c => c.nom.substring(0, 12) + (c.nom.length > 12 ?
                            '...' : '')),
                        datasets: [{
                            data: categoriesData.map(c => c.count),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 159, 64, 0.7)',
                                'rgba(199, 199, 199, 0.7)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(199, 199, 199, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const categorie = categoriesData[context.dataIndex];
                                        return [
                                            `${context.label}: ${context.raw} produits`,
                                            `Valeur: ${formatCurrency(categorie.valeur)}`
                                        ];
                                    }
                                }
                            }
                        }
                    }
                });
                console.log('Graphique Catégories créé');
            }

            // 3. Graphique des marges (Line Chart)
            const margesCtx = document.getElementById('margesChart');
            if (margesCtx && @json($produitsAvecMarge ?? []).length > 0) {
                const margesData = @json($produitsAvecMarge ?? []);
                const margesChart = new Chart(margesCtx, {
                    type: 'line',
                    data: {
                        labels: margesData.map(p => p.nom.substring(0, 12) + (p.nom.length > 12 ? '...' :
                            '')),
                        datasets: [{
                            label: 'Marge Unitaire (FCFA)',
                            data: margesData.map(p => p.marge_unitaire),
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 3,
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 6,
                            pointHoverRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `Marge: ${formatCurrency(context.raw)}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return formatCurrency(value);
                                    }
                                }
                            }
                        }
                    }
                });
                console.log('Graphique Marges créé');
            }

            // 4. Graphique des top produits par valeur stock (GRAND)
            const topProductsCtx = document.getElementById('topProductsChart');
            if (topProductsCtx && @json($topProductsData ?? []).length > 0) {
                const topProductsData = @json($topProductsData ?? []);
                const topProductsChart = new Chart(topProductsCtx, {
                    type: 'bar',
                    data: {
                        labels: topProductsData.map(p => p.nom.substring(0, 20) + (p.nom.length > 20 ?
                            '...' : '')),
                        datasets: [{
                            label: 'Valeur Stock (FCFA)',
                            data: topProductsData.map(p => p.valeur),
                            backgroundColor: topProductsData.map(p => {
                                switch (p.status) {
                                    case 'normal':
                                        return 'rgba(6, 214, 160, 0.8)';
                                    case 'faible':
                                        return 'rgba(255, 209, 102, 0.8)';
                                    case 'rupture':
                                        return 'rgba(239, 71, 111, 0.8)';
                                    default:
                                        return 'rgba(108, 117, 125, 0.8)';
                                }
                            }),
                            borderColor: topProductsData.map(p => {
                                switch (p.status) {
                                    case 'normal':
                                        return 'rgb(6, 214, 160)';
                                    case 'faible':
                                        return 'rgb(255, 209, 102)';
                                    case 'rupture':
                                        return 'rgb(239, 71, 111)';
                                    default:
                                        return 'rgb(108, 117, 125)';
                                }
                            }),
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
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const product = topProductsData[context.dataIndex];
                                        return [
                                            `Produit: ${product.nom}`,
                                            `Valeur: ${formatCurrency(context.raw)}`,
                                            `Stock: ${product.stock} unités`,
                                            `Statut: ${product.status}`,
                                            `Marge totale: ${formatCurrency(product.marge || 0)}`
                                        ];
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return formatCurrency(value);
                                    }
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                ticks: {
                                    maxRotation: 45,
                                    minRotation: 45
                                },
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
                console.log('Graphique Top Produits créé');
            }

            // Fonction pour formater la monnaie
            function formatCurrency(value) {
                if (isNaN(value)) return '0 FCFA';
                return new Intl.NumberFormat('fr-FR', {
                    style: 'currency',
                    currency: 'XOF',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(value).replace('XOF', 'FCFA');
            }

            // Filtrage des produits
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const filter = this.dataset.filter;

                    // Mettre à jour l'état actif
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove(
                        'active'));
                    this.classList.add('active');

                    // Filtrer les lignes
                    document.querySelectorAll('.produit-row').forEach(row => {
                        const status = row.dataset.stockStatus;
                        const shouldShow =
                            filter === 'all' ||
                            (filter === 'stock_faible' && status === 'faible') ||
                            (filter === 'rupture' && status === 'rupture');

                        if (shouldShow) {
                            row.style.display = '';
                            row.style.animation = 'slideUp 0.3s ease-out';
                        } else {
                            row.style.animation = 'fadeOut 0.3s ease-out';
                            setTimeout(() => row.style.display = 'none', 300);
                        }
                    });
                });
            });

            // Gestion des boutons de suppression
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.dataset.id;
                    const productName = this.dataset.name;

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Confirmer la suppression',
                            html: `<div style="text-align: center;">
                            <div style="font-size: 4rem; color: #ef476f; margin-bottom: 20px;">
                                <i class="fas fa-trash-alt"></i>
                            </div>
                            <h3 style="margin-bottom: 15px;">Supprimer "${productName}" ?</h3>
                            <p style="color: #6c757d; margin-bottom: 20px;">
                                Cette action est irréversible. Êtes-vous sûr de vouloir supprimer ce produit ?
                            </p>
                            <div style="background: rgba(239, 71, 111, 0.1); padding: 12px; border-radius: 8px; color: #ef476f; margin-top: 20px;">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Toutes les données associées seront perdues</span>
                            </div>
                        </div>`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Supprimer',
                            cancelButtonText: 'Annuler',
                            confirmButtonColor: '#ef476f',
                            cancelButtonColor: '#6c757d',
                            backdrop: 'rgba(0,0,0,0.8)'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Créer un formulaire de suppression
                                const form = document.createElement('form');
                                form.method = 'POST';
                                form.action = `/produits/${productId}`;
                                form.style.display = 'none';

                                const csrf = document.createElement('input');
                                csrf.type = 'hidden';
                                csrf.name = '_token';
                                csrf.value = '{{ csrf_token() }}';

                                const method = document.createElement('input');
                                method.type = 'hidden';
                                method.name = '_method';
                                method.value = 'DELETE';

                                form.appendChild(csrf);
                                form.appendChild(method);
                                document.body.appendChild(form);
                                form.submit();
                            }
                        });
                    } else {
                        if (confirm(`Supprimer "${productName}" ?`)) {
                            // Créer un formulaire de suppression
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/produits/${productId}`;
                            form.style.display = 'none';

                            const csrf = document.createElement('input');
                            csrf.type = 'hidden';
                            csrf.name = '_token';
                            csrf.value = '{{ csrf_token() }}';

                            const method = document.createElement('input');
                            method.type = 'hidden';
                            method.name = '_method';
                            method.value = 'DELETE';

                            form.appendChild(csrf);
                            form.appendChild(method);
                            document.body.appendChild(form);
                            form.submit();
                        }
                    }
                });
            });

            // Animation des cartes statistiques
            document.querySelectorAll('.stat-card').forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.style.animation = 'slideUp 0.5s ease-out forwards';
            });

            // Animation des lignes du tableau
            document.querySelectorAll('.produit-row').forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.style.animation = 'slideUp 0.3s ease-out forwards';
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 50);
            });

            // Auto-hide des messages flash
            setTimeout(() => {
                document.querySelectorAll('.success-message, .error-message').forEach(msg => {
                    msg.style.transition = 'all 0.3s ease-out';
                    msg.style.opacity = '0';
                    msg.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        if (msg.parentNode) msg.remove();
                    }, 300);
                });
            }, 5000);
        });

        // Fonctions pour la modal
        function openModal(content) {
            document.getElementById('modalBody').innerHTML = content;
            document.getElementById('detailModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('detailModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function editItem() {
            const editUrl = document.querySelector('.btn-action[href*="edit"]')?.href;
            if (editUrl) {
                window.location.href = editUrl;
            }
        }

        // Ajouter les animations CSS manquantes
        const style = document.createElement('style');
        style.textContent = `
        @keyframes fadeOut {
            from { opacity: 1; transform: scale(1); }
            to { opacity: 0; transform: scale(0.95); }
        }
    `;
        document.head.appendChild(style);
    </script>
@endsection
