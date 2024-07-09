<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\EmailVerificationController;

route::get('/',[AdminController::class,'home']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
});

Route::get('/check-email', [EmailVerificationController::class, 'checkEmail'])->name('checkEmail');

//rutas del administrador
route::get('/home',[AdminController::class,'index']);
route::get('/create_room',[AdminController::class,'create_room']);
route::post('/add_room',[AdminController::class,'add_room']);
route::get('/view_room',[AdminController::class,'view_room']);
route::get('/room_delete/{id}',[AdminController::class,'room_delete']);
route::get('/room_update/{id}',[AdminController::class,'room_update']);
route::post('/edit_room/{id}',[AdminController::class,'edit_room']);
route::get('/bookings',[AdminController::class,'bookings']);
route::get('/delete_booking/{id}',[AdminController::class,'delete_booking']);
route::get('/approve_book/{id}',[AdminController::class,'approve_book']);
route::get('/reject_book/{id}',[AdminController::class,'reject_book']);
route::get('/view_gallary',[AdminController::class,'view_gallary']);
route::post('/upload_gallary',[AdminController::class,'upload_gallary']);
route::get('/delete_gallary/{id}',[AdminController::class,'delete_gallary']);
route::get('/all_messages',[AdminController::class,'all_messages']);
route::get('/send_mail/{id}',[AdminController::class,'send_mail']);
route::post('/mail/{id}',[AdminController::class,'mail']);
route::get('/send_mail_conductor/{id}',[AdminController::class,'send_mail_conductor']);
route::post('/mail_conductor/{id}',[AdminController::class,'mail_conductor']);

//rutas del cliente
route::get('/room_details/{id}',[HomeController::class,'room_details']);
route::post('/add_booking/{id}',[HomeController::class,'add_booking']);
Route::post('/add_calificacion/{id}', [HomeController::class, 'add_calificacion']);
route::get('/our_rooms',[HomeController::class,'our_rooms']);
route::get('/hotel_gallary',[HomeController::class,'hotel_gallary']);
route::get('/contact_us',[HomeController::class,'contact_us']);
route::post('/contact',[HomeController::class,'contact']);




//Rutas del Conductor

route::get('/home',[ConductorController::class,'index']);
route::get('/c_create_room',[ConductorController::class,'c_create_room']);
route::post('/c_add_room',[ConductorController::class,'c_add_room']);
route::get('/c_view_room',[ConductorController::class,'c_view_room']);
route::get('/c_room_delete/{id}',[ConductorController::class,'c_room_delete']);
route::get('/c_room_update/{id}',[ConductorController::class,'c_room_update']);
route::get('/c_detalles/{id}',[ConductorController::class,'c_detalles']);
route::post('/c_edit_room/{id}',[ConductorController::class,'c_edit_room']);
route::get('/c_bookings',[ConductorController::class,'c_bookings']);
route::get('/c_delete_booking/{id}',[ConductorController::class,'c_delete_booking']);
route::get('/c_approve_book/{id}',[ConductorController::class,'c_approve_book']);
route::get('/c_reject_book/{id}',[ConductorController::class,'c_reject_book']);
route::get('/c_view_gallary',[ConductorController::class,'c_view_gallary']);
route::post('/c_upload_gallary',[ConductorController::class,'c_upload_gallary']);
route::get('/c_delete_gallary/{id}',[ConductorController::class,'c_delete_gallary']);
route::get('/c_all_messages',[ConductorController::class,'c_all_messages']);
route::get('/c_send_mail/{id}',[ConductorController::class,'c_send_mail']);
route::post('/c_mail/{id}',[ConductorController::class,'c_mail']);
route::get('/c_view_calificacion',[ConductorController::class,'c_view_calificacion']);






