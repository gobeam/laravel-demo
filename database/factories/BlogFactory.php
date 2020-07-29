<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker, $options = []) {
    return [
        'title' => $faker->sentence($nbWords = 1, $variableNbWords = true),
        'user_id' => isset($options['user_id'])? $options['user_id'] :$faker->numberBetween($min = 1, $max = 2),
        'description' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true) ,
        'body' => $faker->text($maxNbChars = 1500) ,
        'status' => $faker->boolean,
        'category_id' => isset($options['category_id'])? $options['category_id'] : $faker->numberBetween($min = 1, $max =9),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
    ];
});
