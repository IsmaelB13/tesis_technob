<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
       
        
        <ul class="list-unstyled">
                <li class="active"><a href="{{url('home')}}"> <i class="icon-home"></i>Inicio </a></li>
                
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Gestión Conductores </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('create_room')}}">Agregar Conductores</a></li>
                    <li><a href="{{url('view_room')}}">Ver Conductores</a></li>
                    
                  </ul>
                </li>


                <li>
                  <a href="{{url('view_gallary')}}"> <i class="icon-home"></i>Galeria</a>
                </li>

                <li>
                  <a href="{{url('all_messages')}}"> <i class="icon-home"></i>Quejas</a>
                </li>

                <li>
                  <a href="{{url('bookings')}}"> <i class="icon-home"></i>Calificación</a>
                </li>
              
      </nav>