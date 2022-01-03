<?php

namespace Modules\Airport\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\City\Entities\City;
use Modules\Airport\Entities\Airport;
use Modules\Flight\Entities\Flight;

class AirportTest extends TestCase
{
    public function test_a_airport_belongs_to_city()
    {
        $airport = Airport::factory()->hasCity()->create();

        $airport->load('city');

        $this->assertInstanceOf(City::class, $airport->city);
    }
}
