
<!DOCTYPE html>
<html>
  <head> 
    @include('conductor.css')
    <style type="text/css">
        .table_deg
        {
            border:2px solid white;
            margin:auto;
            width:80%;
            text-align: center;
            margin-top:40px;
        }
        .th_deg
        {
            background:white;
            padding:30px;

        }

        tr
        {
            border: 3px solid white;
        }
        td
        {
            padding:10px;
        }
    </style>
  </head>
  <body>
    @include('conductor.c_header')
    
    @include('conductor.c_sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">


          <table class ="table_deg">
            <tr>
                <th class = "th_deg">Nombre</th>
                <th class = "th_deg">Email</th>
                <th class = "th_deg">Teléfono</th>
                <th class = "th_deg">Mensajes</th>
                <th class = "th_deg">Enviar Correo</th>
                
            </tr>

            
            @foreach($data as $data)
            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->message}}</td>
                <td>
                    <a  class="btn btn-success" href="{{url('c_send_mail',$data->id)}}">Send Mail</a>
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