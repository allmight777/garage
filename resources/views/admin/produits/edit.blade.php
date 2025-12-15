@extends('layouts.admin')

@section('content')
    <!-- Styles CSS élégants -->
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #667eea;
            --secondary: #7209b7;
            --secondary-light: #9d4edd;
            --success: #06d6a0;
            --success-light: #07e6b0;
            --danger: #ef476f;
            --danger-light: #ff6b8b;
            --warning: #ffd166;
            --warning-light: #ffe08c;
            --info: #4cc9f0;
            --info-light: #6ddbff;
            --dark: #1a1a2e;
            --dark-light: #2d2d44;
            --light: #f8f9fa;
            --gray: #6c757d;
            --gray-light: #adb5bd;
            --gray-lighter: #e9ecef;
            --border: rgba(108, 117, 125, 0.2);
            --glass-bg: rgba(255, 255, 255, 0.9);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 16px 48px rgba(0, 0, 0, 0.12);
            --shadow-input: 0 4px 6px rgba(0, 0, 0, 0.05);
            --radius: 16px;
            --radius-sm: 8px;
            --radius-lg: 24px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --gradient-4: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --gradient-submit: linear-gradient(135deg, #4361ee, #7209b7, #9d4edd);
            --gradient-success: linear-gradient(135deg, #06d6a0, #00b894);
        }

        /* Glass Effect */
        .glass-effect {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .glass-effect:hover {
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

        .gradient-submit {
            background: var(--gradient-submit);
        }

        .gradient-success {
            background: var(--gradient-success);
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
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

        .animate-slide-down {
            animation: slideInDown 0.6s ease-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        .animate-slide-up {
            animation: slideInUp 0.5s ease-out;
        }

        /* Conteneur principal */
        .admin-container {
            padding: 30px;
            max-width: 1200px;
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
            border-radius: var(--radius-lg);
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
            background: var(--gradient-1);
            background-size: 300% 100%;
            animation: shimmer 3s infinite linear;
        }

        .admin-title {
            font-size: 2.8rem;
            font-weight: 900;
            margin: 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .admin-subtitle {
            color: var(--gray);
            font-size: 1.2rem;
            margin-top: 8px;
            font-weight: 400;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 14px 28px;
            color: var(--dark);
            text-decoration: none;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition);
        }

        .btn-back:hover {
            transform: translateX(-5px);
            color: var(--primary);
        }

        /* Steps Navigation */
        .form-steps {
            display: flex;
            justify-content: space-between;
            padding: 30px 40px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 30px;
            position: relative;
        }

        .form-steps::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 10%;
            right: 10%;
            height: 2px;
            background: var(--gray-lighter);
            transform: translateY(-50%);
            z-index: 1;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            position: relative;
            z-index: 2;
        }

        .step-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            background: white;
            border: 2px solid var(--gray-lighter);
            color: var(--gray);
            transition: var(--transition);
        }

        .step.active .step-number {
            background: var(--gradient-1);
            border-color: var(--primary);
            color: white;
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
        }

        .step-label {
            font-size: 0.9rem;
            color: var(--gray);
            font-weight: 600;
            transition: var(--transition);
        }

        .step.active .step-label {
            color: var(--dark);
            font-weight: 700;
        }

        /* Form Grid */
        .form-grid {
            padding: 0 40px 40px;
        }

        .form-section {
            margin-bottom: 40px;
            border-radius: var(--radius);
            padding: 35px;
            animation: slideInUp 0.5s ease-out;
        }

        .form-section:not(:first-child) {
            display: none;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 35px;
        }

        .section-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .section-title-content {
            flex: 1;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark);
            margin: 0 0 5px 0;
        }

        .section-subtitle {
            color: var(--gray);
            font-size: 1rem;
            margin: 0;
            font-weight: 400;
        }

        /* Aperçu actuel */
        .current-preview {
            padding: 30px;
            border-radius: var(--radius);
        }

        .preview-content {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .current-image {
            width: 150px;
            height: 150px;
            border-radius: var(--radius);
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .current-image.no-image {
            flex-direction: column;
            gap: 15px;
            color: var(--gray);
            font-size: 1.2rem;
        }

        .current-image.no-image i {
            font-size: 3rem;
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-overlay {
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
            font-size: 2rem;
        }

        .current-image:hover .image-overlay {
            opacity: 1;
        }

        .current-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--gray);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .info-value {
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge-ref {
            padding: 6px 12px;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(114, 9, 183, 0.1));
            color: var(--primary);
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .stock-unit {
            color: var(--gray);
            font-weight: 400;
        }

        .stock-warning,
        .stock-danger,
        .stock-success {
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stock-warning {
            background: rgba(255, 209, 102, 0.1);
            color: var(--warning);
        }

        .stock-danger {
            background: rgba(239, 71, 111, 0.1);
            color: var(--danger);
        }

        .stock-success {
            background: rgba(6, 214, 160, 0.1);
            color: var(--success);
        }

        .price-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .marge-value {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .text-profit {
            color: var(--success);
        }

        .text-loss {
            color: var(--danger);
        }

        .marge-percent {
            font-size: 0.9rem;
            opacity: 0.8;
            font-weight: 400;
        }

        /* Form Elements */
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
        }

        .form-label.required::after {
            content: '*';
            color: var(--danger);
            margin-left: 4px;
        }

        .input-with-validation {
            position: relative;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 1rem;
            transition: var(--transition);
            background: white;
            color: var(--dark);
            box-shadow: var(--shadow-input);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
            transform: translateY(-2px);
        }

        .form-input.error,
        .form-select.error,
        .form-textarea.error {
            border-color: var(--danger);
            background: rgba(239, 71, 111, 0.02);
        }

        .form-input.success {
            border-color: var(--success);
        }

        .input-icons {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            gap: 8px;
        }

        .valid-icon,
        .error-icon {
            font-size: 1.2rem;
            opacity: 0;
            transition: var(--transition);
        }

        .valid-icon {
            color: var(--success);
        }

        .error-icon {
            color: var(--danger);
        }

        .form-input.success~.input-icons .valid-icon,
        .form-input.error~.input-icons .error-icon {
            opacity: 1;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group-text {
            padding: 0 15px;
            background: var(--gray-lighter);
            border: 2px solid var(--border);
            border-right: none;
            border-radius: var(--radius-sm) 0 0 var(--radius-sm);
            color: var(--gray);
            font-weight: 500;
        }

        .input-group .form-input {
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
            border-left: none;
        }

        .form-error {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--danger);
            font-size: 0.9rem;
            margin-top: 8px;
            padding: 10px 15px;
            background: rgba(239, 71, 111, 0.1);
            border-radius: var(--radius-sm);
            border-left: 3px solid var(--danger);
        }

        .form-error i {
            font-size: 0.9rem;
        }

        .form-hint {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
            font-size: 0.85rem;
            margin-top: 8px;
        }

        .form-hint i {
            color: var(--info);
        }

        .add-type-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .add-type-link:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        /* Select Wrapper */
        .select-wrapper {
            position: relative;
        }

        .select-arrow {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            pointer-events: none;
            transition: var(--transition);
        }

        .form-select:focus+.select-arrow {
            transform: translateY(-50%) rotate(180deg);
        }

        /* Margin Calculator */
        .margin-calculator {
            padding: 25px;
            border-radius: var(--radius);
            margin: 30px 0;
        }

        .calculator-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            color: var(--dark);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .calculator-header i {
            color: var(--primary);
            font-size: 1.3rem;
        }

        .calculator-content {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .margin-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }

        .margin-item:last-child {
            border-bottom: none;
        }

        .margin-label {
            color: var(--gray);
            font-weight: 500;
        }

        .margin-value {
            font-weight: 700;
            color: var(--dark);
            font-size: 1.1rem;
        }

        .margin-bar {
            height: 8px;
            background: var(--gray-lighter);
            border-radius: 4px;
            overflow: hidden;
            margin-top: 10px;
            position: relative;
        }

        .margin-fill {
            height: 100%;
            border-radius: 4px;
            width: 0%;
            transition: width 1s ease-out;
            position: relative;
        }

        .margin-glow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.3),
                    transparent);
            transform: translateX(-100%);
            animation: shimmer 2s infinite linear;
        }

        /* Image Upload */
        .image-upload {
            border: 2px dashed var(--border);
            border-radius: var(--radius);
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .image-upload:hover {
            border-color: var(--primary);
            background: rgba(67, 97, 238, 0.02);
        }

        .image-upload.dragover {
            border-color: var(--success);
            background: rgba(6, 214, 160, 0.05);
            transform: scale(1.02);
        }

        .upload-preview {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .upload-icon {
            font-size: 4rem;
            color: var(--gray-light);
            transition: var(--transition);
        }

        .image-upload:hover .upload-icon {
            color: var(--primary);
            animation: pulse 2s infinite;
        }

        .upload-text {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .upload-text p {
            margin: 0;
            font-weight: 600;
            color: var(--dark);
            font-size: 1.1rem;
        }

        .browse-link {
            color: var(--primary);
            text-decoration: underline;
            cursor: pointer;
        }

        .upload-info {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .upload-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 25px;
        }

        .btn-upload,
        .btn-remove {
            padding: 10px 24px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-upload {
            background: var(--primary);
            color: white;
        }

        .btn-upload:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .btn-remove {
            background: var(--danger-light);
            color: white;
        }

        .btn-remove:hover {
            background: var(--danger);
            transform: translateY(-2px);
        }

        .image-preview {
            max-width: 300px;
            max-height: 300px;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Image Guidelines */
        .image-guidelines {
            padding: 20px;
            border-radius: var(--radius);
            margin-top: 20px;
        }

        .image-guidelines h4 {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 15px 0;
            color: var(--dark);
            font-size: 1rem;
        }

        .image-guidelines h4 i {
            color: var(--warning);
        }

        .image-guidelines ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .image-guidelines li {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .image-guidelines li i {
            color: var(--success);
            font-size: 0.8rem;
        }

        /* Textarea avec outils */
        .textarea-wrapper {
            position: relative;
        }

        .form-textarea {
            min-height: 150px;
            resize: vertical;
            font-family: inherit;
            line-height: 1.5;
        }

        .textarea-tools {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            background: var(--gray-lighter);
            border-radius: 0 0 var(--radius-sm) var(--radius-sm);
            border: 2px solid var(--border);
            border-top: none;
        }

        .char-count {
            color: var(--gray);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .format-tools {
            display: flex;
            gap: 5px;
        }

        .format-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: white;
            color: var(--gray);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .format-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Form Actions */
        .form-actions {
            padding: 40px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 30px;
        }

        .action-left {
            flex: 1;
            max-width: 300px;
        }

        .action-right {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        /* Preview Box */
        .form-preview {
            padding: 25px;
            border-radius: var(--radius);
        }

        .preview-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            color: var(--dark);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .preview-header i {
            color: var(--primary);
        }

        .preview-content {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .preview-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
        }

        .preview-item:last-child {
            border-bottom: none;
        }

        .preview-label {
            color: var(--gray);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .preview-value {
            font-weight: 600;
            color: var(--dark);
        }

        /* Boutons de navigation */
        .btn-prev,
        .btn-next,
        .btn-submit {
            padding: 14px 30px;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-prev {
            background: var(--glass-bg);
            color: var(--gray);
        }

        .btn-prev:hover {
            color: var(--dark);
            transform: translateX(-3px);
        }

        .btn-next {
            background: var(--primary);
            color: white;
        }

        .btn-next:hover {
            background: var(--primary-light);
            transform: translateX(3px);
        }

        .btn-submit {
            background-size: 200% auto;
            color: white;
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
            animation: pulse 2s infinite;
        }

        .btn-submit:hover {
            background-position: right center;
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(67, 97, 238, 0.4);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .admin-container {
                padding: 20px;
            }

            .admin-header {
                flex-direction: column;
                gap: 25px;
                text-align: center;
                padding: 25px 20px;
            }

            .form-steps {
                padding: 20px;
            }

            .form-grid {
                padding: 0 20px 20px;
            }

            .form-section {
                padding: 25px;
            }

            .form-actions {
                flex-direction: column;
                padding: 25px;
            }

            .action-left {
                max-width: 100%;
            }

            .preview-content {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .current-image {
                width: 120px;
                height: 120px;
            }
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .action-right {
                width: 100%;
                justify-content: center;
            }

            .btn-prev,
            .btn-next,
            .btn-submit {
                flex: 1;
                justify-content: center;
            }

            .admin-title {
                font-size: 2.2rem;
            }

            .upload-actions {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .form-steps {
                flex-direction: column;
                gap: 20px;
                align-items: center;
            }

            .form-steps::before {
                display: none;
            }

            .step {
                flex-direction: row;
                gap: 15px;
                width: 100%;
            }

            .step-number {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .btn-prev,
            .btn-next,
            .btn-submit {
                padding: 12px 20px;
                font-size: 0.95rem;
            }

            .section-header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
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

    <div class="admin-container">
        <div class="admin-header">
            <div class="header-content animate-slide-down">
                <h1 class="admin-title">✏️ Modifier le Produit</h1>
                <p class="admin-subtitle">Mettez à jour les informations du produit</p>
            </div>

            <div class="header-actions">
                <a href="{{ route('produits.index') }}" class="btn-back glass-effect">
                    <i class="fas fa-arrow-left"></i>
                    Retour à la liste
                </a>
            </div>
        </div>

        <div class="main-card animate-fade-in glass-effect">
            <form action="{{ route('produits.update', $produit) }}" method="POST" enctype="multipart/form-data"
                id="productForm">
                @csrf
                @method('PUT')

                <!-- Progress Steps -->
                <div class="form-steps">
                    <div class="step active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">Informations de base</div>
                    </div>
                    <div class="step" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">Prix & Stock</div>
                    </div>
                    <div class="step" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">Image & Description</div>
                    </div>
                </div>

                <div class="form-grid">
                    <!-- Aperçu actuel -->
                    <div class="form-section glass-effect" id="step-0">
                        <div class="section-header">
                            <div class="section-icon gradient-1">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div class="section-title-content">
                                <h3 class="section-title">Produit actuel</h3>
                                <p class="section-subtitle">Visualisez le produit à modifier</p>
                            </div>
                        </div>

                        <div class="current-preview glass-effect">
                            <div class="preview-content">
                                @if ($produit->image)
                                    <div class="current-image glass-effect">
                                        <img src="{{ asset('storage/produits/' . $produit->image) }}"
                                            alt="{{ $produit->nom }}" class="preview-image">
                                        <div class="image-overlay">
                                            <i class="fas fa-search-plus"></i>
                                        </div>
                                    </div>
                                @else
                                    <div class="current-image no-image glass-effect">
                                        <i class="fas fa-cube"></i>
                                        <span>Aucune image</span>
                                    </div>
                                @endif

                                <div class="current-info">
                                    <div class="info-item">
                                        <span class="info-label">Produit</span>
                                        <span class="info-value">{{ $produit->nom }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Référence</span>
                                        <span class="info-value badge-ref glass-effect">#{{ $produit->reference }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Stock</span>
                                        <span class="info-value">
                                            {{ $produit->stock_actuel }}
                                            <span class="stock-unit">{{ $produit->unite_mesure }}</span>
                                            @if ($produit->stock_status == 'faible')
                                                <span class="stock-warning">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Stock faible
                                                </span>
                                            @elseif($produit->stock_status == 'rupture')
                                                <span class="stock-danger">
                                                    <i class="fas fa-times-circle"></i>
                                                    Rupture
                                                </span>
                                            @else
                                                <span class="stock-success">
                                                    <i class="fas fa-check-circle"></i>
                                                    Bon stock
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Prix vente</span>
                                        <span class="info-value price-value">{{ number_format($produit->prix_vente, 2) }}
                                            FCFA</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Marge actuelle</span>
                                        <span
                                            class="info-value marge-value @if ($produit->marge > 0) text-profit @else text-loss @endif">
                                            {{ number_format($produit->marge, 2) }} FCFA
                                            <span
                                                class="marge-percent">({{ number_format(($produit->marge / $produit->prix_achat) * 100, 1) }}%)</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 1 : Informations de base -->
                    <div class="form-section glass-effect" id="step-1">
                        <div class="section-header">
                            <div class="section-icon gradient-2">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="section-title-content">
                                <h3 class="section-title">Informations de base</h3>
                                <p class="section-subtitle">Identifiez votre produit</p>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="reference" class="form-label required">
                                    <i class="fas fa-hashtag"></i> Référence
                                </label>
                                <div class="input-with-validation">
                                    <input type="text" id="reference" name="reference"
                                        class="form-input @error('reference') error @enderror"
                                        value="{{ old('reference', $produit->reference) }}" required
                                        placeholder="PROD-001">
                                    <div class="input-icons">
                                        <i class="fas fa-check-circle valid-icon"></i>
                                        <i class="fas fa-exclamation-circle error-icon"></i>
                                    </div>
                                </div>
                                @error('reference')
                                    <div class="form-error animate__animated animate__fadeIn">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-hint">
                                    <i class="fas fa-lightbulb"></i>
                                    Identifiant unique du produit
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nom" class="form-label required">
                                    <i class="fas fa-cube"></i> Nom du produit
                                </label>
                                <div class="input-with-validation">
                                    <input type="text" id="nom" name="nom"
                                        class="form-input @error('nom') error @enderror"
                                        value="{{ old('nom', $produit->nom) }}" required
                                        placeholder="Ex: Smartphone XYZ">
                                    <div class="input-icons">
                                        <i class="fas fa-check-circle valid-icon"></i>
                                        <i class="fas fa-exclamation-circle error-icon"></i>
                                    </div>
                                </div>
                                @error('nom')
                                    <div class="form-error animate__animated animate__fadeIn">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type_produit_id" class="form-label">
                                <i class="fas fa-tag"></i> Type de produit
                            </label>
                            <div class="select-wrapper">
                                <select id="type_produit_id" name="type_produit_id"
                                    class="form-select @error('type_produit_id') error @enderror">
                                    <option value="">Sélectionner un type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('type_produit_id', $produit->type_produit_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="select-arrow">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            @error('type_produit_id')
                                <div class="form-error animate__animated animate__fadeIn">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="fas fa-plus-circle"></i>
                                <a href="{{ route('type_produits.create') }}" class="add-type-link">Créer un nouveau
                                    type</a>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="marque" class="form-label">
                                    <i class="fas fa-industry"></i> Marque
                                </label>
                                <div class="input-with-validation">
                                    <input type="text" id="marque" name="marque" class="form-input"
                                        value="{{ old('marque', $produit->marque) }}" placeholder="Ex: Apple, Samsung">
                                    <div class="input-icons">
                                        <i class="fas fa-check-circle valid-icon"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="modele" class="form-label">
                                    <i class="fas fa-cogs"></i> Modèle
                                </label>
                                <div class="input-with-validation">
                                    <input type="text" id="modele" name="modele" class="form-input"
                                        value="{{ old('modele', $produit->modele) }}"
                                        placeholder="Ex: iPhone 13, Galaxy S21">
                                    <div class="input-icons">
                                        <i class="fas fa-check-circle valid-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2 : Prix et stock -->
                    <div class="form-section glass-effect" id="step-2">
                        <div class="section-header">
                            <div class="section-icon gradient-3">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="section-title-content">
                                <h3 class="section-title">Prix & Stock</h3>
                                <p class="section-subtitle">Gestion financière et inventaire</p>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="prix_achat" class="form-label required">
                                    <i class="fas fa-shopping-cart"></i> Prix d'achat (FCFA)
                                </label>
                                <div class="input-with-validation">
                                    <div class="input-group">
                                        <span class="input-group-text">FCFA</span>
                                        <input type="number" step="0.01" min="0" id="prix_achat"
                                            name="prix_achat" class="form-input @error('prix_achat') error @enderror"
                                            value="{{ old('prix_achat', $produit->prix_achat) }}" required
                                            placeholder="0.00">
                                    </div>
                                    <div class="input-icons">
                                        <i class="fas fa-check-circle valid-icon"></i>
                                        <i class="fas fa-exclamation-circle error-icon"></i>
                                    </div>
                                </div>
                                @error('prix_achat')
                                    <div class="form-error animate__animated animate__fadeIn">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="prix_vente" class="form-label required">
                                    <i class="fas fa-tag"></i> Prix de vente (FCFA)
                                </label>
                                <div class="input-with-validation">
                                    <div class="input-group">
                                        <span class="input-group-text">FCFA</span>
                                        <input type="number" step="0.01" min="0" id="prix_vente"
                                            name="prix_vente" class="form-input @error('prix_vente') error @enderror"
                                            value="{{ old('prix_vente', $produit->prix_vente) }}" required
                                            placeholder="0.00">
                                    </div>
                                    <div class="input-icons">
                                        <i class="fas fa-check-circle valid-icon"></i>
                                        <i class="fas fa-exclamation-circle error-icon"></i>
                                    </div>
                                </div>
                                @error('prix_vente')
                                    <div class="form-error animate__animated animate__fadeIn">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Calculateur de marge -->
                        <div class="margin-calculator glass-effect">
                            <div class="calculator-header">
                                <i class="fas fa-calculator"></i>
                                <span>Calculateur de marge</span>
                            </div>
                            <div class="calculator-content">
                                <div class="margin-item">
                                    <span class="margin-label">Marge brute</span>
                                    <span class="margin-value" id="margeBrute">
                                        {{ number_format($produit->marge, 2) }} FCFA
                                    </span>
                                </div>
                                <div class="margin-item">
                                    <span class="margin-label">Pourcentage de marge</span>
                                    <span class="margin-value" id="margePourcentage">
                                        {{ number_format(($produit->marge / $produit->prix_achat) * 100, 1) }}%
                                    </span>
                                </div>
                                <div class="margin-bar">
                                    <div class="margin-fill" id="margeBar"
                                        style="width: {{ min(($produit->marge / $produit->prix_achat) * 100, 100) }}%;
                                            @if (($produit->marge / $produit->prix_achat) * 100 >= 50) background: var(--gradient-success);
                                            @elseif(($produit->marge / $produit->prix_achat) * 100 >= 20)
                                                background: linear-gradient(135deg, #ffd166, #ff9e00);
                                            @else
                                                background: linear-gradient(135deg, #ef476f, #d00000); @endif">
                                        <div class="margin-glow"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="stock_actuel" class="form-label required">
                                    <i class="fas fa-box"></i> Stock actuel
                                </label>
                                <div class="input-with-validation">
                                    <input type="number" min="0" id="stock_actuel" name="stock_actuel"
                                        class="form-input @error('stock_actuel') error @enderror"
                                        value="{{ old('stock_actuel', $produit->stock_actuel) }}" required
                                        placeholder="0">
                                    <div class="input-icons">
                                        <i class="fas fa-check-circle valid-icon"></i>
                                        <i class="fas fa-exclamation-circle error-icon"></i>
                                    </div>
                                </div>
                                @error('stock_actuel')
                                    <div class="form-error animate__animated animate__fadeIn">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="seuil_alerte" class="form-label required">
                                    <i class="fas fa-exclamation-triangle"></i> Seuil d'alerte
                                </label>
                                <div class="input-with-validation">
                                    <input type="number" min="0" id="seuil_alerte" name="seuil_alerte"
                                        class="form-input @error('seuil_alerte') error @enderror"
                                        value="{{ old('seuil_alerte', $produit->seuil_alerte) }}" required
                                        placeholder="10">
                                    <div class="input-icons">
                                        <i class="fas fa-check-circle valid-icon"></i>
                                        <i class="fas fa-exclamation-circle error-icon"></i>
                                    </div>
                                </div>
                                @error('seuil_alerte')
                                    <div class="form-error animate__animated animate__fadeIn">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="taux_tva" class="form-label">
                                    <i class="fas fa-percentage"></i> Taux TVA (%)
                                </label>
                                <div class="input-with-validation">
                                    <div class="input-group">
                                        <input type="number" step="0.01" min="0" max="100"
                                            id="taux_tva" name="taux_tva" class="form-input"
                                            value="{{ old('taux_tva', $produit->taux_tva) }}" placeholder="20.00">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="unite_mesure" class="form-label">
                                    <i class="fas fa-ruler"></i> Unité de mesure
                                </label>
                                <div class="select-wrapper">
                                    <select id="unite_mesure" name="unite_mesure" class="form-select">
                                        <option value="unité"
                                            {{ old('unite_mesure', $produit->unite_mesure) == 'unité' ? 'selected' : '' }}>
                                            Unité</option>
                                        <option value="kg"
                                            {{ old('unite_mesure', $produit->unite_mesure) == 'kg' ? 'selected' : '' }}>
                                            Kilogramme</option>
                                        <option value="g"
                                            {{ old('unite_mesure', $produit->unite_mesure) == 'g' ? 'selected' : '' }}>
                                            Gramme</option>
                                        <option value="L"
                                            {{ old('unite_mesure', $produit->unite_mesure) == 'L' ? 'selected' : '' }}>
                                            Litre</option>
                                        <option value="mL"
                                            {{ old('unite_mesure', $produit->unite_mesure) == 'mL' ? 'selected' : '' }}>
                                            Millilitre</option>
                                        <option value="m"
                                            {{ old('unite_mesure', $produit->unite_mesure) == 'm' ? 'selected' : '' }}>
                                            Mètre</option>
                                        <option value="cm"
                                            {{ old('unite_mesure', $produit->unite_mesure) == 'cm' ? 'selected' : '' }}>
                                            Centimètre</option>
                                        <option value="paquet"
                                            {{ old('unite_mesure', $produit->unite_mesure) == 'paquet' ? 'selected' : '' }}>
                                            Paquet</option>
                                        <option value="carton"
                                            {{ old('unite_mesure', $produit->unite_mesure) == 'carton' ? 'selected' : '' }}>
                                            Carton</option>
                                    </select>
                                    <div class="select-arrow">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3 : Image et description -->
                    <div class="form-section glass-effect full-width" id="step-3">
                        <div class="section-header">
                            <div class="section-icon gradient-4">
                                <i class="fas fa-images"></i>
                            </div>
                            <div class="section-title-content">
                                <h3 class="section-title">Image & Description</h3>
                                <p class="section-subtitle">Présentez votre produit</p>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="image" class="form-label">
                                    <i class="fas fa-image"></i> Image du produit
                                </label>
                                <div class="image-upload glass-effect" id="imageUpload">
                                    <input type="file" id="image" name="image" class="image-input"
                                        accept="image/*">
                                    <div class="upload-preview" id="uploadPreview">
                                        @if ($produit->image)
                                            <div class="image-preview">
                                                <img src="{{ asset('storage/produits/' . $produit->image) }}"
                                                    alt="Aperçu">
                                            </div>
                                            <div class="upload-text">
                                                <p>Image actuelle</p>
                                                <span class="upload-info">{{ $produit->image }}</span>
                                            </div>
                                        @else
                                            <div class="upload-icon">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <div class="upload-text">
                                                <p>Glissez-déposez ou <span class="browse-link">parcourir</span></p>
                                                <span class="upload-info">PNG, JPG, GIF jusqu'à 2MB</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="upload-actions">
                                        <button type="button" class="btn-upload"
                                            onclick="document.getElementById('image').click()">
                                            <i class="fas fa-upload"></i>
                                            Changer l'image
                                        </button>
                                        @if ($produit->image)
                                            <button type="button" class="btn-remove" id="removeImage"
                                                onclick="removeCurrentImage()">
                                                <i class="fas fa-trash"></i>
                                                Supprimer
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                @error('image')
                                    <div class="form-error animate__animated animate__fadeIn">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="image-guidelines glass-effect">
                                    <h4><i class="fas fa-lightbulb"></i> Recommandations</h4>
                                    <ul>
                                        <li><i class="fas fa-check-circle"></i> Format recommandé : 800x800px</li>
                                        <li><i class="fas fa-check-circle"></i> Arrière-plan clair</li>
                                        <li><i class="fas fa-check-circle"></i> Image nette et bien éclairée</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left"></i> Description
                            </label>
                            <div class="textarea-wrapper">
                                <textarea id="description" name="description" class="form-textarea @error('description') error @enderror"
                                    rows="6" placeholder="Décrivez votre produit en détail...">{{ old('description', $produit->description) }}</textarea>
                                <div class="textarea-tools">
                                    <div class="char-count">
                                        <span id="charCount">{{ strlen($produit->description) }}</span>/500 caractères
                                    </div>
                                    <div class="format-tools">
                                        <button type="button" class="format-btn" data-format="bold">
                                            <i class="fas fa-bold"></i>
                                        </button>
                                        <button type="button" class="format-btn" data-format="italic">
                                            <i class="fas fa-italic"></i>
                                        </button>
                                        <button type="button" class="format-btn" data-format="list">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @error('description')
                                <div class="form-error animate__animated animate__fadeIn">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <div class="action-left">
                        <div class="form-preview glass-effect">
                            <div class="preview-header">
                                <i class="fas fa-history"></i>
                                <span>Modifications</span>
                            </div>
                            <div class="preview-content">
                                <div class="preview-item">
                                    <span class="preview-label">Produit</span>
                                    <span class="preview-value" id="previewNom"> &nbsp; {{ $produit->nom }}</span>
                                </div>
                                <div class="preview-item">
                                    <span class="preview-label"> Référence</span>
                                    <span class="preview-value" id="previewReference"> &nbsp;
                                        {{ $produit->reference }}</span>
                                </div>
                                <div class="preview-item">
                                    <span class="preview-label"> Nouveau prix</span>
                                    <span class="preview-value" id="previewPrix"> &nbsp;
                                        {{ number_format($produit->prix_vente, 2) }} FCFA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="action-right">
                        <button type="button" class="btn-prev glass-effect" id="prevStep">
                            <i class="fas fa-arrow-left"></i>
                            Étape précédente
                        </button>
                        <button type="button" class="btn-next glass-effect" id="nextStep">
                            Étape suivante
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="submit" class="btn-submit gradient-submit">
                            <i class="fas fa-save"></i>
                            Mettre à jour le produit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script amélioré -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Variables globales
            let currentStep = 1;
            const totalSteps = 3;
            let imageFile = null;
            let originalImage = "{{ $produit->image }}";

            // Éléments DOM
            const steps = document.querySelectorAll('.step');
            const sections = document.querySelectorAll('.form-section');
            const prevBtn = document.getElementById('prevStep');
            const nextBtn = document.getElementById('nextStep');
            const form = document.getElementById('productForm');

            // Champs de formulaire
            const referenceInput = document.getElementById('reference');
            const nomInput = document.getElementById('nom');
            const prixAchatInput = document.getElementById('prix_achat');
            const prixVenteInput = document.getElementById('prix_vente');
            const descriptionTextarea = document.getElementById('description');
            const charCount = document.getElementById('charCount');

            // Prévisualisation
            const previewNom = document.getElementById('previewNom');
            const previewReference = document.getElementById('previewReference');
            const previewPrix = document.getElementById('previewPrix');

            // Calculateur de marge
            const margeBrute = document.getElementById('margeBrute');
            const margePourcentage = document.getElementById('margePourcentage');
            const margeBar = document.getElementById('margeBar');

            // Initialisation
            updateStep();
            setupFormValidation();
            setupImageUpload();
            setupTextTools();

            // Navigation par étapes
            nextBtn.addEventListener('click', function() {
                if (validateStep(currentStep)) {
                    if (currentStep < totalSteps) {
                        currentStep++;
                        updateStep();
                    }
                }
            });

            prevBtn.addEventListener('click', function() {
                if (currentStep > 1) {
                    currentStep--;
                    updateStep();
                }
            });

            // Mise à jour de l'étape
            function updateStep() {
                // Masquer l'aperçu initial après la première étape
                const step0 = document.getElementById('step-0');
                if (currentStep > 1 && step0) {
                    step0.style.display = 'none';
                }

                // Mettre à jour les étapes visuelles
                steps.forEach(step => {
                    const stepNumber = parseInt(step.dataset.step);
                    if (stepNumber === currentStep) {
                        step.classList.add('active');
                    } else {
                        step.classList.remove('active');
                    }
                });

                // Afficher/masquer les sections
                sections.forEach(section => {
                    if (section.id === `step-${currentStep}`) {
                        section.style.display = 'block';
                        section.classList.add('animate-slide-up');
                    } else {
                        section.style.display = 'none';
                        section.classList.remove('animate-slide-up');
                    }
                });

                // Mettre à jour les boutons
                prevBtn.style.display = currentStep === 1 ? 'none' : 'flex';
                nextBtn.style.display = currentStep === totalSteps ? 'none' : 'flex';
                document.querySelector('.btn-submit').style.display = currentStep === totalSteps ? 'flex' : 'none';

                // Mettre à jour le texte du bouton suivant
                if (currentStep < totalSteps) {
                    nextBtn.innerHTML = `Étape suivante <i class="fas fa-arrow-right"></i>`;
                } else {
                    nextBtn.style.display = 'none';
                }
            }

            // Validation d'étape
            function validateStep(step) {
                let isValid = true;

                switch (step) {
                    case 1:
                        if (!referenceInput.value.trim()) {
                            showError(referenceInput, 'La référence est obligatoire');
                            isValid = false;
                        } else {
                            showSuccess(referenceInput);
                        }

                        if (!nomInput.value.trim()) {
                            showError(nomInput, 'Le nom est obligatoire');
                            isValid = false;
                        } else {
                            showSuccess(nomInput);
                        }
                        break;

                    case 2:
                        const prixAchat = parseFloat(prixAchatInput.value) || 0;
                        const prixVente = parseFloat(prixVenteInput.value) || 0;

                        if (prixAchat <= 0) {
                            showError(prixAchatInput, 'Le prix d\'achat doit être supérieur à 0');
                            isValid = false;
                        } else {
                            showSuccess(prixAchatInput);
                        }

                        if (prixVente <= 0) {
                            showError(prixVenteInput, 'Le prix de vente doit être supérieur à 0');
                            isValid = false;
                        } else if (prixVente < prixAchat) {
                            showError(prixVenteInput, 'Le prix de vente doit être supérieur au prix d\'achat');
                            isValid = false;
                        } else {
                            showSuccess(prixVenteInput);
                        }
                        break;
                }

                return isValid;
            }

            // Affichage des erreurs/succès
            function showError(input, message) {
                input.classList.add('error');
                input.classList.remove('success');

                let errorDiv = input.parentNode.querySelector('.form-error');
                if (!errorDiv) {
                    errorDiv = document.createElement('div');
                    errorDiv.className = 'form-error animate__animated animate__fadeIn';
                    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                    input.parentNode.appendChild(errorDiv);
                } else {
                    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                }

                // Animation de secousse
                input.style.animation = 'none';
                setTimeout(() => {
                    input.style.animation = 'shake 0.5s';
                }, 10);
            }

            function showSuccess(input) {
                input.classList.remove('error');
                input.classList.add('success');

                const errorDiv = input.parentNode.querySelector('.form-error');
                if (errorDiv) {
                    errorDiv.remove();
                }
            }

            // Setup validation du formulaire
            function setupFormValidation() {
                // Validation en temps réel
                referenceInput.addEventListener('blur', function() {
                    if (this.value.trim()) {
                        showSuccess(this);
                    }
                });

                nomInput.addEventListener('blur', function() {
                    if (this.value.trim()) {
                        showSuccess(this);
                    }
                });

                // Calculateur de marge en temps réel
                prixAchatInput.addEventListener('input', calculateMargin);
                prixVenteInput.addEventListener('input', calculateMargin);

                // Compteur de caractères
                descriptionTextarea.addEventListener('input', function() {
                    charCount.textContent = this.value.length;
                    if (this.value.length > 500) {
                        charCount.style.color = 'var(--danger)';
                    } else {
                        charCount.style.color = 'var(--gray)';
                    }
                });

                // Auto-suggestion du prix de vente
                prixAchatInput.addEventListener('change', function() {
                    const prixAchat = parseFloat(this.value) || 0;
                    if (prixAchat > 0 && (!prixVenteInput.value || parseFloat(prixVenteInput.value) <=
                            prixAchat)) {
                        const suggestedPrice = prixAchat * 1.3; // 30% de marge
                        prixVenteInput.value = suggestedPrice.toFixed(2);
                        calculateMargin();
                    }
                });
            }

            // Calculateur de marge
            function calculateMargin() {
                const prixAchat = parseFloat(prixAchatInput.value) || 0;
                const prixVente = parseFloat(prixVenteInput.value) || 0;

                if (prixAchat > 0 && prixVente > 0) {
                    const marge = prixVente - prixAchat;
                    const pourcentage = (marge / prixAchat) * 100;

                    margeBrute.textContent = `${marge.toFixed(2)} €`;
                    margePourcentage.textContent = `${pourcentage.toFixed(1)}%`;

                    // Mise à jour de la barre de marge
                    const barWidth = Math.min(pourcentage, 100);
                    margeBar.style.width = `${barWidth}%`;

                    // Changer la couleur selon la marge
                    if (pourcentage >= 50) {
                        margeBar.style.background = 'var(--gradient-success)';
                    } else if (pourcentage >= 20) {
                        margeBar.style.background = 'linear-gradient(135deg, #ffd166, #ff9e00)';
                    } else {
                        margeBar.style.background = 'linear-gradient(135deg, #ef476f, #d00000)';
                    }
                }
            }

            // Gestion du téléchargement d'image
            function setupImageUpload() {
                const imageInput = document.getElementById('image');
                const imageUpload = document.getElementById('imageUpload');
                const uploadPreview = document.getElementById('uploadPreview');
                const browseLink = uploadPreview.querySelector('.browse-link');

                // Drag and drop
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    imageUpload.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                ['dragenter', 'dragover'].forEach(eventName => {
                    imageUpload.addEventListener(eventName, highlight, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    imageUpload.addEventListener(eventName, unhighlight, false);
                });

                function highlight() {
                    imageUpload.classList.add('dragover');
                }

                function unhighlight() {
                    imageUpload.classList.remove('dragover');
                }

                // Gérer le drop
                imageUpload.addEventListener('drop', handleDrop, false);

                function handleDrop(e) {
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    handleFiles(files);
                }

                // Gérer la sélection via le bouton
                imageInput.addEventListener('change', function() {
                    handleFiles(this.files);
                });

                if (browseLink) {
                    browseLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        imageInput.click();
                    });
                }

                function handleFiles(files) {
                    if (files.length > 0) {
                        const file = files[0];

                        // Validation
                        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                        const maxSize = 2 * 1024 * 1024; // 2MB

                        if (!validTypes.includes(file.type)) {
                            alert('Format de fichier non supporté. Utilisez JPG, PNG ou GIF.');
                            return;
                        }

                        if (file.size > maxSize) {
                            alert('Le fichier est trop volumineux. Taille maximum: 2MB.');
                            return;
                        }

                        imageFile = file;

                        // Afficher l'aperçu
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            uploadPreview.innerHTML = `
                            <div class="image-preview">
                                <img src="${e.target.result}" alt="Aperçu">
                            </div>
                            <div class="upload-text">
                                <p>${file.name}</p>
                                <span class="upload-info">${(file.size / 1024).toFixed(2)} KB</span>
                            </div>
                        `;
                            document.getElementById('removeImage').style.display = 'flex';
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }

            // Supprimer l'image actuelle
            function removeCurrentImage() {
                if (confirm('Voulez-vous vraiment supprimer l\'image actuelle ?')) {
                    // Ajouter un champ caché pour indiquer la suppression
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'remove_image';
                    hiddenInput.value = '1';
                    form.appendChild(hiddenInput);

                    // Mettre à jour l'affichage
                    const uploadPreview = document.getElementById('uploadPreview');
                    uploadPreview.innerHTML = `
                    <div class="upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="upload-text">
                        <p>Glissez-déposez ou <span class="browse-link">parcourir</span></p>
                        <span class="upload-info">PNG, JPG, GIF jusqu'à 2MB</span>
                    </div>
                `;
                    document.getElementById('removeImage').style.display = 'none';

                    // Réinitialiser setupImageUpload
                    const browseLink = uploadPreview.querySelector('.browse-link');
                    if (browseLink) {
                        browseLink.addEventListener('click', function(e) {
                            e.preventDefault();
                            document.getElementById('image').click();
                        });
                    }
                }
            }

            // Outils de formatage de texte
            function setupTextTools() {
                const formatButtons = document.querySelectorAll('.format-btn');

                formatButtons.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const format = this.dataset.format;
                        formatText(format);
                    });
                });
            }

            function formatText(format) {
                const textarea = descriptionTextarea;
                const start = textarea.selectionStart;
                const end = textarea.selectionEnd;
                const selectedText = textarea.value.substring(start, end);
                let formattedText = '';

                switch (format) {
                    case 'bold':
                        formattedText = `**${selectedText}**`;
                        break;
                    case 'italic':
                        formattedText = `*${selectedText}*`;
                        break;
                    case 'list':
                        formattedText = `• ${selectedText}`;
                        break;
                }

                textarea.value = textarea.value.substring(0, start) +
                    formattedText +
                    textarea.value.substring(end);

                // Remettre le focus et la sélection
                textarea.focus();
                textarea.setSelectionRange(start, start + formattedText.length);

                // Mettre à jour le compteur
                charCount.textContent = textarea.value.length;
            }

            // Validation finale du formulaire
            form.addEventListener('submit', function(e) {
                // Valider toutes les étapes
                for (let i = 1; i <= totalSteps; i++) {
                    if (!validateStep(i)) {
                        e.preventDefault();
                        currentStep = i;
                        updateStep();

                        // Scroll vers l'erreur
                        const errorElement = document.querySelector('.form-input.error');
                        if (errorElement) {
                            errorElement.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }

                        return false;
                    }
                }

                // Animation de soumission
                const submitBtn = document.querySelector('.btn-submit');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mise à jour en cours...';
                submitBtn.disabled = true;

                // Réactiver après 3 secondes (au cas où)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            });

            // Animation de secousse pour les erreurs
            const style = document.createElement('style');
            style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }

            @keyframes slideInDown {
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
                from { opacity: 0; }
                to { opacity: 1; }
            }
        `;
            document.head.appendChild(style);

            // Initialiser le calculateur de marge
            calculateMargin();
        });
    </script>
@endsection
