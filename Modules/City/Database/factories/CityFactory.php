<?php

namespace Modules\City\Database\factories;

use Modules\City\Entities\City;
use Modules\State\Entities\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'state_id' => State::factory()->create()->id,
            'name' => $this->faker->firstName
        ];
    }
}
