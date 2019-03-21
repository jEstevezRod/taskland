<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Events\NewMessage;
use Auth;

class ContactsController extends Controller
{
    
    public function getContacts() {

        $me = auth()->user();
        $contacts = User::where('id','!=',$me->id)->get();

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

        broadcast(new NewMessage($message));

        return response()->json($message);

    }
}
