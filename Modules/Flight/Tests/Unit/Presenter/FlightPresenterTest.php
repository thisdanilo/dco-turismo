<?php

namespace Modules\Flight\Tests\Unit\Presenter;

use Tests\TestCase;
use Modules\Flight\Entities\Flight;

class FlightPresenterTest extends TestCase
{
    public function test_it_gets_action_view()
    {
        $flight = new Flight();

        $flight->id = 123;

        $this->assertStringContainsString($flight->id, $flight->actionView());
    }
}
