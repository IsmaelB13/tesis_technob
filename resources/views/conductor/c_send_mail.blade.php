
<!DOCTYPE html>
<html>
  <head> 
  <base href="/public">
    @include('conductor.css')
    <style type="text/css">
        label
        {
            display: inline-block;
            width:200px;
        }

        .div_deg
        {
            padding-top:30px;
        }
        .div_center
        {
            text-align: center;
            padding-top:40px;
        }



    </style>
   
    
  </head>
  <body>
    @include('conductor.c_header')
    
    @include('conductor.c_sidebar')
      
    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

          <center>
            <h1 style ="font-size:30px; font weight:bold;">Enviar correo:  {{$data->name}}</h1>

            <form action="{{url('c_mail', $data->id)}}" method="Post" >
                @csrf

            <div class= "div_deg">
                <label >Saludo</label>
                <input type="text" name="greeting">
            </div>

            <div class= "div_deg"class= "div_deg">
                <label >Correo</label>

                <textarea name="body" ></textarea>
            </div>

            <div class= "div_deg">
                <label >Texto</label>
                <input type="text" name="action_text">
            </div>

            <div class= "div_deg">
                <label >URL</label>
                <input type="text" name="action_url">
            </div>

            <div class= "div_deg">
                <label >Pie del Correo</label>
                <input type="text" name="endline">
            </div>
        

            

            <div class= "div_deg">
                <input class ="btn btn-success" type="submit" value="Send Mail">
            </div>


            </form>



          </center>





    </div>
    </div>
    </div>

    @include('conductor.c_footer')
  </body>
</html>