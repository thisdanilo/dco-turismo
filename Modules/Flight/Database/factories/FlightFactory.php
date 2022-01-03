<?php

namespace Modules\Flight\Database\factories;

use Modules\Plane\Entities\Plane;
use Modules\Flight\Entities\Flight;
use Modules\Airport\Entities\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flight::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plane_id' => Plane::factory()->create(),
            'airport_origin_id' => Airport::factory()->create(),
            'airport_destination_id' => Airport::factory()->create(),
            'date' => $this->faker->dateTime,
            'time_duration' => $this->faker->time,
            'hour_output' => $this->faker->time,
            'arrival_time' => $this->faker->time,
            'old_price' => '499.00',
            'price' => '399.00',
            'total_prots' =>1,
            'is_promotion' => 'sim',
            'qty_stops' => 1
        ];
    }
}
