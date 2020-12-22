<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Apple::class, function (Faker $faker) {
    return [
        'identity' => $faker->unique()->numberBetween(1,10000),
        'green' => rand(0,220),
        'red'=> rand(0,220),
        'apple2'=> rand(0,220),
        'entry' => rand(0,1),
        'description'=> $faker -> streetAddress,
        'tonnage' => rand(1,50),
        'contract_id' => 9
    ];
});
