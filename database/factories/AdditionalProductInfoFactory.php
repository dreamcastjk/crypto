<?php

namespace Database\Factories;

use App\Models\AdditionalProductInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdditionalProductInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdditionalProductInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'notes' => $this->faker->text(50),
            'overview' => $this->faker->text(50),
            'payment' => $this->faker->text(50),
            'warranty' => $this->faker->text(50),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
