<?php

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    $user = User::inRandomOrder()->first();
    $post = Post::inRandomOrder()->first();
    return [
        'comment' => $faker->paragraphs(2,true),
        'user_id' => $user->id,
        'post_id' => $post->id
    ];
});
