<?php

namespace Modules\Reserve\Tests\Unit\Http\Requests;

use Tests\TestCase;
use Modules\Reserve\Http\Requests\ReserveRequest;
use Modules\Reserve\Http\Controllers\ReserveController;
use Modules\Reserve\Rules\CheckAvailableFlight;

class ReserveRequestTest extends TestCase
{
    protected $form_request;
    protected function setup(): void
    {
        parent::setUp();
        $this->form_request = new ReserveRequest();
    }
    public function test_it_has_rules()
    {
        $rules = [
            'flight_id' => [
                'required',
                new CheckAvailableFlight
            ],
            'user_id' => 'required',
            'date_reserved' => 'required', 'date',
            'status' => 'required', 'enum'
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
        $this->assertActionUsesFormRequest(ReserveController::class, $method, ReserveRequest::class);
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
