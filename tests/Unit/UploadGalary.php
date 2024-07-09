<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Gallary;

class UploadGalary extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_gallery_images()
    {
        // Crear datos de prueba: galería de imágenes
        $galleryData = [
            ['image' => 'image1.jpg'],
            ['image' => 'image2.jpg'],
            ['image' => 'image3.jpg'],
        ];

        // Insertar datos de prueba en la base de datos
        Gallary::insert($galleryData);

        // Simular una solicitud GET a la vista de galería
        $response = $this->get('/view_gallary');

        // Verificar la respuesta exitosa y la vista esperada
        $response->assertStatus(200);
        $response->assertViewIs('admin.gallary');

        // Verificar que se pasaron los datos correctos a la vista
        $response->assertViewHas('gallary', function ($gallary) use ($galleryData) {
            // Comprobar que se recuperaron todas las imágenes de la galería
            return $gallary->count() === count($galleryData) &&
                   $gallary->pluck('image')->all() === array_column($galleryData, 'image');
        });
    }
}
