<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ItemCondition;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemCondition>
 */
// database/factories/ItemConditionFactory.php



class ItemConditionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemCondition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_condition' => $this->faker->randomElement(['second', 'used', 'new']),
        ];
    }
}

