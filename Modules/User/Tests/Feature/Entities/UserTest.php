<?php

namespace Modules\User\Tests\Feature\Entities;

use Tests\TestCase;
use Modules\User\Entities\User;
use Modules\Reserve\Entities\Reserve;

class UserTest extends TestCase
{
    public function test_user_has_reserves()
    {
        $user = User::factory()->hasReserves(2)->create();

        $user->load('reserves');

        $this->assertInstanceOf(Reserve::class, $user->reserves->first());

        $this->assertInstanceOf(Reserve::class, $user->reserves->last());
    }
}
