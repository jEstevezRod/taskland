<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    
    function index()
    {
        $appointments = Appointment::all();

        return response()->json($appointments);
    }
}
