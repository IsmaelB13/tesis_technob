<!DOCTYPE html>
<html>
<head>
  @include('admin.css')
  <style type="text/css">
    body {
      font-family: Arial, sans-serif;
      background-color: #ffffff; /* Fondo blanco para toda la página */
      margin: 0;
      padding: 0;
    }
    .table_deg {
      border: 2px solid black; /* Borde negro para la tabla */
      margin: auto;
      width: 80%;
      text-align: center;
      margin-top: 40px;
    }
    .th_deg {
      background: #007bff; /* Fondo azul para los encabezados */
      color: white; /* Texto blanco para los encabezados */
      padding: 20px; /* Espaciado interno */
    }
    tr {
      border: 2px solid black; /* Borde negro para las filas */
    }
    td {
      padding: 10px; /* Espaciado interno de las celdas */
    }
    .btn {
      text-decoration: none; /* Quita el subrayado predeterminado en los botones */
      color: white; /* Texto blanco en los botones */
      padding: 8px 16px; /* Espaciado interno de los botones */
      border-radius: 4px; /* Bordes redondeados en los botones */
    }
    .btn-danger {
      background-color: #dc3545; /* Fondo rojo para botón de eliminar */
    }
    .btn-danger:hover {
      background-color: #c82333; /* Cambio de color al pasar el mouse */
    }
    .btn-warning {
      background-color: #ffc107; /* Fondo amarillo para botón de actualizar */
    }
    .btn-warning:hover {
      background-color: #e0a800; /* Cambio de color al pasar el mouse */
    }
  </style>
</head>
<body>
  @include('admin.header')
  @include('admin.sidebar')

  <div class="page-content" style="background-color: #ffffff;">
    <div class="page-header" style="background-color: #ffffff;">
      <div class="container-fluid">
        
          <h1>Este módulo te permite ver innformación de los conductores</h1><br>
       
        
          <table class="table_deg">
            <tr>
              <th class="th_deg">Nombre</th>
              <th class="th_deg">Correo</th>
              <th class="th_deg">Telefono</th>
              <th class="th_deg">Tipo</th>
              <th class="th_deg">Acciones</th>
              
            </tr>
          
            @foreach($data as $user)
              @if($user->usertype == 'conductor')
                <tr>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone}}</td>
                  <td>{{$user->usertype}}</td>
                  <td>

                   
                    <a class="btn btn-warning" href="{{ url('send_mail_conductor', $user->id) }}">Notificación</a>
                  
                    <a onclick="return confirm('¿Seguro de eliminar este registro?')" class="btn btn-danger" href="{{url('room_delete', $user->id)}}">Eliminar</a>
                    <a class="btn btn-success" href="{{url('room_update', $user->id)}}">Actualizar</a>
                  </td>
                 
                </tr>
              @endif
            @endforeach
          </table>
          

      </div>
    </div>
  </div>

  @include('admin.footer')
</body>
</html>
