<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TrUserProfile::class, function (Faker $faker) {
    return [
        'tr_user_id' => '',
        'user_profile' => $faker->realText(150),
        'user_skillset' => $faker->word,
        'git_account' => $faker->word,
        'twitter_account' => $faker->word,
        'my_url' => $faker->url,

    ];
});
