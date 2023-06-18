<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ItemType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemType>
 */
// database/factories/ItemTypeFactory.php



class ItemTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_type' => $this->faker->randomElement(['sell', 'buy', 'exchanged']),
        ];
    }
}

