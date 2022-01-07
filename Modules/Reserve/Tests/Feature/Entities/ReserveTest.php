<?php

namespace Modules\Reserve\Tests\Feature\Entities;

use Tests\TestCase;
use App\Models\User;
use Modules\Flight\Entities\Flight;
use Modules\Reserve\Entities\Reserve;

class ReserveTest extends TestCase
{
    public function test_a_reserve_has_user()
    {
        $reserve = Reserve::factory()->hasUser()->create();

        $reserve->load('user');

        $this->assertInstanceOf(User::class, $reserve->user);
    }

    public function test_a_reserve_has_flight()
    {
        $reserve = Reserve::factory()->hasFlight()->create();

        $reserve->load('flight');

        $this->assertInstanceOf(Flight::class, $reserve->flight);
    }

    public function test_it_new_reserve()
    {
        $reserves = Reserve::factory()->hasUser()->hasFlight()->create([
            'date_reserved' => now()->format('d/m/Y'),
            'status' => Reserve::RESERVED
        ]);

        $reserves->load(['user', 'flight']);

        $this->actingAs($reserves->user);

        $new_reserve = $reserves->newReserve($reserves->flight->id);

        $this->assertTrue($new_reserve);
    }
}
