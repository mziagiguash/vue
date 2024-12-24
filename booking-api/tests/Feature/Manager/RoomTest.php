<?php

namespace Tests\Feature\Manager;

use Tests\TestCase;
use App\Models\Room;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    public function test_rooms_index(): void
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
                    ->get('/manager/hotels/' . $hotel->getKey() . '/rooms');
        $response->assertStatus(200);
    }

    public function test_room_can_be_created(): void
    {
        $user = User::factory()->create([
            'role_id' => 2
        ]);
        $hotel = Hotel::factory()->create();

        $image = UploadedFile::fake()->image('room.jpg');
        $file = Storage::fake('public')->put('/rooms/', $image);
        $attributes = [
            'title' => 'Room',
            'description' => 'Description',
            'floor_area' => 22,
            'type' => 'lux',
            'price' => 1300,
            'poster_url' => $file,
            'hotel_id'=> $hotel->getKey()
        ];
        Storage::disk('public')->assertExists('/rooms/' . $image->hashName());

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->post('/manager/hotels/' . $hotel->getKey() . '/rooms', $attributes);
        $response->assertStatus(302);

        $this->assertDatabaseHas('rooms', $attributes);
    }

    public function test_room_can_be_edit(): void
    {
        $hotel = Hotel::factory()->create();
        $user = User::factory()->create([
            'role_id' => 2,
            'hotel_id' => $hotel->getKey()
        ]);
        $room = Room::factory()
            ->for($hotel)
            ->create([
                'hotel_id' => $hotel->getKey()
            ]);
        $attributes = [
            'hotel' => $hotel
        ];
        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->get('/manager/rooms/' . $room->getKey() . '/edit', $attributes);
        $response->assertStatus(200);
    }

    public function test_room_can_be_updated(): void
    {
        $user = User::factory()->create([
            'role_id' => 2
        ]);
        $hotel = Hotel::factory()->create();
        $room = Room::factory()
            ->for(Hotel::factory()->create())
            ->create([
                'hotel_id' => $hotel->getKey()
            ]);
        $image = UploadedFile::fake()->image('room.jpg');
        $file = Storage::fake('public')->put('/rooms/', $image);

        $attributes = [
            'title' => '1a',
            'description' => 'description',
            'floor_area' => 23,
            'type' => 'люкс',
            'poster_url' => $file,
            'price' => 3800,
            'hotel_id'=> $hotel->getKey()
        ];

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->patch('/manager/rooms/' . $room->getKey(), $attributes);
        $response->assertStatus(302);

        Storage::disk('public')->assertExists('/rooms/' . $image->hashName());

        $this->assertDatabaseHas('rooms', array_merge(
            ['id' => $room->getKey()], $attributes
        ));
    }

    public function test_room_can_be_deleted(): void
    {
        $user = User::factory()->create([
            'role_id' => 2
        ]);

        $image = UploadedFile::fake()->image('room.jpg');
        $file = Storage::fake('public')->put('/rooms/', $image);

        $hotel = Hotel::factory()->create();
        $room = Room::factory()
            ->for(Hotel::factory()->create())
            ->create([
                'hotel_id' => $hotel->getKey(),
                'poster_url' => $file
            ]);

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->delete('/manager/rooms/' . $room->getKey());
        $response->assertStatus(302);

        Storage::disk('public')->assertMissing('/rooms/' . $image->hashName());

        $this->assertDatabaseMissing('rooms', ['id' => $room->getKey()]);
    }
}
