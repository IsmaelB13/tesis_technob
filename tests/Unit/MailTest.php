<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{
    use RefreshDatabase; // Asegura que la base de datos se restablezca después de cada prueba

    /**
     * Test sending an email in response to a suggestion.
     *
     * @return void
     */
    public function test_send_email_response_to_suggestion()
    {
        // Suponiendo que tienes un modelo de sugerencia en tu aplicación
        $suggestion = factory(\App\Models\Suggestion::class)->create();

        // Datos simulados para el formulario de envío de correo
        $data = [
            'greeting' => 'Hola',
            'body' => 'Este es el cuerpo del correo.',
            'endline' => 'Saludos',
        ];

        // Simula el envío del formulario de correo
        $response = $this->post('/mail/' . $suggestion->id, $data);

        // Verifica que se haya redirigido correctamente después de enviar el correo (ajusta según tu lógica de redirección)
        $response->assertRedirect('/'); // Cambiar '/' por la ruta a la que se redirige después de enviar el correo

        // Verifica que se haya enviado el correo electrónico
        Mail::assertSent(\App\Mail\SuggestionResponse::class, function ($mail) use ($data) {
            return $mail->greeting === $data['greeting'] &&
                   $mail->body === $data['body'] &&
                   $mail->endline === $data['endline'];
        });
    }
}
