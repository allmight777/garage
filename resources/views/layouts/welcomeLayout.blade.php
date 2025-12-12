<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GaragePro - Services Automobile & Réparation</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="shortcut icon" href="{{ asset('images/logo.webp') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Three.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>

    <style>
        /* Variables et Reset */
        :root {
            --primary: #2563eb;
            --secondary: #1e40af;
            --accent: #f59e0b;
            --dark: #1f2937;
            --light: #f9fafb;
            --success: #10b981;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }

        .logo i {
            color: var(--accent);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 10rem 2rem 6rem;
            text-align: center;
            position: relative;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 2rem;
            opacity: 0.9;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* 3D Model Section */
        .model-section {
            padding: 5rem 2rem;
            background: var(--light);
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 1rem;
        }

        .section-title p {
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        .model-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        @media (max-width: 768px) {
            .model-container {
                grid-template-columns: 1fr;
            }
        }

        .model-viewer {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            height: 500px;
            position: relative;
        }

        #canvas3d {
            width: 100%;
            height: 100%;
            display: block;
        }

        .model-controls {
            position: absolute;
            bottom: 20px;
            left: 20px;
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .model-controls button {
            background: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .model-controls button:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .model-info {
            padding: 2rem;
        }

        .model-info h3 {
            font-size: 2rem;
            color: var(--dark);
            margin-bottom: 1rem;
        }

        .model-info p {
            color: #666;
            margin-bottom: 1.5rem;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 2rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .feature-item i {
            color: var(--success);
            font-size: 1.2rem;
        }

        /* Services Section */
        .services {
            padding: 5rem 2rem;
            background: white;
        }

        .services-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background: var(--light);
            border-radius: 15px;
            padding: 2rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .service-icon i {
            color: white;
            font-size: 1.5rem;
        }

        .service-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        /* Contact Section */
        .contact {
            padding: 5rem 2rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
        }

        .contact-info h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .contact-details {
            margin-top: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .contact-item i {
            font-size: 1.2rem;
            color: var(--accent);
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 3rem 2rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            color: var(--accent);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: background 0.3s;
        }

        .social-links a:hover {
            background: var(--primary);
        }

        .copyright {
            text-align: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #ccc;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .contact-container {
                grid-template-columns: 1fr;
            }
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--dark);
            font-size: 1.5rem;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .mobile-menu {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                background: white;
                padding: 2rem;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                display: none;
            }

            .mobile-menu.active {
                display: block;
            }
        }




        /* STYLE DE LA SECTION1 */
        /* TEXTE HERO PC - overlay sur 3D */
        #hero-pc {
            position: absolute;
            top: 50%;
            left: 10%;
            transform: translateY(-50%);
            z-index: 2;
            color: white;
        }

        /* TEXTE HERO MOBILE - en bas, séparé */
        #hero-mobile {
            display: none;
            padding: 2rem 1rem;
            text-align: center;
            background: #0a0a0a;
            color: white;
        }

        .hero-text-mobile {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Titres et description */
        .hero-title {
            font-weight: 900;
            background: linear-gradient(45deg, #fff, #ff3333);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .hero-subtitle {
            font-weight: 700;
            margin-bottom: 1rem;
            color: #fff;
        }

        .hero-description {
            margin-bottom: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Responsive */
        @media (max-width: 768px) {

            /* Masquer texte PC sur mobile */
            #hero-pc {
                display: none;
            }

            /* Afficher texte mobile */
            #hero-mobile {
                display: block;
            }

            .hero-title {
                font-size: 3rem;
            }

            .hero-subtitle {
                font-size: 1.5rem;
            }

            .hero-description {
                font-size: 1rem;
            }
        }





        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #0a0a0a;
            overflow-x: hidden;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .logo i {
            color: #ff3333;
            font-size: 1.8rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s;
            position: relative;
        }

        .nav-links a:hover {
            color: #ff3333;
        }

        .nav-links a:not(.nav-phone)::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #ff3333;
            transition: width 0.3s;
        }

        .nav-links a:not(.nav-phone):hover::after {
            width: 100%;
        }

        .nav-phone {
            background: rgba(255, 51, 51, 0.1);
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            border: 2px solid rgba(255, 51, 51, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        .mobile-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: rgba(10, 10, 10, 0.98);
            backdrop-filter: blur(20px);
            padding: 1rem 2rem;
            flex-direction: column;
            gap: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 999;
        }

        .mobile-menu.active {
            display: flex;
        }

        .mobile-menu a {
            color: white;
            text-decoration: none;
            padding: 0.8rem;
            border-radius: 8px;
            transition: all 0.3s;
            text-align: center;
        }

        .mobile-menu a:hover {
            background: rgba(255, 51, 51, 0.1);
            color: #ff3333;
        }

        /* Hero Section - Design simple et efficace */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 600px;
            background: #0a0a0a;
            overflow: hidden;
            margin-top: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Container 3D - Maintenant centré et bien contrôlé */
        #canvas3d-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            cursor: grab;
            pointer-events: auto;
        }

        #canvas3d-container canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: auto;
        }

        #canvas3d-container:active {
            cursor: grabbing;
        }

        /* Overlay de contenu */
        .hero-content {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            pointer-events: none;
        }

        .hero-text {
            max-width: 500px;
            color: white;
            pointer-events: auto;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #fff, #ff3333);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
        }

        .hero-subtitle {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #fff;
        }

        .hero-description {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            pointer-events: auto;
        }

        .btn-primary {
            background: linear-gradient(45deg, #ff3333, #d50000);
            color: white;
            box-shadow: 0 10px 25px rgba(255, 51, 51, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(255, 51, 51, 0.6);
        }

        /* Instructions pour la 3D */
        .instructions {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            background: rgba(0, 0, 0, 0.7);
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 3;
        }

        .instructions i {
            color: #ff3333;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .hero-content {
                max-width: 1000px;
            }

            .hero-title {
                font-size: 3.5rem;
            }

            .hero-subtitle {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 992px) {
            .hero {
                height: 90vh;
            }

            .hero-content {
                flex-direction: column;
                justify-content: center;
                text-align: center;
                gap: 3rem;
            }

            .hero-text {
                max-width: 600px;
                margin: 0 auto;
            }

            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .hero {
                height: 80vh;
                min-height: 500px;
            }

            .hero-content {
                padding: 0 1.5rem;
            }

            .hero-text {
                padding: 1.5rem;
                margin-top: 2rem;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .hero-subtitle {
                font-size: 1.8rem;
            }

            .hero-description {
                font-size: 1.1rem;
            }

            .btn {
                padding: 0.9rem 1.8rem;
                font-size: 1rem;
            }

            .nav-container {
                padding: 0 1.5rem;
            }

            .instructions {
                font-size: 0.8rem;
                padding: 0.6rem 1.2rem;
                bottom: 20px;
            }
        }

        @media (max-width: 480px) {
            .hero {
                height: 70vh;
                min-height: 400px;
            }

            .hero-text {
                padding: 1.2rem;
                margin-top: 3rem;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }

            .hero-description {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }

            .logo {
                font-size: 1.3rem;
            }

            .logo i {
                font-size: 1.5rem;
            }
        }

        /* Animation d'apparition */
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

        .hero-text {
            animation: fadeIn 1s ease-out;
        }







        /*STYLE SECTION 2(SERVICES)*/


        .services-section {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            padding: 4rem 2rem;
            color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            color: #ffffff;
        }

        .section-title h2 {
            color: #ffffff;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .section-title p {
            color: #cccccc;
            font-size: 1.1rem;
        }

        .services-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .services-top-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .services-bottom-row {
            grid-column: 1 / -1;
        }

        .service-model-card,
        .service-wide-model-card {
            background: linear-gradient(145deg, #111111, #222222);
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid #333;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.1);
        }

        .service-model-card:hover,
        .service-wide-model-card:hover {
            border-color: #ff0000;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(255, 0, 0, 0.2);
        }

        .model-viewer {
            position: relative;
            height: 350px;
            background: #000;
        }

        /* Style du carrousel de cartes */
        .cards-carousel-section {
            padding: 2rem;
        }

        .carousel-title {
            text-align: center;
            color: #ffffff;
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
        }

        .carousel-subtitle {
            text-align: center;
            color: #cccccc;
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        .cards-carousel-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .cards-wrapper {
            display: flex;
            gap: 1.5rem;
            overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE and Edge */
            padding: 1rem 0;
            width: 100%;
            max-width: 1200px;
        }

        .cards-wrapper::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }

        .service-card {
            flex: 0 0 280px;
            background: linear-gradient(145deg, #151515, #1e1e1e);
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #333;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .service-card:hover {
            border-color: #ff0000;
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(255, 0, 0, 0.25);
        }

        .card-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 2px solid #333;
            border-radius: 20px;
        }

        .card-content {
            padding: 1.5rem;
        }

        .card-title {
            color: #ffffff;
            font-size: 1.2rem;
            margin-bottom: 0.8rem;

        }

        .card-description {
            color: #ffffff;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .card-tag {
            background: rgba(255, 0, 0, 0.1);
            color: #ff6666;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            border: 1px solid rgba(255, 0, 0, 0.2);
        }

        .card-btn {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .card-btn:hover {
            background: linear-gradient(135deg, #ff3333, #dd0000);
            transform: scale(1.05);
        }

        .carousel-nav-btn {
            background: rgba(255, 0, 0, 0.8);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .carousel-nav-btn:hover {
            background: rgba(255, 0, 0, 0.9);
            transform: scale(1.1);
        }

        .carousel-indicators {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 1rem;
        }

        .indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .indicator.active {
            background: #ff0000;
            transform: scale(1.3);
        }

        /* Modal Styles */
        .card-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .modal-container {
            background: linear-gradient(145deg, #151515, #1a1a1a);
            width: 90%;
            max-width: 1000px;
            max-height: 90vh;
            border-radius: 15px;
            overflow: hidden;
            border: 2px solid #ff0000;
            box-shadow: 0 0 30px rgba(255, 0, 0, 0.3);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background: rgba(255, 0, 0, 0.1);
            border-bottom: 2px solid #333;
        }

        .modal-header h2 {
            color: #ff0000;
            margin: 0;
            font-size: 1.8rem;
        }

        .close-modal-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 2rem;
            cursor: pointer;
            transition: color 0.3s ease;
            line-height: 1;
            padding: 0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .close-modal-btn:hover {
            color: #ff0000;
            background: rgba(255, 255, 255, 0.1);
        }

        .modal-body {
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            max-height: calc(90vh - 80px);
        }

        .modal-image-section {
            width: 100%;
            height: 300px;
            overflow: hidden;
        }

        #modal-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-content-section {
            padding: 2rem;
        }

        .modal-description {
            color: #ccc;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .modal-details,
        .modal-features {
            margin-bottom: 2rem;
        }

        .modal-details h3,
        .modal-features h3 {
            color: #ff0000;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            background: rgba(255, 255, 255, 0.05);
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #333;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .detail-label {
            color: #ff6666;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .detail-value {
            color: #fff;
            font-size: 1rem;
        }

        .features-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
        }

        .feature-item {
            background: rgba(255, 0, 0, 0.1);
            color: #ff6666;
            padding: 0.6rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            border: 1px solid rgba(255, 0, 0, 0.3);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .feature-item i {
            font-size: 0.8rem;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #333;
        }

        .action-btn {
            flex: 1;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .primary-btn {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            color: white;
            border: none;
        }

        .primary-btn:hover {
            background: linear-gradient(135deg, #ff3333, #dd0000);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3);
        }

        .secondary-btn {
            background: transparent;
            color: #ff0000;
            border: 2px solid #ff0000;
        }

        .secondary-btn:hover {
            background: rgba(255, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .model-container {
            width: 100%;
            height: 100%;
        }

        .model-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(255, 255, 255, 0.9));
            padding: 1.5rem;
            color: white;
        }

        .model-overlay h4 {
            color: white;
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .service-features {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .service-features span {
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .services-list {
            max-width: 1200px;
            margin: 4rem auto 0;
            background: rgba(255, 255, 255, 0.05);
            padding: 2rem;
            border-radius: 10px;
            border: 1px solid #333;
        }

        .services-list h3 {
            text-align: center;
            color: #ff0000;
            margin-bottom: 2rem;
            font-size: 1.8rem;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }

        .service-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 1rem;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
            border-left: 3px solid #ff0000;
        }

        .service-item:hover {
            background: rgba(255, 0, 0, 0.1);
            transform: translateX(5px);
        }

        .service-item i {
            color: #ff0000;
            font-size: 1.2rem;
            width: 30px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .services-top-row {
                grid-template-columns: repeat(2, 1fr);
            }

            .service-card {
                flex: 0 0 250px;
            }

            .modal-body {
                flex-direction: column;
            }

            .modal-image-section {
                height: 250px;
            }
        }

        @media (max-width: 768px) {
            .services-top-row {
                grid-template-columns: 1fr;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .service-card {
                flex: 0 0 220px;
            }

            .cards-carousel-container {
                gap: 0.5rem;
            }

            .carousel-nav-btn {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .modal-container {
                width: 95%;
                max-height: 95vh;
            }

            .modal-header {
                padding: 1rem;
            }

            .modal-header h2 {
                font-size: 1.4rem;
            }

            .modal-content-section {
                padding: 1rem;
            }

            .modal-actions {
                flex-direction: column;
            }

            .modal-body {
                max-height: calc(95vh - 60px);
            }

            .modal-image-section {
                height: 200px;
            }
        }

        @media (max-width: 480px) {
            .service-card {
                flex: 0 0 200px;
            }

            .card-content {
                padding: 1rem;
            }

            .card-title {
                font-size: 1.1rem;
            }

            .carousel-title {
                font-size: 1.5rem;
            }
        }



    </style>
</head>



<main class="main">

    @yield('content')

</main>



<footer id="footer">

    <style>
        #footer {
            background: #0a0a0a;
            padding: 3rem 2rem;
            color: #eee;
            border-top: 2px solid #e50914;
            box-shadow: 0 -5px 25px rgba(229, 9, 20, 0.25);
        }

        #footer .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5rem;
            max-width: 1300px;
            margin: auto;
        }

        #footer h3 {
            color: #e50914;
            margin-bottom: 1rem;
            text-shadow: 0 0 10px rgba(229, 9, 20, 0.5);
        }

        #footer p {
            color: #bbb;
            line-height: 1.5;
        }

        /* Social icons */
        #footer .social-links a {
            margin-right: 12px;
            font-size: 1.3rem;
            color: #e50914;
            transition: 0.3s;
            text-shadow: 0 0 10px rgba(229, 9, 20, 0.8);
        }

        #footer .social-links a:hover {
            transform: scale(1.2);
            color: #ff1620;
            text-shadow: 0 0 18px rgba(255, 22, 32, 1);
        }

        #footer .footer-links li {
            list-style: none;
            margin-bottom: 0.7rem;
        }

        #footer .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: 0.3s;
        }

        #footer .footer-links a:hover {
            color: #e50914;
            text-shadow: 0 0 10px rgba(229, 9, 20, 0.8);
        }

        /* Newsletter */
        #footer input[type="email"] {
            background: #111;
            border: 1px solid #333;
            color: #fff;
            transition: 0.3s;
        }

        #footer input[type="email"]:focus {
            border-color: #e50914;
            box-shadow: 0 0 12px rgba(229, 9, 20, 0.6);
        }

        #footer button {
            background: #e50914 !important;
            transition: 0.3s;
            box-shadow: 0 0 12px rgba(229, 9, 20, 0.6);
        }

        #footer button:hover {
            background: #ff1620 !important;
            box-shadow: 0 0 18px rgba(255, 22, 32, 0.9);
        }

        /* Bas du footer */
        #footer .copyright {
            margin-top: 3rem;
            text-align: center;
            border-top: 1px solid #222;
            padding-top: 1.5rem;
            color: #666;
        }
    </style>

    <div class="footer-container">
        <div class="footer-column">
            <h3>GaragePro</h3>
            <p>Votre partenaire de confiance pour l'entretien et la réparation automobile depuis 2008.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

        <div class="footer-column">
            <h3>Services</h3>
            <ul class="footer-links">
                <li><a href="#">Réparation Mécanique</a></li>
                <li><a href="#">Changement de Pneus</a></li>
                <li><a href="#">Entretien Régulier</a></li>
                <li><a href="#">Électricité Auto</a></li>
                <li><a href="#">Contrôle Technique</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Liens Utiles</h3>
            <ul class="footer-links">
                <li><a href="#accueil">Accueil</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#model-3d">Produits 3D</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#">Mentions Légales</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Newsletter</h3>
            <p>Inscrivez-vous pour recevoir nos offres spéciales et conseils d'entretien.</p>
            <div style="margin-top: 1rem; display: flex;">
                <input type="email" placeholder="Votre email"
                    style="flex: 1; padding: 0.8rem; border-radius: 8px 0 0 8px;">
                <button
                    style="color: white; padding: 0.8rem 1rem; border-radius: 0 8px 8px 0;">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="copyright">
        <p>&copy; 2025 GaragePro. Tous droits réservés.</p>
    </div>
</footer>

</body>

</html>
