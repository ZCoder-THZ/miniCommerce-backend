<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class SubcategoryFactory extends Factory
{
    protected $model = Subcategory::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'sub_category_name' => $faker->word,
            'sub_category_image' => $faker->imageUrl(),
            'category_id' => rand(1, 10), // Assuming category IDs range from 1 to 10
            'status' => $faker->randomElement(['publish', 'hidden']),
        ];
    }
}
