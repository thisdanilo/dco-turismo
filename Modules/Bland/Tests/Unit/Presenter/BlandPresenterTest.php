<?php

namespace Modules\Bland\Tests\Unit\Presenter;

use Tests\TestCase;
use Modules\Bland\Entities\Bland;

class BlandPresenterTest extends TestCase
{
    public function test_it_gets_action_view()
    {
        $bland = new Bland();

        $bland->id = 123;

        $this->assertStringContainsString($bland->id, $bland->actionView());
    }
}
