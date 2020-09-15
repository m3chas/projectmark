<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Post model Factorie
|--------------------------------------------------------------------------
|
| This will be used to seed the DB with the users created on each post
|
*/

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description' => $faker->paragraph,
        'publication_date' => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now', $timezone = null)
    ];
});
