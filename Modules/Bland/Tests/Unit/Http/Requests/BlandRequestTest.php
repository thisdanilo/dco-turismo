<?php

namespace Modules\Bland\Tests\Unit\Http\Requests;

use Tests\TestCase;
use Modules\Bland\Http\Requests\BlandRequest;
use Modules\Bland\Http\Controllers\BlandController;

class BlandRequestTest extends TestCase
{
    protected $form_request;
    protected function setup(): void
    {
        parent::setUp();
        $this->form_request = new BlandRequest();
    }
    public function test_it_has_rules()
    {
        $rules = [
            'name' => 'required', 'string'
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
        $this->assertActionUsesFormRequest(BlandController::class, $method, BlandRequest::class);
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
