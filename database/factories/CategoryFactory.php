<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'category_name' => $faker->word,
            'category_image' => $faker->imageUrl(),

            'status' => $faker->randomElement(['publish', 'hidden']),
        ];
    }
}
