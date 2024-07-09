<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AddDriverTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_creates_new_driver_with_valid_data()
    {
        // Generamos datos válidos para el conductor
        $name = $this->faker->name;
        $email = $this->faker->unique()->safeEmail;
        $password = 'password123'; // Debe cumplir con las reglas de validación definidas
        $phone = $this->faker->numerify('##########'); // Genera un número de teléfono de 10 dígitos

        // Simulamos la solicitud de agregar un conductor
        $response = $this->post('/add_room', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'usertype' => 'conductor', // Ajusta según sea necesario
        ]);

        // Verificamos que la operación haya sido exitosa (redirección o mensaje de éxito)
        $response->assertRedirect(); // Puedes ajustar esta aserción según el comportamiento esperado

        // Verificamos que el conductor se haya creado en la base de datos
        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        // Mensaje en español
        $this->assertTrue(true); // Marcar como éxito
        $this->artisan('test:crear-conductor')
             ->expectsOutput('Se creó correctamente el conductor');
    }
}
