<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Leave;
use Faker\Generator as Faker;

$factory->define(Leave::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'reason' => $faker->sentence(10),
        'type' => $faker->sentence(2),
        'start' => now(),
        'end' => now(),
        'halfDay' => 1,
        'status' => 1
    ];
});
