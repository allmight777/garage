<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reference',
        'nom',
        'description',
        'image',
        'marque',
        'modele',
        'prix_achat',
        'prix_vente',
        'stock_actuel',
        'seuil_alerte',
        'stock_status',
        'taux_tva',
        'unite_mesure',
        'est_actif',
        'type_produit_id'
    ];

    protected $casts = [
        'prix_achat' => 'decimal:2',
        'prix_vente' => 'decimal:2',
        'stock_actuel' => 'integer',
        'seuil_alerte' => 'integer',
        'taux_tva' => 'decimal:2',
        'est_actif' => 'boolean'
    ];

    public function typeProduit()
    {
        return $this->belongsTo(TypeProduit::class);
    }

    /**
     * Scope pour les produits en stock faible
     */
    public function scopeStockFaible($query)
    {
        return $query->where('stock_status', 'faible');
    }

    /**
     * Scope pour les produits en rupture
     */
    public function scopeRupture($query)
    {
        return $query->where('stock_status', 'rupture');
    }

    /**
     * Scope pour les produits en stock normal
     */
    public function scopeStockNormal($query)
    {
        return $query->where('stock_status', 'normal');
    }

    /**
     * Calculer la marge
     */
    public function getMargeAttribute()
    {
        return $this->prix_vente - $this->prix_achat;
    }

    /**
     * Calculer le pourcentage de marge
     */
    public function getPourcentageMargeAttribute()
    {
        if ($this->prix_achat > 0) {
            return (($this->prix_vente - $this->prix_achat) / $this->prix_achat) * 100;
        }
        return 0;
    }

    /**
     * Calculer la valeur du stock
     */
    public function getValeurStockAttribute()
    {
        return $this->stock_actuel * $this->prix_achat;
    }

    /**
     * Mettre à jour le statut de stock
     */
    public function updateStockStatus()
    {
        if ($this->stock_actuel == 0) {
            $this->stock_status = 'rupture';
        } elseif ($this->stock_actuel <= ($this->seuil_alerte * 0.3)) {
            $this->stock_status = 'faible';
        } else {
            $this->stock_status = 'normal';
        }

        $this->save();
    }
}
