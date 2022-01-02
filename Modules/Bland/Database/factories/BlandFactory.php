<?php

namespace Modules\Bland\Database\factories;

use Modules\Bland\Entities\Bland;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bland::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name
        ];
    }
}
