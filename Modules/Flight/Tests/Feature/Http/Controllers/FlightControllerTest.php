<?php

namespace Modules\Flight\Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use Modules\Plane\Entities\Plane;
use Modules\Flight\Entities\Flight;
use Modules\Airport\Entities\Airport;

class FlightControllerTest extends TestCase
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

        $response = $this->actingAs($user)->get(route('flight.index'));

        $response->assertSuccessful();

        $response->assertSee('Voos');
    }

    public function test_route_create()
    {
        $user = $this->user->factory()->create();

        $response = $this->actingAs($user)->get(route('flight.create'));

        $response->assertSuccessful();

        $response->assertSee('Voos');
    }

    public function test_route_store()
    {
        $user = $this->user->factory()->create();

        $plane = Plane::factory()->create();

        $airport = Airport::factory()->create();

        $data = [
            'plane_id' => $plane->id,
            'airport_origin_id' => $airport->id,
            'airport_destination_id' => $airport->id,
            'date' => '04/01/2022',
            'time_duration' => '02:00:00',
            'hour_output' => '02:00:00',
            'arrival_time' => '02:00:00',
            'old_price' => '499,00',
            'price' => '399,00',
            'total_prots' => '1',
            'is_promotion' => 'sim',
            'qty_stops' => '1',
        ];

        $response = $this->actingAs($user)->post(route('flight.store'), $data);

        $response->assertRedirect(route('flight.index'));

        $response->assertSessionHas('message', 'Cadastro realizado com sucesso.');

        $this->assertDatabaseCount('flights', 1);

        $this->assertDatabaseHas('flights', [
            'date' => '04/01/2022',
        ]);
    }

    public function test_route_show()
    {
        $user = $this->user->factory()->create();

        $flight = Flight::factory()->hasOrigin()->hasDestination()->create();

        $flight->load([
            'origin',
            'destination'
        ]);

        $response = $this->actingAs($user)->get(route('flight.show', [
            'id' => $flight->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($flight->name);
    }

    public function test_route_edit()
    {
        $user = $this->user->factory()->create();

        $flight = Flight::factory()->create();

        $response = $this->actingAs($user)->get(route('flight.edit', [
            'id' => $flight->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($flight->name);
    }

    public function test_route_update()
    {
        $user = $this->user->factory()->create();

        $flight = Flight::factory()->hasOrigin()->hasDestination()->create();

        $plane = Plane::factory()->create();

        $airport = Airport::factory()->create();

        $flight->load([
            'origin',
            'destination'
        ]);

        $data = [
            'plane_id' => $plane->id,
            'airport_origin_id' => $airport->id,
            'airport_destination_id' => $airport->id,
            'date' => '04/01/2022',
            'time_duration' => '02:00:00',
            'hour_output' => '02:00:00',
            'arrival_time' => '02:00:00',
            'old_price' => '499,00',
            'price' => '399,00',
            'total_prots' => '1',
            'is_promotion' => 'sim',
            'qty_stops' => '1',
        ];


        $response = $this->actingAs($user)->put(route('flight.update', $flight->id), $data);

        $response->assertRedirect(route('flight.edit', $flight->id));

        $response->assertSessionHas('message', 'Atualização realizada com sucesso.');

        $this->assertDatabaseHas('flights', [
            'date' => '04/01/2022',
        ]);
    }

    public function test_route_confirm_delete()
    {
        $user = $this->user->factory()->create();

        $flight = Flight::factory()->hasOrigin()->hasDestination()->create();

        $flight->load([
            'origin',
            'destination'
        ]);

        $response = $this->actingAs($user)->get(route('flight.confirm_delete', [
            'id' => $flight->id
        ]));

        $response->assertSuccessful();

        $response->assertSee($flight->name);
    }

    public function test_route_delete()
    {
        $user = $this->user->factory()->create();

        $flight = Flight::factory()->create();

        $response = $this->actingAs($user)->delete(route('flight.delete', [
            'id' =>  $flight->id
        ]));

        $response->assertRedirect(route('flight.index'));

        $response->assertSessionHas('message', 'Exclusão realizada com sucesso.');

        $this->assertDeleted('flights', $flight->toArray());

        $this->assertSoftDeleted($flight);

        $this->assertDatabaseCount('flights', 1);
    }
}
