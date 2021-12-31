<?php

namespace Modules\State\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\State\Entities\State;

class StateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = State::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'abbr' => $this->faker->firstName
        ];
    }
}
