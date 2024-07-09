<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class Login extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_form_submission()
    {
        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard'); // Cambiar '/dashboard' por la ruta a la que se redirige tras iniciar sesión
    }
}
