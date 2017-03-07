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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(API\Models\Customer::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstNameMale,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'gender' => 'male',
        'country' => $faker->stateAbbr,
    ];
});

$factory->define(API\Models\Transactions\Payment::class, function (Faker\Generator $faker) {
    return [
        'amount' => rand(1, 100),
        'type' => $faker->randomElement([
            API\Models\Transactions\Payment::DEPOSIT,
            API\Models\Transactions\Payment::WITHDRAW,
        ]),
        'created_at' => $faker->dateTimeThisMonth,
    ];
});
