<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
    'name'           => $faker->name,
    'email'          => $faker->unique()->safeEmail,
    'password'       => bcrypt('123456'),
    'birthday'       => $faker->date(),
    'avatar'         => $faker->imageUrl($width = 250, $height = 250),
    'address'        => $faker->address,
    'phone'          => $faker->e164PhoneNumber,
    'status'         => $faker->randomElement(array('1','0')),
    'token_confirm'  => str_random(10),
    'gender'         => $faker->randomElement(array('1','0')),
    'about'          => $faker->text(),
    ];
});
use App\Models\Role;
$factory->define(Role::class, function (Faker $faker) {
    static $typeId;

    return [
        'name' => $faker->word,
        'type' => $faker->randomElement([1, 2]),
    ];
});

// Define factory for Teacher
use App\Models\Post;
$factory->define(Post::class, function (Faker $faker) {
    $description = $faker->text();
    $birthday = $faker->date();
    $gender = $faker->randomElement(array(0,1));
    return [
        'title' => $faker->name,
        'description' => $description,
        'image' => $faker->imageUrl($width = 250, $height = 250),
        'content' => $description ,
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
    ];
});

use App\Models\ReviewPost;
$factory->define(ReviewPost::class, function (Faker $faker) {
    $name = str_random(20);
    $description = $faker->text();
    $status = $faker->randomElement(array('1','0'));
    $voting_helpful = $faker->randomNumber;
    $rating = $faker->numberBetween(1,5);
    return [
        'name' => $name,
        'description' => $description,
        'status' => $status,
        'number_of_likes' => $voting_helpful,
        'rating' => $rating,
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'post_id' => function () {
            return factory(App\Models\Post::class)->create()->id;
        }
    ];
});

$factory->define(App\Models\Media::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl(),
        'type' => rand(0, 1),
    ];
});

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name'=> $faker->name(),
        'description'=> $faker->text()
    ];
});


$factory->define(App\Models\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});