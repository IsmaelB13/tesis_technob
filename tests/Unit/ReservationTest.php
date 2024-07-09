<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test room reservation functionality.
     *
     * @return void
     */
    public function testRoomReservation()
    {
        // Crear un usuario autenticado (puedes modificar según tu lógica de autenticación)
        $user = User::factory()->create();

        // Crear una habitación para reservar
        $room = Room::factory()->create();

        // Simular la acción de reserva (ejemplo: haciendo una solicitud POST a la ruta de reserva)
        $response = $this->actingAs($user)
                         ->post('/add_booking/' . $room->id, [
                             'name' => $user->name,
                             'email' => $user->email,
                             'phone' => $user->phone,
                             'startDate' => '2024-07-15', // Fecha de inicio simulada
                             'endDate' => '2024-07-20',   // Fecha de fin simulada
                             'calificacion' => 'Efectivo', // Tipo de pago simulado
                         ]);

        // Verificar redirección a la página de confirmación (o ajustar según la lógica de tu aplicación)
        $response->assertRedirect('/confirmation'); 

        // Verificar que los datos de la reserva se hayan guardado correctamente en la base de datos
        $this->assertDatabaseHas('bookings', [
            'room_id' => $room->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'start_date' => '2024-07-15',
            'end_date' => '2024-07-20',
            'payment_type' => 'Efectivo',
            // Añade más campos según tu estructura de datos de reserva
        ]);
    }
}
