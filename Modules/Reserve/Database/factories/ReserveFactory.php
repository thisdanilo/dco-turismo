<?php

namespace Modules\Reserve\Database\factories;

use App\Models\User;
use Modules\Flight\Entities\Flight;
use Modules\Reserve\Entities\Reserve;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReserveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reserve::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'flight_id' => Flight::factory()->create(),
            'user_id' => User::factory()->create(),
            'date_reserved' => $this->faker->dateTime,
            'status' => Reserve::RESERVED
        ];
    }
}
