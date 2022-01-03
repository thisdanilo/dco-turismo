<?php

namespace Modules\Flight\Tests\Unit\Services;

use Tests\TestCase;
use Modules\Flight\Entities\Flight;
use Modules\Flight\Services\FlightService;

class FlightServiceTest extends TestCase
{
    protected $flight_service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->flight_service = new FlightService();
    }

    public function test_route_update_or_create_exception()
    {
        $this->expectException(\Exception::class);

        $this->flight_service->updateOrCreate([]);
    }

    public function test_route_delete_exception()
    {
        $this->expectException(\Exception::class);

        $flight = $this->mock(Flight::class);

        $this->flight_service->removeData($flight);
    }
}
