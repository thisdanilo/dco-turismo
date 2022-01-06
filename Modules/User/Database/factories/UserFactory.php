<?php

namespace Modules\User\Database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Flight\Entities\Flight;

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
