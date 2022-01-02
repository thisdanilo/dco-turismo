<?php

namespace Modules\Bland\Tests\Unit\Services;

use Tests\TestCase;
use Modules\Bland\Entities\Bland;
use Modules\Bland\Services\BlandService;

class BlandServiceTest extends TestCase
{
    protected $bland_service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bland_service = new BlandService();
    }

    public function test_route_update_or_create_exception()
    {
        $this->expectException(\Exception::class);

        $this->bland_service->updateOrCreate([]);
    }

    public function test_route_delete_exception()
    {
        $this->expectException(\Exception::class);

        $bland = $this->mock(Bland::class);

        $this->bland_service->removeData($bland);
    }
}
