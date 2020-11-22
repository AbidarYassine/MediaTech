<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FactureProduit;
use Faker\Generator as Faker;

$factory->define(FactureProduit::class, function (Faker $faker) {
    return [
        'facture_id'=>$faker->numberBetween(1,10),
        'produit_id'=>$faker->numberBetween(1,40),
    ];
});
