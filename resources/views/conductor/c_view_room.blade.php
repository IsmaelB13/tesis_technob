<!DOCTYPE html>
<html>
<head>
    @include('conductor.css')
    <style type="text/css">
        .table_deg {
    border: 2px solid black; /* Cambia el color del borde a negro */
    margin: auto;
    width: 80%;
    text-align: center;
    margin-top: 40px;
}

.th_deg {
    background-color: #007bff; /* Fondo azul para los encabezados */
    color: white; /* Texto blanco para los encabezados */
    padding: 20px;
    border-top: 2px solid black; /* Borde negro en la parte superior */
    border-left: none; /* Sin borde izquierdo */
    border-right: none; /* Sin borde derecho */
}


tr {
    border: 1px solid black; /* Borde negro para las filas */
}

td {
    padding: 10px;

}
.pagination-links {
    margin-top: 10px; /* Ejemplo de ajuste de margen superior */
}

.pagination-info {
    margin-right: 10px; /* Ejemplo de ajuste de margen derecho */
}


    </style>
    <!-- Añade el enlace a Bootstrap aquí -->
      <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">-->
</head>
<body>
    @include('conductor.c_header')
    @include('conductor.c_sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content"style="background-color: #ffffff;">
        <div class="page-header" style="background-color: #ffffff;">
            <div class="container-fluid">
                
                <h1>Este modulo te permite ver la información del viaje</h1>
               
                <table class="table_deg">
                    <tr>
                        <th class="th_deg">Título</th>
                        <th class="th_deg">Precio</th>
                        <th class="th_deg">Tipo de Vehiculo</th>
                        <th class="th_deg">Imagen</th>
                        <th class="th_deg">Acciones</th>
                       
                    </tr>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->room_title }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->room_type }}</td>
                        <td>
                            <img width="120" src="room/{{ $item->image }}">
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{ url('c_detalles', $item->id) }}">Ver detalles</a>
                            <a onclick="return confirm('¿Seguro de eliminar este registro?')" class="btn btn-danger" href="{{ url('c_room_delete', $item->id) }}">Eliminar</a>
                            <a class="btn btn-success" href="{{ url('c_room_update', $item->id) }}">Actualizar</a>
                        </td>
                        
                    </tr>
                    @endforeach
                </table>
                <!-- Paginación -->
                <div class="d-flex justify-content-center">
                    <div class="pagination-info mr-2"> <!-- Añadir margen derecho para separar del paginador -->
                        <span>{{ __('pagination.showing') }} {{ $data->firstItem() }} {{ __('pagination.to') }} {{ $data->lastItem() }} {{ __('pagination.of') }} {{ $data->total() }} {{ __('pagination.results') }}</span>
                        <span class="ml-2">{{ __('pagination.page') }} {{ $data->currentPage() }} {{ __('pagination.current_page') }} {{ $data->lastPage() }}</span>
                    </div>
                    <div > <!-- Añadir margen superior para separar -->
                        {{ $data->links('vendor.pagination.simple-bootstrap-4') }}
                    </div>
                </div>
                
                
                @include('conductor.c_footer')
            </div>
        </div>
    </div>
</body>
</html>
