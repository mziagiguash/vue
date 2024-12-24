<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_index(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);

        $response = $this
                    ->actingAs($user)
                    ->get('/admin');

        $response->assertStatus(200);
    }
}
