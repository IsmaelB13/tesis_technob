<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AddTripTest extends TestCase
{
    use RefreshDatabase; // Asegura que la base de datos se restablezca después de cada prueba

    /**
     * Test adding a new trip.
     *
     * @return void
     */
    public function test_add_trip()
    {
        Storage::fake('public'); // Finge el almacenamiento de archivos públicos

        // Datos simulados para el formulario de agregar viaje
        $data = [
            'title' => 'Nuevo Viaje',
            'description' => 'Descripción del nuevo viaje',
            'price' => 500,
            'type' => 'Automovil',
            'wifi' => 'yes',
            'image' => UploadedFile::fake()->image('tour.jpg'),
        ];

        // Simula el envío del formulario de agregar viaje
        $response = $this->post('/c_add_room', $data);

        // Verifica que se haya redirigido correctamente después de agregar el viaje
        $response->assertRedirect('/'); // Cambiar '/' por la ruta a la que se redirige después de agregar el viaje

        // Verifica que el viaje se haya guardado correctamente en la base de datos
        $this->assertDatabaseHas('trips', [
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'type' => $data['type'],
            'wifi' => $data['wifi'],
            // Puedes agregar más campos según la estructura de tu tabla de viajes
        ]);

        // Verifica que la imagen se haya almacenado correctamente
        Storage::disk('public')->assertExists('images/' . $data['image']->hashName());
    }
}
