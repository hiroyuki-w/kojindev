<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TrApplicationTag::class, function (Faker $faker) {
    return [
        'tr_application_id' => '',
        'tag_name' => $faker->word,
    ];
});
