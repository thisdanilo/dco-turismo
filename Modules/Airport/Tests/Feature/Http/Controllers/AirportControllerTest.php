<?php

namespace Modules\Airport\Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Modules\City\Entities\City;
use Modules\Airport\Entities\Airport;

class AirportControllerTest extends TestCase
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

        $response = $this->actingAs($user)->get(route('airport.index'));

        $response->assertSuccessful();

        $response->assertSee('Aeroportos');
    }

    public function test_route_create()
    {
        $user = $this->user->factory()->create();

        $response = $this->actingAs($user)->get(route('airport.create'));

        $response->assertSuccessful();

        $response->assertSee('Aeroportos');
    }

    public function test_route_store()
    {
        $user = $this->user->factory()->create();

        $city = City::factory()->create();

        $data = [
            'city_id' => $city->id,
            'name' => 'Aeroporto 01',
            'latitude' => '102544',
            'longitude' => '2665977',
            'address' => 'Rua Teste',
            'number' => '102',
            'zip_code' => '99999-999'
        ];

        $response = $this->actingAs($user)->post(route('airport.store'), $data);

        $response->assertRedirect(route('airport.index'));

        $response->assertSessionHas('message', 'Cadastro realizado com sucesso.');

        $this->assertDatabaseCount('airports', 1);

        $this->assertDatabaseHas('airports', [
            'name' => 'Aeroporto 01'
        ]);
    }

    public function test_route_show()
    {
        $user = $this->user->factory()->create();

        $airport = Airport::factory()->create();

        $response = $this->actingAs($user)->get(route('airport.show', [
            'id' => $airport->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($airport->name);
    }

    public function test_route_edit()
    {
        $user = $this->user->factory()->create();

        $airport = Airport::factory()->create();

        $response = $this->actingAs($user)->get(route('airport.edit', [
            'id' => $airport->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($airport->name);
    }

    public function test_route_update()
    {
        $user = $this->user->factory()->create();

        $airport = Airport::factory()->hasCity()->create();

        $airport->load('city');

        $data = [
            'city_id' => $airport->id,
            'name' => 'Aeroporto 01',
            'latitude' => '102544',
            'longitude' => '2665977',
            'address' => 'Rua Teste',
            'number' => '102',
            'zip_code' => '99999-999'
        ];

        $response = $this->actingAs($user)->put(route('airport.update', $airport->id), $data);

        $response->assertRedirect(route('airport.edit', $airport->id));

        $response->assertSessionHas('message', 'Atualização realizada com sucesso.');

        $this->assertDatabaseHas('airports', [
            'name' => 'Aeroporto 01'
        ]);
    }

    public function test_route_confirm_delete()
    {
        $user = $this->user->factory()->create();

        $airport = Airport::factory()->create();

        $response = $this->actingAs($user)->get(route('airport.confirm_delete', [
            'id' => $airport->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($airport->name);
    }

    public function test_route_delete()
    {
        $user = $this->user->factory()->create();

        $airport = Airport::factory()->create();

        $response = $this->actingAs($user)->delete(route('airport.delete', [
            'id' =>  $airport->id
        ]));

        $response->assertRedirect(route('airport.index'));

        $response->assertSessionHas('message', 'Exclusão realizada com sucesso.');

        $this->assertDeleted('Airports', $airport->toArray());

        $this->assertSoftDeleted($airport);

        $this->assertDatabaseCount('airports', 1);
    }
}
