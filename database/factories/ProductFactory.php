<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->word();
        return [
            'name' => fake('ar')->word(),
            'description' => fake()->paragraph(3),
            'slug' => Str::slug($name). '-' .fake() ->unique()->numberBetween(1,9999),
            'price' => fake()->randomFloat(2,20,999),
            'store_id' => Store::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id
            //
      ];
    }
}
