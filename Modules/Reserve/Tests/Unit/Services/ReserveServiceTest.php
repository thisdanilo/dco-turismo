<?php

namespace Modules\Reserve\Tests\Unit\Services;

use Tests\TestCase;
use Modules\Reserve\Entities\Reserve;
use Modules\Reserve\Services\ReserveService;

class ReserveServiceTest extends TestCase
{
    protected $reserve_service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->reserve_service = new ReserveService();
    }

    public function test_route_update_or_create_exception()
    {
        $this->expectException(\Exception::class);

        $this->reserve_service->updateOrCreate([]);
    }

    public function test_route_delete_exception()
    {
        $this->expectException(\Exception::class);

        $reserve = $this->mock(Reserve::class);

        $this->reserve_service->removeData($reserve);
    }
}
