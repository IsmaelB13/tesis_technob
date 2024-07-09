
<!DOCTYPE html>
<html>
  <head> 
    @include('conductor.css')
  </head>
  <body>
    @include('conductor.c_header')
    
    @include('conductor.c_sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">



          <center>

          <h1 style="font-size:40px; font-weight:bolder;">
            Galeria
          </h1>
          <div class="row">
          @foreach($gallary as $gallary)
          <div class="col-md-4">
          <img style="height: 200!important; width: 300px!important;" src="/gallary/{{$gallary->image}}" >
          <a class="btn btn-danger" href="{{url('c_delete_gallary',$gallary->id)}}">Eliminar Imagen</a>
          </div>
          @endforeach
          </div>



          
          <form action="{{url('c_upload_gallary')}}" method="Post" enctype="multipart/form-data">
            @csrf

            <div style="padding:30px;">
                <label style="color:white; font-weight:bold;" >Carga una Imagen:</label>
                <input type="file" name="image">
            
                
                <input class="btn btn-success" type="submit" value="Agregar Imagen">
            </div>


          </form>
          </center>
         



          </div>
          </div>
          </div>

    @include('conductor.c_footer')
  </body>
</html>