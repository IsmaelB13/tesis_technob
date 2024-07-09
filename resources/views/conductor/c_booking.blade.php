<!DOCTYPE html>
<html>
<head>
    @include('conductor.css')

    <style type="text/css">
        .table_deg {
            border: 2px solid white;
            margin: auto;
            width: 80%;
            text-align: center;
            margin-top: 40px;
        }
        .th_deg {
            background-color: #007bff; /* Color de fondo azul */
            color: white; /* Color del texto blanco */
            padding: 15px;
        }
        tr {
            border: 2px solid black; 
        }
        td {
            padding: 10px;
        }
    </style>
</head>
<body>
@include('conductor.c_header')
@include('conductor.c_sidebar')
<!-- Sidebar Navigation end-->

<div class="page-content" style="background-color: #ffffff;">
    <div class="page-header" style="background-color: #ffffff;">
        <div class="container-fluid">
            <h1>Este modulo te permite ver la información de la reserva</h1>
          
            <table class="table_deg">
                <tr>
                    <th class="th_deg">ID</th>
                    <th class="th_deg">Cliente</th>
                    <th class="th_deg">Teléfono</th>
                    <th class="th_deg">Llegada</th>
                    <th class="th_deg">Salida</th>
                    <th class="th_deg">Estado</th>
                    <th class="th_deg">Solicitud</th>
                    <th class="th_deg"></th>
                </tr>

                @foreach($data as $item)
                <tr>
                    <td>{{$item->room_id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->start_date}}</td>
                    <td>{{$item->end_date}}</td>
                    <td>
                        @if($item->status == 'Aprobado')
                            <span style="color:green;">Aprobado</span>
                        @elseif($item->status == 'Rechazado')
                            <span style="color:red;">Rechazado</span>
                        @elseif($item->status == 'Espera')
                            <span style="color:rgb(255, 102, 0);">Espera</span>
                        @endif
                    </td>
                    <td>
                        @if($item->status == 'Espera')
                            <span style="padding-bottom:10px;">
                                <a onclick="return confirm('¿Seguro que desea eliminar?');" class="btn btn-danger" href="{{url('c_delete_booking',$item->id)}}">Eliminar</a>
                                <a class="btn btn-success" href="{{url('c_approve_book',$item->id)}}">Aprobar</a>
                                <a class="btn btn-warning" href="{{url('c_reject_book',$item->id)}}">Rechazar</a>
                            </span>
                        @else
                            <!-- Si no está en estado 'waiting', deshabilitar los botones -->
                            <span style="padding-bottom:10px;">
                                <button class="btn btn-danger" disabled>Eliminar</button>
                                <button class="btn btn-success" disabled>Aprobar</button>
                                <button class="btn btn-warning" disabled>Rechazar</button>
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@include('conductor.c_footer')
</body>
</html>
