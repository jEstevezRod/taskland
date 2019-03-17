<?php

namespace App\Http\Controllers\API;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use JWTAuth;


class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = JWTAuth::user() ;

         $notes = DB::table('notes')->where('author',$user->id)->get();

        return response()->json($notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = JWTAuth::user() ;

        $note = new Note;
        $note->text = $request->input('text') !== null ?$request->input('text') : ' ';
        $note->author = $user->id;
        $note->title = $request->input('title') !== null ?$request->input('title') : ' ';
        $note->shared = $request->input('shared');
        $note->save();

        return response()->json($note);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        if (empty($request->input('title') )) {
            return response()->json([ 'message' => 'Title empty. Please try to fill it.', 'code' => 405]);
        }
;        $updated = Note::where('id', $id)
            ->update([
            'text' => $request->input('text'),
            'title' => $request->input('title'),
            'shared' => $request->input('shared') !== null ? $request->input('shared') : false,
        ]);

        if ($updated) {
            return response()->json(['code'=> 200, 'note' => Note::where('id',$id)]);
        }
        else {
            return response()->json(['code' => 500, 'message' => 'Error updating the note.' . $id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminated = Note::where('id', $id)->delete();

        return response()->json(['eliminated' => $eliminated, 'id' => $id]);
    }
}
