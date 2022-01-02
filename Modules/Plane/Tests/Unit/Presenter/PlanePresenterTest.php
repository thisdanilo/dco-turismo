<?php

namespace Modules\Plane\Tests\Unit\Presenter;

use Tests\TestCase;
use Modules\Plane\Entities\Plane;

class PlanePresenterTest extends TestCase
{
    public function test_it_gets_action_view()
    {
        $plane = new Plane();

        $plane->id = 123;

        $this->assertStringContainsString($plane->id, $plane->actionView());
    }
}
