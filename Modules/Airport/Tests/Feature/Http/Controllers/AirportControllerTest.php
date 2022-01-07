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

        City::factory()->create();

        $this->user = User::factory()->create();
    }

    public function test_route_index()
    {
        $response = $this->actingAs($this->user)->get(route('airport.index'));

        $response->assertSuccessful();

        $response->assertSee('Aeroportos');
    }

    public function test_route_create()
    {
        $response = $this->actingAs($this->user)->get(route('airport.create'));

        $response->assertSuccessful();

        $response->assertSee('Aeroportos');
    }

    public function test_route_store()
    {
        $data = [
            'city_id' => 1,
            'name' => 'Aeroporto 01',
            'latitude' => '102544',
            'longitude' => '2665977',
            'address' => 'Rua Teste',
            'number' => '102',
            'zip_code' => '99999-999'
        ];

        $response = $this->actingAs($this->user)->post(route('airport.store'), $data);

        $response->assertRedirect(route('airport.index'));

        $response->assertSessionHas('message', 'Cadastro realizado com sucesso.');

        $this->assertDatabaseCount('airports', 1);

        $this->assertDatabaseHas('airports', [
            'name' => 'Aeroporto 01'
        ]);
    }

    public function test_route_show()
    {
        $airport = Airport::factory()->create();

        $response = $this->actingAs($this->user)->get(route('airport.show', [
            'id' => $airport->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($airport->name);
    }

    public function test_route_edit()
    {
        $airport = Airport::factory()->create();

        $response = $this->actingAs($this->user)->get(route('airport.edit', [
            'id' => $airport->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($airport->name);
    }

    public function test_route_update()
    {
        $airport = Airport::factory()->hasCity()->create();

        $airport->load('city');

        $data = [
            'city_id' => $airport->city->id,
            'name' => 'Aeroporto 01',
            'latitude' => '102544',
            'longitude' => '2665977',
            'address' => 'Rua Teste',
            'number' => '102',
            'zip_code' => '99999-999'
        ];

        $response = $this->actingAs($this->user)->put(route('airport.update', ['id' => $airport->id]), $data);

        $response->assertRedirect(route('airport.edit', $airport->id));

        $response->assertSessionHas('message', 'Atualização realizada com sucesso.');

        $this->assertDatabaseHas('airports', [
            'name' => 'Aeroporto 01'
        ]);
    }

    public function test_route_confirm_delete()
    {
        $airport = Airport::factory()->create();

        $response = $this->actingAs($this->user)->get(route('airport.confirm_delete', [
            'id' => $airport->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($airport->name);
    }

    public function test_route_delete()
    {
        $airport = Airport::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('airport.delete', [
            'id' =>  $airport->id
        ]));

        $response->assertRedirect(route('airport.index'));

        $response->assertSessionHas('message', 'Exclusão realizada com sucesso.');

        $this->assertDeleted('Airports', $airport->toArray());

        $this->assertSoftDeleted($airport);

        $this->assertDatabaseCount('airports', 1);
    }
}
