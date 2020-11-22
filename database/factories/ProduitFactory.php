<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produit;
use Faker\Generator as Faker;

$factory->define(Produit::class, function (Faker $faker) {
    return [
        'ref_produit'=>'PRO_' . $faker->unique()->numberBetween(1001, 20000),
        'prix_unitaire'=>$faker->numberBetween(50.50, 6000.50),
        'quantity_stock'=>$faker->numberBetween(3, 900),
        'libelle'=>$faker->name,
    ];
});
