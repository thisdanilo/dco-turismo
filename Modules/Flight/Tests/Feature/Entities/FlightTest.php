<?php

namespace Modules\Flight\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Flight\Entities\Flight;
use Modules\Airport\Entities\Airport;

class FlightTest extends TestCase
{
    public function test_a_plane_has_origin()
    {
        $flight = Flight::factory()->hasOrigin()->create();

        $flight->load('origin');

        $this->assertInstanceOf(Airport::class, $flight->origin);
    }

    public function test_a_plane_has_destination()
    {
        $flight = Flight::factory()->hasDestination()->create();

        $flight->load('destination');

        $this->assertInstanceOf(Airport::class, $flight->destination);
    }

    public function test_it_search_flights()
    {
        $flights = Flight::factory()->hasOrigin()->hasDestination()->create([
            'date' => now()->format('d/m/Y')
        ]);

        $flights->load([
            'origin',
            'destination'
        ]);

        $search_flights = $flights->searchFlights($flights->origin->id, $flights->destination->id, now()->format('d/m/Y'));

        $this->assertEquals(1, $search_flights->count());
    }

    public function test_it_promotions()
    {
        $flights = Flight::factory()->create([
            'is_promotion' => true,
            'date' => now()->format('Y-m-d')
        ]);

        $promotions = $flights->promotions();

        $this->assertEquals(1, $promotions->count());
    }
}
