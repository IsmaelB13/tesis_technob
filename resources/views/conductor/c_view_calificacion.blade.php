<!DOCTYPE html>
<html>
<head>
  <title>Calificaciones de Clientes</title>
  @include('conductor.css')

  <style type="text/css">
    .table_deg {
      border: 2px solid black; /* Borde negro */
      margin: auto;
      width: 80%;
      text-align: center;
      margin-top: 40px;
    }
    .th_deg {
      background: #007bff; /* Fondo azul */
      color: white; /* Texto blanco para mejor legibilidad */
      padding: 15px;
    }
    tr {
      border: 2px solid black; /* Borde negro */
    }
    td {
      padding: 10px;
    }
  </style>
</head>
<body>
  @include('conductor.c_header')
  @include('conductor.c_sidebar')

  <div class="page-content" style="background-color: #ffffff;">
    <div class="page-header" style="background-color: #ffffff;">
      <div class="container-fluid">
        <h1>Este módulo te permite visualizar la calificación de los clientes sobre un viaje realizado</h1><br>

        @if ($ver->isEmpty())
          <p>No hay registros disponibles.</p>
        @else
          <table class="table_deg">
            <tr>
              <th class="th_deg">Cliente</th>
              <th class="th_deg">Email</th>
              <th class="th_deg">Teléfono</th>
              <th class="th_deg">Calificación</th>
            </tr>
            @foreach ($ver as $item)
              @if ($item->calificacion !== null && $item->estado !== 'rechazado')
                <tr>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->email }}</td>
                  <td>{{ $item->phone }}</td>
                  <td>
                    {{ $item->calificacion }}
                  </td>
                </tr>
              @endif
            @endforeach
          </table>
        @endif
      </div>
      
    </div>
  </div>

  @include('admin.footer')
</body>
</html>
