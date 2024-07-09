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

class AdminController extends Controller
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
        $user = User::all();
        $room = Room::all();
        $gallary = Gallary::all();
        return view('home.index',compact('room','gallary'));
    }

    public function create_room()
    {
        return view('admin.create_room');
    }

    public function add_room(Request $request)
    {
    // Validación
    $request->validate([
        'name' => 'required|regex:/^[A-Za-zÀ-ÿ\s]+$/|max:15',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'phone' => 'required|digits:10',
    ], [
        'email.unique' => 'El correo ya está en uso.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'phone.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
    ]);

    // Guardar los datos en la base de datos si la validación pasa
    $data = new User;
    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;
    $data->usertype = $request->usertype;
    $data->password = bcrypt($request->password); // Asegúrate de encriptar la contraseña

    $data->save();
    return redirect()->back()->with('success', 'Usuario agregado correctamente');
}

    public function view_room()
    {
        $data= User::all();
        return view('admin.view_room', compact('data'));
    }
    
    public function room_delete($id)
    {
        $data= User::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function room_update($id)
    {
        $data= User::find($id);
        return view('admin.update_room',compact('data'));
    }
   
    public function edit_room(Request $request, $id)
{
    // Validación
    $request->validate([
        'name' => 'required|regex:/^[A-Za-zÀ-ÿ\s]+$/|max:15',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'required|min:8',
        'phone' => 'required|digits:10',
    ], [
        'email.unique' => 'El correo ya está en uso.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'phone.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
    ]);

    // Actualizar los datos en la base de datos si la validación pasa
    $data = User::find($id);
    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;
    $data->usertype = $request->usertype;

    // Si la contraseña es la misma que la actual, no cambiarla
    if ($request->password !== $data->password) {
        $data->password = bcrypt($request->password); // Asegúrate de encriptar la nueva contraseña
    }

    $data->save();
    return redirect()->back()->with('success', 'Usuario actualizado correctamente');
}


    public function bookings()
    {
        $data=Booking::all();
        return view('admin.booking',compact('data'));
    }

    public function delete_booking($id)
    {
        $data=Booking::find($id);
        $data->delete();

        return redirect()->back();
    }
    public function approve_book($id)
    {
        $booking = Booking::find($id);
        $booking->status='Aprobado';
        $booking->save();
        return redirect()->back();
    }
    public function reject_book($id)
    {
        $booking = Booking::find($id);
        $booking->status='Rechazado';
        $booking->save();
        return redirect()->back();
    }

    public function view_gallary()
    {
        $gallary= Gallary::all();
        return view('admin.gallary',compact('gallary'));
    }

    public function upload_gallary(Request $request)
    {
        // Validación del lado del servidor
        $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png,jfif|max:5120', // max:5120 equivale a 5MB
        ]);
    
        // Procesamiento de la carga de imagen si la validación es exitosa
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('gallary', $imageName);
    
            // Guardar el nombre de la imagen en la base de datos
            $data = new Gallary;
            $data->image = $imageName;
            $data->save();
    
            return redirect()->back()->with('success', 'Imagen agregada correctamente');
        }
    
        // Si llegamos aquí, la validación falló o no se envió ninguna imagen
        return redirect()->back()->with('error', 'Error al cargar la imagen');
    }
    

    public function delete_gallary($id)
    {
        $data= Gallary::find($id);
        $data->delete();

    
        return redirect()->back();
    }

    public function all_messages()
    {
        
        $data = Contact::paginate(4)->withQueryString();
        return view('admin.all_message',compact('data'));
    }

    public function send_mail($id)
    {
        $data = Contact::find($id);
        return view('admin.send_mail',compact('data'));
    }
    public function send_mail_conductor($id)
    {
        $data = User::find($id);
        return view('admin.send_mail_conductor',compact('data'));
    }

    public function mail(Request $request, $id)
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

    public function mail_conductor(Request $request, $id)
    {
    $data = User::find($id);
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
