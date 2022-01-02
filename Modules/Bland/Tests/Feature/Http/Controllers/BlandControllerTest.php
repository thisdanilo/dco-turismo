<?php

namespace Modules\Bland\Tests\Feature\Http\Controllers;

use Modules\Bland\Entities\Bland;
use Tests\TestCase;

class BlandControllerTest extends TestCase
{
    public function test_route_index()
    {
        $response = $this->get(route('bland.index'));

        $response->assertSuccessful();

        $response->assertSee('Marcas');
    }

    public function test_route_create()
    {
        $response = $this->get(route('bland.create'));

        $response->assertSuccessful();

        $response->assertSee('Marcas');
    }

    public function test_route_store()
    {
        $data = [
            "name" => "Marca 01"
        ];

        $response = $this->post(route('bland.store'), $data);

        $response->assertRedirect(route('bland.index'));

        $response->assertSessionHas('message', 'Cadastro realizado com sucesso.');

        $this->assertDatabaseCount('blands', 1);

        $this->assertDatabaseHas('blands', [
            'name' => 'Marca 01'
        ]);
    }

    public function test_route_show()
    {
        $bland = Bland::factory()->create();

        $response = $this->get(route('bland.show', [
            'id' => $bland->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($bland->name);
    }

    public function test_route_edit()
    {
        $bland = bland::factory()->create();

        $response = $this->get(route('bland.edit', [
            'id' => $bland->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($bland->name);
    }

    public function test_route_update()
    {
        $bland = bland::factory()->create();

        $data = [
            "name" => "Marca. 02"
        ];

        $response = $this->put(route('bland.update', $bland->id), $data);

        $response->assertRedirect(route('bland.edit', $bland->id));

        $response->assertSessionHas('message', 'Atualização realizada com sucesso.');

        $this->assertDatabaseHas('blands', [
            'name' => 'Marca. 02'
        ]);
    }

    public function test_route_confirm_delete()
    {
        $bland = bland::factory()->create();

        $response = $this->get(route('bland.confirm_delete', [
            'id' => $bland->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($bland->name);
    }

    public function test_route_delete()
    {
        $bland = bland::factory()->create();

        $response = $this->delete(route('bland.delete', [
            'id' =>  $bland->id
        ]));

        $response->assertRedirect(route('bland.index'));

        $response->assertSessionHas('message', 'Exclusão realizada com sucesso.');

        $this->assertDeleted('blands', $bland->toArray());

        $this->assertSoftDeleted($bland);

        $this->assertDatabaseCount('blands', 1);
    }
}
