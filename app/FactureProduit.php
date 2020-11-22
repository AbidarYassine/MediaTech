<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FactureProduit extends Model
{
    protected $fillable=[
        'facture_id','produit_id','qty'
    ];
}
