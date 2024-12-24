<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class HotelTest extends TestCase
{
    use RefreshDatabase;

    public function test_hotels_index(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);

        $response = $this
                ->actingAs($user)
                ->assertAuthenticated()
                ->get('/admin/hotels');
        $response->assertStatus(200);
    }

    public function test_hotel_can_be_edit(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);
        $hotel = Hotel::factory()->create();

        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->get('/admin/hotels/' . $hotel->getKey() . '/edit');
        $response->assertOk();
    }

    public function test_hotels_can_be_created(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);

        $image = UploadedFile::fake()->image('hotel.jpg');
        $file = Storage::fake('public')->put('/hotels/', $image);
        $attributes = [
            'title' => 'Hotel',
            'description' => 'Description',
            'address' => 'Address',
            'poster_url' => $file,
        ];

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->post('/admin/hotels/', $attributes);
        $response->assertStatus(302);

        Storage::disk('public')->assertExists('/hotels/' . $image->hashName());

        $this->assertDatabaseHas('hotels', $attributes);
    }

    public function test_hotels_can_be_updated(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);
        $hotel = Hotel::factory()->create();

        Storage::delete($hotel->poster_url);
        
        $image = UploadedFile::fake()->image('hotel.jpg');
        $file = Storage::fake('public')->put('hotels', $image);

        $attributes = [
            'title' => 'New Hotel',
            'description' => 'New Description',
            'address' => 'New address',
            'poster_url' => $file
        ];

        $response = $this
                    ->actingAs($user)
                    ->assertAuthenticated()
                    ->patch('/admin/hotels/' . $hotel->getKey(), $attributes);
        $response->assertStatus(302);

        Storage::disk('public')->assertExists('/hotels/' . $image->hashName());

        $this->assertDatabaseHas('hotels', array_merge(
            ['id' => $hotel->getKey()], $attributes
        ));
    }

    public function test_hotels_can_be_deleted(): void
    {
        $user = User::factory()->create([
            'role_id' => 3
        ]);

        $image = UploadedFile::fake()->image('hotel.jpg');
        $file = Storage::fake('public')->put('/hotels/', $image);

        $hotel = Hotel::factory()->create([
            'poster_url' => $file
        ]);

        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs($user)
                    ->delete('/admin/hotels/' . $hotel->getKey());
        $response->assertStatus(302);

        Storage::disk('public')->assertMissing('/hotels/' . $image->hashName());

        $this->assertDatabaseMissing('hotels', ['id' => $hotel->getKey()]);
    }
}
