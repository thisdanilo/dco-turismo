<?php

namespace Modules\Airport\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\City\Entities\City;
use Modules\Airport\Entities\Airport;

class AirportTest extends TestCase
{
    public function test_it_airport_has_city()
    {
        $airport = Airport::factory()->hasCity()->create();

        $airport->load('city');

        $this->assertInstanceOf(City::class, $airport->city);
    }
}
