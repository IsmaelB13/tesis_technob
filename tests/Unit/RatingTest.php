<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RatingTest extends TestCase
{
    use RefreshDatabase; // Asegura que la base de datos se restablezca después de cada prueba

    /**
     * Test viewing ratings of clients for a trip.
     *
     * @return void
     */
    public function test_view_ratings()
    {
        // Suponiendo que tienes datos simulados de calificación en tu base de datos
        $ratings = factory(\App\Models\Rating::class, 5)->create();

        // Simula la visita a la página que muestra las calificaciones
        $response = $this->get('/ratings'); // Ajusta '/ratings' según tu ruta en Laravel

        // Verifica que la página se cargue correctamente
        $response->assertStatus(200);

        // Verifica que las calificaciones se muestran correctamente en la tabla
        foreach ($ratings as $rating) {
            $response->assertSee($rating->name); // Ajusta según cómo se muestra el nombre en tu vista
            $response->assertSee($rating->email); // Ajusta según cómo se muestra el correo en tu vista
            $response->assertSee($rating->phone); // Ajusta según cómo se muestra el teléfono en tu vista
            $response->assertSee($rating->calificacion); // Ajusta según cómo se muestra la calificación en tu vista
        }
    }
}
