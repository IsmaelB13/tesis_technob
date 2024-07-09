<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateDriverTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_user_correctly()
    {
        // Crear un usuario de ejemplo
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('password'),
            'usertype' => 'conductor',
        ]);

        // Datos de prueba para la actualización
        $newData = [
            'name' => 'Updated Name',
            'email' => 'updated.email@example.com',
            'phone' => '9876543210',
            'password' => 'newpassword',
            'usertype' => 'conductor',
        ];

        // Simular una petición POST a la ruta de actualización
        $response = $this->post("/edit_room/{$user->id}", $newData);

        // Verificar redirección y mensaje de éxito en español
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Usuario actualizado correctamente');

        // Verificar que los datos se hayan actualizado correctamente en la base de datos
        $updatedUser = User::find($user->id);

        $this->assertEquals($newData['name'], $updatedUser->name);
        $this->assertEquals($newData['email'], $updatedUser->email);
        $this->assertEquals($newData['phone'], $updatedUser->phone);
        $this->assertEquals($newData['usertype'], $updatedUser->usertype);

        // Verificar que la contraseña se haya encriptado correctamente
        $this->assertTrue(Hash::check($newData['password'], $updatedUser->password));
    }
}
