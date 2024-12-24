<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\Room;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Status;
use App\Models\Booking;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_bookings_index(): void
    {
        $user = User::factory()->create();
        $response = $this
                ->actingAs($user)
                ->assertAuthenticated()
                ->get('/bookings');

        $response->assertStatus(200);
    }

    public function test_booking_created(): void
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();
        $room = Room::factory()
                ->for($hotel)
                ->create([
                    'hotel_id' => $hotel->getKey()
                ]);

        $attributes = [
            'room_id' => $room->getKey(),
            'days' => 5,
            'price' => 5620,
            'status_id' => 1,
            'user_id' => $user->getKey()
        ];

        $this->withoutExceptionHandling();
        $response = $this
                ->actingAs($user)
                ->assertAuthenticated()
                ->post('/bookings/store', $attributes);
        $response->assertStatus(302);
    }

    public function test_booking_can_be_showed(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()
                ->for(Hotel::factory()->create())
                ->create();
        $booking = Booking::factory()
                ->for($room)
                ->create();

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->get('/booking/' . $booking->getKey());
        $response->assertStatus(200);
    }

    public function test_booking_can_be_updated(): void
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();
        $room = Room::factory()
            ->for(Hotel::factory()->create())
            ->create([
                'hotel_id' => $hotel->getKey()
            ]);

        $booking = Booking::factory()
                    ->for($room)
                    ->create([
                        'room_id' => $room->getKey(),
                        'user_id' => $user->getKey()
                    ]);

        $attributes = [
            'days' => 6,
            'status_id' => 1,
        ];

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->patch('/booking/' . $booking->getKey(), $attributes);
        $response->assertStatus(302);

        $this->assertDatabaseHas('bookings', array_merge(
            ['id' => $booking->getKey()], $attributes
        ));
    }

    public function test_booking_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();
        $room = Room::factory()
            ->for(Hotel::factory()->create())
            ->create([
                'hotel_id' => $hotel->getKey()
            ]);

        $booking = Booking::factory()
                ->for($room)
                ->create([
                    'room_id' => $room->getKey(),
                    'user_id' => $user->getKey()
                ]);

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->delete('/booking/' . $booking->getKey());
        $response->assertStatus(302);

        $this->assertDatabaseMissing('bookings', ['id' => $booking->getKey()]);
    }
}
