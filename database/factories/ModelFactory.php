<?php

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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Oracle::class, function (Faker\Generator $faker) {
    return [
        'date' => $faker->date,
        'db' => $faker->sentence,
        'type' => $faker->sentence,
        'last_bk' => $faker->date,
        'retried' => $faker->boolean,
        'num_failed_bk' => $faker->numberBetween($min = 1, $max = 5),
        //'session' => $faker->numberBetween($min = 1000, $max = 9000),
        'host' => $faker->sentence,
        'observation' => $faker->paragraph,
    ];
});
$factory->define(App\Australia::class, function (Faker\Generator $faker) {
    return [
        'date' => $faker->date,
        'session' => $faker->numberBetween($min = 1, $max = 5),
        'specification' => $faker->sentence,
        'host' => $faker->sentence,
        'type' => $faker->sentence,
        'retried' => $faker->boolean,
        'new_session' => $faker->numberBetween($min = 1, $max = 5),
        'incident' => $faker->numberBetween($min = 10000, $max = 20000),
        'link' => $faker->sentence,
        'end_ok' => $faker->boolean,
        'observations' => $faker->paragraph,
    ];
});
