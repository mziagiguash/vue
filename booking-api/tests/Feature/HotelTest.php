<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Hotel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HotelTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_hotels_index(): void
    {
        $response = $this
                ->get('/hotels');
        $response->assertStatus(200);
    }

    public function test_hotel_can_be_showed(): void
    {
        $hotel = Hotel::factory()->create();

        $response = $this
                    ->get('/hotels/' . $hotel->getKey());
        $response->assertStatus(200);
    }

    public function test_feedbacks_index(): void
    {
        $hotel = Hotel::factory()->create();

        $response = $this
                ->get('/hotels/' . $hotel->getKey() . '/feedbacks');
        $response->assertStatus(200);
    }
}
