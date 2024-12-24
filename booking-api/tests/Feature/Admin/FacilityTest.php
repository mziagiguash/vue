<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Facility;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FacilityTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_facilities_index(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);

        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->get('/admin/facilities');
        $response->assertStatus(200);
    }

    public function test_facilities_can_be_edit(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);

        $facility = Facility::factory()->create();

        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->get('/admin/facilities/' . $facility->getKey() . '/edit');
        $response->assertOk();
    }

    public function test_facilities_can_be_created(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);

        $attributes = [
            'title' => 'parking'
        ];

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->post('/admin/facilities/', $attributes);
        $response->assertStatus(302);
    }

    public function test_facilities_can_be_updated(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);
        $facility = Facility::factory()->create();

        $attributes = [
            'title' => 'pool',
        ];

        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->patch('/admin/facilities/' . $facility->getKey() . '/update', $attributes);
        $response->assertStatus(302);

        $this->assertDatabaseHas('facilities', array_merge(
            ['id' => $facility->getKey()], $attributes
        ));
    }

    public function test_hotels_can_be_deleted(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);
        $facility = Facility::factory()->create();

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->delete('/admin/facilities/' . $facility->getKey() . '/delete');
        $response->assertStatus(302);

        $this->assertDatabaseMissing('facilities', ['id' => $facility->getKey()]);
    }
}
