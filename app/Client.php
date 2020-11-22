<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function factures()
    {
        return $this->hasMany('App\Facture');
    }
    protected $fillable = [
        'nom', 'prenom', 'code_client','tele'
    ];
}
