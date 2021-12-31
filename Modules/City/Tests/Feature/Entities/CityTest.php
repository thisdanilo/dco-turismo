<?php

namespace Modules\City\Tests\Feature\Entities;

use Modules\Address\Entities\Address;
use Modules\City\Entities\City;
use Modules\Client\Entities\Client;
use Modules\State\Entities\State;
use Tests\TestCase;

class CityTest extends TestCase
{
    public function test_a_city_belongs_to_state()
    {
        $city = City::factory()->hasState()->create();

        $city->load('state');

        $this->assertInstanceOf(State::class, $city->state);
    }

    public function test_city_has_address()
    {
        $client = Client::factory()->hasAddress(
            City::factory()->hasAddress(
                Address::factory()->count(2)
            )
        )
            ->create();

        $client->load('address');

        $this->assertInstanceOf(Address::class, $client->Address->first());
    }
}
