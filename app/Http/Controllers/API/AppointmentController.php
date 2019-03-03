<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Models\AssignedTask;
use JWTAuth;
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
    public function loadTasksCalendar(Request $request)
    {

        // $user = JWTAuth::toUser($request->input('token'));
        $user = JWTAuth::user();
        $user_id = $user->id;

        $appointments = AssignedTask::where('user_id', $user_id)
            ->join('tasks', 'assigned_tasks.task_id','=','tasks.id')
            ->select('tasks.id','tasks.author', 'tasks.subject','tasks.description','tasks.created_at','tasks.dueDate','tasks.progress','assigned_tasks.*')
            ->get();


        return response()->json($appointments);
    }
}
