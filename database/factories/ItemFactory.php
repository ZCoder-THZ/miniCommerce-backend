<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'item_name' => $faker->sentence,

            'category_id' => rand(1, 10), // Assuming category IDs range from 1 to 10
            'user_id' => rand(1, 20), // Assuming user IDs range from 1 to 100
            'uploader'=>$faker->sentence,
            'price' => $faker->randomNumber(4),
            'description' => $faker->paragraph,
            'item_condition' => $faker->randomElement(['second', 'used', 'new']),
            'item_type' => $faker->randomElement(['sell', 'buy', 'exchanged']),
            'status' => $faker->randomElement(['avaliable', 'unavaliable']),
            'image' => $faker->imageUrl(),
               'ltd' => $faker->latitude,
              'lng' => $faker->longitude,
            'phone' => $faker->numerify('##########'), // Assuming 10-digit phone numbers
            'address' => $faker->address,

        ];
    }
}
