<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeProduit extends Model
{
    protected $fillable = [
        'reference',
        'nom',
        'description',
        'image',
    ];


    public function produits()
{
    return $this->hasMany(Produit::class, 'type_produit_id');
}

}
