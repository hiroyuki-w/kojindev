<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TrFeedback::class, function (Faker $faker) {
    return [
        'tr_application_id' => '',
        'feedback_title' => $faker->realText(30),
        'question_1' => $faker->realText(15),
        'question_2' => $faker->realText(15),
        'question_3' => $faker->realText(15),
    ];
});
