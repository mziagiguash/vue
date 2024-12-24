<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_index(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);

        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->get('/admin/users/');
        $response->assertStatus(200);
    }

    public function test_user_can_be_edit(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->get('/admin/users/' . $user->getKey() . '/edit');
        $response->assertStatus(200);
    }

    public function test_user_can_be_updated(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);
        $hotel = Hotel::factory()->create();

        $attributes = [
            'hotel_id' => $hotel->getKey(),
        ];

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->patch('/admin/users/' . $user->getKey(), $attributes);
        $response->assertStatus(302);

        $this->assertDatabaseHas('users', array_merge(
            ['id' => $user->getKey()], $attributes
        ));
    }

    public function test_room_can_be_deleted(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->delete('/admin/users/' . $user->getKey());
        $response->assertStatus(302);

        $this->assertDatabaseMissing('users', ['id' => $user->getKey()]);
    }
}
