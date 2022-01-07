<?php

namespace Modules\Dashboard\Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;

class DashboardControllerTest extends TestCase
{
    public function test_route_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard.index'));

        $response->assertSuccessful();

        $response->assertSee('Home');
    }
}
