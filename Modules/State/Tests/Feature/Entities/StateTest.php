<?php

namespace Modules\State\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\City\Entities\City;
use Modules\State\Entities\State;

class StateTest extends TestCase
{
    public function test_state_has_cities()
    {
        $state = State::factory()->hasCities(
            City::factory()->count(2)
        )
            ->create();

        $state->load('cities');

        $this->assertInstanceOf(City::class, $state->cities->first());

        $this->assertInstanceOf(City::class, $state->cities->last());
    }
}
