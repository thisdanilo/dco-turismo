<?php

namespace Modules\Airport\Tests\Unit\Http\Requests;

use Tests\TestCase;
use Modules\Airport\Http\Requests\AirportRequest;
use Modules\Airport\Http\Controllers\AirportController;

class AirportRequestTest extends TestCase
{
    protected $form_request;

    protected function setup(): void
    {
        parent::setUp();

        $this->form_request = new AirportRequest();
    }

    public function test_it_has_rules()
    {
        $rules = [
            'city_id' => 'required',
            'name' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'address' => 'required|string',
            'number' => 'required|string',
            'zip_code' => 'required|string'
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
        $this->assertActionUsesFormRequest(AirportController::class, $method, AirportRequest::class);
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
