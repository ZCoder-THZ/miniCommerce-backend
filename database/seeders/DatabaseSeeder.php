<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Models\ItemType;
use App\Models\SubCategory;
use App\Models\ItemCondition;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(5)->create();
        SubCategory::factory()->count(1)->create();
        Category::factory()->count(9)->create();
        Item::factory()->count(30)->create();
         ItemType::factory()->count(3)->create();
          ItemCondition::factory()->count(3)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
