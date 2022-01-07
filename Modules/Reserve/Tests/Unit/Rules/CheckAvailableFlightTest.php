<?php

namespace Modules\Reserve\Tests\Unit\Rules;

use Tests\TestCase;
use Modules\Reserve\Rules\CheckAvailableFlight;

class CheckAvailableFlightTest extends TestCase
{
    public function test_it_message()
    {
        $message = 'A quantidade de reservas superou a quantidade de passageiros permitidos!.';

        $this->assertEquals($message, (new CheckAvailableFlight)->message());
    }
}
