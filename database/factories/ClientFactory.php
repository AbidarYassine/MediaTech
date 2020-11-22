<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'nom' => $faker->lastName,
        'prenom' => $faker->firstName,
        'code_client' => 'CLI' . $faker->unique()->numberBetween(1001, 20000),
        'tele' => $faker->lastName,
    ];
});
