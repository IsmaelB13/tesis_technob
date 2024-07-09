<div class="our_room">
   <div class="container">
       <div class="row">
           <div class="col-md-12">
               <div class="titlepage">
                   <h2>Viajes </h2>
                   <p>Vive las experiencias turísticas más increíbles en Quito</p>
               </div>
           </div>
       </div>

       <div class="row">
           @foreach($room as $rooms)
           <div class="col-md-4 col-sm-6">
               <div id="serv_hover" class="room">
                   <div class="room_img">
                       <img style="height:200px; width:320px" src="room/{{$rooms->image}}" alt="#"/>
                   </div>
                   <div class="bed_room">
                       <h3>{{$rooms->room_title}}</h3>
                       <p style="padding:10px">{!! Str::limit($rooms->description, 100) !!}</p>

                       @if(Auth::check())
                           <a class="btn btn-primary" href="{{ url('room_details', $rooms->id) }}">Ver Detalles</a>
                       @else
                           <button class="btn btn-primary" disabled>Ver Detalles</button>
                       @endif
                   </div>
               </div>
           </div>
           @endforeach
       </div>
   </div>
</div>
