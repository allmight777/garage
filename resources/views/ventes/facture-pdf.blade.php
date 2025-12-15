<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
  <link rel="shortcut icon" href="{{ asset('images/logo.webp') }}" type="image/x-icon">
<title>Facture {{ $vente->numero_vente }}</title>
<style>
/* Reset et style global */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

@page {
    size: A4;
    margin: 15mm; /* marges plus confortables */
}

body {
    font-family: 'DejaVu Sans', sans-serif;
    font-size: 10px;
    line-height: 1.5;
    color: #2c3e50;
    background: #fff;
    padding: 5mm;
}

/* Conteneur */
.facture-container {
    width: 100%;
    page-break-inside: avoid;
    padding: 5mm;
}

/* HEADER */
.facture-header {
    display: flex;
    justify-content: space-between;
    border-bottom: 2px solid #2c3e50;
    padding-bottom: 8px;
    margin-bottom: 10px;
}

.entreprise-nom {
    font-size: 20pt;
    font-weight: bold;
    color: #2c3e50;
}

.entreprise-details {
    font-size: 9pt;
    line-height: 1.4;
    margin-top: 2mm;
}

.facture-titre h1 {
    font-size: 28pt;
    color: #e74c3c;
    margin-bottom: 0;
}

.numero-facture {
    font-size: 12pt;
    font-weight: bold;
}

.statut-badge {
    display: inline-block;
    padding: 3px 8px;
    background: {{ $vente->statut == 'terminee' ? '#27ae60' : '#e74c3c' }};
    color: #fff;
    font-size: 9pt;
    font-weight: bold;
    border-radius: 3px;
    margin-top: 3px;
}

/* INFOS */
.info-section {
    display: flex;
    gap: 10mm;
    margin-bottom: 10px;
}

.info-block {
    flex: 1;
    border: 0.5px solid #ccc;
    padding: 5mm;
    border-radius: 3px;
}

.info-block h3 {
    font-size: 10pt;
    border-bottom: 1px solid #3498db;
    margin-bottom: 3px;
    padding-bottom: 2px;
}

.info-item {
    font-size: 9pt;
    margin-bottom: 2px;
}

/* TABLE PRODUITS */
.produits-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 9pt;
    margin-bottom: 10px;
}

.produits-table th {
    background: #2c3e50;
    color: #fff;
    padding: 4px;
    text-align: center;
}

.produits-table td {
    border-bottom: 0.5px solid #ddd;
    padding: 4px;
}

.text-center { text-align: center; }
.text-right { text-align: right; }

/* TOTAUX */
.totaux-section {
    display: flex;
    gap: 10mm;
    margin-bottom: 10px;
}

.notes-block, .totaux-block {
    border: 0.5px solid #ccc;
    padding: 5mm;
    border-radius: 3px;
}

.totaux-row {
    display: flex;
    justify-content: space-between;
    font-size: 9pt;
    margin-bottom: 2px;
}

.total-row {
    border-top: 1px solid #000;
    font-weight: bold;
    margin-top: 4px;
    padding-top: 2px;
}

.montant-total {
    color: #e74c3c;
    font-size: 12pt;
    font-weight: bold;
}

/* Montant en lettres */
.montant-lettres {
    font-size: 8pt;
    margin-top: 4px;
    background: #f4f4f4;
    padding: 3px;
    text-align: center;
    border-radius: 2px;
}

/* Signature */
.signature-section {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
}

.signature-block {
    width: 45%;
    text-align: center;
    font-size: 9pt;
}

.signature-line {
    border-bottom: 1px solid #000;
    margin: 10px auto 3px;
    width: 80%;
}

/* Cachet */
.cachet {
    margin-top: 10px;
    text-align: right;
    font-size: 9pt;
    font-weight: bold;
    color: #e74c3c;
}

/* Footer */
.facture-footer {
    margin-top: 15px;
    border-top: 1px solid #ccc;
    display: flex;
    font-size: 8pt;
    padding-top: 3px;
}

.footer-block {
    flex: 1;
    text-align: center;
}
</style>
</head>
<body>
<div class="facture-container">

<!-- HEADER -->
<div class="facture-header">
    <div>
        <div class="entreprise-nom">{{ $entreprise['nom'] }}</div>
        <div class="entreprise-details">
            Adresse : {{ $entreprise['adresse'] }}<br>
            Téléphone : {{ $entreprise['telephone'] }}<br>
            Email : {{ $entreprise['email'] }}<br>
            RCCM : {{ $entreprise['rccm'] }}<br>
            NIF : {{ $entreprise['nif'] }}
        </div>
    </div>
    <div style="text-align:right">
        <h1>FACTURE</h1>
        <div class="numero-facture">{{ $vente->numero_vente }}</div>
        <div class="statut-badge">
            {{ strtoupper($vente->statut == 'terminee' ? 'PAYÉE' : 'ANNULÉE') }}
        </div>
    </div>
</div>

<!-- INFOS -->
<div class="info-section">
    <div class="info-block">
        <h3>CLIENT</h3>
        {{ $vente->client->nom_complet ?? 'Client non enregistré' }}
    </div>
    <div class="info-block">
        <h3>DÉTAILS</h3>
        Date : {{ $vente->created_at->format('d/m/Y H:i') }}<br>
        Vendeur : {{ $vente->vendeur->name }}<br>
        Paiement : {{ ucfirst($vente->mode_paiement_text) }}
    </div>
</div>

<!-- TABLE PRODUITS -->
<table class="produits-table">
<thead>
<tr>
<th>#</th>
<th>Désignation</th>
<th>Réf</th>
<th class="text-center">PU</th>
<th class="text-center">Qté</th>
<th class="text-right">Total</th>
</tr>
</thead>
<tbody>
@foreach($vente->ligneVentes as $i=>$ligne)
<tr>
<td class="text-center">{{ $i+1 }}</td>
<td>{{ $ligne->produit->nom }}</td>
<td>{{ $ligne->produit->reference }}</td>
<td class="text-center">{{ number_format($ligne->prix_unitaire,0,' ',' ') }}</td>
<td class="text-center">{{ $ligne->quantite }}</td>
<td class="text-right">{{ number_format($ligne->sous_total,0,' ',' ') }}</td>
</tr>
@endforeach
</tbody>
</table>

<!-- TOTAUX -->
<div class="totaux-section">
    <div class="notes-block">
        Conditions : Paiement à la livraison – FCFA
    </div>
    <div class="totaux-block">
        <div class="totaux-row"><span>Sous-total</span><span>{{ number_format($vente->montant_total,0,' ',' ') }}</span></div>
        <div class="total-row"><span>TOTAL</span><span class="montant-total">{{ number_format($vente->montant_total,0,' ',' ') }} FCFA</span></div>
        <div class="montant-lettres">{{ $montantEnLettres }}</div>
    </div>
</div>

<!-- CACHET -->
<div class="cachet">
PAYÉ – {{ $vente->created_at->format('d/m/Y') }}
</div>

<!-- SIGNATURE -->
<div class="signature-section">
    <div class="signature-block">
        <div class="signature-line"></div>
        Client
    </div>
    <div class="signature-block">
        <div class="signature-line"></div>
        {{ $entreprise['nom'] }}
    </div>
</div>

<!-- FOOTER -->
<div class="facture-footer">
    <div class="footer-block">{{ $entreprise['nom'] }}</div>
    <div class="footer-block">{{ $entreprise['telephone'] }}</div>
    <div class="footer-block">Page 1/1</div>
</div>

</div>
</body>
</html>
