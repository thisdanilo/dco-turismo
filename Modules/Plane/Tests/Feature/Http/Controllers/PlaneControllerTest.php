<?php

namespace Modules\Plane\Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Modules\Bland\Entities\Bland;
use Modules\Plane\Entities\Plane;

class PlaneControllerTest extends TestCase
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

        $response = $this->actingAs($user)->get(route('plane.index'));

        $response->assertSuccessful();

        $response->assertSee('Aviões');
    }

    public function test_route_create()
    {
        $user = $this->user->factory()->create();

        $response = $this->actingAs($user)->get(route('plane.create'));

        $response->assertSuccessful();

        $response->assertSee('Aviões');
    }

    public function test_route_store()
    {
        $user = $this->user->factory()->create();

        $bland = Bland::factory()->create();

        $data = [
            'bland_id' => $bland->id,
            'total_passengers' => 100,
            'class' => Plane::ECONOMIC
        ];

        $response = $this->actingAs($user)->post(route('plane.store'), $data);

        $response->assertRedirect(route('plane.index'));

        $response->assertSessionHas('message', 'Cadastro realizado com sucesso.');

        $this->assertDatabaseCount('planes', 1);

        $this->assertDatabaseHas('planes', [
            'total_passengers' => 100
        ]);
    }

    public function test_route_show()
    {
        $user = $this->user->factory()->create();

        $plane = Plane::factory()->create();

        $response = $this->actingAs($user)->get(route('plane.show', [
            'id' => $plane->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($plane->name);
    }

    public function test_route_edit()
    {
        $user = $this->user->factory()->create();

        $plane = PLane::factory()->create();

        $response = $this->actingAs($user)->get(route('plane.edit', [
            'id' => $plane->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($plane->name);
    }

    public function test_route_update()
    {
        $user = $this->user->factory()->create();

        $plane = Plane::factory()->hasBland()->create();

        $plane->load('bland');

        $data = [
            'bland_id' => $plane->id,
            'total_passengers' => 100,
            'class' => Plane::ECONOMIC
        ];

        $response = $this->actingAs($user)->put(route('plane.update', $plane->id), $data);

        $response->assertRedirect(route('plane.edit', $plane->id));

        $response->assertSessionHas('message', 'Atualização realizada com sucesso.');

        $this->assertDatabaseHas('planes', [
            'total_passengers' => 100
        ]);
    }

    public function test_route_confirm_delete()
    {
        $user = $this->user->factory()->create();

        $plane = Plane::factory()->create();

        $response = $this->actingAs($user)->get(route('plane.confirm_delete', [
            'id' => $plane->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($plane->name);
    }

    public function test_route_delete()
    {
        $user = $this->user->factory()->create();

        $plane = Plane::factory()->create();

        $response = $this->actingAs($user)->delete(route('plane.delete', [
            'id' =>  $plane->id
        ]));

        $response->assertRedirect(route('plane.index'));

        $response->assertSessionHas('message', 'Exclusão realizada com sucesso.');

        $this->assertDeleted('planes', $plane->toArray());

        $this->assertSoftDeleted($plane);

        $this->assertDatabaseCount('planes', 1);
    }
}
