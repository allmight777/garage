<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'numero_vente',
        'client_id',
        'client_nom',
        'client_telephone',
        'client_adresse',
        'montant_total',
        'mode_paiement',
        'user_id',
        'notes',
        'statut'
    ];

    protected $casts = [
        'montant_total' => 'decimal:0',
        'created_at' => 'datetime:d/m/Y H:i'
    ];

    // Générer numéro vente
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($vente) {
            if (empty($vente->numero_vente)) {
                $date = date('Ymd');
                $last = self::where('numero_vente', 'like', "V{$date}-%")
                    ->orderBy('numero_vente', 'desc')
                    ->first();

                $next = $last ? intval(substr($last->numero_vente, -4)) + 1 : 1;
                $vente->numero_vente = "V{$date}-" . str_pad($next, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    // Relations
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vendeur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ligneVentes()
    {
        return $this->hasMany(LigneVente::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'ligne_ventes')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }

    // Accesseurs
    public function getMontantFormattedAttribute()
    {
        return number_format($this->montant_total, 0, ',', ' ') . ' FCFA';
    }

    public function getModePaiementTextAttribute()
    {
        $modes = [
            'especes' => 'Espèces',
            'mobile_money' => 'Mobile Money',
            'carte' => 'Carte bancaire',
            'cheque' => 'Chèque'
        ];
        return $modes[$this->mode_paiement] ?? $this->mode_paiement;
    }

    public function getStatutTextAttribute()
    {
        $statuts = [
            'en_cours' => 'En cours',
            'terminee' => 'Terminée',
            'annulee' => 'Annulée'
        ];
        return $statuts[$this->statut] ?? $this->statut;
    }

    public function getClientInfoAttribute()
    {
        if ($this->client_id) {
            return $this->client->nom_complet;
        }
        return $this->client_nom ?: 'Client non enregistré';
    }

    // Scopes
 // Dans app/Models/Vente.php, ajoutez ces scopes :

public function scopeTerminees($query)
{
    return $query->where('statut', 'terminee');
}

public function scopeToday($query)
{
    return $query->whereDate('created_at', today());
}

public function scopeThisMonth($query)
{
    return $query->whereMonth('created_at', now()->month)
                 ->whereYear('created_at', now()->year);
}

public function scopeBetweenDates($query, $startDate, $endDate)
{
    return $query->whereBetween('created_at', [$startDate, $endDate]);
}
}
