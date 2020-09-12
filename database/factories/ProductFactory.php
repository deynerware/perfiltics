<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id'       => rand(1,5),
        'name'              => $faker->word,
        'price'             => rand(1000, 50000),
        'quantity'          => rand(20,100)
    ];
});
