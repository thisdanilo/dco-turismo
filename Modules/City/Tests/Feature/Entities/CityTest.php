<?php

namespace Modules\City\Tests\Feature\Entities;

use Modules\Airport\Entities\Airport;
use Tests\TestCase;
use Modules\City\Entities\City;
use Modules\State\Entities\State;

class CityTest extends TestCase
{
    public function test_a_city_belongs_to_state()
    {
        $city = City::factory()->hasState()->create();

        $city->load('state');

        $this->assertInstanceOf(State::class, $city->state);
    }

    public function test_city_has_airports()
    {
        $city = City::factory()->hasAirports(
            Airport::factory()->count(2)
        )
            ->create();

        $city->load('airports');

        $this->assertInstanceOf(Airport::class, $city->airports->first());

        $this->assertInstanceOf(Airport::class, $city->airports->last());
    }
}
