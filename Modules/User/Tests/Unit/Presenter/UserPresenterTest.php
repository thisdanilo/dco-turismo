<?php

namespace Modules\User\Tests\Unit\Presenter;

use Tests\TestCase;
use App\Models\User;

class UserPresenterTest extends TestCase
{
    public function test_it_gets_action_view()
    {
        $user = new User();

        $user->id = 123;

        $this->assertStringContainsString($user->id, $user->actionView());
    }
}
