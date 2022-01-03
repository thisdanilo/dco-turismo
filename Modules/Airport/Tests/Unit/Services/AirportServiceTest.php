<?php

namespace Modules\Airport\Tests\Unit\Services;

use Tests\TestCase;
use Modules\Airport\Entities\Airport;
use Modules\Airport\Services\AirportService;

class AirportServiceTest extends TestCase
{
    protected $airport_service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->airport_service = new AirportService();
    }

    public function test_route_update_or_create_exception()
    {
        $this->expectException(\Exception::class);

        $this->airport_service->updateOrCreate([]);
    }

    public function test_route_delete_exception()
    {
        $this->expectException(\Exception::class);

        $airport = $this->mock(Airport::class);

        $this->airport_service->removeData($airport);
    }
}
