<?php

namespace App;
use App\Produit;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class,'facture_produits');
    }
    protected $fillable = [
        'code_facture', 'date_creation', 'client_id',
    ];
}
