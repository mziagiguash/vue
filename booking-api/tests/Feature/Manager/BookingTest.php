<?php

namespace Tests\Feature\Manager;

use Tests\TestCase;
use App\Models\Room;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Booking;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_bookings_index(): void
    {
        $hotel = Hotel::factory()->create();
        $user = User::factory()->create([
            'role_id' => 2,
            'hotel_id' => $hotel->getKey()
        ]);

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->get('/manager/bookings');
        $response->assertStatus(200);
    }

    public function test_booking_can_be_edit(): void
    {
        $hotel = Hotel::factory()->create();
        $user = User::factory()->create([
            'role_id' => 2,
            'hotel_id' => $hotel->getKey()
        ]);
        $room = Room::factory()->create([
            'hotel_id' => $hotel->getKey()
        ]);
        $booking = Booking::factory()
            ->for($room)
            ->create([
                'room_id' => $room->getKey(),
                'user_id' => $user->getKey(),
                'status_id' => 0
        ]);

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->get('/manager/booking/' . $booking->getKey());
        $response->assertStatus(200);
    }

    public function test_bookings_can_be_updated(): void
    {
        $user = User::factory()->create([
            'role_id' => 2
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
                    ->patch('/manager/booking/' . $booking->getKey() . '/update', $attributes);
        $response->assertStatus(302);

        $this->assertDatabaseHas('bookings', array_merge(
            ['id' => $booking->getKey()], $attributes
        ));
    }
}
