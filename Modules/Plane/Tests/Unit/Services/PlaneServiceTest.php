<?php

namespace Modules\Plane\Tests\Unit\Services;

use Tests\TestCase;
use Modules\Plane\Entities\Plane;
use Modules\Plane\Services\PlaneService;

class PlaneServiceTest extends TestCase
{
    protected $plane_service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->plane_service = new PlaneService();
    }

    public function test_route_update_or_create_exception()
    {
        $this->expectException(\Exception::class);

        $this->plane_service->updateOrCreate([]);
    }

    public function test_route_delete_exception()
    {
        $this->expectException(\Exception::class);

        $plane = $this->mock(Plane::class);

        $this->plane_service->removeData($plane);
    }
}
