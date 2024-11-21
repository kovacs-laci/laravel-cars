<?php

namespace Tests\Feature;

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_guest_can_view_vehicles_index()
    {
        // Create a few maker records in the database
        Vehicle::factory()->count(3)->create();

        // Send a GET request to the index route
        $response = $this->get(route('vehicles.index'));

        // Check if the response status is OK
        $response->assertStatus(200);

        // Assert that the response view contains makers data
        $response->assertViewHas('vehicles');
        $response->assertViewIs('vehicle.index');
        $response->assertSee('Járművek');
        $response->assertSeeHtml('<div class="col">Rendszám</div>');
    }
}
