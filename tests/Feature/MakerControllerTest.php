<?php

namespace Tests\Feature;

use App\Models\Maker;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MakerControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a guest user can access the makers index page and see the list of makers.
     */
    public function test_guest_can_view_makers_index()
    {
        // Create a few maker records in the database
        Maker::factory()->count(3)->create();

        // Send a GET request to the index route
        $response = $this->get(route('makers.index'));

        // Check if the response status is OK
        $response->assertStatus(200);

        // Assert that the response view contains makers data
        $response->assertViewHas('makers');
    }

    // Test for authenticated user creating a maker
    public function test_authenticated_user_can_create_maker()
    {
        // Simulate an authenticated user
        $this->actingAs(User::factory()->create());

        $makerData = ['name' => 'New Maker'];

        $response = $this->post(route('makers.store'), $makerData);

        $response->assertRedirect(route('makers.index'));

        // Assert that the response redirects to the makers index route with a success message
        $this->assertDatabaseHas('makers', $makerData);
        $response->assertSessionHas('success', 'New Maker sikeresen létrehozva');
    }

    /**
     * Test that a guest user cannot create a maker.
     */
    public function test_guest_cannot_create_maker()
    {
        $makerData = ['name' => 'Guest Maker'];

        $response = $this->post(route('makers.store'), $makerData);

        // Assert that guest is redirected to login
        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('makers', $makerData);
    }

    // Test for authenticated user updating a maker
    public function test_authenticated_user_can_update_maker()
    {
        $maker = Maker::factory()->create();

        // Simulate an authenticated user
        $this->actingAs(User::factory()->create());

        $updatedData = ['name' => 'Updated Maker'];

        $response = $this->patch(route('makers.update', $maker->id), $updatedData);

        // Assert that the maker was updated in the database
        $this->assertDatabaseHas('makers', $updatedData);

        // Assert that the response redirects with a success message
        $response->assertRedirect(route('makers.index'));
        $response->assertSessionHas('success', 'Updated Maker sikeresen módosítva');
    }

    /**
     * Test that a guest user cannot update a maker.
     */
    public function test_guest_cannot_update_maker()
    {
        $maker = Maker::factory()->create();
        $updatedData = ['name' => 'Guest Updated Maker'];

        $response = $this->patch(route('makers.update', $maker->id), $updatedData);

        // Assert that guest is redirected to login
        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('makers', $updatedData);
    }


    // Test for authenticated user deleting a maker
    public function test_authenticated_user_can_delete_maker()
    {
        $maker = Maker::factory()->create();

        // Simulate an authenticated user
        $this->actingAs(User::factory()->create());

        // Send a DELETE request to the destroy route
        $response = $this->delete(route('makers.destroy', $maker->id));

        // Assert that the maker was deleted from the database
        $this->assertDatabaseMissing('makers', ['id' => $maker->id]);

        // Assert that the response redirects with a success message
        $response->assertRedirect(route('makers.index'));
        $response->assertSessionHas('success', 'Sikeresen törölve');
    }

    /**
     * Test that a guest user cannot delete a maker.
     */
    public function test_guest_cannot_delete_maker()
    {
        $maker = Maker::factory()->create();

        $response = $this->delete(route('makers.destroy', $maker->id));

        // Assert that guest is redirected to login
        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('makers', ['id' => $maker->id]);
    }

    /**
     * Test that the show method displays the specified maker.
     */
    public function test_can_view_maker()
    {
        // Create a maker
        $maker = Maker::factory()->create();

        // Send a GET request to the show route
        $response = $this->get(route('makers.show', $maker->id));

        // Assert that the response status is OK
        $response->assertStatus(200);

        // Assert that the view contains the maker data
        $response->assertViewHas('maker', $maker);
    }

}
