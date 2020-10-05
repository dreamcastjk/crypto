<?php

namespace Database\Factories;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

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
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->colorName,
            'hashrate' => $this->faker->randomNumber(2),
            'hashrate_unit' => $this->faker->regexify('[a-zA-Z]{2}'),
            'weight' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomNumber(4),
            'in_store_count' => $this->faker->randomNumber(3),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
