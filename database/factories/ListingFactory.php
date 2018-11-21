<?php

use Faker\Generator as Faker;

$factory->define(App\Listing::class, function (Faker $faker) {
    return [
        'street_address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zip_code' => $faker->postcode,
        'lng' => $faker->longitude,
        'lat' => $faker->latitude,
        'apt_num' => $faker->randomDigit,
        'date_available' => $faker->dateTimeBetween($startDate = '-30 days', $max = '+6 months'),
        'monthly_price' => $faker->numberBetween($min = 200, $max = 2500),
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'num_beds' => $faker->numberBetween($min = 1, $max = 3),
        'num_baths' => $faker->numberBetween($min = 1, $max = 3),
        'square_ft' => $faker->numberBetween($min = 750, $max = 2500),
    ];
});
