<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Meeting;
use App\User;
use Faker\Generator as Faker;

$factory->define(Meeting::class, function (Faker $faker) {
    return [
    'meeting_name' => $faker->name,
    'owner_id' => User::all()->random(1)->pluck('id')[0]
    ];
});
