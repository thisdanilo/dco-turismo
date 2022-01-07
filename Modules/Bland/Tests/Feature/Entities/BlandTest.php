<?php

namespace Modules\Bland\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\Bland\Entities\Bland;
use Modules\Plane\Entities\Plane;

class BlandTest extends TestCase
{
    public function test_bland_has_planes()
    {
        $bland = Bland::factory()->hasPlanes(2)->create();

        $bland->load('planes');

        $this->assertInstanceOf(Plane::class, $bland->planes->first());

        $this->assertInstanceOf(Plane::class, $bland->planes->last());
    }
}
