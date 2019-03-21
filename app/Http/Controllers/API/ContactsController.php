<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Tymon\JWTAuth\Facades\JWTAuth;

class ContactsController extends Controller
{
    
    public function getContacts() {

        $contacts = User::all();

        return response()->json($contacts);
    }

    public function getMessages($id) {

        $messages = Message::where('from',$id)->orWhere('to', $id)->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request) {

        $user = JWTAuth::user();

        $message = Message::create([
            'from' => $user->id,
            'to' => $request->contact_id,
            'text' => $request->text
        ]);

        return response()->json($message);

    }
}
