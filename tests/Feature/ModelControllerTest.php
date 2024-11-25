<?php

namespace Tests\Feature;

use App\Models\Model;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModelControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * Test that a guest user can access the models index page and see the list of models.
     */
    public function test_guest_can_view_models_index()
    {
        // Create a few model records in the database
        Model::factory()->count(3)->create();

        // Send a GET request to the index route
        $response = $this->get(route('models.index'));

        // Check if the response status is OK
        $response->assertStatus(200);

        // Assert that the response view contains models data
        $response->assertViewHas('models');
    }

    // Test for authenticated user creating a model
    public function test_authenticated_user_can_create_model()
    {
        // Simulate an authenticated user
        $this->actingAs(User::factory()->create());

        $model = Model::factory()->create();
        $modelData = ['name' => 'New Model', 'maker_id' => $model->maker->id, ];

        $response = $this->post(route('models.store'), $modelData);

        $response->assertRedirect(route('models.index'));

        // Assert that the response redirects to the models index route with a success message
        $this->assertDatabaseHas('models', $modelData);
        $response->assertSessionHas('success', 'New Model sikeresen létrehozva');
    }

    /**
     * Test that a guest user cannot update a model.
     */
    public function test_guest_cannot_update_model()
    {
        $model = Model::factory()->create();
        $updatedData = ['name' => 'Guest Updated Model', 'id' => $model->id];

        $response = $this->patch(route('models.update', $model->id), $updatedData);

        // Assert that guest is redirected to login
        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('models', $updatedData);
    }

    // Test for authenticated user deleting a model
    public function test_authenticated_user_can_delete_model()
    {
        // Simulate an authenticated user
        $this->actingAs(User::factory()->create());

        $model = Model::factory()->create();

        // Send a DELETE request to the destroy route
        $response = $this->delete(route('models.destroy', $model->id));

        // Assert that the model was deleted from the database
        $this->assertDatabaseMissing('models', ['id' => $model->id]);

        // Assert that the response redirects with a success message
        $response->assertRedirect(route('models.index'));
        $response->assertSessionHas('success', 'Sikeresen törölve');
    }

    /**
     * Test that a guest user cannot delete a model.
     */
    public function test_guest_cannot_delete_model()
    {
        $model = Model::factory()->create();

        $response = $this->delete(route('models.destroy', $model->id));

        // Assert that guest is redirected to login
        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('models', ['id' => $model->id]);
    }

    /**
     * Test that the show method displays the specified model.
     */
    public function test_can_view_model()
    {
        // Create a model
        $model = Model::factory()->create();

        // Send a GET request to the show route
        $response = $this->get(route('models.show', $model->id));

        // Assert that the response status is OK
        $response->assertStatus(200);

        // Assert that the view contains the model data
        $response->assertViewHas('model', $model);
    }

}
