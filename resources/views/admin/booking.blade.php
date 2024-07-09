<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
        .table_deg {
            border: 2px solid black; /* Cambiado a negro */
            margin:auto;
            width:80%;
            text-align: center;
            margin-top:40px;
        }
        .th_deg {
            background: #007bff; /* Cambiado a azul */
            color: white; /* Texto en blanco para mejor legibilidad */
            padding:15px;
        }

        tr {
            border: 2px solid black; /* Cambiado a negro */
        }
        td {
            padding:10px;
      
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar') 
      <!-- Sidebar Navigation end-->

      <div class="page-content" style="background-color: #ffffff;" >
        <div class="page-header" style="background-color: #ffffff;">
          <div class="container-fluid">
            <h1>Este módulo te permite visualizar la calificación de los clientes sobre un viaje realizado</h1><br>

          <table class ="table_deg">
            <tr>
                <th class = "th_deg">Cliente</th>
                <th class = "th_deg">Email</th>
                <th class = "th_deg">Teléfono</th>
                <th class = "th_deg">Calificación</th>
            </tr>

            @foreach($data as $item)
                @if($item->calificacion !== null)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->calificacion}}</td>
                </tr>
                @endif
            @endforeach
          </table>
          <br>
          
          </div>
        </div>
      </div>

    @include('admin.footer')
  </body>
</html>
