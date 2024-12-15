<?php

namespace App\Http\Controllers\Api\V1\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointments;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function index()
    {
     $data = Appointments::all();
        return AppointmentResource::collection($data);
    }

    public function show($id)
    {
        $data = Appointments::findOrFail($id);
        return new AppointmentResource($data);
    }

    public function create(AppointmentRequest $request, User $doctor)
    {
        $Appointment = Appointments::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'appointement_date' => now()/*date("Y-m-d H:i:s")*/,
            'patient_id' => auth("sanctum")->id(),
            'doctor_id' => $doctor->id
        ]);

        return response()->json([
            'message' => 'Your appointment has been sent successfully',
            'data' => new AppointmentResource($Appointment)
        ]);
    }


    public function delete($id)
    {
        $Appointment = Appointments::find($id);
        if (!$Appointment) {
            return response()->json(["message" => "Error: Message not found"], 404);
        }
        $Appointment->delete();
        return response()->json(["message" => "Appointment has been deleted successfully"]);
    }
}
