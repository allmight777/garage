@extends('layouts.admin')

@section('content')

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
                <h6 class="mb-0 font-bold capitalize">Créer Produit</h6>
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
    <div class="admin-header animate-slide-down">
        <div class="header-content">
            <h1 class="admin-title">
                <i class="fas fa-plus-circle"></i> Nouveau Type de Produit
            </h1>
            <p class="admin-subtitle">Ajoutez une nouvelle catégorie à votre catalogue</p>
        </div>

        <a href="{{ route('type_produits.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Retour à la liste
        </a>
    </div>

    <!-- Carte formulaire -->
    <div class="form-card animate-fade-in">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fas fa-edit"></i> Informations du type
            </h2>
            <div class="form-steps">
                <div class="step active">
                    <span class="step-number">1</span>
                    <span class="step-text">Informations</span>
                </div>
                <div class="step">
                    <span class="step-number">2</span>
                    <span class="step-text">Validation</span>
                </div>
            </div>
        </div>

        <form action="{{ route('type_produits.store') }}" method="POST" enctype="multipart/form-data" id="typeForm" class="form-content">
            @csrf

            <!-- Section Informations -->
            <div class="form-section active">
                <div class="form-grid">
                    <!-- Référence -->
                    <div class="form-group">
                        <label for="reference" class="form-label">
                            <i class="fas fa-hashtag"></i> Référence
                            <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-icon">
                                <i class="fas fa-barcode"></i>
                            </div>
                            <input type="text"
                                   id="reference"
                                   name="reference"
                                   class="form-input"
                                   placeholder="Ex: TYPE-001"
                                   required
                                   maxlength="50">
                        </div>
                        <div class="form-hint">Identifiant unique du type</div>
                        @error('reference')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Nom -->
                    <div class="form-group">
                        <label for="nom" class="form-label">
                            <i class="fas fa-tag"></i> Nom
                            <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-icon">
                                <i class="fas fa-heading"></i>
                            </div>
                            <input type="text"
                                   id="nom"
                                   name="nom"
                                   class="form-input"
                                   placeholder="Ex: Pneus Sport"
                                   required
                                   maxlength="100">
                        </div>
                        <div class="form-hint">Nom affiché dans le catalogue</div>
                        @error('nom')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group full-width">
                    <label for="description" class="form-label">
                        <i class="fas fa-align-left"></i> Description
                    </label>
                    <div class="input-group">
                        <div class="input-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <textarea id="description"
                                  name="description"
                                  class="form-textarea"
                                  placeholder="Décrivez ce type de produit..."
                                  rows="4"
                                  maxlength="500"></textarea>
                    </div>
                    <div class="form-hint">
                        <span id="charCount">0</span>/500 caractères
                    </div>
                    @error('description')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <i class="fas fa-image"></i> Image
                    </label>

                    <div class="upload-container">
                        <!-- Zone de dépôt -->
                        <div class="upload-dropzone" id="dropzone">
                            <div class="dropzone-content">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <h3>Glissez-déposez votre image ici</h3>
                                <p>Ou cliquez pour parcourir</p>
                                <p class="upload-info">PNG, JPG, JPEG (max. 2MB)</p>
                            </div>
                            <input type="file"
                                   id="image"
                                   name="image"
                                   class="file-input"
                                   accept="image/png, image/jpeg, image/jpg">
                        </div>

                        <!-- Prévisualisation -->
                        <div class="upload-preview" id="previewContainer">
                            <div class="preview-placeholder">
                                <i class="fas fa-image"></i>
                                <p>Aucune image sélectionnée</p>
                            </div>
                            <div class="preview-image" id="previewImage"></div>
                        </div>

                        <!-- Contrôles -->
                        <div class="upload-controls">
                            <button type="button" class="btn-upload" id="uploadBtn">
                                <i class="fas fa-folder-open"></i> Choisir une image
                            </button>
                            <button type="button" class="btn-remove" id="removeBtn">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </div>
                    </div>

                    @error('image')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Section Validation (cachée) -->
            <div class="form-section">
                <div class="summary-card">
                    <h3 class="summary-title">
                        <i class="fas fa-check-circle"></i> Récapitulatif
                    </h3>

                    <div class="summary-content">
                        <div class="summary-item">
                            <span class="summary-label">Référence :</span>
                            <span class="summary-value" id="summaryReference"></span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Nom :</span>
                            <span class="summary-value" id="summaryNom"></span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Description :</span>
                            <span class="summary-value" id="summaryDescription"></span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Image :</span>
                            <span class="summary-value" id="summaryImage"></span>
                        </div>
                    </div>

                    <div class="summary-note">
                        <i class="fas fa-info-circle"></i>
                        Vérifiez les informations avant de soumettre le formulaire
                    </div>
                </div>
            </div>

            <!-- Actions du formulaire -->
            <div class="form-actions">
                <button type="button" class="btn-prev" id="prevBtn">
                    <i class="fas fa-arrow-left"></i> Précédent
                </button>

                <button type="button" class="btn-next" id="nextBtn">
                    Suivant <i class="fas fa-arrow-right"></i>
                </button>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="fas fa-save"></i> Enregistrer le type
                </button>
            </div>
        </form>
    </div>

