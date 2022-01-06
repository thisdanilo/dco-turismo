<?php

namespace Modules\User\Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    protected $user;

    protected function setup(): void
    {
        parent::setUp();

        $this->user = new User();
    }

    public function test_route_index()
    {
        $user = $this->user->factory()->create();

        $response = $this->actingAs($user)->get(route('user.index'));

        $response->assertSuccessful();

        $response->assertSee('Clientes');
    }

    public function test_route_show()
    {
        $user = $this->user->factory()->create();

        $response = $this->actingAs($user)->get(route('user.show', [
            'id' => $user->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($user->name);
    }

    public function test_route_edit()
    {
        $user = $this->user->factory()->create();

        $response = $this->actingAs($user)->get(route('user.edit', [
            'id' => $user->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($user->name);
    }

    public function test_route_update()
    {
        $user = $this->user->factory()->create();

        $data = [
            "name" => "João Silva",
            "email" => "Joao@joao.com",
            "password" => bcrypt('123456789')
        ];

        $response = $this->actingAs($user)->put(route('user.update', $user->id), $data);

        $response->assertRedirect(route('user.edit', $user->id));

        $response->assertSessionHas('message', 'Atualização realizada com sucesso.');

        $this->assertDatabaseHas('users', [
            'name' => 'João Silva'
        ]);
    }

    public function test_route_confirm_delete()
    {
        $user = $this->user->factory()->create();

        $response = $this->actingAs($user)->get(route('user.confirm_delete', [
            'id' => $user->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($user->name);
    }

    public function test_route_delete()
    {
        $user = $this->user->factory()->create();

        $response = $this->actingAs($user)->delete(route('user.delete', [
            'id' =>  $user->id
        ]));

        $response->assertRedirect(route('user.index'));

        $response->assertSessionHas('message', 'Exclusão realizada com sucesso.');

        $this->assertDeleted('users', $user->toArray());
    }
}
