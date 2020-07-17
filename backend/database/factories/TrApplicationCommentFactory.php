<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TrApplicationComment::class, function (Faker $faker) {
    return [
        'tr_application_id' => '',
        'tr_user_id' => factory(App\Models\TrUser::class),
        'user_name' => $faker->name,
        'post_comment' => $faker->realText(255),
    ];
});
