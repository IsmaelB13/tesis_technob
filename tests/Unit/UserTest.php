<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function it_renders_home_route()
    {
        // Simula una solicitud GET a la ruta '/home'
        $response = $this->get('/home');

        // Verifica que la respuesta tenga un código de estado HTTP 200 (OK)
        $response->assertStatus(200);

        // Verifica que la vista 'home.index' se está utilizando para renderizar la respuesta
        $response->assertViewIs('home.index');
    }

    // Puedes agregar más pruebas para otras rutas de manera similar
}
