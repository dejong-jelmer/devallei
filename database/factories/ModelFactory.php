<?php

use App\Models\User;
use App\Models\Coach;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'naam' => $faker->name,
    ];
});

$factory->define(Coach::class, function (Faker\Generator $faker) {
    
    return [
        'coach' => $faker->name,
        'voornaam' => $faker->name,
        'tussenvoegsel' => str_random(2),
        'achternaam' => $faker->name,
        'email' => $faker->email,
    ];
});


