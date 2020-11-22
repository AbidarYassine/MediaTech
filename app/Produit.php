<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Facture;

class Produit extends Model
{
    public function factures()
    {
        return $this->belongsToMany(Facture::class,'facture_produits');
    }
    protected $fillable = [
        'ref_produit', 'prix_unitaire', 'quantity_stock', 'libelle',
    ];
    //     $user = User::find(2);
    // $roleIds = [1, 2];
    // $user->roles()->attach($roleIds);
}
