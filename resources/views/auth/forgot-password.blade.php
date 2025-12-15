<html>
<link rel="shortcut icon" href="{{ asset('images/logo.webp') }}" type="image/x-icon">
<style>
    html,
    body {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
        font-family: 'Poppins', sans-serif;
    }

    :root {
        --primary: #4361ee;
        --primary-dark: #3a56d4;
        --secondary: #7209b7;
        --success: #06d6a0;
        --danger: #ef476f;
        --warning: #ffd166;
        --dark: #1a1a2e;
        --light: #f8f9fa;
        --gray: #6c757d;
        --glass-bg: rgba(255, 255, 255, 0.92);
        --glass-border: rgba(255, 255, 255, 0.25);
        --shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        --shadow-hover: 0 16px 48px rgba(0, 0, 0, 0.15);
        --radius: 16px;
        --radius-lg: 24px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
    }

    /* Background Image avec overlay */
    .login-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        filter: brightness(0.7) contrast(1.1);
        z-index: -2;
    }

    /* Overlay gradient */
    .login-container::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg,
                rgba(67, 97, 238, 0.85) 0%,
                rgba(114, 9, 183, 0.85) 50%,
                rgba(26, 26, 46, 0.8) 100%);
        z-index: -1;
    }

    /* Pattern overlay subtil */
    .pattern-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        z-index: -1;
    }

    .login-card {
        width: 100%;
        max-width: 450px;
        background: var(--glass-bg);
        backdrop-filter: blur(12px) saturate(180%);
        -webkit-backdrop-filter: blur(12px) saturate(180%);
        border-radius: var(--radius-lg);
        padding: 40px;
        box-shadow: var(--shadow);
        border: 1px solid var(--glass-border);
        animation: slideUp 0.6s ease-out;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
    }

    .login-card::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.3;
        z-index: -1;
        animation: float 20s linear infinite;
    }

    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .login-logo {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
        animation: float 3s ease-in-out infinite;
        position: relative;
        overflow: hidden;
    }

    .login-logo::before {
        content: '';
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: shine 3s ease-in-out infinite;
    }

    .login-title {
        font-size: 2.2rem;
        font-weight: 900;
        color: var(--dark);
        margin-bottom: 10px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .login-subtitle {
        color: var(--gray);
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 10px;
        color: var(--dark);
        font-weight: 600;
        font-size: 0.95rem;
        transition: var(--transition);
    }

    .form-input {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        font-size: 1rem;
        transition: var(--transition);
        background: rgba(255, 255, 255, 0.95);
        color: var(--dark);
        backdrop-filter: blur(5px);
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        transform: translateY(-2px);
        background: white;
    }

    .form-input-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
        transition: var(--transition);
    }

    .form-input:focus+.form-input-icon {
        color: var(--primary);
    }

    .error-message {
        color: var(--danger);
        font-size: 0.85rem;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        animation: slideIn 0.3s ease-out;
    }

    .submit-btn {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        position: relative;
        overflow: hidden;
        letter-spacing: 0.5px;
        margin-top: 10px;
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(67, 97, 238, 0.3);
        background: linear-gradient(135deg, var(--primary-dark), var(--secondary));
    }

    .submit-btn:active {
        transform: translateY(-1px);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        margin-top: 25px;
        padding: 10px 15px;
        border-radius: 8px;
        transition: var(--transition);
    }

    .back-link:hover {
        background: rgba(67, 97, 238, 0.1);
        color: var(--primary-dark);
        text-decoration: none;
        transform: translateX(-5px);
    }

    .alert-message {
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 15px;
        animation: slideIn 0.4s ease-out;
        backdrop-filter: blur(10px);
    }

    .alert-success {
        background: rgba(6, 214, 160, 0.15);
        border: 1px solid rgba(6, 214, 160, 0.3);
        color: var(--success);
    }

    .alert-error {
        background: rgba(239, 71, 111, 0.15);
        border: 1px solid rgba(239, 71, 111, 0.3);
        color: var(--danger);
    }

    .alert-icon {
        font-size: 1.2rem;
    }

    .login-footer {
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes ripple {
        0% {
            transform: scale(0);
            opacity: 0.5;
        }

        100% {
            transform: scale(4);
            opacity: 0;
        }
    }

    @keyframes shine {
        0% {
            transform: translateX(-100%) translateY(-100%) rotate(45deg);
        }

        100% {
            transform: translateX(100%) translateY(100%) rotate(45deg);
        }
    }

    /* Responsive */
    @media (max-width: 480px) {
        .login-card {
            padding: 30px 20px;
        }

        .login-title {
            font-size: 1.8rem;
        }

        .login-container::before {
            background-attachment: scroll;
        }
    }
</style>

<!-- Particules flottantes -->
<div class="particles" id="particles"></div>

<div class="login-container">
    <div class="pattern-overlay"></div>

    <div class="login-card">
        <!-- Header avec logo -->
        <div class="login-header">

            <h1 class="login-title">Réinitialisation</h1>
            <p class="login-subtitle">
                Mot de passe oublié ? Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous
                enverrons un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un nouveau.
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert-message alert-success">
                <i class="fas fa-check-circle alert-icon"></i>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        <!-- Formulaire de réinitialisation -->
        <form method="POST" action="{{ route('password.email') }}" id="resetForm">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label class="form-label" for="email">
                    <i class="fas fa-envelope me-2"></i>Adresse Email
                </label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}"
                    required autofocus autocomplete="email" placeholder="votre@email.com">
                <i class="fas fa-at form-input-icon"></i>

                @error('email')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">
                <i class="fas fa-paper-plane"></i>
                <span id="submitText">Envoyer le lien de réinitialisation</span>
                <div id="loadingSpinner" style="display: none;">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
            </button>

            <!-- Back to Login -->
            <a href="{{ route('login') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Retour à la connexion
            </a>
        </form>


    </div>
