<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_bookings_index(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);

        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->get('/admin/bookings');
        $response->assertStatus(200);
    }

    public function test_booking_can_be_edit(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);
        $hotel = Hotel::factory()->create();
        $booking = Booking::factory()
            ->for(Room::factory()->create([
                'hotel_id' => $hotel->getKey()
            ]))
            ->create([
                'room_id' => 1,
                'user_id' => $user->getKey(),
                'status_id' => 0
        ]);

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->get('/admin/booking/' . $booking->getKey());
        $response->assertOk();
    }

    public function test_bookings_can_be_updated(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);
        $hotel = Hotel::factory()->create();
        $booking = Booking::factory()
            ->for(Room::factory()->create([
                'hotel_id' => $hotel->getKey()
            ]))
            ->create([
                'room_id' => 1,
                'user_id' => $user->getKey(),
                'status_id' => 0
        ]);

        $attributes = [
            'status_id' => 1,
        ];

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->patch('/admin/booking/' . $booking->getKey() . '/update', $attributes);
        $response->assertStatus(302);

        $this->assertDatabaseHas('bookings', array_merge(
            ['id' => $booking->getKey()], $attributes
        ));
    }
}
