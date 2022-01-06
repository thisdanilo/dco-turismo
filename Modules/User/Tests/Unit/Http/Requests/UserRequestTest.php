<?php

namespace Modules\User\Tests\Unit\Http\Requests;

use Tests\TestCase;
use Modules\User\Http\Requests\UserRequest;
use Modules\User\Http\Controllers\UserController;

class UserRequestTest extends TestCase
{
    protected $form_request;
    protected function setup(): void
    {
        parent::setUp();
        $this->form_request = new UserRequest();
    }
    public function test_it_has_rules()
    {
        $rules = [
            'name' => 'required', 'string',
            'email' => 'required', 'string'
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
        $this->assertActionUsesFormRequest(UserController::class, $method, UserRequest::class);
    }
    public function methodsDataProvider()
    {
        yield [
            'update'
        ];
    }
}
