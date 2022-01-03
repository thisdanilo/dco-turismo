<?php

namespace Modules\Flight\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Flight\Entities\Flight;
use Modules\Airport\Entities\Airport;

class FlightTest extends TestCase
{
    public function test_a_plane_belongs_to_origin()
    {
        $flight = Flight::factory()->hasOrigin()->create();

        $flight->load('origin');

        $this->assertInstanceOf(Airport::class, $flight->origin);
    }

    public function test_a_plane_belongs_to_destination()
    {
        $flight = Flight::factory()->hasDestination()->create();

        $flight->load('destination');

        $this->assertInstanceOf(Airport::class, $flight->destination);
    }
}
