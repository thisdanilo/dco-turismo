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

        $this->user = User::factory()->create();
    }

    public function test_route_index()
    {
        $response = $this->actingAs($this->user)->get(route('user.index'));

        $response->assertSuccessful();

        $response->assertSee('Clientes');
    }

    public function test_route_show()
    {
        $response = $this->actingAs($this->user)->get(route('user.show', [
            'id' => $this->user->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($this->user->name);
    }

    public function test_route_edit()
    {
        $response = $this->actingAs($this->user)->get(route('user.edit', [
            'id' => $this->user->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($this->user->name);
    }

    public function test_route_update()
    {
        $data = [
            "name" => "João Silva",
            "email" => "Joao@joao.com",
            "password" => bcrypt('123456789')
        ];

        $response = $this->actingAs($this->user)->put(route('user.update', $this->user->id), $data);

        $response->assertRedirect(route('user.edit', $this->user->id));

        $response->assertSessionHas('message', 'Atualização realizada com sucesso.');

        $this->assertDatabaseHas('users', [
            'name' => 'João Silva'
        ]);
    }

    public function test_route_confirm_delete()
    {
        $response = $this->actingAs($this->user)->get(route('user.confirm_delete', [
            'id' => $this->user->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($this->user->name);
    }

    public function test_route_delete()
    {
        $response = $this->actingAs($this->user)->delete(route('user.delete', [
            'id' =>  $this->user->id
        ]));

        $response->assertRedirect(route('user.index'));

        $response->assertSessionHas('message', 'Exclusão realizada com sucesso.');

        $this->assertDeleted('users', $this->user->toArray());
    }
}
