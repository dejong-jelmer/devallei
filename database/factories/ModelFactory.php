<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Coachdata;
use App\Models\Attendance;
use App\Models\Studentdata;

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
    ];
});

$factory->define(Coachdata::class, function (Faker\Generator $faker) {
    
    return [
        'voornaam' => $faker->name,
        'tussenvoegsel' => str_random(2),
        'achternaam' => $faker->name,
        'email' => $faker->email,
        'huisnummer' => random_int(0, 999)."",
        'mobiel' => random_int(0000000000, 9999999999)."",
        'postcode' => random_int(0000, 9999) . str_random(2),
        'straat' => str_random(5),
        'telefoon' => random_int(0000000000, 9999999999)."",
    ];
});

$factory->define(Student::class, function (Faker\Generator $faker) {
    return [
        'status_id' => 1,
        'allowed' => true,

    ];
});


$factory->define(Status::class, function (Faker\Generator $faker) {
    return [
        'status' => str_random(5),
    ];
});

$factory->define(Studentdata::class, function (Faker\Generator $faker) {
    return [
        'voornaam' => $faker->name,
        'tussenvoegsel' => str_random(2),
        'achternaam' => $faker->name,
        'email' => $faker->email,
        'huisnummer' => random_int(0, 999)."",
        'postcode' => random_int(0000, 9999) . str_random(2),
        'straat' => str_random(5),
        'telefoon_1' => random_int(0000000000, 9999999999)."",
        'leerlingnummer' => random_int(00000, 99999)."",
    ];
});



