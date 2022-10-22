<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\:Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'       => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'quantity'    => fake()->numberBetween(1,300),
            'sku'         => fake()->regexify('[A-Za-z0-9]{6}'),
            'merchant_id' => Merchant::all()->random()->id,
        ];
    }
}
