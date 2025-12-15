<?php
// app/Models/LigneVente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneVente extends Model
{
    use HasFactory;

    protected $fillable = [
        'vente_id',
        'produit_id',
        'quantite',
        'prix_unitaire'
    ];

    protected $casts = [
        'quantite' => 'integer',
        'prix_unitaire' => 'decimal:0'
    ];

    // Relations
    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    // Accesseur
    public function getSousTotalAttribute()
    {
        return $this->quantite * $this->prix_unitaire;
    }

    // Événements pour gestion automatique du stock
    protected static function boot()
    {
        parent::boot();

        static::created(function ($ligneVente) {
            if ($ligneVente->vente->statut === 'terminee') {
                $ligneVente->produit->decrement('stock_actuel', $ligneVente->quantite);
                $ligneVente->produit->updateStockStatus();
            }
        });

        static::updating(function ($ligneVente) {
            if ($ligneVente->vente->statut === 'terminee') {
                $ancien = LigneVente::find($ligneVente->id);
                if ($ancien) {
                    $difference = $ancien->quantite - $ligneVente->quantite;
                    if ($difference != 0) {
                        $ligneVente->produit->increment('stock_actuel', $difference);
                        $ligneVente->produit->updateStockStatus();
                    }
                }
            }
        });

        static::deleting(function ($ligneVente) {
            if ($ligneVente->vente->statut === 'terminee') {
                $ligneVente->produit->increment('stock_actuel', $ligneVente->quantite);
                $ligneVente->produit->updateStockStatus();
            }
        });
    }
}
