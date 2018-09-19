<?php

use Faker\Generator as Faker;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'user_id'=>rand(1,2),
        'discussion_id'=>rand(1,20),
        'contents'=>$faker->text(rand(20,200))
    ];
});
