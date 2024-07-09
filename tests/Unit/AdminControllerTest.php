<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Booking;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_a_booking()
    {
        // Crear un booking de ejemplo
        $booking = Booking::factory()->create();

        // Hacer la petición para eliminar el booking
        $response = $this->delete(route('delete_booking', $booking->id));

        // Verificar que la operación haya sido exitosa (redirección o mensaje de éxito)
        $response->assertRedirect(); // Puedes ajustar esta aserción según el comportamiento esperado

        // Verificar que el booking se haya eliminado de la base de datos
        $this->assertDatabaseMissing('bookings', [
            'id' => $booking->id,
        ]);
    }
}
