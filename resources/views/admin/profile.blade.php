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

        /* Container */

        .profile-container {

            padding: 30px;

            max-width: 1400px;

            margin: 0 auto;

            min-height: 100vh;

            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);

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

            transition: all 0.3s ease;

        }

        .close-alert:hover {

            background: rgba(255, 255, 255, 0.3);

            transform: rotate(90deg);

        }

        /* Header */

        .profile-header {

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

        .profile-header::before {

            content: '';

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 4px;

            background: linear-gradient(90deg, var(--primary), var(--secondary));

        }

        .profile-title {

            font-size: 2.5rem;

            font-weight: 800;

            color: var(--dark);

            margin: 0;

            background: linear-gradient(135deg, var(--primary), var(--secondary));

            -webkit-background-clip: text;

            -webkit-text-fill-color: transparent;

            background-clip: text;

        }

        .profile-subtitle {

            color: var(--gray);

            font-size: 1.1rem;

            margin-top: 10px;

        }

        /* Carte principale */

        .main-card {

            background: white;

            border-radius: var(--radius);

            box-shadow: var(--shadow);

            margin-bottom: 30px;

            overflow: hidden;

            transition: var(--transition);

        }

        .main-card:hover {

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

        /* Formulaires */

        .form-section {

            padding: 30px;

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 40px;

        }

        @media (max-width: 1024px) {

            .form-section {

                grid-template-columns: 1fr;

                gap: 30px;

            }

        }

        .form-column {

            display: flex;

            flex-direction: column;

            gap: 25px;

        }

        .form-group {

            position: relative;

        }

        .form-label {

            font-size: 0.95rem;

            font-weight: 600;

            color: var(--dark);

            margin-bottom: 8px;

            display: block;

        }

        .form-label i {

            margin-right: 8px;

            color: var(--primary);

        }

        .input-group {

            position: relative;

            display: flex;

            align-items: center;

        }

        .form-control {

            width: 100%;

            padding: 14px 16px 14px 45px;

            border: 2px solid var(--border);

            border-radius: 10px;

            font-size: 0.95rem;

            transition: var(--transition);

            background: #f8f9fa;

            color: var(--dark);

        }

        .form-control:focus {

            outline: none;

            border-color: var(--primary);

            background: white;

            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);

        }

        .input-icon {

            position: absolute;

            left: 15px;

            color: var(--gray);

            font-size: 1rem;

        }

        .toggle-password {

            position: absolute;

            right: 15px;

            background: none;

            border: none;

            color: var(--gray);

            cursor: pointer;

            transition: var(--transition);

            padding: 5px;

        }

        .toggle-password:hover {

            color: var(--primary);

        }

        /* Boutons */

        .btn-submit {

            display: inline-flex;

            align-items: center;

            gap: 10px;

            padding: 16px 32px;

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

        }

        .btn-submit:hover {

            transform: translateY(-3px);

            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);

        }

        /* Informations du compte */

        .info-grid {

            display: grid;

            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));

            gap: 20px;

            margin-top: 20px;

        }

        .info-card {

            background: linear-gradient(135deg, #f8f9fa, white);

            border-radius: 12px;

            padding: 20px;

            border: 1px solid var(--border);

            transition: var(--transition);

        }

        .info-card:hover {

            transform: translateY(-3px);

            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);

        }

        .info-header {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 15px;

        }

        .info-icon {

            width: 40px;

            height: 40px;

            border-radius: 10px;

            background: linear-gradient(135deg, var(--primary), var(--secondary));

            color: white;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 1.2rem;

        }

        .info-title {

            font-size: 1.1rem;

            font-weight: 600;

            color: var(--dark);

            margin: 0;

        }

        .info-content {

            display: flex;

            flex-direction: column;

            gap: 8px;

        }

        .info-item {

            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 8px 0;

            border-bottom: 1px dashed var(--border);

        }

        .info-item:last-child {

            border-bottom: none;

        }

        .info-label {

            font-size: 0.85rem;

            color: var(--gray);

        }

        .info-value {

            font-size: 0.95rem;

            font-weight: 600;

            color: var(--dark);

        }

        .badge-status {

            display: inline-block;

            padding: 6px 12px;

            border-radius: 20px;

            font-size: 0.85rem;

            font-weight: 600;

        }

        .badge-success {

            background: linear-gradient(135deg, #06d6a0, #00b894);

            color: white;

        }

        .badge-warning {

            background: linear-gradient(135deg, #ffd166, #ff9e00);

            color: var(--dark);

        }

        /* Section avatar */

        .avatar-section {

            display: flex;

            flex-direction: column;

            align-items: center;

            gap: 20px;

            padding: 30px;

            background: linear-gradient(135deg, #f8f9fa, white);

            border-radius: var(--radius);

            border: 1px solid var(--border);

        }

        .avatar-wrapper {

            position: relative;

            width: 150px;

            height: 150px;

            border-radius: 50%;

            overflow: hidden;

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);

            background: linear-gradient(135deg, var(--primary), var(--secondary));

            display: flex;

            align-items: center;

            justify-content: center;

        }

        .avatar-initials {

            font-size: 3.5rem;

            font-weight: 700;

            color: white;

            text-transform: uppercase;

        }

        .avatar-change {

            position: absolute;

            bottom: 0;

            width: 100%;

            background: rgba(0, 0, 0, 0.7);

            color: white;

            text-align: center;

            padding: 8px;

            font-size: 0.85rem;

            cursor: pointer;

            transition: var(--transition);

            opacity: 0;

        }

        .avatar-wrapper:hover .avatar-change {

            opacity: 1;

        }

        .avatar-info {

            text-align: center;

        }

        .avatar-name {

            font-size: 1.5rem;

            font-weight: 700;

            color: var(--dark);

            margin: 10px 0 5px 0;

        }

        .avatar-email {

            font-size: 0.95rem;

            color: var(--gray);

            margin: 0;

        }

        /* Section de sécurité */

        .security-section {

            background: linear-gradient(135deg, #fff5f5, #fff);

            border-radius: var(--radius);

            padding: 25px;

            border: 1px solid var(--border);

            margin-top: 20px;

        }

        .security-header {

            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 20px;

        }

        .security-icon {

            font-size: 1.5rem;

            color: var(--primary);

        }

        /* Responsive */

        @media (max-width: 768px) {

            .profile-container {

                padding: 15px;

            }



            .profile-header {

                flex-direction: column;

                gap: 20px;

                text-align: center;

                padding: 20px;

            }



            .profile-title {

                font-size: 2rem;

            }



            .card-header {

                flex-direction: column;

                gap: 15px;

                text-align: center;

                padding: 20px;

            }



            .form-section {

                padding: 20px;

            }



            .btn-submit {

                width: 100%;

                justify-content: center;

            }

        }

        @media (max-width: 480px) {

            .info-grid {

                grid-template-columns: 1fr;

            }



            .avatar-wrapper {

                width: 120px;

                height: 120px;

            }



            .avatar-initials {

                font-size: 2.5rem;

            }

        }

        /* Messages d'erreur */

        .invalid-feedback {

            display: block;

            margin-top: 5px;

            font-size: 0.85rem;

            color: var(--danger);

        }

        .is-invalid {

            border-color: var(--danger) !important;

        }

        .is-invalid:focus {

            box-shadow: 0 0 0 3px rgba(239, 71, 111, 0.1) !important;

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
                <h6 class="mb-0 font-bold capitalize">Mon compte</h6>
            </nav>

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
    </nav>


    <div class="profile-container">

        <!-- Header -->

        <div class="profile-header animate-slide-down">

            <div class="header-content">

                <h1 class="profile-title">👤 Mon Profil</h1>

                <p class="profile-subtitle">Gérez vos informations personnelles et votre sécurité</p>

            </div>

        </div>

        <!-- Messages de succès/erreur -->

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

        <!-- Carte principale -->

        <div class="main-card animate-fade-in">

            <!-- En-tête de la carte -->

            <div class="card-header">

                <h2 class="card-title">

                    <i class="fas fa-user-edit"></i> Informations personnelles

                </h2>

            </div>

            <!-- Contenu -->

            <div class="form-section">

                <!-- Colonne gauche : Avatar et informations -->

                <div class="form-column">

                    <!-- Avatar -->

                    <div class="avatar-section animate-slide-up" style="animation-delay: 0.1s">

                        <div class="avatar-wrapper">

                            @php

                                $initiales = collect(explode(' ', $user->name))
                                    ->map(fn($part) => strtoupper(substr($part, 0, 1)))

                                    ->join('');

                            @endphp

                            <div class="avatar-initials">{{ $initiales }}</div>

                            <div class="avatar-change">

                                <i class="fas fa-camera me-1"></i> Changer

                            </div>

                        </div>

                        <div class="avatar-info">

                            <h3 class="avatar-name">{{ $user->name }}</h3>

                            <p class="avatar-email">{{ $user->email }}</p>

                            <small class="text-muted">Membre depuis {{ $user->created_at->format('d/m/Y') }}</small>

                        </div>

                    </div>

                    <!-- Informations du compte -->

                    <div class="info-grid">

                        <div class="info-card animate-slide-up" style="animation-delay: 0.2s">

                            <div class="info-header">

                                <div class="info-icon">

                                    <i class="fas fa-id-card"></i>

                                </div>

                                <h3 class="info-title">Identité</h3>

                            </div>

                            <div class="info-content">

                                <div class="info-item">

                                    <span class="info-label">ID Utilisateur</span>

                                    <span class="info-value">#{{ $user->id }}</span>

                                </div>

                                <div class="info-item">

                                    <span class="info-label">Nom complet</span>

                                    <span class="info-value">{{ $user->name }}</span>

                                </div>

                            </div>

                        </div>

                        <div class="info-card animate-slide-up" style="animation-delay: 0.3s">

                            <div class="info-header">

                                <div class="info-icon">

                                    <i class="fas fa-shield-alt"></i>

                                </div>

                                <h3 class="info-title">Sécurité</h3>

                            </div>

                            <div class="info-content">

                                <div class="info-item">

                                    <span class="info-label">Statut email</span>

                                    <span class="info-value">

                                        @if ($user->email_verified_at)
                                            <span class="badge-status badge-success">

                                                <i class="fas fa-check-circle me-1"></i> Vérifié

                                            </span>
                                        @else
                                            <span class="badge-status badge-warning">

                                                <i class="fas fa-clock me-1"></i> Non vérifié

                                            </span>
                                        @endif

                                    </span>

                                </div>

                                <div class="info-item">

                                    <span class="info-label">Dernière connexion</span>

                                    <span class="info-value">Aujourd'hui</span>

                                </div>

                            </div>

                        </div>

                        <div class="info-card animate-slide-up" style="animation-delay: 0.4s">

                            <div class="info-header">

                                <div class="info-icon">

                                    <i class="fas fa-history"></i>

                                </div>

                                <h3 class="info-title">Historique</h3>

                            </div>

                            <div class="info-content">

                                <div class="info-item">

                                    <span class="info-label">Compte créé</span>

                                    <span class="info-value">{{ $user->created_at->format('d/m/Y H:i') }}</span>

                                </div>

                                <div class="info-item">

                                    <span class="info-label">Dernière mise à jour</span>

                                    <span class="info-value">{{ $user->updated_at->format('d/m/Y H:i') }}</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Colonne droite : Formulaires -->

                <div class="form-column">

                    <!-- Formulaire d'informations -->

                    <form method="POST" action="{{ route('admin.profile.update') }}" class="animate-slide-up"
                        style="animation-delay: 0.1s">

                        @csrf

                        @method('PUT')



                        <h3 class="form-title" style="color: var(--dark); margin-bottom: 20px;">

                            <i class="fas fa-user-cog me-2"></i>Modifier mes informations

                        </h3>

                        <!-- Nom -->

                        <div class="form-group">

                            <label class="form-label">

                                <i class="fas fa-user"></i> Nom complet

                            </label>

                            <div class="input-group">

                                <i class="fas fa-user input-icon"></i>

                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $user->name) }}"
                                    placeholder="Votre nom complet" required>

                            </div>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <!-- Email -->

                        <div class="form-group">

                            <label class="form-label">

                                <i class="fas fa-envelope"></i> Adresse email

                            </label>

                            <div class="input-group">

                                <i class="fas fa-envelope input-icon"></i>

                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $user->email) }}"
                                    placeholder="Votre adresse email" required>

                            </div>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <!-- Bouton d'enregistrement -->

                        <div class="form-group" style="margin-top: 20px;">

                            <button type="submit" class="btn-submit">

                                <i class="fas fa-save me-2"></i> Enregistrer les modifications

                            </button>

                        </div>

                    </form>

                    <!-- Formulaire de changement de mot de passe -->

                    <div class="security-section animate-slide-up" style="animation-delay: 0.2s">

                        <div class="security-header">

                            <i class="fas fa-key security-icon"></i>

                            <h3 style="margin: 0; color: var(--dark);">Changer le mot de passe</h3>

                        </div>

                        <form method="POST" action="{{ route('admin.profile.update') }}">

                            @csrf

                            @method('PUT')



                            <!-- Mot de passe actuel -->

                            <div class="form-group">

                                <label class="form-label">

                                    <i class="fas fa-lock"></i> Mot de passe actuel

                                </label>

                                <div class="input-group">

                                    <i class="fas fa-lock input-icon"></i>

                                    <input type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        id="currentPassword" name="current_password" placeholder="••••••••">

                                    <button type="button" class="toggle-password"
                                        onclick="togglePassword('currentPassword')">

                                        <i class="fas fa-eye"></i>

                                    </button>

                                </div>

                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>

                            <!-- Nouveau mot de passe -->

                            <div class="form-group">

                                <label class="form-label">

                                    <i class="fas fa-key"></i> Nouveau mot de passe

                                </label>

                                <div class="input-group">

                                    <i class="fas fa-key input-icon"></i>

                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="newPassword" name="password" placeholder="••••••••">

                                    <button type="button" class="toggle-password"
                                        onclick="togglePassword('newPassword')">

                                        <i class="fas fa-eye"></i>

                                    </button>

                                </div>

                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>

                            <!-- Confirmation du mot de passe -->

                            <div class="form-group">

                                <label class="form-label">

                                    <i class="fas fa-lock"></i> Confirmer le mot de passe

                                </label>

                                <div class="input-group">

                                    <i class="fas fa-lock input-icon"></i>

                                    <input type="password" class="form-control" id="confirmPassword"
                                        name="password_confirmation" placeholder="••••••••">

                                    <button type="button" class="toggle-password"
                                        onclick="togglePassword('confirmPassword')">

                                        <i class="fas fa-eye"></i>

                                    </button>

                                </div>

                            </div>

                            <!-- Bouton -->

                            <div class="form-group" style="margin-top: 20px;">

                                <button type="submit" class="btn-submit"
                                    style="background: linear-gradient(135deg, var(--success), #00b894);">

                                    <i class="fas fa-key me-2"></i> Mettre à jour le mot de passe

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        function togglePassword(inputId) {

            const input = document.getElementById(inputId);

            const icon = input.parentElement.querySelector('.toggle-password i');



            if (input.type === 'password') {

                input.type = 'text';

                icon.classList.remove('fa-eye');

                icon.classList.add('fa-eye-slash');

            } else {

                input.type = 'password';

                icon.classList.remove('fa-eye-slash');

                icon.classList.add('fa-eye');

            }

        }

        // Animation pour les cartes

        document.addEventListener('DOMContentLoaded', function() {

            const cards = document.querySelectorAll('.animate-slide-up');

            cards.forEach((card, index) => {

                card.style.animationDelay = `${0.1 + (index * 0.1)}s`;

            });

            // Auto-remove success/error messages after 5 seconds

            setTimeout(() => {

                document.querySelectorAll('.success-message, .error-message').forEach(alert => {

                    if (alert) {

                        alert.style.transition = 'all 0.5s ease';

                        alert.style.opacity = '0';

                        setTimeout(() => alert.remove(), 500);

                    }

                });

            }, 5000);

        });
    </script>
@endsection
