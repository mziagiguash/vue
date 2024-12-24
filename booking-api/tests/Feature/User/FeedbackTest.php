<?php

namespace Tests\Feature\User;

use App\Models\Feedback;
use Tests\TestCase;
use App\Models\Room;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedbackTest extends TestCase
{
    use RefreshDatabase;

    public function test_feedback_can_created(): void
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();

        $this->withoutExceptionHandling();
        $response = $this
                ->actingAs($user)
                ->assertAuthenticated()
                ->get('/hotels/' . $hotel->getKey() . '/feedback');
        $response->assertStatus(200);
    }

    public function test_feedback_can_by_stored(): void
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();

        $attributes = [
            'hotel_id' => $hotel->getKey(),
            'user_id' => $user->getKey()
        ];

        $this->withoutExceptionHandling();
        $response = $this
                ->actingAs($user)
                ->assertAuthenticated()
                ->post('/hotels/' . $hotel->getKey() . '/feedback/store', $attributes);
        $response->assertStatus(302);
    }

    public function test_feedback_can_edited(): void
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();
        $feedback = Feedback::factory()
                ->for($hotel)
                ->create();

        $this->withoutExceptionHandling();
        $response = $this
                ->actingAs($user)
                ->assertAuthenticated()
                ->get('/hotels/' . $hotel->getKey() . '/feedbacks/' . $feedback->getKey() . '/edit');
        $response->assertStatus(200);
    }

    public function test_feedback_can_be_updated(): void
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();
        $feedback = Feedback::factory()
                ->for($hotel)
                ->create();
        $attributes = [
            'hotel_id' => $hotel->getKey(),
            'user_id' => $user->getKey()
        ];

        $this->withoutExceptionHandling();
        $response = $this
                ->actingAs($user)
                ->assertAuthenticated()
                ->patch('/hotels/' . $hotel->getKey() . '/feedbacks/' . $feedback->getKey() . '/update', $attributes);
        $response->assertStatus(302);

        $this->assertDatabaseHas('feedback', array_merge(
            ['id' => $feedback->getKey()], $attributes
        ));
    }
}
