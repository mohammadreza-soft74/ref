<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'firstName' => $faker->name,
        'lastName' => $faker->lastName,
        'phone'=> $faker->phoneNumber,
        'nationalCode' => $faker->postcode,
        'address' => $faker->address
    ];
});
