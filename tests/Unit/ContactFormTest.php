<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test contact form submission.
     *
     * @return void
     */
    public function testContactFormSubmission()
    {
        // Genera datos aleatorios para el formulario
        $formData = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'title' => 'Plan Turístico de Ejemplo', // Aquí puedes ajustar el título según tu lógica
            'message' => $this->faker->paragraph,
        ];

        // Simula una solicitud POST al endpoint del formulario de contacto
        $response = $this->post('/contact', $formData);

        // Verifica que la respuesta sea exitosa (código de estado HTTP 200)
        $response->assertStatus(200);

        // Verifica que el mensaje de éxito se muestra en la respuesta
        $response->assertSee('¡Mensaje enviado correctamente!');

        // Opcionalmente, puedes verificar que los datos enviados están en la base de datos
        // Asegúrate de ajustar esto según cómo se maneje el almacenamiento de datos en tu aplicación
        $this->assertDatabaseHas('contact_messages', [
            'name' => $formData['name'],
            'email' => $formData['email'],
            // Agrega más campos según sea necesario
        ]);
    }
}
