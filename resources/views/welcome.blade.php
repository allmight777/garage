@extends('layouts.welcomeLayout')

@section('content')

    <body>


        <!-- 1ERE SECTION -->

        <!-- Hero Section avec effet oblique -->

        <!-- Navigation -->
        <nav class="navbar">
            <div class="nav-container">
                <a href="#" class="logo">
                    <i class="fas fa-car"></i>
                    <span>GaragePro</span>
                </a>

                <div class="nav-links">
                    <a href="#accueil">Accueil</a>
                    <a href="#nos-services">Services</a>

                    <a href="{{ route('products.all') }}">Nos produits</a>
                    <a href="#contact">Contact</a>
                    <a href="tel:0123456789" class="nav-phone">
                        <i class="fas fa-phone"></i> 01 23 45 67 89
                    </a>
                </div>

                <button class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div class="mobile-menu">
                <a href="#accueil">Accueil</a>
                <a href="#nos-services">Services</a>
                <a href="{{ route('products.all') }}">Nos produits</a>
                <a href="#contact">Contact</a>
                <a href="tel:0123456789">01 23 45 67 89</a>
            </div>
        </nav>

        <!-- Hero Section -->

        <!-- HERO 3D -->

        <style>
            .hero-schedule {
                width: 100%;
                max-width: 400px;
                margin: 1rem 0 2rem 0;
                border-collapse: collapse;
                background: rgba(255, 255, 255, 0.05);
                border-radius: 10px;
                overflow: hidden;
                font-size: 1rem;
            }

            .hero-schedule th,
            .hero-schedule td {
                padding: 0.5rem 0.75rem;
                text-align: center;
            }

            .hero-schedule th {
                background: #e50914;
                color: #fff;
                text-transform: uppercase;
                font-weight: bold;
                font-size: 0.85rem;
            }

            .hero-schedule tbody tr:nth-child(even) {
                background: rgba(255, 255, 255, 0.1);
            }

            .hero-schedule td {
                color: #fff;
            }
        </style>


        <section class="hero" id="accueil">
            <!-- Container 3D -->
            <div id="canvas3d-container"></div>

            <!-- TEXTE HERO - PC -->
            <div id="hero-pc">
                <div class="hero-text">
                    <h1 class="hero-title">GaragePro</h1>
                    <h2 class="hero-subtitle">Horaires d'ouverture</h2>

                    <table class="hero-schedule">
                        <thead>
                            <tr>
                                <th>Jour</th>
                                <th>Ouverture</th>
                                <th>Fermeture</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lundi</td>
                                <td>08:00</td>
                                <td>18:00</td>
                            </tr>
                            <tr>
                                <td>Mardi</td>
                                <td>08:00</td>
                                <td>18:00</td>
                            </tr>
                            <tr>
                                <td>Mercredi</td>
                                <td>08:00</td>
                                <td>18:00</td>
                            </tr>
                            <tr>
                                <td>Jeudi</td>
                                <td>08:00</td>
                                <td>18:00</td>
                            </tr>
                            <tr>
                                <td>Vendredi</td>
                                <td>08:00</td>
                                <td>18:00</td>
                            </tr>
                            <tr>
                                <td>Samedi</td>
                                <td>09:00</td>
                                <td>15:00</td>
                            </tr>
                            <tr>
                                <td>Dimanche</td>
                                <td>Fermé</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="tel:0123456789" class="btn btn-primary">
                        <i class="fas fa-phone"></i> 01 23 45 67 89
                    </a>
                </div>
            </div>
        </section>

        <!-- TEXTE HERO - MOBILE -->
        <section id="hero-mobile">
            <div class="hero-text-mobile">
                <h1 class="hero-title">GaragePro</h1>
                <h2 class="hero-subtitle">Horaires d'ouverture</h2>

                <table class="hero-schedule">
                    <thead>
                        <tr>
                            <th>Jour</th>
                            <th>Ouverture</th>
                            <th>Fermeture</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lun</td>
                            <td>08:00</td>
                            <td>18:00</td>
                        </tr>
                        <tr>
                            <td>Mar</td>
                            <td>08:00</td>
                            <td>18:00</td>
                        </tr>
                        <tr>
                            <td>Mer</td>
                            <td>08:00</td>
                            <td>18:00</td>
                        </tr>
                        <tr>
                            <td>Jeu</td>
                            <td>08:00</td>
                            <td>18:00</td>
                        </tr>
                        <tr>
                            <td>Ven</td>
                            <td>08:00</td>
                            <td>18:00</td>
                        </tr>
                        <tr>
                            <td>Sam</td>
                            <td>09:00</td>
                            <td>15:00</td>
                        </tr>
                        <tr>
                            <td>Dim</td>
                            <td>Fermé</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>

                <a href="tel:0123456789" class="btn btn-primary">
                    <i class="fas fa-phone"></i> 01 23 45 67 89
                </a>
            </div>
        </section>





        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>

        <script>
            // Mobile Menu
            document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
                document.querySelector('.mobile-menu').classList.toggle('active');
            });

            // Fermer le menu en cliquant à l'extérieur
            document.addEventListener('click', function(e) {
                const mobileMenu = document.querySelector('.mobile-menu');
                const menuBtn = document.querySelector('.mobile-menu-btn');

                if (mobileMenu.classList.contains('active') &&
                    !mobileMenu.contains(e.target) &&
                    !menuBtn.contains(e.target)) {
                    mobileMenu.classList.remove('active');
                }
            });

            // Three.js Scene - Version corrigée et optimisée
            document.addEventListener('DOMContentLoaded', function() {
                // Créer le canvas
                const container = document.getElementById('canvas3d-container');
                const canvas = document.createElement('canvas');
                canvas.id = 'canvas3d';
                container.appendChild(canvas);

                // Créer la scène
                const scene = new THREE.Scene();
                scene.background = new THREE.Color(0x0a0a0a);

                // Créer la caméra - position ajustée pour le centre
                const camera = new THREE.PerspectiveCamera(
                    50, // Champ de vision plus large
                    window.innerWidth / window.innerHeight,
                    0.1,
                    1000
                );

                // Position centrale de la caméra
                camera.position.set(0, 2, 8);

                // Renderer avec meilleure performance
                const renderer = new THREE.WebGLRenderer({
                    canvas: canvas,
                    antialias: true,
                    alpha: false,
                    powerPreference: "high-performance"
                });

                renderer.setSize(window.innerWidth, window.innerHeight);
                renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
                renderer.shadowMap.enabled = true;
                renderer.shadowMap.type = THREE.PCFSoftShadowMap;

                // Contrôles OrbitControls - BIEN CONFIGURÉS
                const controls = new THREE.OrbitControls(camera, renderer.domElement);

                // Configuration des contrôles pour un bon UX
                controls.enableDamping = true;
                controls.dampingFactor = 0.05;
                controls.rotateSpeed = 0.8;
                controls.enableZoom = true;
                controls.enablePan = false; // Désactiver le pan pour éviter les déplacements bizarres

                // Limites pour garder la voiture au centre
                controls.minDistance = 3;
                controls.maxDistance = 15;
                controls.maxPolarAngle = Math.PI / 2; // Empêcher de passer sous le sol

                // Target au centre de la scène
                controls.target.set(0, 1, 0);

                // Éclairage optimisé
                const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
                scene.add(ambientLight);

                const mainLight = new THREE.DirectionalLight(0xffffff, 1);
                mainLight.position.set(5, 10, 5);
                mainLight.castShadow = true;
                scene.add(mainLight);

                const fillLight = new THREE.DirectionalLight(0xff3333, 0.3);
                fillLight.position.set(-5, 5, -5);
                scene.add(fillLight);

                // Sol amélioré
                const groundGeometry = new THREE.PlaneGeometry(30, 30);
                const groundMaterial = new THREE.MeshStandardMaterial({
                    color: 0x9D253D, // Couleur principale
                    emissive: 0x3a0f18, //  bordeaux sombre lumineux
                    emissiveIntensity: 0.5, // augmente l'effet lumineux
                    roughness: 0.35, // plus de reflets
                    metalness: 0.6 // plus brillant
                });


                const ground = new THREE.Mesh(groundGeometry, groundMaterial);
                ground.rotation.x = -Math.PI / 2;
                ground.position.y = -0.5;
                ground.receiveShadow = true;
                scene.add(ground);

                // Grille subtile
                const gridHelper = new THREE.GridHelper(20, 20, 0x333333, 0x222222);
                gridHelper.material.opacity = 0.1;
                gridHelper.material.transparent = true;
                gridHelper.position.y = -0.49;
                scene.add(gridHelper);

                // Charger le modèle
                const loader = new THREE.GLTFLoader();
                let carModel = null;

                loader.load(
                    '/models/porsche_carrera_gt_concept_2000_replica.glb',
                    function(gltf) {
                        carModel = gltf.scene;

                        // Calculer la taille initiale
                        const box = new THREE.Box3().setFromObject(carModel);
                        const size = box.getSize(new THREE.Vector3());
                        const maxDim = Math.max(size.x, size.y, size.z);

                        // Déterminer l'échelle selon la largeur d'écran
                        const scale = (window.innerWidth <= 768 ? 21 : 35) / maxDim;

                        // Appliquer l'échelle
                        carModel.scale.setScalar(scale);

                        // Recalculer le box après scale pour centrer correctement
                        box.setFromObject(carModel);
                        const center = box.getCenter(new THREE.Vector3());
                        carModel.position.sub(center);

                        // Ajuster la hauteur pour qu'elle ne rentre pas dans le sol
                        carModel.position.y += (size.y * scale) / 2;


                        // Centrer le modèle
                        carModel.position.sub(center.multiplyScalar(scale));
                        carModel.position.y = 0;

                        // Améliorer les matériaux
                        carModel.traverse((child) => {
                            if (child.isMesh) {
                                child.castShadow = true;
                                child.receiveShadow = true;

                                if (child.material) {
                                    child.material.roughness = 0.2;
                                    child.material.metalness = 0.8;
                                }
                            }
                        });

                        scene.add(carModel);
                        console.log('✅ Modèle chargé et centré');

                        // Mettre à jour le target des contrôles
                        controls.target.copy(carModel.position);
                        controls.update();

                        // Ajouter un peu de rotation automatique
                        function autoRotate() {
                            if (carModel && controls) {
                                carModel.rotation.y += 0.002;
                            }
                            requestAnimationFrame(autoRotate);
                        }
                        autoRotate();

                        // Ajouter des instructions
                        addInstructions();
                    },
                    undefined,
                    function(error) {
                        console.error('❌ Erreur de chargement:', error);
                        createSimpleCar();
                        addInstructions();
                    }
                );

                // Modèle simple de secours
                function createSimpleCar() {
                    const carGroup = new THREE.Group();

                    // Corps principal
                    const body = new THREE.Mesh(
                        new THREE.BoxGeometry(3, 1, 5),
                        new THREE.MeshStandardMaterial({
                            color: 0xd50000,
                            roughness: 0.2,
                            metalness: 0.8
                        })
                    );
                    body.position.y = 0.5;
                    body.castShadow = true;
                    carGroup.add(body);

                    // Toit
                    const roof = new THREE.Mesh(
                        new THREE.BoxGeometry(2.5, 0.5, 3),
                        new THREE.MeshStandardMaterial({
                            color: 0x990000
                        })
                    );
                    roof.position.y = 1.25;
                    roof.position.z = -0.5;
                    roof.castShadow = true;
                    carGroup.add(roof);

                    // Roues
                    const wheelPositions = [{
                            x: -1.5,
                            y: 0.5,
                            z: 1.5
                        },
                        {
                            x: 1.5,
                            y: 0.5,
                            z: 1.5
                        },
                        {
                            x: -1.5,
                            y: 0.5,
                            z: -1.5
                        },
                        {
                            x: 1.5,
                            y: 0.5,
                            z: -1.5
                        }
                    ];

                    wheelPositions.forEach(pos => {
                        const wheel = new THREE.Mesh(
                            new THREE.CylinderGeometry(0.5, 0.5, 0.3, 32),
                            new THREE.MeshStandardMaterial({
                                color: 0x333333,
                                roughness: 0.3,
                                metalness: 0.8
                            })
                        );
                        wheel.rotation.z = Math.PI / 2;
                        wheel.position.set(pos.x, pos.y, pos.z);
                        wheel.castShadow = true;
                        carGroup.add(wheel);
                    });

                    carGroup.position.y = 0;
                    scene.add(carGroup);
                    carModel = carGroup;

                    // Rotation automatique
                    function autoRotate() {
                        carGroup.rotation.y += 0.002;
                        requestAnimationFrame(autoRotate);
                    }
                    autoRotate();
                }

                // Ajouter des instructions
                function addInstructions() {
                    const instructions = document.createElement('div');
                    instructions.className = 'instructions';
                    instructions.innerHTML =
                        '<i class="fas fa-mouse-pointer"></i> Cliquez + glissez pour tourner | Molette pour zoomer';
                    document.querySelector('.hero').appendChild(instructions);
                }

                // Animation loop
                function animate() {
                    requestAnimationFrame(animate);
                    controls.update();
                    renderer.render(scene, camera);
                }
                animate();

                // Gestion du redimensionnement
                function onWindowResize() {
                    camera.aspect = window.innerWidth / window.innerHeight;
                    camera.updateProjectionMatrix();
                    renderer.setSize(window.innerWidth, window.innerHeight);
                }

                window.addEventListener('resize', onWindowResize);

                // Debug: vérifier que les contrôles fonctionnent
                console.log('🚀 Three.js initialisé avec OrbitControls');
                console.log('🎮 Contrôles activés: rotation, zoom');
            });
        </script>



        <!-- 2ERE SECTION -->


        <!-- Nos Services Section -->
        <section class="services-section" id="nos-services">
            <div class="section-title">
                <h2 style="color: white;">NOS SERVICES EXPERTISE PNEUMATIQUE</h2>
                <p>Découvrez nos prestations spécialisées à travers nos équipements et technologies de pointe</p>
            </div>

            <div class="services-container">
                <!-- Ligne supérieure avec 3 modèles -->
                <div class="services-top-row">
                    <!-- Service 1: Diagnostic & Contrôle -->
                    <div class="service-model-card">
                        <div class="model-viewer">
                            <div class="model-container" id="model-container-1"></div>
                            <div class="model-overlay">
                                <h4>DIAGNOSTIC & CONTRÔLE</h4>
                                <div class="service-features">
                                    <span><i class="fas fa-check"></i> Diagnostic technique</span>
                                    <span><i class="fas fa-check"></i> Contrôle parallélisme</span>
                                    <span><i class="fas fa-check"></i> Diagnostic électronique</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service 2: Montage & Réparation -->
                    <div class="service-model-card">
                        <div class="model-viewer">
                            <div class="model-container" id="model-container-2"></div>
                            <div class="model-overlay">
                                <h4>MONTAGE & RÉPARATION</h4>
                                <div class="service-features">
                                    <span><i class="fas fa-check"></i> Montage/Démontage</span>
                                    <span><i class="fas fa-check"></i> Collage chaud/froid</span>
                                    <span><i class="fas fa-check"></i> Réparation spéciale</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service 3: Entretien & Graissage -->
                    <div class="service-model-card">
                        <div class="model-viewer">
                            <div class="model-container" id="model-container-3"></div>
                            <div class="model-overlay">
                                <h4>ENTRETIEN & GRAISSAGE</h4>
                                <div class="service-features">
                                    <span><i class="fas fa-check"></i> Vidange rapide</span>
                                    <span><i class="fas fa-check"></i> Graissage ponts</span>
                                    <span><i class="fas fa-check"></i> Entretien filtres</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ligne inférieure avec le carrousel de cartes -->
                <div class="services-bottom-row">
                    <div class="service-wide-model-card">
                        <div class="cards-carousel-section">
                            <h3 class="carousel-title">NOS RÉFÉRENCES & RÉALISATIONS</h3>
                            <p class="carousel-subtitle">Découvrez nos travaux et équipements en détail</p>

                            <div class="cards-carousel-container">
                                <button class="carousel-nav-btn prev-btn">
                                    <i class="fas fa-chevron-left"></i>
                                </button>

                                <div class="cards-wrapper" id="cards-wrapper">
                                    <!-- Les cartes seront ajoutées dynamiquement par JavaScript -->
                                </div>

                                <button class="carousel-nav-btn next-btn">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>

                            <div class="carousel-indicators" id="carousel-indicators">
                                <!-- Les indicateurs seront ajoutés dynamiquement -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste complète des services -->
            <div class="services-list">
                <h3>NOS PRESTATIONS COMPLÈTES</h3>
                <div class="services-grid">
                    <div class="service-item">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Contrôle et réglage de Parallélisme</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-balance-scale"></i>
                        <span>Equilibrage et calibrage de roue</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-tools"></i>
                        <span>Montage et Démontage Pneu</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Vente de pneus et accessoires</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-fire"></i>
                        <span>Collage à chaud, à froid et spécial</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-compress-arrows-alt"></i>
                        <span>Régulation rapide de pression pneumatique</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-oil-can"></i>
                        <span>Graissage général et des ponts de transfert</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-filter"></i>
                        <span>Vidange rapide et entretien des filtres</span>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-stethoscope"></i>
                        <span>Diagnostic technique complet</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal pour afficher les détails de la carte -->
        <div class="card-modal" id="card-modal">
            <div class="modal-container">
                <div class="modal-header">
                    <h2 id="modal-card-title">Titre de la carte</h2>
                    <button class="close-modal-btn" id="close-modal-btn">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="modal-image-section">
                        <img id="modal-card-image" src="" alt="Image détaillée">
                    </div>
                    <div class="modal-content-section">
                        <div class="modal-description" id="modal-card-description">
                            <!-- Description détaillée -->
                        </div>
                        <div class="modal-details">
                            <h3>Détails techniques</h3>
                            <div class="details-grid" id="modal-card-details">
                                <!-- Détails techniques -->
                            </div>
                        </div>
                        <div class="modal-features">
                            <h3>Caractéristiques</h3>
                            <div class="features-list" id="modal-card-features">
                                <!-- Caractéristiques -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- Inclure Three.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Configuration des modèles 3D
                const models = [{
                        id: 'model-container-1',
                        file: 'models/roue_delorean__rim.glb',
                        label: 'DIAGNOSTIC & CONTRÔLE'
                    },
                    {
                        id: 'model-container-2',
                        file: 'models/veilside_andrew_racing_v.glb',
                        label: 'MONTAGE & RÉPARATION'
                    },
                    {
                        id: 'model-container-3',
                        file: 'models/roue_delorean__rim.glb',
                        label: 'ENTRETIEN & GRAISSAGE'
                    }
                ];

                // Configuration des cartes du carrousel (10 cartes)
                const carouselCards = [{
                        id: 1,
                        title: "Équilibrage de Roue",
                        description: "Notre équipement high-tech pour l'équilibrage précis de vos roues avec système laser de dernière génération.",
                        imageUrl: "{{ asset('images/1.webp') }}",
                        tags: ["Précision", "Laser", "Rapide"],
                        details: [{
                                label: "Type",
                                value: "Équilibrage dynamique"
                            },
                            {
                                label: "Précision",
                                value: "± 1 gramme"
                            },
                            {
                                label: "Temps",
                                value: "15 minutes"
                            },
                            {
                                label: "Garantie",
                                value: "2 ans"
                            }
                        ],
                        features: ["Système laser", "Calibrage automatique", "Rapport détaillé",
                            "Garantie longue durée"
                        ]
                    },
                    {
                        id: 2,
                        title: "Montage Pneu",
                        description: "Montage professionnel avec protection des jantes garantie et équipement de dernière technologie.",
                        imageUrl: "{{ asset('images/3.webp') }}",
                        tags: ["Expertise", "Protection", "Rapidité"],
                        details: [{
                                label: "Équipement",
                                value: "Machine automatique"
                            },
                            {
                                label: "Protection",
                                value: "Jantes garanties"
                            },
                            {
                                label: "Durée",
                                value: "30 minutes"
                            },
                            {
                                label: "Expertise",
                                value: "10 ans d'expérience"
                            }
                        ],
                        features: ["Machine automatique", "Protection jantes", "Montage rapide",
                            "Expertise certifiée"
                        ]
                    },
                    {
                        id: 3,
                        title: "Contrôle Parallélisme",
                        description: "Analyse informatique du parallélisme pour une conduite optimale et une usure réduite des pneus.",
                        imageUrl: "{{ asset('images/4.webp') }}",
                        tags: ["Précision", "Analyse", "Optimisation"],
                        details: [{
                                label: "Technologie",
                                value: "Système 3D laser"
                            },
                            {
                                label: "Précision",
                                value: "0.01°"
                            },
                            {
                                label: "Durée",
                                value: "45 minutes"
                            },
                            {
                                label: "Rapport",
                                value: "Complet"
                            }
                        ],
                        features: ["Système 3D", "Précision extrême", "Rapport détaillé", "Optimisation complète"]
                    },
                    {
                        id: 4,
                        title: "Réparation Spéciale",
                        description: "Réparation de pneus endommagés avec collage haute résistance et matériaux premium.",
                        imageUrl: "{{ asset('images/5.webp') }}",
                        tags: ["Réparation", "Garantie", "Expertise"],
                        details: [{
                                label: "Type",
                                value: "Collage haute résistance"
                            },
                            {
                                label: "Garantie",
                                value: "6 mois"
                            },
                            {
                                label: "Durée",
                                value: "1 heure"
                            },
                            {
                                label: "Matériaux",
                                value: "Premium"
                            }
                        ],
                        features: ["Collage chaud/froid", "Garantie réparation", "Matériaux premium",
                            "Expertise spécialisée"
                        ]
                    },
                    {
                        id: 5,
                        title: "Vente Accessoires",
                        description: "Large choix d'accessoires et équipements pour votre véhicule avec conseils personnalisés.",
                        imageUrl: "{{ asset('images/6.webp') }}",
                        tags: ["Accessoires", "Choix", "Conseils"],
                        details: [{
                                label: "Gamme",
                                value: "Complète"
                            },
                            {
                                label: "Marques",
                                value: "Premium"
                            },
                            {
                                label: "Conseils",
                                value: "Personnalisés"
                            },
                            {
                                label: "Garantie",
                                value: "1 an minimum"
                            }
                        ],
                        features: ["Grand choix", "Marques premium", "Conseils experts", "Garantie étendue"]
                    },
                    {
                        id: 6,
                        title: "Diagnostic Électronique",
                        description: "Diagnostic complet des systèmes électroniques de votre véhicule avec équipement haute technologie.",
                        imageUrl: "{{ asset('images/7.webp') }}",
                        tags: ["Diagnostic", "Électronique", "Précision"],
                        details: [{
                                label: "Systèmes",
                                value: "Tous systèmes"
                            },
                            {
                                label: "Précision",
                                value: "Code erreur précis"
                            },
                            {
                                label: "Durée",
                                value: "30 minutes"
                            },
                            {
                                label: "Rapport",
                                value: "Détaillé"
                            }
                        ],
                        features: ["Diagnostic complet", "Lecture codes", "Analyse précise", "Rapport clair"]
                    },
                    {
                        id: 7,
                        title: "Graissage Ponts",
                        description: "Graissage professionnel des ponts de transfert avec huiles haute performance.",
                        imageUrl: "{{ asset('images/2.webp') }}",
                        tags: ["Entretien", "Performance", "Prévention"],
                        details: [{
                                label: "Huile",
                                value: "Haute performance"
                            },
                            {
                                label: "Durée",
                                value: "45 minutes"
                            },
                            {
                                label: "Fréquence",
                                value: "Selon utilisation"
                            },
                            {
                                label: "Bénéfice",
                                value: "Longévité accrue"
                            }
                        ],
                        features: ["Huiles premium", "Technique précise", "Prévention usure",
                            "Performance optimale"
                        ]
                    },
                    {
                        id: 8,
                        title: "Vidange Rapide",
                        description: "Service de vidange express avec huiles synthétiques et filtres de qualité.",
                        imageUrl: "{{ asset('images/8.webp') }}",
                        tags: ["Express", "Qualité", "Efficace"],
                        details: [{
                                label: "Type",
                                value: "Vidange express"
                            },
                            {
                                label: "Huile",
                                value: "Synthétique"
                            },
                            {
                                label: "Durée",
                                value: "20 minutes"
                            },
                            {
                                label: "Filtres",
                                value: "Qualité OEM"
                            }
                        ],
                        features: ["Service express", "Huiles synthétiques", "Filtres qualité", "Nettoyage complet"]
                    },
                    {
                        id: 9,
                        title: "Pneus Hiver",
                        description: "Large choix de pneus hiver avec montage et équilibrage inclus.",
                        imageUrl: "{{ asset('images/9.webp') }}",
                        tags: ["Hiver", "Sécurité", "Choix"],
                        details: [{
                                label: "Gamme",
                                value: "Complète hiver"
                            },
                            {
                                label: "Marques",
                                value: "Premium"
                            },
                            {
                                label: "Services",
                                value: "Montage inclus"
                            },
                            {
                                label: "Garantie",
                                value: "Saison complète"
                            }
                        ],
                        features: ["Grand choix", "Marques reconnues", "Montage inclus", "Garantie saison"]
                    },
                    {
                        id: 10,
                        title: "Service Express",
                        description: "Service rapide pour les urgences avec délais réduits et qualité garantie.",
                        imageUrl: "{{ asset('images/10.webp') }}",
                        tags: ["Express", "Urgence", "Rapidité"],
                        details: [{
                                label: "Délai",
                                value: "Moins de 1h"
                            },
                            {
                                label: "Disponibilité",
                                value: "7j/7"
                            },
                            {
                                label: "Qualité",
                                value: "Garantie"
                            },
                            {
                                label: "Urgence",
                                value: "Prioritaire"
                            }
                        ],
                        features: ["Délais rapides", "Disponibilité 7j/7", "Qualité garantie",
                            "Service prioritaire"
                        ]
                    }
                ];

                // Initialiser les modèles 3D
                models.forEach((model, index) => {
                    const container = document.getElementById(model.id);
                    if (container) {
                        initModelViewer(container, model.file, model.label);
                    }
                });

                // Initialiser le carrousel de cartes
                initCardsCarousel();

                // Initialiser la modal
                initCardModal();

                function initModelViewer(container, modelPath, label) {
                    // Créer la scène Three.js
                    const scene = new THREE.Scene();
                    scene.background = new THREE.Color(0x111111);

                    const camera = new THREE.PerspectiveCamera(50, container.clientWidth / container.clientHeight, 0.1,
                        1000);
                    camera.position.set(0, 0, 5);

                    const renderer = new THREE.WebGLRenderer({
                        antialias: true,
                        alpha: true
                    });
                    renderer.setSize(container.clientWidth, container.clientHeight);
                    renderer.setPixelRatio(window.devicePixelRatio);
                    renderer.shadowMap.enabled = true;

                    container.appendChild(renderer.domElement);

                    // Ajouter des lumières
                    const ambientLight = new THREE.AmbientLight(0x0000000, 0.6);
                    scene.add(ambientLight);

                    const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
                    directionalLight.position.set(5, 5, 5);
                    directionalLight.castShadow = true;
                    scene.add(directionalLight);

                    const directionalLight2 = new THREE.DirectionalLight(0xffffff, 0.8);
                    directionalLight2.position.set(-5, 5, -5);
                    scene.add(directionalLight2);

                    // Ajouter OrbitControls
                    const controls = new THREE.OrbitControls(camera, renderer.domElement);
                    controls.enableDamping = true;
                    controls.dampingFactor = 0.05;
                    controls.autoRotate = true;
                    controls.autoRotateSpeed = 1.0;

                    // Charger le modèle
                    const loader = new THREE.GLTFLoader();

                    // Ajouter un placeholder pendant le chargement
                    const geometry = new THREE.BoxGeometry(1, 1, 1);
                    const material = new THREE.MeshStandardMaterial({
                        color: 0xff0000,
                        metalness: 0.7,
                        roughness: 0.2
                    });
                    const placeholder = new THREE.Mesh(geometry, material);
                    scene.add(placeholder);

                    // Text de chargement
                    const loadingText = document.createElement('div');
                    loadingText.style.position = 'absolute';
                    loadingText.style.top = '50%';
                    loadingText.style.left = '50%';
                    loadingText.style.transform = 'translate(-50%, -50%)';
                    loadingText.style.color = '#ffffff';
                    loadingText.style.fontFamily = 'Arial, sans-serif';
                    loadingText.style.fontSize = '14px';
                    loadingText.style.textAlign = 'center';
                    loadingText.innerHTML = `Chargement de ${label}...`;
                    container.style.position = 'relative';
                    container.appendChild(loadingText);

                    loader.load(
                        modelPath,
                        function(gltf) {
                            // Retirer le placeholder et le texte de chargement
                            scene.remove(placeholder);
                            container.removeChild(loadingText);

                            const model = gltf.scene;

                            // Ajuster l'échelle selon le modèle
                            model.scale.set(3.5, 3.5, 3.5);

                            // Ajuster l'orientation selon le modèle
                            if (container.id === 'model-container-1') {
                                model.rotation.x = Math.PI / 2;
                                model.rotation.y = 0;
                            }

                            // Centrer le modèle
                            const box = new THREE.Box3().setFromObject(model);
                            const center = box.getCenter(new THREE.Vector3());
                            model.position.sub(center);

                            // Ajouter au rendu
                            scene.add(model);

                            // Animation
                            function animate() {
                                requestAnimationFrame(animate);
                                controls.update();
                                renderer.render(scene, camera);
                            }

                            animate();

                            // Redimensionnement
                            window.addEventListener('resize', function() {
                                camera.aspect = container.clientWidth / container.clientHeight;
                                camera.updateProjectionMatrix();
                                renderer.setSize(container.clientWidth, container.clientHeight);
                            });
                        },
                        function(xhr) {
                            console.log((xhr.loaded / xhr.total * 100) + '% loaded');
                        },
                        function(error) {
                            console.error('Erreur de chargement du modèle:', error);
                            loadingText.innerHTML = 'Erreur de chargement<br>Vérifiez le chemin: ' + modelPath;
                            loadingText.style.color = '#ff4444';
                        }
                    );
                }

                function initCardsCarousel() {
                    const cardsWrapper = document.getElementById('cards-wrapper');
                    const indicators = document.getElementById('carousel-indicators');
                    const prevBtn = document.querySelector('.prev-btn');
                    const nextBtn = document.querySelector('.next-btn');

                    let currentPage = 0;
                    const cardsPerPage = 3;
                    const totalPages = Math.ceil(carouselCards.length / cardsPerPage);

                    // Créer les cartes
                    carouselCards.forEach((card, index) => {
                        // Créer la carte
                        const cardElement = document.createElement('div');
                        cardElement.className = 'service-card';
                        cardElement.setAttribute('data-id', card.id);

                        cardElement.innerHTML = `
                    <img src="${card.imageUrl}" alt="${card.title}" class="card-image">
                    <div class="card-content">
                        <h3 class="card-title" style="color: white;">${card.title}</h3>
                        <p class="card-description">${card.description}</p>
                        <div class="card-tags">
                            ${card.tags.map(tag => `<span class="card-tag">${tag}</span>`).join('')}
                        </div>
                        <button class="card-btn" data-id="${card.id}">
                            <i class="fas fa-info-circle"></i> Voir les détails
                        </button>
                    </div>
                `;

                        cardsWrapper.appendChild(cardElement);

                        // Ajouter l'événement click au bouton
                        const button = cardElement.querySelector('.card-btn');
                        button.addEventListener('click', (e) => {
                            e.stopPropagation();
                            const cardData = carouselCards.find(c => c.id === card.id);
                            if (cardData) {
                                openCardModal(cardData);
                            }
                        });
                    });

                    // Créer les indicateurs
                    for (let i = 0; i < totalPages; i++) {
                        const indicator = document.createElement('div');
                        indicator.className = 'indicator';
                        if (i === 0) indicator.classList.add('active');
                        indicator.setAttribute('data-page', i);
                        indicator.addEventListener('click', () => {
                            goToPage(i);
                        });
                        indicators.appendChild(indicator);
                    }

                    // Événements des boutons
                    prevBtn.addEventListener('click', () => {
                        goToPage(currentPage - 1);
                    });

                    nextBtn.addEventListener('click', () => {
                        goToPage(currentPage + 1);
                    });

                    // Fonctions
                    function goToPage(page) {
                        if (page < 0) {
                            page = totalPages - 1;
                        } else if (page >= totalPages) {
                            page = 0;
                        }

                        currentPage = page;
                        const scrollAmount = page * cardsWrapper.clientWidth;
                        cardsWrapper.scrollTo({
                            left: scrollAmount,
                            behavior: 'smooth'
                        });

                        // Mettre à jour les indicateurs
                        document.querySelectorAll('.indicator').forEach((indicator, i) => {
                            if (i === page) {
                                indicator.classList.add('active');
                            } else {
                                indicator.classList.remove('active');
                            }
                        });
                    }

                    // Défilement automatique
                    let autoScrollInterval = setInterval(() => {
                        goToPage(currentPage + 1);
                    }, 5000);

                    // Arrêter le défilement automatique au survol
                    cardsWrapper.addEventListener('mouseenter', () => {
                        clearInterval(autoScrollInterval);
                    });

                    cardsWrapper.addEventListener('mouseleave', () => {
                        autoScrollInterval = setInterval(() => {
                            goToPage(currentPage + 1);
                        }, 5000);
                    });

                    // Navigation au clavier
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'ArrowLeft') {
                            goToPage(currentPage - 1);
                        } else if (e.key === 'ArrowRight') {
                            goToPage(currentPage + 1);
                        }
                    });
                }

                function initCardModal() {
                    const modal = document.getElementById('card-modal');
                    const closeBtn = document.getElementById('close-modal-btn');
                    const modalTitle = document.getElementById('modal-card-title');
                    const modalImage = document.getElementById('modal-card-image');
                    const modalDescription = document.getElementById('modal-card-description');
                    const modalDetails = document.getElementById('modal-card-details');
                    const modalFeatures = document.getElementById('modal-card-features');

                    function openCardModal(cardData) {
                        modalTitle.textContent = cardData.title;
                        modalImage.src = cardData.imageUrl;
                        modalImage.alt = cardData.title;
                        modalDescription.textContent = cardData.description;

                        // Ajouter les détails
                        modalDetails.innerHTML = '';
                        cardData.details.forEach(detail => {
                            const detailItem = document.createElement('div');
                            detailItem.className = 'detail-item';
                            detailItem.innerHTML = `
                        <span class="detail-label">${detail.label}:</span>
                        <span class="detail-value">${detail.value}</span>
                    `;
                            modalDetails.appendChild(detailItem);
                        });

                        // Ajouter les caractéristiques
                        modalFeatures.innerHTML = '';
                        cardData.features.forEach(feature => {
                            const featureItem = document.createElement('div');
                            featureItem.className = 'feature-item';
                            featureItem.innerHTML = `
                        <i class="fas fa-check"></i>
                        <span>${feature}</span>
                    `;
                            modalFeatures.appendChild(featureItem);
                        });

                        modal.style.display = 'flex';
                        document.body.style.overflow = 'hidden';
                    }

                    function closeCardModal() {
                        modal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }

                    // Événements
                    closeBtn.addEventListener('click', closeCardModal);

                    modal.addEventListener('click', (e) => {
                        if (e.target === modal) {
                            closeCardModal();
                        }
                    });

                    // Fermer avec la touche ESC
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape' && modal.style.display === 'flex') {
                            closeCardModal();
                        }
                    });

                    // Exposer la fonction pour l'utilisation externe
                    window.openCardModal = openCardModal;
                }
            });
        </script>



        <!-- Products Section -->
        <section class="products" id="products-section">
            <div class="section-title" id="products-title">
                <h2 id="products-main-title">Nos Produits & Accessoires</h2>
                <p id="products-subtitle">Découvrez notre gamme de produits de qualité pour votre véhicule</p>
            </div>

            <div class="products-grid" id="products-grid-container">
                @foreach ($produits as $index => $produit)
                    <div class="product-card {{ $index >= 8 ? 'extra-product' : '' }}"
                        id="product-card-{{ $produit->id }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="product-badge" id="badge-container-{{ $produit->id }}">

                            @if ($produit->typeProduit)
                                <span id="type-badge-{{ $produit->id }}"
                                    style="
            display:inline-flex;
            align-items:center;
            gap:6px;
            background:linear-gradient(135deg, #1a73e8, #a10c0c);
            color:#fff;
            padding:6px 14px;
            border-radius:30px;
            font-size:0.85rem;
            font-weight:600;
            box-shadow:0 4px 12px rgba(0,0,0,0.15);
            margin-bottom:8px;
        ">
                                    <i class="fas fa-tag"></i> {{ $produit->typeProduit->nom }}
                                </span>
                            @endif

                        </div>

                        <div class="product-image" id="image-container-{{ $produit->id }}">
                            @if ($produit->image)
                                <img src="{{ asset('storage/produits/' . $produit->image) }}" alt="{{ $produit->nom }}"
                                    class="product-img" id="product-img-{{ $produit->id }}">
                            @else
                                <div class="product-image-placeholder" id="placeholder-{{ $produit->id }}">
                                    <i class="fas fa-box-open"></i>
                                </div>
                            @endif
                            <div class="product-overlay" id="overlay-{{ $produit->id }}">
                                <button class="zoom-btn" id="zoom-btn-{{ $produit->id }}"
                                    data-image="{{ $produit->image ? asset('storage/produits/' . $produit->image) : asset('images/shopping-cart.png') }}">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div>
                        </div>

                        <div class="product-info" id="product-info-{{ $produit->id }}">
                            <div class="product-header" id="product-header-{{ $produit->id }}">
                                <h3 class="product-title" id="product-name-{{ $produit->id }}">{{ $produit->nom }}</h3>
                                <div class="product-price" id="product-price-{{ $produit->id }}">
                                    <span class="current-price"
                                        id="price-{{ $produit->id }}">{{ number_format($produit->prix_vente, 2, ',', ' ') }}FCFA</span>
                                    @if ($produit->taux_tva > 0)
                                        <span class="price-ttc" id="ttc-{{ $produit->id }}">TTC</span>
                                    @endif
                                </div>
                            </div>

                            <p class="product-description" id="product-desc-{{ $produit->id }}">
                                {{ $produit->description ? Str::limit($produit->description, 80) : 'Description non disponible' }}
                            </p>

                            <div class="product-specs" id="product-specs-{{ $produit->id }}">
                                <div class="spec-item" id="spec-marque-{{ $produit->id }}">
                                    <span class="spec-icon">
                                        <i class="fas fa-industry"></i>
                                    </span>
                                    <span class="spec-content">
                                        <span class="spec-label">Marque</span>
                                        <span class="spec-value">{{ $produit->marque ?? 'Non spécifiée' }}</span>
                                    </span>
                                </div>

                                <div class="spec-item" id="spec-modele-{{ $produit->id }}">
                                    <span class="spec-icon">
                                        <i class="fas fa-cog"></i>
                                    </span>
                                    <span class="spec-content">
                                        <span class="spec-label">Modèle</span>
                                        <span class="spec-value">{{ $produit->modele ?? 'Standard' }}</span>
                                    </span>
                                </div>

                                <div class="spec-item" id="spec-stock-{{ $produit->id }}">
                                    <span class="spec-icon">
                                        <i class="fas fa-layer-group"></i>
                                    </span>
                                    <span class="spec-content">
                                        <span class="spec-label">Stock</span>
                                        <span class="spec-value stock-{{ $produit->stock_status }}"
                                            id="stock-value-{{ $produit->id }}">
                                            {{ $produit->stock_actuel }} {{ $produit->unite_mesure }}
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="product-actions" id="actions-{{ $produit->id }}">
                                <button class="btn btn-details" id="detail-btn-{{ $produit->id }}"
                                    data-product-id="{{ $produit->id }}">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Voir détails</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($produits->count() > 8)
                <center>
                    <div class="products-action" data-aos="fade-up">
                        <a href="{{ route('products.all') }}"> <button class="btn btn-more" id="show-more-products-btn">
                                <i class="fas fa-chevron-down"></i>
                                <span>Voir plus de produits</span>
                            </button> </a>
                    </div>
                </center>
            @endif
        </section>

        <!-- Modal pour les détails du produit -->
        <div class="product-detail-modal" id="product-detail-modal-container">
            <div class="modal-overlay" id="detail-modal-overlay"></div>
            <div class="modal-container" id="detail-modal-content">
                <div class="modal-header" id="detail-modal-header" style="width: 100%;">
                    <h3 id="detail-modal-title">Détails du produit</h3>
                    <button class="btn-close-modal" id="close-detail-modal-btn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body" id="product-detail-body">
                    <!-- Contenu chargé dynamiquement -->
                </div>
            </div>
        </div>

        <!-- Modal pour l'image zoomée -->
        <div class="image-zoom-modal" id="image-zoom-modal-container">
            <div class="modal-overlay" id="zoom-modal-overlay"></div>
            <div class="modal-zoom-container" id="zoom-modal-content">
                <button class="btn-close-zoom" id="close-zoom-modal-btn">
                    <i class="fas fa-times"></i>
                </button>
                <img id="zoomed-image-display" src="" alt="Image zoomée" class="zoom-image">
            </div>
        </div>

        <style>
            /* ===== STYLES SPÉCIFIQUES PRODUITS (ID BASÉS) ===== */
            #products-section {
                padding: 4rem 2rem;
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            }

            #products-title {
                text-align: center;
                margin-bottom: 3rem;
            }

            #products-main-title {
                font-size: 2.5rem;
                color: #2c3e50;
                margin-bottom: 0.5rem;
                position: relative;
                display: inline-block;
            }

            #products-main-title::after {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 50%;
                transform: translateX(-50%);
                width: 60px;
                height: 4px;
                background: #e50914;
                border-radius: 2px;
            }

            #products-subtitle {
                color: #7f8c8d;
                font-size: 1.1rem;
                max-width: 600px;
                margin: 1rem auto 0;
            }

            /* Grille des produits */
            #products-grid-container {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
                gap: 2rem;
                margin: 3rem 0;
            }

            /* Carte produit */
            .product-card {
                background: white;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                position: relative;
                opacity: 0;
                transform: translateY(20px);
            }

            .product-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            }

            /* Badges */
            .product-badge {
                position: absolute;
                top: 15px;
                left: 15px;
                right: 15px;
                display: flex;
                justify-content: space-between;
                z-index: 2;
            }

            /* Image produit */
            .product-image {
                height: 220px;
                position: relative;
                overflow: hidden;
                background: #f5f7fa;
            }

            .product-img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.5s ease;
            }

            .product-card:hover .product-img {
                transform: scale(1.05);
            }

            .product-image-placeholder {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            .product-image-placeholder i {
                font-size: 3rem;
                opacity: 0.8;
            }

            .product-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.4);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .product-card:hover .product-overlay {
                opacity: 1;
            }

            .zoom-btn {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                border: none;
                background: rgba(255, 255, 255, 0.9);
                color: #333;
                font-size: 1.2rem;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .zoom-btn:hover {
                background: white;
                transform: scale(1.1);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            /* Informations produit */
            .product-info {
                padding: 1.5rem;
            }

            .product-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 1rem;
            }

            .product-title {
                font-size: 1.3rem;
                font-weight: 700;
                color: #2c3e50;
                margin: 0;
                line-height: 1.3;
                flex: 1;
            }

            .product-price {
                text-align: right;
                margin-left: 1rem;
            }

            .current-price {
                font-size: 1.5rem;
                font-weight: 800;
                color: #e50914;
                display: block;
                line-height: 1;
            }

            .price-ttc {
                font-size: 0.8rem;
                color: #7f8c8d;
                font-weight: 500;
            }

            .product-description {
                color: #5a6268;
                font-size: 0.95rem;
                line-height: 1.5;
                margin: 1rem 0;
                padding-bottom: 1rem;
                border-bottom: 1px solid #eee;
            }

            /* Spécifications */
            .product-specs {
                margin: 1.5rem 0;
            }

            .spec-item {
                display: flex;
                align-items: center;
                margin-bottom: 0.8rem;
                padding: 0.5rem;
                border-radius: 8px;
                transition: background 0.3s ease;
            }

            .spec-item:hover {
                background: #f8f9fa;
            }

            .spec-icon {
                width: 32px;
                height: 32px;
                background: #e8f4fc;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 0.8rem;
                color: #3498db;
                font-size: 0.9rem;
            }

            .spec-content {
                flex: 1;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .spec-label {
                font-size: 0.85rem;
                color: #7f8c8d;
                font-weight: 500;
            }

            .spec-value {
                font-size: 0.9rem;
                color: #2c3e50;
                font-weight: 600;
            }

            /* Actions produit */
            .product-actions {
                display: flex;
                gap: 0.8rem;
                margin-top: 1.5rem;
            }

            /* Bouton voir plus */
            #products-action-container {
                text-align: center;
                margin-top: 3rem;
            }

            #show-more-products-btn {
                background: red;
                color: #ffffff;
                padding: 0.8rem 2rem;
                border-radius: 25px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            #show-more-products-btn:hover {
                background: #3498db;
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 5px 20px rgba(52, 152, 219, 0.3);
            }

            /* ===== MODAL DÉTAILS ===== */
            #product-detail-modal-container {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 9999;
                padding: 2rem;
            }

            #detail-modal-content {
                position: relative;
                background: white;
                max-width: 900px;
                max-height: 90vh;
                margin: 0 auto;
                border-radius: 20px;
                overflow: hidden;
                animation: productModalSlideIn 0.4s ease;
            }

            .product-actions {
                width: 100%;
            }

            .product-actions .btn-details {
                width: 100%;
                /* prend toute la largeur */
                display: flex;
                /* pour aligner icône + texte */
                justify-content: center;
                align-items: center;
                gap: 8px;
                background: #1a73e8;
                color: #fff;
                padding: 12px 0;
                border-radius: 12px;
                font-size: 1rem;
                font-weight: 600;
                border: none;
                cursor: pointer;
            }


            @keyframes productModalSlideIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px) scale(0.95);
                }

                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }

            #detail-modal-header {
                padding: 1.5rem 2rem;
                background: linear-gradient(135deg, #f00e0e 0%, #e60f0f 100%);
                color: white;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            #detail-modal-title {
                margin: 0;
                font-size: 1.5rem;
                font-weight: 600;
            }

            #close-detail-modal-btn {
                background: rgba(255, 255, 255, 0.1);
                border: none;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                color: white;
                font-size: 1.2rem;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #close-detail-modal-btn:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: rotate(90deg);
            }

            #product-detail-body {
                padding: 2rem;
                overflow-y: auto;
                max-height: calc(90vh - 70px);
            }

            /* Contenu modal */
            .detail-content {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
            }

            .detail-image-container {
                position: relative;
                border-radius: 15px;
                overflow: hidden;
                background: #f8f9fa;
                min-height: 300px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .detail-image {
                width: 100%;
                height: 100%;
                object-fit: contain;
                padding: 1rem;
            }

            .detail-image-placeholder {
                width: 100%;
                height: 300px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border-radius: 15px;
            }

            .detail-image-placeholder i {
                font-size: 4rem;
                opacity: 0.8;
            }

            .detail-info {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .detail-title {
                font-size: 2rem;
                font-weight: 700;
                color: #2c3e50;
                margin: 0 0 0.5rem 0;
            }

            .detail-price {
                font-size: 2.2rem;
                font-weight: 800;
                color: #e50914;
                margin-bottom: 1rem;
            }

            .detail-description {
                background: #f8f9fa;
                padding: 1.5rem;
                border-radius: 12px;
                border-left: 4px solid #3498db;
            }

            .detail-description h4 {
                color: #2c3e50;
                margin: 0 0 1rem 0;
                font-size: 1.1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .detail-description h4 i {
                color: #3498db;
            }

            .detail-description p {
                color: #5a6268;
                line-height: 1.6;
                margin: 0;
                white-space: pre-line;
            }

            .detail-specs {
                background: white;
                border: 1px solid #e9ecef;
                border-radius: 12px;
                padding: 1.5rem;
            }

            .detail-specs h4 {
                color: #2c3e50;
                margin: 0 0 1.5rem 0;
                font-size: 1.1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .detail-specs h4 i {
                color: #e74c3c;
            }

            .specs-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .spec-card {
                background: #f8f9fa;
                padding: 1rem;
                border-radius: 10px;
                border: 1px solid #e9ecef;
                transition: all 0.3s ease;
            }

            .spec-card:hover {
                background: #e9ecef;
                transform: translateY(-2px);
            }

            .spec-label {
                font-size: 0.8rem;
                color: #7f8c8d;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 0.3rem;
                display: block;
            }

            .spec-value {
                font-size: 0.95rem;
                color: #2c3e50;
                font-weight: 600;
                display: block;
            }

            .spec-value.stock {
                color: #27ae60;
            }

            /* ===== MODAL ZOOM ===== */
            #image-zoom-modal-container {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 10000;
            }

            #zoom-modal-content {
                position: relative;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
            }

            #close-zoom-modal-btn {
                position: absolute;
                top: 20px;
                right: 20px;
                background: rgba(0, 0, 0, 0.7);
                border: none;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                color: white;
                font-size: 1.5rem;
                cursor: pointer;
                z-index: 10;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #close-zoom-modal-btn:hover {
                background: rgba(0, 0, 0, 0.9);
                transform: rotate(90deg);
            }

            #zoomed-image-display {
                max-width: 90%;
                max-height: 90%;
                object-fit: contain;
                border-radius: 10px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                animation: productZoomIn 0.3s ease;
            }

            @keyframes productZoomIn {
                from {
                    opacity: 0;
                    transform: scale(0.8);
                }

                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            /* ===== RESPONSIVE ===== */
            @media (max-width: 768px) {
                #products-section {
                    padding: 2rem 1rem;
                }

                #products-grid-container {
                    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                    gap: 1.5rem;
                }

                .detail-content {
                    grid-template-columns: 1fr;
                }

                .specs-grid {
                    grid-template-columns: 1fr;
                }

                .product-actions {
                    flex-direction: column;
                }
            }

            .extra-product {
                display: none;
            }

            /* Animation spécifique pour les produits */
            @keyframes productCardAppear {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Classes d'état stock spécifiques aux produits */
            #products-section .stock-bon {
                color: #27ae60 !important;
            }

            #products-section .stock-faible {
                color: #f39c12 !important;
            }

            #products-section .stock-rupture {
                color: #e74c3c !important;
            }

            /* Styles spécifiques pour les badges produits */
            #products-section .badge-danger {
                background: rgba(220, 53, 69, 0.95) !important;
                color: white !important;
            }

            #products-section .badge-warning {
                background: rgba(255, 193, 7, 0.95) !important;
                color: #212529 !important;
            }

            #products-section .badge-success {
                background: rgba(40, 167, 69, 0.95) !important;
                color: white !important;
            }

            #products-section .badge-type {
                background: rgba(52, 152, 219, 0.95) !important;
                color: white !important;
            }

            /* Styles pour les boutons spécifiques produits */
            #products-section .btn-details {
                background: linear-gradient(135deg, #db3434 0%, #2980b9 100%) !important;
                color: white !important;
            }

            #products-section .btn-details:hover {
                background: linear-gradient(135deg, #2980b9 0%, #b10404 100%) !important;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Éléments avec IDs spécifiques
                const showMoreBtn = document.getElementById('show-more-products-btn');
                const extraProducts = document.querySelectorAll('.extra-product');
                const zoomModal = document.getElementById('image-zoom-modal-container');
                const closeZoomModal = document.getElementById('close-zoom-modal-btn');
                const zoomedImage = document.getElementById('zoomed-image-display');
                const zoomButtons = document.querySelectorAll('.zoom-btn');
                const detailModal = document.getElementById('product-detail-modal-container');
                const closeDetailModal = document.getElementById('close-detail-modal-btn');
                const detailButtons = document.querySelectorAll('.btn-details');
                const detailContent = document.getElementById('product-detail-body');
                const detailModalOverlay = document.getElementById('detail-modal-overlay');
                const zoomModalOverlay = document.getElementById('zoom-modal-overlay');

                let showingAll = false;

                // Animation d'apparition pour les cartes produits
                const productObserverOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -100px 0px'
                };

                const productObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.animation = 'productCardAppear 0.6s ease forwards';
                            productObserver.unobserve(entry.target);
                        }
                    });
                }, productObserverOptions);

                document.querySelectorAll('.product-card').forEach(card => {
                    productObserver.observe(card);
                });

                // Bouton "Voir plus" - produits
                if (showMoreBtn) {
                    showMoreBtn.addEventListener('click', function() {
                        if (!showingAll) {
                            extraProducts.forEach((product, index) => {
                                setTimeout(() => {
                                    product.style.display = 'block';
                                    product.style.animation =
                                        'productCardAppear 0.6s ease forwards';
                                    productObserver.observe(product);
                                }, index * 100);
                            });
                            showMoreBtn.innerHTML = '<i class="fas fa-chevron-up"></i><span>Voir moins</span>';
                            showingAll = true;
                        } else {
                            extraProducts.forEach(product => {
                                product.style.display = 'none';
                            });
                            showMoreBtn.innerHTML =
                                '<i class="fas fa-chevron-down"></i><span>Voir plus de produits</span>';
                            showingAll = false;
                        }
                    });
                }

                // Zoom d'image - produits
                zoomButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const imageUrl = this.getAttribute('data-image');
                        zoomedImage.src = imageUrl;
                        zoomModal.style.display = 'block';
                        document.body.style.overflow = 'hidden';
                    });
                });

                if (closeZoomModal) {
                    closeZoomModal.addEventListener('click', () => {
                        zoomModal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    });
                }

                if (zoomModalOverlay) {
                    zoomModalOverlay.addEventListener('click', function(e) {
                        zoomModal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    });
                }

                // Détails produit
                detailButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.getAttribute('data-product-id');
                        const productCard = document.getElementById(`product-card-${productId}`);
                        const productName = productCard ?
                            productCard.querySelector('.product-title').textContent : 'Produit';

                        fetch(`/produit/${productId}/details`)
                            .then(response => {
                                if (!response.ok) throw new Error('Network response was not ok');
                                return response.json();
                            })
                            .then(data => {
                                detailContent.innerHTML = `
                        <div class="detail-content">
                            <div class="detail-image-container">
                                ${data.image ?
                                    `<img src="${data.image}" alt="${data.nom}" class="detail-image">` :
                                    `<div class="detail-image-placeholder">
                                                                <i class="fas fa-box-open"></i>
                                                            </div>`
                                }
                            </div>
                            <div class="detail-info">
                                <h2 class="detail-title">${data.nom}</h2>
                                <div class="detail-price">${data.prix_vente ? data.prix_vente + 'FCFA' : 'Prix non disponible'}</div>

                                <div class="detail-description">
                                    <h4><i class="fas fa-file-alt"></i> Description</h4>
                                    <p>${data.description || 'Aucune description disponible pour ce produit.'}</p>
                                </div>

                                <div class="detail-specs">
                                    <h4><i class="fas fa-list"></i> Caractéristiques</h4>
                                    <div class="specs-grid">
                                        <div class="spec-card">
                                            <span class="spec-label">Référence</span>
                                            <span class="spec-value">${data.reference || 'N/A'}</span>
                                        </div>
                                        <div class="spec-card">
                                            <span class="spec-label">Marque</span>
                                            <span class="spec-value">${data.marque || 'Non spécifiée'}</span>
                                        </div>
                                        <div class="spec-card">
                                            <span class="spec-label">Modèle</span>
                                            <span class="spec-value">${data.modele || 'Standard'}</span>
                                        </div>
                                        <div class="spec-card">
                                            <span class="spec-label">Type</span>
                                            <span class="spec-value">${data.type_produit || 'Non spécifié'}</span>
                                        </div>
                                        <div class="spec-card">
                                            <span class="spec-label">Stock</span>
                                            <span class="spec-value stock">${data.stock_actuel || 0} ${data.unite_mesure || 'unité(s)'}</span>
                                        </div>
                                        <div class="spec-card">
                                            <span class="spec-label">TVA</span>
                                            <span class="spec-value">${data.taux_tva || 0}%</span>
                                        </div>
                                        <div class="spec-card">
                                            <span class="spec-label">Unité</span>
                                            <span class="spec-value">${data.unite_mesure || 'unité'}</span>
                                        </div>
                                        <div class="spec-card">
                                            <span class="spec-label">Ajouté le</span>
                                            <span class="spec-value">${data.created_at || 'Date non disponible'}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                                detailModal.style.display = 'block';
                                document.body.style.overflow = 'hidden';
                            })
                            .catch(error => {
                                console.error('Erreur:', error);
                                detailContent.innerHTML = `
                        <div style="text-align: center; padding: 3rem;">
                            <i class="fas fa-exclamation-triangle fa-3x" style="color:#e74c3c;"></i>
                            <h3>Erreur de chargement</h3>
                            <p>Impossible de charger les détails du produit.</p>
                            <button onclick="location.reload()" class="btn" style="margin-top: 1rem;">
                                <i class="fas fa-redo"></i> Réessayer
                            </button>
                        </div>
                    `;
                                detailModal.style.display = 'block';
                                document.body.style.overflow = 'hidden';
                            });
                    });
                });

                // Fermer modal détails
                if (closeDetailModal) {
                    closeDetailModal.addEventListener('click', () => {
                        detailModal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    });
                }

                if (detailModalOverlay) {
                    detailModalOverlay.addEventListener('click', function(e) {
                        detailModal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    });
                }

                // Fermer avec ESC
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        if (zoomModal.style.display === 'block') {
                            zoomModal.style.display = 'none';
                            document.body.style.overflow = 'auto';
                        }
                        if (detailModal.style.display === 'block') {
                            detailModal.style.display = 'none';
                            document.body.style.overflow = 'auto';
                        }
                    }
                });

                // Toast notification spécifique aux produits
                function showProductToast(message) {
                    const toast = document.createElement('div');
                    toast.className = 'product-toast-notification';
                    toast.innerHTML = `
            <i class="fas fa-check-circle"></i>
            <span>${message}</span>
        `;
                    document.body.appendChild(toast);

                    setTimeout(() => {
                        toast.classList.add('show');
                    }, 10);

                    setTimeout(() => {
                        toast.classList.remove('show');
                        setTimeout(() => {
                            toast.remove();
                        }, 300);
                    }, 3000);
                }

                // Styles pour le toast spécifique produits
                const productToastStyle = document.createElement('style');
                productToastStyle.textContent = `
        .product-toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(135deg, #27ae60 0%, #219653 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            box-shadow: 0 10px 30px rgba(39, 174, 96, 0.3);
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 99999;
        }

        .product-toast-notification.show {
            transform: translateY(0);
            opacity: 1;
        }

        .product-toast-notification i {
            font-size: 1.2rem;
        }
    `;
                document.head.appendChild(productToastStyle);
            });
        </script>



        <!-- Contact Section -->
        <section class="contact" id="contact">

            <style>
                #contact {
                    background: #0a0a0a;
                    padding: 4rem 2rem;
                    color: #fff;
                }

                #contact .contact-container {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                    gap: 2.5rem;
                    align-items: start;
                }

                #contact h2,
                #contact h3 {
                    color: #e50914;
                    /* Rouge lumineux style Netflix */
                    text-shadow: 0 0 10px rgba(229, 9, 20, 0.5);
                }

                #contact p {
                    color: #ccc;
                }

                /* Items contact */
                .contact-item {
                    display: flex;
                    gap: 1rem;
                    margin-bottom: 1.2rem;
                    align-items: center;
                }

                .contact-item i {
                    font-size: 1.6rem;
                    color: #e50914;
                    text-shadow: 0 0 6px rgba(229, 9, 20, 0.7);
                }

                /* Formulaire */
                #contactForm input,
                #contactForm select {
                    padding: 1rem;
                    border-radius: 8px;
                    border: 1px solid #444;
                    background: #111;
                    color: white;
                    outline: none;
                    box-shadow: 0 0 10px rgba(100, 0, 0, 0.3);
                    transition: 0.3s;
                }

                #contactForm input:focus,
                #contactForm select:focus {
                    border-color: #e50914;
                    box-shadow: 0 0 15px rgba(229, 9, 20, 0.7);
                }

                /* Bouton */
                .btn-send {
                    padding: 1rem;
                    border-radius: 8px;
                    background: #e50914;
                    color: white;
                    border: none;
                    font-size: 1rem;
                    font-weight: bold;
                    cursor: pointer;
                    box-shadow: 0 0 15px rgba(229, 9, 20, 0.7);
                    transition: 0.3s;
                }

                .btn-send:hover {
                    background: #ff1620;
                    box-shadow: 0 0 20px rgba(255, 22, 32, 0.9);
                    transform: translateY(-2px);
                }
            </style>

            <div class="contact-container">

                <!-- Informations de contact -->
                <div class="contact-info">
                    <h2>Prenez Contact</h2>
                    <p>Notre équipe est à votre disposition pour répondre à toutes vos questions et planifier votre
                        rendez-vous.</p>

                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <strong>Adresse</strong>
                                <p>123 Rue du Garage, 75000 Cotonou</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <strong>Téléphone</strong>
                                <p>01 23 45 67 89</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>Email</strong>
                                <p>contact@garagepro.fr</p>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Formulaire -->
                <div
                    style="background: #111; padding: 2rem; border-radius: 10px; box-shadow: 0 0 20px rgba(229,9,20,0.3);">
                    <h3 style="margin-bottom: 1.5rem; font-size: 1.5rem;">Demande de Rendez-vous</h3>

                    <form id="contactForm" style="display: grid; gap: 1rem;">

                        <input id="name" type="text" placeholder="Votre nom">
                        <input id="phone" type="tel" placeholder="Téléphone">
                        <input id="email" type="email" placeholder="Email">

                        <select id="service">
                            <option value="">Type de service</option>
                            <option>Réparation</option>
                            <option>Entretien</option>
                            <option>Pneus</option>
                            <option>Diagnostic</option>
                        </select>

                        <button type="button" class="btn-send" onclick="sendEmail()">
                            <i class="fas fa-paper-plane"></i> Envoyer la demande
                        </button>

                    </form>
                </div>

            </div>

        </section>


        <!-- Google Map Section -->
        <section class="map" id="map">
            <style>
                html,
                body {
                    margin: 0;
                    padding: 0;
                    height: 100%;
                }

                #map {
                    background: #0a0a0a;
                    padding: 0;
                    color: #fff;
                    width: 100%;
                    height: 500px;
                    position: relative;
                }

                #map iframe {
                    width: 100%;
                    height: 100%;
                    border: 0;
                }


                #map h2,
                #map h3,
                #map p {
                    position: absolute;
                    top: 10px;
                    left: 20px;
                    color: #fff;
                    z-index: 2;
                }
            </style>

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.121823171401!2d2.335174475785061!3d6.378271824832322!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023576c47850fe9%3A0xc67088be44709da7!2sLE%20CH%C3%82TEAU%20-%20MAISON%20DES%20JEUNES!5e0!3m2!1sfr!2sbj!4v1765830156397!5m2!1sfr!2sbj"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </section>



        <!-- SCRIPT JS POUR ENVOYER PAR MAIL -->
        <script>
            function sendEmail() {
                const name = document.getElementById('name').value;
                const phone = document.getElementById('phone').value;
                const email = document.getElementById('email').value;
                const service = document.getElementById('service').value;

                const subject = "Demande de rendez-vous";

                const body =
                    "Nom : " + name + "%0D%0A" +
                    "Téléphone : " + phone + "%0D%0A" +
                    "Email : " + email + "%0D%0A" +
                    "Service demandé : " + service + "%0D%0A";

                const to = "contact@garagepro.fr"; // <-- Adresse destinataire

                window.location.href = `mailto:${to}?subject=${subject}&body=${body}`;
            }
        </script>
    @endsection
