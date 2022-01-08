<?php

namespace Modules\User\Database\factories;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' =>  $this->faker->email,
            'password' => bcrypt('1234556789'),
            'is_admin' => 1
        ];
    }
}
