<?php

namespace Modules\City\Tests\Feature\Entities;

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
}
