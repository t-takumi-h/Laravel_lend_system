<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->word . "オシロ",
        'part_num' => $faker->word . "PN",
        'vendor' => $faker->word . "社",
        'category_id' => "",
        'table_id' => 1,
    ];
});
