<?php

use App\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $user = User::inRandomOrder()-> first();
    $category = Category::inRandomOrder()-> first();
    return [
        'title' => $faker->sentence(6,true),
        'body' => $faker-> paragraphs(3,true),
        'user_id' => $user->id,
        'category_id' => $category->id
    ];
});