</div>

<!-- Styles -->
<style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3a56d4;
        --secondary: #7209b7;
        --success: #06d6a0;
        --warning: #ffd166;
        --danger: #ef476f;
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
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    .animate-slide-down {
        animation: slideDown 0.6s ease-out;
    }

    .animate-fade-in {
        animation: fadeIn 0.8s ease-out;
    }

    /* Container principal */
    .admin-container {
        padding: 30px;
        max-width: 1200px;
        margin: 0 auto;
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
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
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .admin-title i {
        color: var(--primary);
        font-size: 2.5rem;
    }

    .admin-subtitle {
        color: var(--gray);
        font-size: 1.1rem;
        margin-top: 10px;
    }

    /* Bouton retour */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        transition: var(--transition);
    }

    .btn-back:hover {
        transform: translateX(-5px);
        box-shadow: 0 5px 20px rgba(108, 117, 125, 0.3);
    }

    /* Carte formulaire */
    .form-card {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: var(--transition);
    }

    .form-card:hover {
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

    /* Étapes */
    .form-steps {
        display: flex;
        gap: 20px;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 10px;
        opacity: 0.5;
        transition: var(--transition);
    }

    .step.active {
        opacity: 1;
    }

    .step-number {
        width: 30px;
        height: 30px;
        background: var(--border);
        color: var(--gray);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .step.active .step-number {
        background: var(--primary);
        color: white;
        box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
    }

    .step-text {
        font-weight: 600;
        color: var(--gray);
        font-size: 0.9rem;
    }

    .step.active .step-text {
        color: var(--dark);
    }

    /* Contenu du formulaire */
    .form-content {
        padding: 30px;
    }

    .form-section {
        display: none;
    }

    .form-section.active {
        display: block;
        animation: fadeIn 0.5s ease-out;
    }

    /* Grille formulaire */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    /* Labels */
    .form-label {
        display: block;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 10px;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label i {
        color: var(--primary);
        font-size: 1.1rem;
    }

    .required {
        color: var(--danger);
        margin-left: 4px;
    }

    /* Input groups */
    .input-group {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
        z-index: 1;
    }

    .form-input, .form-textarea {
        width: 100%;
        padding: 15px 15px 15px 50px;
        border: 2px solid var(--border);
        border-radius: 12px;
        font-size: 1rem;
        color: var(--dark);
        background: #f8f9fa;
        transition: var(--transition);
    }

    .form-textarea {
        padding-left: 50px;
        resize: vertical;
        min-height: 120px;
    }

    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .form-input::placeholder, .form-textarea::placeholder {
        color: #adb5bd;
    }

    /* Aide et erreurs */
    .form-hint {
        font-size: 0.85rem;
        color: var(--gray);
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .form-error {
        font-size: 0.85rem;
        color: var(--danger);
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        animation: slideDown 0.3s ease-out;
    }

    /* Upload d'image */
    .upload-container {
        border: 2px dashed var(--border);
        border-radius: var(--radius);
        padding: 30px;
        background: #f8f9fa;
        transition: var(--transition);
    }

    .upload-container:hover {
        border-color: var(--primary);
        background: rgba(67, 97, 238, 0.02);
    }

    .upload-dropzone {
        text-align: center;
        cursor: pointer;
        position: relative;
        padding: 40px;
        border-radius: 12px;
        background: white;
        border: 2px dashed var(--border);
        transition: var(--transition);
    }

    .upload-dropzone:hover {
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .upload-dropzone.dragover {
        border-color: var(--success);
        background: rgba(6, 214, 160, 0.05);
    }

    .dropzone-content i {
        font-size: 3rem;
        color: var(--primary);
        margin-bottom: 15px;
    }

    .dropzone-content h3 {
        color: var(--dark);
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .dropzone-content p {
        color: var(--gray);
        margin-bottom: 5px;
    }

    .upload-info {
        font-size: 0.9rem;
        color: #adb5bd;
    }

    .file-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    /* Prévisualisation */
    .upload-preview {
        margin-top: 25px;
        min-height: 150px;
        border-radius: 12px;
        overflow: hidden;
        background: white;
        border: 2px solid var(--border);
        position: relative;
    }

    .preview-placeholder {
        padding: 40px;
        text-align: center;
        color: var(--gray);
    }

    .preview-placeholder i {
        font-size: 3rem;
        margin-bottom: 15px;
        opacity: 0.5;
    }

    .preview-image {
        display: none;
        padding: 20px;
        text-align: center;
    }

    .preview-image img {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Contrôles upload */
    .upload-controls {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .btn-upload, .btn-remove {
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: none;
    }

    .btn-upload {
        background: var(--primary);
        color: white;
    }

    .btn-upload:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .btn-remove {
        background: var(--danger);
        color: white;
    }

    .btn-remove:hover {
        background: #d00000;
        transform: translateY(-2px);
    }

    /* Récapitulatif */
    .summary-card {
        background: #f8f9fa;
        border-radius: var(--radius);
        padding: 30px;
        border: 2px solid var(--border);
    }

    .summary-title {
        font-size: 1.3rem;
        color: var(--dark);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .summary-title i {
        color: var(--success);
    }

    .summary-content {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .summary-item {
        display: flex;
        padding: 15px;
        background: white;
        border-radius: 8px;
        border-left: 4px solid var(--primary);
    }

    .summary-label {
        font-weight: 600;
        color: var(--dark);
        min-width: 120px;
    }

    .summary-value {
        color: var(--gray);
        flex: 1;
    }

    .summary-note {
        margin-top: 20px;
        padding: 15px;
        background: rgba(6, 214, 160, 0.1);
        border-radius: 8px;
        color: var(--success);
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
    }

    /* Actions du formulaire */
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 30px 0 0;
        border-top: 1px solid var(--border);
        margin-top: 30px;
    }

    .btn-prev, .btn-next, .btn-submit {
        padding: 15px 30px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        min-width: 180px;
    }

    .btn-prev {
        background: #6c757d;
        color: white;
        opacity: 0.7;
        display: none;
    }

    .btn-prev.active {
        opacity: 1;
    }

    .btn-prev:hover {
        background: #5a6268;
        transform: translateX(-3px);
    }

    .btn-next {
        background: var(--primary);
        color: white;
        margin-left: auto;
    }

    .btn-next:hover {
        background: var(--primary-dark);
        transform: translateX(3px);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--success), #00b894);
        color: white;
        display: none;
        animation: pulse 2s infinite;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(6, 214, 160, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .admin-container {
            padding: 15px;
        }

        .admin-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .form-actions {
            flex-direction: column;
            gap: 15px;
        }

        .btn-prev, .btn-next, .btn-submit {
            width: 100%;
        }

        .card-header {
            flex-direction: column;
            gap: 15px;
        }

        .form-steps {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .upload-controls {
            flex-direction: column;
        }

        .btn-upload, .btn-remove {
            width: 100%;
        }

        .admin-title {
            font-size: 1.8rem;
        }
    }
</style>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Éléments du DOM
        const form = document.getElementById('typeForm');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        const formSections = document.querySelectorAll('.form-section');
        const steps = document.querySelectorAll('.step');
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.querySelector('.file-input');
        const uploadBtn = document.getElementById('uploadBtn');
        const removeBtn = document.getElementById('removeBtn');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const charCount = document.getElementById('charCount');
        const descriptionInput = document.getElementById('description');

        let currentStep = 0;

        // Gestionnaire d'étapes
        function showStep(step) {
            // Masquer toutes les sections
            formSections.forEach(section => {
                section.classList.remove('active');
            });

            // Afficher la section active
            formSections[step].classList.add('active');

            // Mettre à jour les étapes visuelles
            steps.forEach((stepEl, index) => {
                stepEl.classList.toggle('active', index <= step);
            });

            // Mettre à jour les boutons
            prevBtn.classList.toggle('active', step > 0);
            prevBtn.style.display = step > 0 ? 'flex' : 'none';
            nextBtn.style.display = step < formSections.length - 1 ? 'flex' : 'none';
            submitBtn.style.display = step === formSections.length - 1 ? 'flex' : 'none';

            // Mettre à jour le récapitulatif si c'est la dernière étape
            if (step === formSections.length - 1) {
                updateSummary();
            }
        }

        // Bouton suivant
        nextBtn.addEventListener('click', function() {
            if (validateCurrentStep()) {
                currentStep++;
                showStep(currentStep);
            }
        });

        // Bouton précédent
        prevBtn.addEventListener('click', function() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });

        // Validation de l'étape
        function validateCurrentStep() {
            const currentSection = formSections[currentStep];
            const requiredInputs = currentSection.querySelectorAll('[required]');
            let isValid = true;

            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    showError(input, 'Ce champ est obligatoire');
                } else {
                    hideError(input);
                }
            });

            return isValid;
        }

        // Gestion des erreurs
        function showError(input, message) {
            let errorDiv = input.parentNode.parentNode.querySelector('.form-error');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'form-error';
                errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                input.parentNode.parentNode.appendChild(errorDiv);
            }

            input.classList.add('error');
            input.focus();
        }

        function hideError(input) {
            const errorDiv = input.parentNode.parentNode.querySelector('.form-error');
            if (errorDiv) {
                errorDiv.remove();
            }
            input.classList.remove('error');
        }

        // Compteur de caractères
        if (descriptionInput && charCount) {
            descriptionInput.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = length;

                if (length > 500) {
                    this.value = this.value.substring(0, 500);
                    charCount.textContent = 500;
                }
            });
        }

        // Upload d'image
        uploadBtn.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                handleFileUpload(file);
            }
        });

        removeBtn.addEventListener('click', function() {
            fileInput.value = '';
            previewImage.style.display = 'none';
            previewImage.innerHTML = '';
            previewContainer.querySelector('.preview-placeholder').style.display = 'block';
        });

        // Drag and drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            dropzone.classList.add('dragover');
        }

        function unhighlight() {
            dropzone.classList.remove('dragover');
        }

        dropzone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                handleFileUpload(files[0]);
            }
        }

        function handleFileUpload(file) {
            // Vérifier la taille (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('L\'image ne doit pas dépasser 2MB');
                return;
            }

            // Vérifier le type
            if (!file.type.match('image.*')) {
                alert('Veuillez sélectionner une image');
                return;
            }

            // Afficher la prévisualisation
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.innerHTML = `<img src="${e.target.result}" alt="Prévisualisation">`;
                previewImage.style.display = 'block';
                previewContainer.querySelector('.preview-placeholder').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        // Mise à jour du récapitulatif
        function updateSummary() {
            document.getElementById('summaryReference').textContent =
                document.getElementById('reference').value || 'Non renseigné';

            document.getElementById('summaryNom').textContent =
                document.getElementById('nom').value || 'Non renseigné';

            document.getElementById('summaryDescription').textContent =
                document.getElementById('description').value || 'Non renseigné';

            const imageName = fileInput.files[0] ? fileInput.files[0].name : 'Aucune image';
            document.getElementById('summaryImage').textContent = imageName;
        }

        // Soumission du formulaire
        form.addEventListener('submit', function(e) {
            if (!validateCurrentStep()) {
                e.preventDefault();
                return false;
            }

            // Ajouter une animation de chargement
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
            submitBtn.disabled = true;
        });

        // Initialiser
        showStep(0);

        // Effet ripple sur les boutons
        document.querySelectorAll('.btn-prev, .btn-next, .btn-submit, .btn-upload, .btn-remove').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.classList.add('ripple-effect');

                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.7);
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    transform: scale(0);
                    animation: ripple-animation 0.6s linear;
                `;

                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Ajouter l'animation ripple au CSS
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = `
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }

            .btn-prev, .btn-next, .btn-submit, .btn-upload, .btn-remove {
                position: relative;
                overflow: hidden;
            }

            .error {
                border-color: var(--danger) !important;
            }

            .error:focus {
                box-shadow: 0 0 0 3px rgba(239, 71, 111, 0.1) !important;
            }
        `;
        document.head.appendChild(rippleStyle);
    });
</script>

@endsection
