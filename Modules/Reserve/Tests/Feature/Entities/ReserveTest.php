<?php

namespace Modules\Reserve\Tests\Feature\Entities;

use Tests\TestCase;
use App\Models\User;
use Modules\Flight\Entities\Flight;
use Modules\Reserve\Entities\Reserve;

class ReserveTest extends TestCase
{
    public function test_a_reserve_belongs_to_user()
    {
        $reserve = Reserve::factory()->hasUser()->create();

        $reserve->load('user');

        $this->assertInstanceOf(User::class, $reserve->user);
    }

    public function test_a_reserve_belongs_to_flight()
    {
        $reserve = Reserve::factory()->hasFlight()->create();

        $reserve->load('flight');

        $this->assertInstanceOf(Flight::class, $reserve->flight);
    }
}
