<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TrUser::class, function (Faker $faker) {

    return [
        'email' => $faker->safeEmail,
        'password' => bcrypt($faker->password),
        'user_name' => $faker->userName,
        'social_type' => $faker->word,
        'social_id' => $faker->word,
    ];
});
