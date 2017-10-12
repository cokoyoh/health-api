<?php

use Faker\Generator as Faker;

$factory->define(App\Applink::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5, true),
        'description' => $faker->paragraphs(2, true),
        'uri' =>  "https://play.google.com/store/apps/details?id=comm.cchong.BloodAssistant",
    ];
});
