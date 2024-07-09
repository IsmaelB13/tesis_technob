<!DOCTYPE html>
<html>
<head> 
    @include('admin.css')
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content" style="background-color: #ffffff;">
        <div class="page-header" style="background-color: #ffffff;">
            <div class="container-fluid">
                <h1>Este módulo te permite agregar imagenes turísticas</h1><br>
                <center>
                    <h1 style="font-size: 40px; font-weight: bolder;">Galería</h1>
                    <div class="row">
                        @foreach($gallary as $image)
                        <div class="col-md-4">
                            <img style="height: 200px; width: 300px;" src="/gallary/{{$image->image}}" >
                            <a onclick="return confirm('¿Seguro de eliminar este registro?')" class="btn btn-danger" href="{{url('delete_gallary',$image->id)}}">Eliminar Imagen</a>
                        </div>
                        @endforeach
                    </div>

                    <form action="{{ url('upload_gallary') }}" method="POST" enctype="multipart/form-data" id="galleryForm">
                        @csrf
                        <div style="padding: 30px; display: flex; justify-content: space-between; align-items: center;">
                            <div style="flex: 1;">
                                <label style="color: white; font-weight: bold; text-align: center;">Carga una Imagen:</label>
                                <input type="file" name="image" id="image" style="display: block; margin: 0 auto;">
                            </div>
                            <input class="btn btn-success" type="submit" value="Agregar Imagen" id="submitButton" enable>
                        </div>
                    </form>
                </center>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener referencia al input de la imagen y al botón de enviar
        var imageInput = document.getElementById('image');
        var submitButton = document.getElementById('submitButton');

        // Escuchar cambios en el input de la imagen
        imageInput.addEventListener('change', function () {
            // Verificar si se seleccionó un archivo
            if (this.files.length > 0) {
                var file = this.files[0];
                // Verificar el tamaño del archivo (5MB máximo)
                if (file.size <= 5 * 1024 * 1024) {
                    // Verificar el tipo de archivo (jpg, jpeg, png, jfif)
                    var fileType = file.type.split('/')[1];
                    if (['jpg', 'jpeg', 'png', 'jfif'].includes(fileType)) {
                        // Habilitar el botón de enviar
                        submitButton.enable = true;
                        return;
                    }
                }
            }
            // Si no se cumple alguna condición, deshabilitar el botón de enviar
            submitButton.disabled = true;
        });
    });
</script>
@endpush
