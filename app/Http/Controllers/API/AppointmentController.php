<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    
    function index()
    {
        $appointments = Appointment::all();
        $response = [];

        return response()->json($appointments);
    }

    function store(Request $request)
    {
        $appointment = new Appointment;
        $appointment->title = $request->input('data.title');
        $appointment->description = $request->input('data.description');
        $appointment->task_id = $request->input('task_id') ? $request->input('task_id') : null;
        $appointment->from = $request->input('from');
        $appointment->to = $request->input('to');
        $appointment->date =$request->input('date');
        $appointment->save();

        return response()->json([
             'message' => 'Appointment created correctly!',
             'appointment' => $appointment
         ]);
    }
}
