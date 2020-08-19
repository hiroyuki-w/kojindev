<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TrFeedbackComment::class, function (Faker $faker) {
    return [
        'tr_feedback_id' => '',
        'comment_tr_user_id' => '',
        'feedback_comment' => $faker->realText(200),
    ];
});
