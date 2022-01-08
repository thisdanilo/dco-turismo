<?php

namespace Modules\Airport\Database\factories;
use Modules\City\Entities\City;
use Modules\Airport\Entities\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Airport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city_id' => City::factory()->create(),
            'name' => $this->faker->name,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'address' => $this->faker->streetName,
            'number' => $this->faker->buildingNumber,
            'zip_code' => $this->faker->postcode
        ];
    }
}
