<?php

namespace Modules\Airport\Tests\Unit\Presenter;

use Tests\TestCase;
use Modules\Airport\Entities\Airport;

class AirportPresenterTest extends TestCase
{
    public function test_it_gets_action_view()
    {
        $airport = new Airport();

        $airport->id = 123;

        $this->assertStringContainsString($airport->id, $airport->actionView());
    }
}
