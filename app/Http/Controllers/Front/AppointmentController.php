<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ConfimationAppointmentMail;
use App\Models\Appointments;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function index(){
        return view("front.appointments.index");
    }

    


    public function create(User $user){

        Gate::authorize('make-appointment');

        $user->load("major");
        return view('front.appointments.create' , compact('user'));
    }

    public function store(Request $request , User $user){

        $request->validate([
            "name"=>"required|string|min:3|max:50" ,
            "email"=>"required|email",
            "phone"=>"required|numeric"
        ]);
        
        $appointment = Appointments::create([

        'name' => $request->name , 
        'email' => $request->email , 
        'phone'=> $request->phone ,
        'appointement_date' => date("Y-m-d H:i:s"),
        'patient_id' => auth()->user()->id ,
        'doctor_id' => $user->id ,
            ]);
            

            Mail::to(auth()->user()->email)->send(new ConfimationAppointmentMail($appointment)) ;            
            return back()->with("success" , "your appointment has been successfully");
    }
}
