<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Booking; // Asegúrate de importar el modelo correcto de Booking

class ApproveTripTest extends TestCase
{
    use RefreshDatabase; // Asegura que la base de datos se restablezca después de cada prueba

    /**
     * Test approving a booking.
     *
     * @return void
     */
    public function test_approve_booking()
    {
        // Crea una reserva de ejemplo en la base de datos
        $booking = Booking::factory()->create([
            'status' => 'waiting', // Estado inicial de la reserva
        ]);

        // Simula la visita a la página donde se muestra la información de las reservas
        $response = $this->get('/c_show_booking');

        // Verifica que la página cargue correctamente
        $response->assertStatus(200);

        // Simula la aprobación de la reserva
        $response = $this->get('/c_approve_book/' . $booking->id);

        // Verifica que se haya redirigido correctamente después de aprobar la reserva
        $response->assertRedirect('/c_show_booking'); // Cambiar '/c_show_booking' por la ruta a la que se redirige después de aprobar la reserva

        // Verifica que el estado de la reserva haya cambiado a "Aprobado" en la base de datos
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'Aprobado',
        ]);
    }
}
