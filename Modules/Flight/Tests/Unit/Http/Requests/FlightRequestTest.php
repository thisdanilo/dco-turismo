<?php

namespace Modules\Flight\Tests\Unit\Http\Requests;

use Tests\TestCase;
use Modules\Flight\Http\Requests\FlightRequest;
use Modules\Flight\Http\Controllers\FlightController;

class FlightRequestTest extends TestCase
{
    protected $form_request;

    protected function setup(): void
    {
        parent::setUp();

        $this->form_request = new FlightRequest();
    }

    public function test_it_has_rules()
    {
        $rules = [
            'plane_id' => 'required',
            'airport_origin_id' => 'required',
            'airport_destination_id' => 'required',
            'date' => 'required|date',
            'time_duration' => 'required|time',
            'hour_output' => 'required|time',
            'arrival_time' => 'required|time',
            'old_price' => 'required|decimal',
            'price' => 'required|decimal',
            'total_prots' => 'required|integer',
            'is_promotion' => 'required|boolean',
            'qty_stops' => 'required|integer',
            'description' => 'nullable|text'
        ];

        $this->assertEquals($rules,  $this->form_request->rules());
    }

    public function test_it_has_authorize()
    {
        $this->assertTrue($this->form_request->authorize());
    }

    /**
     * @dataProvider methodsDataProvider
     */
    public function test_it_has_form_request($method)
    {
        $this->assertActionUsesFormRequest(FlightController::class, $method, FlightRequest::class);
    }

    public function methodsDataProvider()
    {
        yield [
            'store'
        ];
        yield [
            'update'
        ];
    }
}
