<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Gallary;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function room_details($id)
    {
        $room = Room::find($id);
        $item = Booking::all();
        $user = Auth::user();
        return view('home.room_details', compact('room', 'item', 'user'));
    }
 

    public function add_booking(Request $request, $id)
    {
        $request->validate([

            'startDate'=> 'required|date',
            'endDate'=> 'date|after:startDate',
        ]);


        $data = new Booking;
        $data->room_id = $id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
      


        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $isBooked=Booking::where('room_id',$id)->where('start_date','<=',$endDate)->where('end_date', '>=',$startDate)->exists();

        if($isBooked)
        {
            return redirect()->back()->with('message','Fecha no disponible por favor probar con una fecha diferente');
        }

        else
        {
            $data->start_date = $request->startDate;
            $data->end_date = $request->endDate;
    
            $data-> save();
            return redirect()->back()->with('message','Registro ingresado con éxito');


        }

     

    }

    public function add_calificacion(Request $request,$id){
        
        $data = Booking::find($id);

        $data->calificacion = $request->calificacion;
        $data-> save();
        return redirect()->back();


    } 



    
    public function contact(Request $request)
    {
        $contact= new Contact;  
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->title = $request->title;



        $contact->save();
        return redirect()->back()->with('message','Mensaje Enviado con éxito');


        
    }

    public function our_rooms()
    {
        $room= Room::all();
        return view('home.our_rooms',compact('room'));
    }
    public function hotel_gallary()
    {
        $gallary= Gallary::all();
        return view('home.hotel_gallary',compact('gallary'));
    }

    public function contact_us()
    {
        $room = Room::all();
       
        return view('home.contact_us',compact('room'));
    }

   
}
