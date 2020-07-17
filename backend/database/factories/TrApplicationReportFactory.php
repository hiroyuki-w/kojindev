<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TrApplicationReport::class, function (Faker $faker) {
    return [
        'tr_application_id' => '',
        'report_type' => $faker->numberBetween(1, 3),
        'report_title' => $faker->realText(15),
        'report_text' => $faker->realText(255),
    ];
});
