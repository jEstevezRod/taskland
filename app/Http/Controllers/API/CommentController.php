<?php

namespace App\Http\Controllers\API;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function store (Request $request){

        $comment = new Comment();

        $comment->text = $request->input('text');
        $comment->author = $request->input('author_id');
        $comment->task_id = $request->input('task_id');
        $comment->save();

        

        return response()->json([
            'message' => 'Comment created correctly!',
            'comment' => $comment
        ]);
    }

    public function index ($id) {

        $comments = Comment::where('task_id', $id)
            ->join('users','comments.author','=','users.id')
            ->select('comments.*','users.name','users.lastname')
            ->orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Comments loaded correctly!',
            'comments' => $comments]);
    }
}
