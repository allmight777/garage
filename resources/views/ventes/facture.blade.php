{{-- resources/views/ventes/facture.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="{{ asset('images/logo.webp') }}" type="image/x-icon">
    <title>Facture {{ $vente->numero_vente }}</title>
    <style>
        /* Styles pour l'impression */
        @page {
            margin: 0.5cm;
            size: A4;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: white;
            padding: 20px;
        }

        .facture-container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border: 1px solid #ddd;
            position: relative;
        }

        /* En-tête de la facture */
        .facture-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #2c3e50;
        }

        .entreprise-info {
            flex: 1;
        }

        .entreprise-nom {
            font-size: 28px;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .entreprise-details {
            color: #666;
            font-size: 12px;
            line-height: 1.6;
        }

        .entreprise-details strong {
            color: #2c3e50;
        }

        .facture-titre {
            text-align: right;
            flex: 1;
        }

        .facture-titre h1 {
            font-size: 36px;
            color: #e74c3c;
            font-weight: 900;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .numero-facture {
            font-size: 18px;
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 15px;
        }

        /* Infos client et entreprise */
        .info-section {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
            margin-bottom: 40px;
            padding: 25px;
            background: linear-gradient(to right, #f8f9fa, #ffffff);
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        .info-block {
            padding: 15px;
            background: white;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
        }

        .info-block h3 {
            color: #2c3e50;
            font-size: 16px;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #3498db;
            font-weight: 700;
        }

        .info-item {
            display: flex;
            margin-bottom: 8px;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            min-width: 120px;
        }

        .info-value {
            color: #2c3e50;
            font-weight: 500;
        }

        /* Tableau des produits */
        .produits-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .produits-table thead {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
        }

        .produits-table th {
            padding: 15px 10px;
            text-align: left;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
        }

        .produits-table th:first-child {
            border-radius: 8px 0 0 0;
        }

        .produits-table th:last-child {
            border-radius: 0 8px 0 0;
        }

        .produits-table tbody tr {
            border-bottom: 1px solid #e0e0e0;
            transition: background 0.3s;
        }

        .produits-table tbody tr:hover {
            background: #f8f9fa;
        }

        .produits-table tbody tr:last-child {
            border-bottom: none;
        }

        .produits-table td {
            padding: 15px 10px;
            vertical-align: top;
            border: none;
        }

        .produit-nom {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .produit-ref {
            color: #7f8c8d;
            font-size: 11px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        /* Totaux */
        .totaux-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .notes-block {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .notes-block h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: 700;
        }

        .notes-content {
            color: #666;
            font-style: italic;
            line-height: 1.6;
            min-height: 80px;
        }

        .totaux-block {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 25px;
        }

        .totaux-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px dashed #ddd;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #2c3e50;
            font-size: 18px;
            font-weight: 800;
            color: #2c3e50;
        }

        .montant-total {
            font-size: 24px;
            color: #e74c3c;
            font-weight: 900;
        }

        /* Pied de page */
        .facture-footer {
            margin-top: 60px;
            padding-top: 25px;
            border-top: 3px solid #2c3e50;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            text-align: center;
        }

        .footer-block {
            padding: 15px;
        }

        .footer-block h4 {
            color: #2c3e50;
            font-size: 13px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .footer-block p {
            color: #666;
            font-size: 11px;
            line-height: 1.5;
        }

        /* Badges et statut */
        .statut-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .statut-terminee {
            background: #27ae60;
            color: white;
        }

        .statut-annulee {
            background: #e74c3c;
            color: white;
        }

        /* Cache les éléments lors de l'impression */
        @media print {
            body {
                padding: 0;
            }

            .facture-container {
                padding: 15px;
                border: none;
            }

            .no-print {
                display: none !important;
            }

            .page-break {
                page-break-before: always;
            }
        }

        /* Pour l'affichage web */
        .actions-print {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            display: flex;
            gap: 10px;
        }

        .btn-print {
            padding: 12px 25px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }

        .btn-back {
            padding: 12px 25px;
            background: #95a5a6;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }

        /* Signature */
        .signature-section {
            margin-top: 60px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 60px;
            padding-top: 40px;
            border-top: 1px solid #ddd;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 40px;
            padding-top: 10px;
            text-align: center;
            color: #666;
        }

        /* Timbres et cachets */
        .cachet-section {
            position: absolute;
            bottom: 100px;
            right: 50px;
            opacity: 0.7;
            pointer-events: none;
        }

        .cachet {
            width: 150px;
            height: 150px;
            border: 3px solid #e74c3c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            color: #e74c3c;
            text-transform: uppercase;
            transform: rotate(-15deg);
            opacity: 0.5;
        }

        /* Code QR pour paiement */
        .qr-section {
            position: absolute;
            bottom: 100px;
            left: 50px;
            text-align: center;
        }

        .qr-placeholder {
            width: 120px;
            height: 120px;
            background: #f8f9fa;
            border: 2px dashed #ddd;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 12px;
            margin: 0 auto 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .info-section,
            .totaux-section,
            .facture-footer,
            .signature-section {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .facture-header {
                flex-direction: column;
                text-align: center;
            }

            .facture-titre {
                text-align: center;
                margin-top: 20px;
            }

            .actions-print {
                flex-direction: column;
                right: 10px;
                left: 10px;
                top: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Boutons d'actions (visibles uniquement sur web) -->
    <div class="actions-print no-print">
        <button onclick="window.print()" class="btn-print">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
            </svg>
            Imprimer
        </button>
        <a href="{{ route('ventes.show', $vente) }}" class="btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Retour
        </a>
    </div>

    <!-- Contenu principal de la facture -->
    <div class="facture-container">
        <!-- En-tête -->
        <div class="facture-header">
            <div class="entreprise-info">
                <div class="entreprise-nom">GARAGE AUTO PLUS</div>
                <div class="entreprise-details">
                    <strong>Adresse :</strong> Rue des Artisans, Zone Industrielle, Cotonou<br>
                    <strong>Téléphone :</strong> +229 21 30 40 50<br>
                    <strong>Email :</strong> contact@garageautoplus.bj<br>
                    <strong>RCCM :</strong> BJ-COT-2023-12345B<br>
                    <strong>NIF :</strong> 2023000012345
                </div>
            </div>
            <div class="facture-titre">
                <h1>FACTURE</h1>
                <div class="numero-facture">{{ $vente->numero_vente }}</div>
                <div class="statut-badge statut-{{ $vente->statut }}">
                    {{ strtoupper($vente->statut_text) }}
                </div>
            </div>
        </div>

        <!-- Informations client et vente -->
        <div class="info-section">
            <div class="info-block">
                <h3>CLIENT</h3>
                @if($vente->client || $vente->client_nom)
                    <div class="info-item">
                        <span class="info-label">Nom :</span>
                        <span class="info-value">{{ $vente->client->nom_complet ?? $vente->client_nom }}</span>
                    </div>
                    @if($vente->client && $vente->client->telephone || $vente->client_telephone)
                    <div class="info-item">
                        <span class="info-label">Téléphone :</span>
                        <span class="info-value">{{ $vente->client->telephone ?? $vente->client_telephone }}</span>
                    </div>
                    @endif
                    @if($vente->client && $vente->client->adresse || $vente->client_adresse)
                    <div class="info-item">
                        <span class="info-label">Adresse :</span>
                        <span class="info-value">{{ $vente->client->adresse ?? $vente->client_adresse }}</span>
                    </div>
                    @endif
                @else
                    <div class="info-item">
                        <span class="info-label">Client :</span>
                        <span class="info-value">Client non enregistré</span>
                    </div>
                @endif
            </div>

            <div class="info-block">
                <h3>INFORMATIONS DE LA VENTE</h3>
                <div class="info-item">
                    <span class="info-label">N° Facture :</span>
                    <span class="info-value">{{ $vente->numero_vente }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date :</span>
                    <span class="info-value">{{ $vente->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Vendeur :</span>
                    <span class="info-value">{{ $vente->vendeur->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Mode paiement :</span>
                    <span class="info-value">{{ ucfirst($vente->mode_paiement_text) }}</span>
                </div>
            </div>
        </div>

        <!-- Tableau des produits -->
        <div class="produits-section">
            <table class="produits-table">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>DÉSIGNATION</th>
                        <th width="12%">RÉFÉRENCE</th>
                        <th width="12%" class="text-center">PRIX UNITAIRE</th>
                        <th width="10%" class="text-center">QUANTITÉ</th>
                        <th width="15%" class="text-right">SOUS-TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vente->ligneVentes as $index => $ligne)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <div class="produit-nom">{{ $ligne->produit->nom }}</div>
                            @if($ligne->produit->marque)
                            <div class="produit-ref">Marque: {{ $ligne->produit->marque }}</div>
                            @endif
                        </td>
                        <td>{{ $ligne->produit->reference }}</td>
                        <td class="text-center">{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                        <td class="text-center">{{ $ligne->quantite }}</td>
                        <td class="text-right">{{ number_format($ligne->sous_total, 0, ',', ' ') }} FCFA</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totaux et notes -->
        <div class="totaux-section">
            <div class="notes-block">
                <h3>NOTES ET CONDITIONS</h3>
                <div class="notes-content">
                    @if($vente->notes)
                        {{ $vente->notes }}
                    @else
                        • Tous les prix sont en Francs CFA<br>
                        • Paiement à la livraison<br>
                        • Garantie selon les conditions du fabricant<br>
                        • Les retours sous 7 jours avec preuve d'achat<br>
                        • Merci pour votre confiance !
                    @endif
                </div>
            </div>

            <div class="totaux-block">
                <div class="totaux-row">
                    <span>Sous-total :</span>
                    <span>{{ number_format($vente->montant_total, 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="totaux-row">
                    <span>Remise :</span>
                    <span>0 FCFA</span>
                </div>
                <div class="totaux-row">
                    <span>TVA (0%) :</span>
                    <span>0 FCFA</span>
                </div>
                <div class="total-row">
                    <span>TOTAL À PAYER :</span>
                    <span class="montant-total">{{ number_format($vente->montant_total, 0, ',', ' ') }} FCFA</span>
                </div>
                <div style="margin-top: 15px; text-align: center; color: #666; font-size: 11px;">
                    Montant en lettres : <strong>{{ $montantEnLettres ?? '' }}</strong>
                </div>
            </div>
        </div>

        <!-- Signatures -->
        <div class="signature-section">
            <div>
                <div class="signature-line"></div>
                <div style="text-align: center; margin-top: 10px;">
                    Signature du Client<br>
                    <small style="color: #666;">Cachet et signature</small>
                </div>
            </div>
            <div>
                <div class="signature-line"></div>
                <div style="text-align: center; margin-top: 10px;">
                    Pour GARAGE AUTO PLUS<br>
                    <small style="color: #666;">Le Directeur Commercial</small>
                </div>
            </div>
        </div>

        <!-- Cachet et QR code -->
        <div class="cachet-section no-print">
            <div class="cachet">
                PAYÉ<br>
                {{ $vente->created_at->format('d/m/Y') }}
            </div>
        </div>

        <div class="qr-section no-print">
            <div class="qr-placeholder">
                <div style="text-align: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#3498db" viewBox="0 0 16 16">
                        <path d="M2 2h2v2H2V2Z"/>
                        <path d="M6 0v6H0V0h6ZM5 1H1v4h4V1ZM4 12H2v2h2v-2Z"/>
                        <path d="M6 10v6H0v-6h6Zm-5 1v4h4v-4H1Zm11-9h2v2h-2V2Z"/>
                        <path d="M10 0v6h6V0h-6Zm5 1v4h-4V1h4ZM8 1V0h1v2H8v2H7V1h1Zm0 5V4h1v2H8ZM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8H6Zm0 0v1H2V8H1v1H0V7h3v1h3Zm10 1h-1V7h1v2Zm-1 0h-1v2h2v-1h-1V9Zm-4 0h2v1h-1v1h-1V9Zm2 3v-1h-1v1h-1v1H9v1h3v-2h1Zm0 0h3v1h-2v1h-1v-2Zm-4-1v1h1v-2H7v1h2Z"/>
                        <path d="M7 12h1v3h4v1H7v-4Zm9 2v2h-3v-1h2v-1h1Z"/>
                    </svg>
                    <div style="font-size: 9px; margin-top: 5px;">SCAN FOR PAYMENT</div>
                </div>
            </div>
            <div style="font-size: 10px; color: #666;">
                Code facture: {{ $vente->numero_vente }}
            </div>
        </div>

        <!-- Pied de page -->
        <div class="facture-footer">
            <div class="footer-block">
                <h4>CONTACT</h4>
                <p>
                    Tél: +229 21 30 40 50<br>
                    Email: contact@garageautoplus.bj<br>
                    Site: www.garageautoplus.bj
                </p>
            </div>
            <div class="footer-block">
                <h4>HORAIRES</h4>
                <p>
                    Lundi - Vendredi: 8h-18h<br>
                    Samedi: 9h-16h<br>
                    Dimanche: Fermé
                </p>
            </div>
            <div class="footer-block">
                <h4>INFORMATIONS</h4>
                <p>
                    Facture générée le: {{ now()->format('d/m/Y H:i') }}<br>
                    ID Transaction: {{ $vente->id }}<br>
                    Statut: {{ $vente->statut_text }}
                </p>
            </div>
        </div>
    </div>

    <!-- Script pour l'impression -->
    <script>
        // Auto-impression optionnelle (décommentez si vous voulez l'auto-impression)
        // window.onload = function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 1000);
        // };

        // Fonction pour ajouter le montant en lettres
        function nombreEnLettres(nombre) {
            // Cette fonction convertit un nombre en lettres
            // Pour simplifier, on retourne une chaîne vide ou on peut utiliser une librairie
            return '';
        }

        // Ajouter le montant en lettres au chargement
        document.addEventListener('DOMContentLoaded', function() {
            const montant = {{ $vente->montant_total }};
            // Vous pouvez implémenter la conversion ici ou dans le contrôleur
        });

        // Améliorer l'expérience d'impression
        document.querySelector('.btn-print').addEventListener('click', function() {
            // Mettre en surbrillance la zone à imprimer
            const facture = document.querySelector('.facture-container');
            facture.style.boxShadow = '0 0 0 4px rgba(52, 152, 219, 0.3)';
            facture.style.transition = 'box-shadow 0.3s';

            setTimeout(function() {
                facture.style.boxShadow = '';
                window.print();
            }, 300);
        });

        // Gestion du retour
        document.querySelector('.btn-back').addEventListener('click', function(e) {
            if (window.history.length > 1) {
                e.preventDefault();
                window.history.back();
            }
        });
    </script>
</body>
</html>
