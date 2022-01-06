<?php

namespace Modules\Bland\Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Modules\Bland\Entities\Bland;

class BlandControllerTest extends TestCase
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

        $response = $this->actingAs($user)->get(route('bland.index'));

        $response->assertSuccessful();

        $response->assertSee('Marcas');
    }

    public function test_route_create()
    {
        $user = $this->user->factory()->create();

        $response = $this->actingAs($user)->get(route('bland.create'));

        $response->assertSuccessful();

        $response->assertSee('Marcas');
    }

    public function test_route_store()
    {
        $user = $this->user->factory()->create();

        $data = [
            "name" => "Marca 01"
        ];

        $response = $this->actingAs($user)->post(route('bland.store'), $data);

        $response->assertRedirect(route('bland.index'));

        $response->assertSessionHas('message', 'Cadastro realizado com sucesso.');

        $this->assertDatabaseCount('blands', 1);

        $this->assertDatabaseHas('blands', [
            'name' => 'Marca 01'
        ]);
    }

    public function test_route_show()
    {
        $user = $this->user->factory()->create();

        $bland = Bland::factory()->create();

        $response = $this->actingAs($user)->get(route('bland.show', [
            'id' => $bland->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($bland->name);
    }

    public function test_route_edit()
    {
        $user = $this->user->factory()->create();

        $bland = bland::factory()->create();

        $response = $this->actingAs($user)->get(route('bland.edit', [
            'id' => $bland->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($bland->name);
    }

    public function test_route_update()
    {
        $user = $this->user->factory()->create();

        $bland = bland::factory()->create();

        $data = [
            "name" => "Marca. 02"
        ];

        $response = $this->actingAs($user)->put(route('bland.update', $bland->id), $data);

        $response->assertRedirect(route('bland.edit', $bland->id));

        $response->assertSessionHas('message', 'Atualização realizada com sucesso.');

        $this->assertDatabaseHas('blands', [
            'name' => 'Marca. 02'
        ]);
    }

    public function test_route_confirm_delete()
    {
        $user = $this->user->factory()->create();

        $bland = bland::factory()->create();

        $response = $this->actingAs($user)->get(route('bland.confirm_delete', [
            'id' => $bland->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($bland->name);
    }

    public function test_route_delete()
    {
        $user = $this->user->factory()->create();

        $bland = bland::factory()->create();

        $response = $this->actingAs($user)->delete(route('bland.delete', [
            'id' =>  $bland->id
        ]));

        $response->assertRedirect(route('bland.index'));

        $response->assertSessionHas('message', 'Exclusão realizada com sucesso.');

        $this->assertDeleted('blands', $bland->toArray());

        $this->assertSoftDeleted($bland);

        $this->assertDatabaseCount('blands', 1);
    }
}
