<?php

namespace Database\Factories;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = $this->faker->unique()->word;

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'hashrate' => $this->faker->randomNumber(2),
            'hashrate_unit' => $this->faker->regexify('[a-zA-Z]{2}'),
            'weight' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomNumber(4),
            'in_store_count' => $this->faker->randomNumber(3),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'image' => [
                'https://via.placeholder.com/500',
                'https://via.placeholder.com/500',
            ]
        ];
    }
}
