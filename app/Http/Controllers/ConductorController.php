<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Gallary;
use App\Models\Contact;
use Notification;
use App\Notifications\SendEmailNotification;

class ConductorController extends Controller
{
    public function index()
    {
        if(Auth::user()->usertype == 'user')
        {
            $room = Room::all();
            $gallary = Gallary::all();

            return view('home.index',compact('room','gallary'));
        }
        else if(Auth::user()->usertype == 'admin')
        {
            return view('admin.index');
        }

        else{

            return view('conductor.index');

        }

    }
    public function home()
    {
        
        $room = Room::all();
        $gallary = Gallary::all();
        return view('conductor.index',compact('room','gallary'));
    }

    public function c_create_room()
    {
        return view('conductor.c_create_room');
    }
    public function c_add_room(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:45|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/|unique:rooms,room_title',
        'description' => 'required|string|max:50',
        'price' => 'required|numeric|max:1000',
        'image' => 'required|mimes:jpg,png,jfif|max:2048',
        'wifi' => 'required|in:efectivo,transferencia',
        'bank' => 'required_if:wifi,transferencia|nullable|string|max:20|regex:/^[A-Za-z\s]{1,20}$/',
        'account_number' => 'required_if:wifi,transferencia|nullable|digits:10',
    ], [
        'title.unique' => 'El título ya ha sido registrado.',
        'title.regex' => 'El título solo puede contener letras y espacios.',
        'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, png, jfif.',
        'bank.required_if' => 'El banco es obligatorio cuando el pago es por transferencia.',
        'bank.regex' => 'El banco solo puede contener letras y espacios, máximo 20 caracteres.',
        'account_number.required_if' => 'El número de cuenta es obligatorio cuando el pago es por transferencia.',
        'account_number.digits' => 'El número de cuenta debe tener exactamente 10 dígitos.',
    ]);

    $data = new Room;

    $data->room_title = $request->title;
    $data->description = $request->description;
    $data->price = $request->price;
    $data->wifi = $request->wifi;
    $data->room_type = $request->type;
    $data->bank = $request->bank;
    $data->account_number = $request->account_number;
    $image = $request->image;

    if($image)
    {
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('room', $imagename);
        $data->image = $imagename;
    }

    $data->save();
    return redirect()->back()->with('success', 'Viaje agregado exitosamente.');
}


    public function c_view_room()
    {
         $data = Room::paginate(4)->withQueryString();
        return view('conductor.c_view_room', compact('data'));
    }
    public function c_room_delete($id)
    {
        $data= Room::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function c_room_update($id)
    {
        $data= Room::find($id);
        return view('conductor.c_update_room',compact('data'));
    }

    public function c_detalles($id)
    {
        $data= Room::find($id);
        return view('conductor.c_detalles',compact('data'));
    }
    

    public function c_edit_room(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:25|regex:/^[A-Za-z\s]+$/|unique:rooms,room_title,' . $id,
            'description' => 'required|string|max:50',
            'price' => 'required|numeric|max:1000',
            'image' => 'nullable|mimes:jpg,png,jfif|max:2048'
        ], [
            'title.unique' => 'El título ya ha sido registrado.',
            'title.regex' => 'El título solo puede contener letras y espacios.',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpg, png, jfif.'
        ]);
    
        $data = Room::find($id);
        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;
    
        $image = $request->image;
    
        if($image)
        {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $data->image = $imagename;
        }
    
        $data->save();
        return redirect()->back()->with('success', 'Plan Turístico actualizado exitosamente.');
    }
    

    public function c_bookings()
    {
        $data=Booking::all();
        return view('conductor.c_booking',compact('data'));
       
    }
    
    public function c_view_calificacion()
    {
        $ver=Booking::all();
        return view('conductor.c_view_calificacion',compact('ver'));
    }


    public function c_delete_booking($id)
    {
        $data=Booking::find($id);
        $data->delete();

        return redirect()->back();
    }
    public function c_approve_book($id)
    {
        $booking = Booking::find($id);
        $booking->status='Aprobado';
        $booking->save();
        return redirect()->back();
    }
    public function c_reject_book($id)
    {
        $booking = Booking::find($id);
        $booking->status='Rechazado';
        $booking->save();
        return redirect()->back();
    }

    public function c_view_gallary()
    {
        $gallary= Gallary::all();
        return view('conductor.c_gallary',compact('gallary'));
    }

    public function c_upload_gallary(Request $request)
    {
        $data= new Gallary;
        $image = $request->image;

        if($image)
        {
            $imagename=time().'.' .$image->getClientOriginalExtension();
            $request->image->move('gallary',$imagename);
            $data->image = $imagename;
            $data->save();
            return redirect()->back();
        }
    }

    public function c_delete_gallary($id)
    {
        $data= Gallary::find($id);
        $data->delete();

    
        return redirect()->back();
    }

    public function c_all_messages()
    {
        $data =  Contact::all();
        return view('conductor.c_all_message',compact('data'));
    }

    public function c_send_mail($id)
    {
        $data = Contact::find($id);
        return view('conductor.c_send_mail',compact('data'));
    }

    public function c_mail(Request $request, $id)
{
    $data = Contact::find($id);
    $details = [
        'greeting' => $request->greeting,
        'body' => $request->body,
        'action_text' => $request->action_text,
        'action_url' => $request->action_url,
        'endline' => $request->endline,
    ];
    Notification::send($data,new SendEmailNotification($details));

    return redirect()->back();



}

}