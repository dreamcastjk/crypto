<?php

namespace Database\Factories;

use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber,
            'telegram' => $this->faker->phoneNumber,
            'facebook' => $this->faker->randomNumber(5),
            'vk' => $this->faker->url,
            'skype' => $this->faker->slug(1),
            'whatsup' => $this->faker->phoneNumber,
        ];
    }
}
