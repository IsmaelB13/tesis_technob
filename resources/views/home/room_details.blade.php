<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style type="text/css">
        label {
            display: inline-block;
            width: 200px;
        }
        input {
            width: 100%;
        }
        .alert {
            font-size: 14px;
            padding: 10px;
            margin-bottom: 10px;
        }
        /* Ocultar la imagen inicialmente */
        #transferImage {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @include('home.header')

    <div class="our_room">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>VIajes</h2>
                        <p>Vive las experiencias turísticas más increíbles en Quito</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div id="serv_hover" class="room d-flex align-items-center">
                        <div class="room_img" style="flex: 1;">
                            <img style="height:300px; width:100%;" src="/room/{{$room->image}}" alt="#"/>
                        </div>
                        <div class="bed_room" style="flex: 1; padding-left: 20px;">
                            <h1 style="font-weight: bold; font-size: 2em;">Detalles del viaje</h1>
                            <h2>{{$room->room_title}}</h2> <br>
                            <label>Descripción:</label> <p style="padding: 12px;">{{$room->description}}</p>
                            <label>Precio por día:</label><p style="padding: 12px">{{$room->price}}</p>
                            <label>Vehículo:</label><p style="padding: 12px">{{$room->room_type}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <center>
                        <h1 style="font-size: 40px!important;">Reservas</h1>
                    </center>

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-bs-dismiss="alert">x</button>
                            {{session()->get('message')}}
                        </div>
                    @endif

                    @if($errors)
                        @foreach($errors->all() as $error)
                            <li style="color:red">
                                {{$error}}
                            </li>
                        @endforeach
                    @endif

                    <form action="{{url('add_booking', $room->id)}}" method="Post">
                        @csrf

                        <div>
                            <label>Nombre</label>
                            <input type="text" name="name"
                            @if(Auth::id())
                                value="{{Auth::user()->name}}" readonly>
                            @endif
                        </div>

                        <div>
                            <label>Correo</label>
                            <input type="email" name="email"
                            @if(Auth::id())
                                value="{{Auth::user()->email}}" readonly>
                            @endif
                        </div>

                        <div>
                            <label>Telefono</label>
                            <input type="number" name="phone"
                            @if(Auth::id())
                                value="{{Auth::user()->phone}}" readonly>
                            @endif
                        </div>

                        <div>
                            <label>Fecha Inicio</label>
                            <input type="date" name="startDate" id="startDate" min="">
                        </div>

                        <div>
                            <label>Fecha Fin</label>
                            <input type="date" name="endDate" id="endDate" min="">
                        </div>
                        <br>

                        <div>
                            <label>Tipo de Pago</label>
                            <select id="tipoPago" name="calificacion" required>
                                <option selected value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                        </div>

                        <div id="transferImage">
                            <label>Banco</label>
                            <p style="padding: 12px">{{$room->bank}}</p>
                            <label>Cuenta de Ahorros</label>
                            <p style="padding: 12px">{{$room->account_number}}</p>
                        </div>

                        <div style="padding-top: 20px;">
                            <input type="submit" style="background-color:skyblue;" class="btn btn-primary" value="Reservar">
                        </div>
                    </form>
                    <br>
                </div>
            </div>

            <div class="row">
                <!-- Aprobado y Rechazado Sections -->
                <div class="col-md-12">
                    <div class="row">
                        @foreach($item as $data)
                            <div class="col-md-4 mb-3">
                                @if($data->status == 'Aprobado' && $data->room_id == $room->id && $data->email == Auth::user()->email)
                                    <form action="{{ url('add_calificacion', $data->id) }}" method="POST" enctype="multipart/form-data" id="formCalificacion{{ $data->id }}">
                                        @csrf
                                        <div class="alert alert-success">
                                            <center>
                                                <label for="calificacion">CALIFICACIÓN</label><br>
                                                <h1>Reserva del:</h1>
                                                <td>{{ $data->start_date }}</td><br><br>
                                                <h1>Hasta:</h1>
                                                <td>{{ $data->end_date }}</td><br>
                                                <select id="calificacion{{ $data->id }}" name="calificacion" required>
                                                    <option selected value="Excelente">Excelente</option>
                                                    <option value="Buena">Buena</option>
                                                    <option value="Regular">Regular</option>
                                                    <option value="Mala">Mala</option>
                                                    <option value="Pesima">Pésima</option>
                                                </select>
                                                <button type="submit" style="background-color: skyblue;" class="btn btn-primary btn-sm btnCalificar" data-id="{{ $data->id }}">Calificar</button>
                                            </center>
                                        </div>
                                    </form>
                                @elseif($data->status == 'Rechazado' && $data->room_id == $room->id && $data->email == Auth::user()->email)
                                    <div class="alert alert-danger">
                                        <center>
                                            <h1>Rechazada la reserva:</h1>
                                            <td>{{$data->start_date}}</td><br><br>
                                            <h1>Hasta:</h1>
                                            <td>{{$data->end_date}}</td>
                                            <h5>Motivo:<br>!Servicio no disponible!</h5>
                                        </center>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('home.footer')

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Establecer la fecha mínima como hoy
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('startDate').setAttribute('min', today);
            document.getElementById('endDate').setAttribute('min', today);

            // Mostrar u ocultar los detalles de transferencia según la selección del tipo de pago
            $('#tipoPago').on('change', function() {
                if ($(this).val() === 'Transferencia') {
                    $('#transferImage').show();
                } else {
                    $('#transferImage').hide();
                }
            });

            // Escuchar el evento 'submit' de los formularios de calificación
            $('.btnCalificar').on('click', function(e) {
                e.preventDefault();
                var formId = $(this).data('id');
                var form = $('#formCalificacion' + formId);

                // Desactivar el botón de calificar
                $(this).prop('disabled', true);

                // Enviar el formulario usando AJAX
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        // Manejar la respuesta según sea necesario
                        console.log('Calificación enviada correctamente.');
                        // Aquí puedes añadir más lógica si es necesario
                    },
                    error: function(error) {
                        console.error('Error al enviar la calificación:', error);
                        // Puedes manejar errores aquí
                    }
                });
            });
        });
    </script>
</body>
</html>
