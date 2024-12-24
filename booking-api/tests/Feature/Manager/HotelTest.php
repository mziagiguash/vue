<?php

namespace Tests\Feature\Manager;

use Tests\TestCase;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HotelTest extends TestCase
{
    use RefreshDatabase;

    public function test_hotel_can_be_edit(): void
    {
        $hotel = Hotel::factory()->create();
        $user = User::factory()->create([
            'role_id' => 2,
            'hotel_id' => $hotel->getKey()
        ]);

        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->get('/manager/hotels/' . $hotel->getKey() . '/edit');
        $response->assertStatus(200);
    }

    public function test_hotels_can_be_updated(): void
    {
        $hotel = Hotel::factory()->create();

        Storage::delete($hotel->poster_url);

        $image = UploadedFile::fake()->image('hotel.jpg');
        $file = Storage::fake('public')->put('/hotels/', $image);

        $user = User::factory()->create([
            'role_id' => 2,
            'hotel_id' => $hotel->getKey()
        ]);
        $attributes = [
            'title' => 'New Hotel',
            'description' => 'New Description',
            'address' => 'New address',
            'poster_url' => $file
        ];

        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->patch('/manager/hotels/' . $hotel->getKey(), $attributes);
        $response->assertStatus(302);

        Storage::disk('public')->assertExists('/hotels/' . $image->hashName());

        $this->assertDatabaseHas('hotels', array_merge(
            ['id' => $hotel->getKey()], $attributes
        ));
    }
}
