<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'adresse'
    ];

    // Relations
    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    // Accesseurs
    public function getNomCompletAttribute()
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    public function getTelephoneFormattedAttribute()
    {
        return $this->telephone ?: 'Non renseigné';
    }

    // Scopes


public function scopeRechercher($query, $search)
{
    return $query->where('nom', 'like', "%{$search}%")
        ->orWhere('prenom', 'like', "%{$search}%")
        ->orWhere('telephone', 'like', "%{$search}%");
}
}
