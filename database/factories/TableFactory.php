<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Table;
use Faker\Generator as Faker;

$factory->define(Table::class, function (Faker $faker) {
    return [
        'title' => $faker->word . "γγΌγγ«",
        'author_id' => 1,
    ];
});