</div>

<script>
    // Form submission with loading state
    document.getElementById('resetForm').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('.submit-btn');
        const submitText = document.getElementById('submitText');
        const loadingSpinner = document.getElementById('loadingSpinner');

        // Show loading state
        submitText.style.display = 'none';
        loadingSpinner.style.display = 'block';
        submitBtn.disabled = true;

        // Simulate a small delay for better UX
        setTimeout(() => {
            submitText.style.display = 'inline';
            loadingSpinner.style.display = 'none';
            submitBtn.disabled = false;
        }, 2000);
    });

    // Input focus effects
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
        // Add focus effect
        input.addEventListener('focus', function() {
            this.parentElement.querySelector('.form-label').style.color = 'var(--primary)';
        });

        // Remove focus effect
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.querySelector('.form-label').style.color = 'var(--dark)';
            }
        });
    });

    // Create floating particles
    function createParticles() {
        const particlesContainer = document.getElementById('particles');
        const particleCount = 20;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';

            // Random properties
            const size = Math.random() * 10 + 5;
            const posX = Math.random() * 100;
            const duration = Math.random() * 20 + 20;
            const delay = Math.random() * 10;

            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${posX}%`;
            particle.style.animationDuration = `${duration}s`;
            particle.style.animationDelay = `${delay}s`;
            particle.style.opacity = Math.random() * 0.4 + 0.1;

            particlesContainer.appendChild(particle);
        }
    }

    // Add ripple effect to submit button
    const submitBtn = document.querySelector('.submit-btn');
    submitBtn.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.7);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            width: ${size}px;
            height: ${size}px;
            top: ${y}px;
            left: ${x}px;
            pointer-events: none;
        `;

        this.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    });

    // Add CSS for ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: floatParticle 20s infinite linear;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // Initialize particles on load
    document.addEventListener('DOMContentLoaded', function() {
        createParticles();

        // Add keyboard event for Enter key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.target.matches('button')) {
                document.querySelector('.submit-btn').click();
            }
        });
    });

    // Add visual feedback for successful form interaction
    const form = document.getElementById('resetForm');
    form.addEventListener('input', function(e) {
        if (e.target.matches('.form-input')) {
            const isValid = e.target.checkValidity();
            if (isValid) {
                e.target.style.borderColor = 'var(--success)';
                e.target.style.boxShadow = '0 0 0 3px rgba(6, 214, 160, 0.1)';
            }
        }
    });
</script>

</html>
