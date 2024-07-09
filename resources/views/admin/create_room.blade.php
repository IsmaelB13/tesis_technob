<!DOCTYPE html>
<html>
<head>
  <title>Agregar conductor</title>
  @include('admin.css')

  <style type="text/css">
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border: 2px solid #007bff;
    }
    label {
      display: inline-block;
      width: 120px;
      margin-bottom: 10px;
      font-weight: bold;
    }
    input[type=text], input[type=password], input[type=number], input[type=email] {
      width: calc(100% - 130px);
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    .btn-primary {
      display: block;
      width: 100%;
      background-color: #007bff;
      color: #fff;
      padding: 10px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  @include('admin.header')
  @include('admin.sidebar')

  <div class="page-content" style="background-color: #ffffff;">
    <div class="page-header" style="background-color: #ffffff;">
      <h1>Este módulo te permite agregar conductores</h1><br>
      <div class="container">
        <h1 style="font-size: 30px; font-weight: bold; text-align: center;">Agregar </h1><br>
        <form action="{{ url('add_room') }}" method="post" enctype="multipart/form-data">
          @csrf
          @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif
          <div class="form-group">
              <label for="name">Nombre</label>
              <input type="text" id="name" name="name" required maxlength="15" pattern="[A-Za-zÀ-ÿ\s]+" title="Solo se permiten letras y espacios." value="{{ old('name') }}">
              @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          </div>
          <div class="form-group">
              <label for="email">Correo</label>
              <input type="email" id="email" name="email" required value="{{ old('email') }}">
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
              <input type="number" id="phone" name="phone" required value="{{ old('phone') }}">
              @error('phone')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          </div>
          <input type="hidden" id="usertype" name="usertype" value="conductor">
          <div class="form-group">
              <input class="btn btn-primary" type="submit" value="Agregar">
          </div>
        </form>
      </div>
    </div>
  </div>

  @include('admin.footer')
</body>
</html>
