<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;

class CalificarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_add_calificacion_to_booking()
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->create(['email' => $user->email]);

        $this->actingAs($user);

        $response = $this->postJson(route('add_calificacion', $booking->id), [
            'calificacion' => 'Excelente',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Calificación actualizada correctamente']);

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'calificacion' => 'Excelente',
        ]);
    }

    /** @test */
    public function it_fails_if_user_is_not_authorized()
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->create(['email' => 'anotheruser@example.com']);

        $this->actingAs($user);

        $response = $this->postJson(route('add_calificacion', $booking->id), [
            'calificacion' => 'Excelente',
        ]);

        $response->assertStatus(401)
                 ->assertJson(['error' => 'Unauthorized']);
    }
}
