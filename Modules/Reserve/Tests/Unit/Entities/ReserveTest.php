<?php

namespace Modules\Reserve\Tests\Unit\Entities;

use Tests\TestCase;
use Modules\Reserve\Entities\Reserve;

class ReserveTest extends TestCase
{
    protected $reserve;

    protected function setup(): void
    {
        parent::setUp();

        $this->reserve = new Reserve();
    }

    /**
     * @dataProvider statusAttributeDataProvider
     */
    public function test_it_formats_status_attribute($value, $expected_result)
    {
        $this->reserve->status = $value;

        $this->assertEquals($this->reserve->formatted_status, $expected_result);
    }

    public function statusAttributeDataProvider()
    {
        yield 'formatted_status deve retornar Reservado' => [
            'value' => Reserve::RESERVED,
            'expected_result' => 'Reservado'
        ];

        yield 'formatted_status deve retornar Cancelado' => [
            'value' => Reserve::CANCELED,
            'expected_result' => 'Cancelado'
        ];

        yield 'formatted_status deve retornar Pago' => [
            'value' => Reserve::PAID,
            'expected_result' => 'Pago'
        ];

        yield 'formatted_status deve retornar Concluído' => [
            'value' => Reserve::CONCLUDED,
            'expected_result' => 'Concluído'
        ];
    }

    public function test_it_formats_date_reserved_attribute()
    {
        $this->reserve->date_reserved = '2022-01-10';

        $this->assertEquals('10/01/2022', $this->reserve->formatted_date_reserved);
    }
}
