<?php
use Faker\Provider\Lorem;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Model\Category::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name' => $faker->name,
        'slug' => str_slug($name),
    ];
});

$factory->define(App\Model\Blog::class, function (Faker\Generator $faker) {
    $title = $faker->name;
    return [
        'category_id' => rand(1, 50),
        'title'       => $title,
        'slug'        => str_slug($title),
        'content'     => $faker->text,
        'thumbnail'   => 'http://lorempixel.com/400/200/sports/3',
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s'),
    ];
});
