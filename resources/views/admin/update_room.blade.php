<!DOCTYPE html>
<html>
<head>
  <title>Update Room</title>
  <base href="/public";>
  @include('admin.css')

  <style type="text/css">
    body {
      font-family: Arial, sans-serif; /* Cambiar la fuente según necesites */
      background-color: #f0f0f0; /* Color de fondo para toda la página */
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px; /* Ancho máximo del contenido del formulario */
      margin: auto; /* Centrar el contenido horizontalmente */
      padding: 20px;
      background-color: #fff; /* Fondo blanco para el formulario */
      border-radius: 8px; /* Bordes redondeados */
      box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Sombra ligera */
      border: 2px solid #ffc107; /* Borde amarillo */
    }
    label {
      display: inline-block;
      width: 120px; /* Ancho de las etiquetas */
      margin-bottom: 10px;
      font-weight: bold;
    }
    input[type=text], input[type=password], input[type=number], input[type=email] {
      width: calc(100% - 130px); /* Ancho de los campos de entrada */
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc; /* Borde del campo de entrada */
      border-radius: 4px; /* Bordes redondeados */
      box-sizing: border-box; /* Asegurar que el padding no afecte el ancho total */
    }
    .btn-warning {
      display: block;
      width: 100%; /* Ancho completo del botón */
      background-color: #ffc107; /* Color de fondo del botón de advertencia */
      color: #212529; /* Color del texto del botón de advertencia */
      padding: 10px 0; /* Padding arriba y abajo, 0 a los lados para centrarlo */
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }
    .btn-warning:hover {
      background-color: #e0a800; /* Cambio de color al pasar el mouse sobre el botón */
    }
  </style>
</head>
<body>
  @include('admin.header')
  @include('admin.sidebar')

  <div class="page-content" style="background-color: #ffffff;">
    <div class="page-header" style="background-color: #ffffff;">
   
        <h1>Este módulo te permite actualizar la información del conductor</h1><br>
        
      <div class="container">
        
        <h1 style="font-size: 30px; font-weight:bold; text-align: center;">Actualizar </h1> <br>

        <form action="{{ url('edit_room', $data->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
      
      
          @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif
      
          <div class="form-group">
              <label for="name">Nombre</label>
              <input type="text" id="name" name="name" required maxlength="15" pattern="[A-Za-zÀ-ÿ\s]+" title="Solo se permiten letras y espacios." value="{{ old('name', $data->name) }}">
              @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          </div>
      
          <div class="form-group">
              <label for="email">Correo</label>
              <input type="email" id="email" name="email" required value="{{ old('email', $data->email) }}">
              @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          </div>
      
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
      
          <div class="form-group">
              <label for="phone">Teléfono</label>
              <input type="number" id="phone" name="phone" required value="{{ old('phone', $data->phone) }}">
              @error('phone')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          </div>
      
          <input type="hidden" id="usertype" name="usertype" value="conductor">
      
          <div class="form-group">
              <input class="btn btn-warning" type="submit" value="Actualizar">
          </div>
      </form>
      
      </div>
    </div>
  </div>

  @include('admin.footer')
</body>
</html>
