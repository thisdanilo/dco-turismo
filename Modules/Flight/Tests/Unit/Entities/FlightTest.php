<?php

namespace Modules\Flight\Tests\Unit\Entities;

use Tests\TestCase;
use Modules\Flight\Entities\Flight;

class FlightTest extends TestCase
{
    public function test_it_formats_date_attribute()
    {
        $flight = new Flight();

        $flight->date = '2022-01-10';

        $this->assertEquals('10/01/2022', $flight->formatted_date);
    }

    public function test_it_formats_time_duration_attribute()
    {
        $flight = new Flight();

        $flight->datetime_duration = now()->format('H:i');

        $this->assertEquals(now()->format('H:i'), $flight->formatted_time_duration);
    }
}
