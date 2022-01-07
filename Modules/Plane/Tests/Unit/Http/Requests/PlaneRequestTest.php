<?php

namespace Modules\Plane\Tests\Unit\Http\Requests;

use Tests\TestCase;
use Modules\Plane\Http\Requests\PlaneRequest;
use Modules\Plane\Http\Controllers\PlaneController;

class PlaneRequestTest extends TestCase
{
    protected $form_request;

    protected function setup(): void
    {
        parent::setUp();

        $this->form_request = new PlaneRequest();
    }

    public function test_it_has_rules()
    {
        $rules = [
            'total_passengers' => 'required|integer',
            'class' => 'required'
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
        $this->assertActionUsesFormRequest(PlaneController::class, $method, PlaneRequest::class);
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
