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
                <h6 class="mb-0 font-bold capitalize">Modifier produit</h6>
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
                    <i class="fas fa-edit"></i> Modifier le Type
                </h1>
                <p class="admin-subtitle">Mettez à jour les informations de cette catégorie</p>
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
                    <i class="fas fa-pencil-alt"></i> Modifications
                </h2>
                <div class="current-info">
                    <div class="info-badge">
                        <i class="fas fa-info-circle"></i>
                        ID: <strong>{{ $typeProduit->id }}</strong>
                    </div>
                    <div class="info-badge">
                        <i class="fas fa-calendar"></i>
                        Créé le: <strong>{{ $typeProduit->created_at->format('d/m/Y') }}</strong>
                    </div>
                </div>
            </div>

            <form action="{{ route('type_produits.update', $typeProduit) }}" method="POST" enctype="multipart/form-data"
                id="editForm" class="form-content">
                @csrf @method('PUT')

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
                            <input type="text" id="reference" name="reference"
                                value="{{ old('reference', $typeProduit->reference) }}" class="form-input"
                                placeholder="Ex: TYPE-001" required maxlength="50">
                        </div>
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
                            <input type="text" id="nom" name="nom" value="{{ old('nom', $typeProduit->nom) }}"
                                class="form-input" placeholder="Ex: Pneus Sport" required maxlength="100">
                        </div>
                        @error('nom')
                            <div class="form-error">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description" class="form-label">
                        <i class="fas fa-align-left"></i> Description
                    </label>
                    <div class="input-group">
                        <div class="input-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <textarea id="description" name="description" class="form-textarea" placeholder="Décrivez ce type de produit..."
                            rows="4" maxlength="500">{{ old('description', $typeProduit->description) }}</textarea>
                    </div>
                    <div class="form-hint">
                        <span id="charCount">{{ strlen($typeProduit->description) }}</span>/500 caractères
                    </div>
                    @error('description')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-image"></i> Image
                    </label>

                    <div class="upload-container">
                        <!-- Image actuelle -->
                        <div class="current-image-section">
                            <h4 class="section-title">
                                <i class="fas fa-history"></i> Image actuelle
                            </h4>
                            <div class="current-image-preview">
                                @if ($typeProduit->image)
                                    <div class="image-wrapper">
                                        <img src="{{ asset('storage/type_produits/' . $typeProduit->image) }}"
                                            alt="{{ $typeProduit->nom }}" class="current-image"
                                            onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHJlY3Qgd2lkdGg9IjIwMCIgaGVpZ2h0PSIyMDAiIHJ4PSIxMiIgZmlsbD0iI0YwRjBGMSIvPjxwYXRoIGQ9Ik0xMDAgNTBMMTI1IDE1ME03NSAxNTBMMTAwIDUwWiIgZmlsbD0iIzYxNjE2QiIvPjxwYXRoIGQ9Ik0xMDAgMTUwQzEyNS41MjIgMTUwIDE1MCAxMjUuNTIyIDE1MCAxMDBDMTUwIDc0LjQ3NzkgMTI1LjUyMiA1MCAxMDAgNTBDNzQuNDc3OSA1MCA1MCA3NC40Nzc5IDUwIDEwMEM1MCAxMjUuNTIyIDc0LjQ3NzkgMTUwIDEwMCAxNTBaIiBmaWxsPSIjNjE2MTZCIi8+PC9zdmc+'">
                                        <div class="image-overlay">
                                            <span class="image-name">{{ $typeProduit->image }}</span>
                                            <span class="image-size">Image actuelle</span>
                                        </div>
                                    </div>
                                    <div class="image-actions">
                                        <a href="{{ asset('storage/type_produits/' . $typeProduit->image) }}"
                                            target="_blank" class="btn-action btn-view">
                                            <i class="fas fa-expand"></i> Agrandir
                                        </a>
                                    </div>
                                @else
                                    <div class="no-current-image">
                                        <i class="fas fa-image-slash"></i>
                                        <p>Aucune image actuellement</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Nouvelle image -->
                        <div class="new-image-section">
                            <h4 class="section-title">
                                <i class="fas fa-upload"></i> Nouvelle image
                            </h4>

                            <!-- Zone de dépôt -->
                            <div class="upload-dropzone" id="dropzone">
                                <div class="dropzone-content">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <h3>Glissez-déposez votre nouvelle image</h3>
                                    <p>Ou cliquez pour parcourir</p>
                                    <p class="upload-info">PNG, JPG, JPEG (max. 2MB)</p>
                                </div>
                                <input type="file" id="image" name="image" class="file-input"
                                    accept="image/png, image/jpeg, image/jpg">
                            </div>

                            <!-- Prévisualisation -->
                            <div class="upload-preview" id="previewContainer">
                                <div class="preview-placeholder">
                                    <i class="fas fa-image"></i>
                                    <p>Aucune nouvelle image sélectionnée</p>
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
                    </div>

                    @error('image')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <div class="action-buttons">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Enregistrer les modifications
                        </button>

                        <button type="button" class="btn-reset" id="resetBtn">
                            <i class="fas fa-undo"></i> Réinitialiser
                        </button>

                        <a href="{{ route('type_produits.index') }}" class="btn-cancel">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
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

            0%,
            100% {
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
            background: linear-gradient(90deg, var(--primary), var(--warning));
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
            color: var(--warning);
            font-size: 2.5rem;
        }

        .admin-subtitle {
            color: var(--gray);
            font-size: 1.1rem;
            margin-top: 10px;
        }

        .current-info {
            display: flex;
            gap: 15px;
        }

        .info-badge {
            padding: 8px 16px;
            background: rgba(255, 209, 102, 0.1);
            border: 1px solid var(--warning);
            border-radius: 20px;
            font-size: 0.9rem;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-badge i {
            color: var(--warning);
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

        /* Contenu du formulaire */
        .form-content {
            padding: 30px;
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

        .form-input,
        .form-textarea {
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

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
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

        /* Section image actuelle */
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--warning);
        }

        .current-image-section {
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: var(--radius);
            border: 2px solid var(--border);
        }

        .current-image-preview {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .image-wrapper {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .current-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            transition: var(--transition);
        }

        .image-wrapper:hover .current-image {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: white;
            padding: 10px;
            font-size: 0.8rem;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .image-name {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 600;
        }

        .image-size {
            font-size: 0.7rem;
            opacity: 0.8;
        }

        .image-actions {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-view {
            background: var(--primary);
            color: white;
        }

        .btn-view:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .no-current-image {
            text-align: center;
            padding: 30px;
            color: var(--gray);
        }

        .no-current-image i {
            font-size: 3rem;
            margin-bottom: 10px;
            opacity: 0.5;
        }

        /* Nouvelle image */
        .new-image-section {
            margin-top: 20px;
        }

        /* Upload d'image */
        .upload-container {
            border-radius: var(--radius);
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
            margin-bottom: 20px;
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
            min-height: 150px;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            border: 2px solid var(--border);
            position: relative;
            margin-bottom: 20px;
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
        }

        .btn-upload,
        .btn-remove {
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

        /* Actions du formulaire */
        .form-actions {
            padding: 30px 0 0;
            border-top: 1px solid var(--border);
            margin-top: 30px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .btn-submit,
        .btn-reset,
        .btn-cancel {
            padding: 15px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            min-width: 180px;
            text-decoration: none;
            border: none;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--warning), #ff9e00);
            color: white;
            animation: pulse 2s infinite;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #ffb142, #ff9e00);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 209, 102, 0.3);
        }

        .btn-reset {
            background: #6c757d;
            color: white;
        }

        .btn-reset:hover {
            background: #5a6268;
            transform: translateY(-3px);
        }

        .btn-cancel {
            background: var(--danger);
            color: white;
        }

        .btn-cancel:hover {
            background: #d00000;
            transform: translateY(-3px);
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

            .current-info {
                flex-direction: column;
                width: 100%;
            }

            .card-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-submit,
            .btn-reset,
            .btn-cancel {
                width: 100%;
            }

            .current-image-preview {
                flex-direction: column;
                text-align: center;
            }

            .upload-controls {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .admin-title {
                font-size: 1.8rem;
            }
        }
    </style>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Éléments du DOM
            const form = document.getElementById('editForm');
            const resetBtn = document.getElementById('resetBtn');
            const charCount = document.getElementById('charCount');
            const descriptionInput = document.getElementById('description');
            const dropzone = document.getElementById('dropzone');
            const fileInput = document.querySelector('.file-input');
            const uploadBtn = document.getElementById('uploadBtn');
            const removeBtn = document.getElementById('removeBtn');
            const previewContainer = document.getElementById('previewContainer');
            const previewImage = document.getElementById('previewImage');

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

            // Réinitialisation du formulaire
            resetBtn.addEventListener('click', function() {
                if (confirm('Êtes-vous sûr de vouloir réinitialiser tous les champs ?')) {
                    form.reset();
                    fileInput.value = '';
                    previewImage.style.display = 'none';
                    previewImage.innerHTML = '';
                    previewContainer.querySelector('.preview-placeholder').style.display = 'block';

                    // Restaurer les valeurs d'origine
                    document.getElementById('reference').value = '{{ $typeProduit->reference }}';
                    document.getElementById('nom').value = '{{ $typeProduit->nom }}';
                    document.getElementById('description').value = '{{ $typeProduit->description }}';
                    charCount.textContent = '{{ strlen($typeProduit->description) }}';

                    // Animation de feedback
                    this.innerHTML = '<i class="fas fa-check"></i> Réinitialisé !';
                    this.style.background = 'var(--success)';

                    setTimeout(() => {
                        this.innerHTML = '<i class="fas fa-undo"></i> Réinitialiser';
                        this.style.background = '';
                    }, 2000);
                }
            });

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

            // Soumission du formulaire
            form.addEventListener('submit', function(e) {
                // Vérifier les champs obligatoires
                const requiredInputs = form.querySelectorAll('[required]');
                let isValid = true;

                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        showError(input, 'Ce champ est obligatoire');
                    } else {
                        hideError(input);
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    return false;
                }

                // Ajouter une animation de chargement
                const submitBtn = form.querySelector('.btn-submit');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Modification en cours...';
                submitBtn.disabled = true;
            });

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

                // Scroll vers l'erreur
                input.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

            function hideError(input) {
                const errorDiv = input.parentNode.parentNode.querySelector('.form-error');
                if (errorDiv) {
                    errorDiv.remove();
                }
                input.classList.remove('error');
            }

            // Effet ripple sur les boutons
            document.querySelectorAll('.btn-submit, .btn-reset, .btn-cancel, .btn-upload, .btn-remove').forEach(
                btn => {
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

            .btn-submit, .btn-reset, .btn-cancel, .btn-upload, .btn-remove {
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

            // Animation d'entrée pour les champs
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                group.style.opacity = '0';
                group.style.transform = 'translateY(20px)';
                group.style.transition =
                    `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;

                setTimeout(() => {
                    group.style.opacity = '1';
                    group.style.transform = 'translateY(0)';
                }, 100);
            });
        });
    </script>
@endsection
