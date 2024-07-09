<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    use RefreshDatabase; // Asegura que la base de datos se restablezca después de cada prueba

    /**
     * Test for deleting an image from the gallery.
     *
     * @return void
     */
    public function test_delete_image_from_gallery()
    {
        // Suponiendo que tienes una imagen en la galería para la prueba
        $image = factory(\App\Models\Gallery::class)->create();

        // Simula la petición para eliminar la imagen
        $response = $this->delete('/delete_gallary/' . $image->id);

        // Verifica que se haya redirigido correctamente después de eliminar
        $response->assertRedirect('/'); // Cambiar '/' por la ruta a la que se redirige después de eliminar

        // Verifica que la imagen ya no exista en la base de datos
        $this->assertDatabaseMissing('galleries', ['id' => $image->id]);
    }
}
