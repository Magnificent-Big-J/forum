<?php

use Faker\Generator as Faker;

$factory->define(App\Discussion::class, function (Faker $faker) {
    return [
        'user_id'=>rand(1,2),
        'channel_id'=>rand(1,8),
        'title'=>$faker->text(20),
        'contents'=>$faker->text(rand(50,100))
    ];
});
