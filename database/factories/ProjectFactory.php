<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Project::class, function (Faker $faker) {
    return [
        'name'=>$faker->streetName,
        'client_id'=>rand(1,50),
        'description'=>$faker->realText(200),
        'estimation'=>$faker->randomFloat(2, 1, 1000),
        'time_spent'=>$faker->randomFloat(2, 1, 1000),
        'status'=>$faker->randomElement(['ongoing','in_progress','finished'])
    ];
});
