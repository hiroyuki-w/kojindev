<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TrApplication::class, function (Faker $faker) {
    return [
        'tr_user_id' => '',
        'application_name' => $faker->word,
        'application_concept' => $faker->realText(36),
        'application_overview' => $faker->realText(150),
        'public_flg' => $faker->boolean,
        'application_type' => $faker->numberBetween(1, 3),
        'used_technology' => $faker->realText(150),
        'pr_message' => $faker->realText(150),
        'additional_features' => $faker->realText(150),
        'other_message' => $faker->realText(150),
        'application_url' => $faker->url,
    ];
});
