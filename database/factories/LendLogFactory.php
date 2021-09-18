<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\LendLog;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(LendLog::class, function (Faker $faker) {
    return [
        'item_id' => 1,
        'borrower_id' => $faker->randomElement(['1', '2']),
        'borrow_at' => now(),
        'return_expect' => now()->format('Y-m-d'),
        'return_at' => now()->addDay(3),
        'was_returned' => 1,
    ];
});
