<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Facture;
use Faker\Generator as Faker;
use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Support\Carbon;

$factory->define(Facture::class, function (Faker $faker) {
    $year = rand(2009, 2016);
    $month = rand(1, 12);
    $day = rand(1, 28);
    $date = $date = Carbon::create($year, $month, $day, 0, 0, 0);
    return [
        'code_facture' => 'FACT' . $faker->unique()->numberBetween(1001, 20000),
        'date_creation' => $date->format('Y-m-d H:i:s'),
        'client_id' => $faker->numberBetween(1, 10),
    ];
});
