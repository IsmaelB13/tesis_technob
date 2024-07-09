<?php

namespace Tests\Feature;

use App\Models\Room; // Asegúrate de importar el modelo Room si no está importado automáticamente
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewRoomsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test viewing rooms on the frontend.
     *
     * @return void
     */
    public function testViewRooms()
    {
        // Crear datos de ejemplo de habitaciones
        $rooms = Room::factory()->count(3)->create();

        // Simular la carga de la vista
        $response = $this->get('/rooms'); // Ajusta la ruta según tu configuración real

        // Verificar que la vista cargue correctamente
        $response->assertStatus(200);

        // Verificar que los datos de las habitaciones se muestren en la vista
        foreach ($rooms as $room) {
            $response->assertSee($room->room_title);
            $response->assertSee($room->description);
            // Puedes agregar más aserciones según los datos que esperas mostrar en la vista
        }
    }
}
