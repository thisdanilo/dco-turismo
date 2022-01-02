<?php

namespace Modules\Plane\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Bland\Entities\Bland;
use Modules\Plane\Entities\Plane;

class PlaneTest extends TestCase
{
    public function test_a_plane_belongs_to_bland()
    {
        $plane = Plane::factory()->hasBland()->create();

        $plane->load('bland');

        $this->assertInstanceOf(Bland::class, $plane->bland);
    }
}
