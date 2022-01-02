<?php

namespace Modules\Plane\Database\factories;

use Modules\Plane\Entities\Plane;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Bland\Entities\Bland;

class PlaneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plane::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bland_id' => Bland::factory()->create(),
            'total_passengers' => $this->faker->numberBetween,
            'class' => $this->faker->randomElement(['EC', 'LU'])
        ];
    }
}
