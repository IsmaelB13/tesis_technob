<div class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Quejas u observaciones</h2>
                  </div>

                  @if(session()->has('message'))
                  <div class="alert alert-success">
                     <button type="button" class="close" data-bs-dismiss='alert'>x</button>
                  {{session()->get('message')}}

                  </div>

                  

                  @endif





               </div>
            </div>

            
            <div class="row">
               <div class="col-md-6">
                  <form id="request" class="main_form" action="{{url('contact')}}" method="Post">
                     @csrf
                     <div class="row">
                         <div class="col-md-12">
                             <input class="contactus" placeholder="Nombre" type="text" name="name" 
                             @if(Auth::check())
                                 value="{{ Auth::user()->name }}" readonly
                             @endif
                             required> 
                         </div>
                         <div class="col-md-12">
                             <input class="contactus" placeholder="Correo" type="email" name="email" 
                             @if(Auth::check())
                                 value="{{ Auth::user()->email }}" readonly
                             @endif
                             required> 
                         </div>
                         <div class="col-md-12">
                             <input class="contactus" placeholder="Telefono" type="number" name="phone" 
                             @if(Auth::check())
                                 value="{{ Auth::user()->phone }}" readonly
                             @endif
                             required> 
                         </div>
                         <div class="col-md-12">
                             <label for="rooms">Selecciona el plan turístico:</label><br>
                             <select id="rooms" name="title">
                                 @foreach($room as $rooms)
                                     <option value="{{ $rooms->room_title }}">{{ $rooms->room_title }}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div>
                             <h1></h1>
                         </div>
                         <div class="col-md-12">
                             <textarea class="textarea" placeholder="Mensaje" name="message" required></textarea>
                         </div>
                         <div class="col-md-12">
                             <button type="submit" class="send_btn">Enviar</button>
                         </div>
                     </div>
                 </form>
                 
               </div>
               <div class="col-md-6">
                  <div class="map_main">
                     <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Mitad+del+Mundo+Ecuador" width="600" height="400" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>