<?php

namespace Modules\Reserve\Tests\Unit\Presenter;

use Tests\TestCase;
use Modules\Reserve\Entities\Reserve;

class ReservePresenterTest extends TestCase
{
    public function test_it_gets_action_view()
    {
        $reserve = new Reserve();

        $reserve->id = 123;

        $this->assertStringContainsString($reserve->id, $reserve->actionView());
    }
}
