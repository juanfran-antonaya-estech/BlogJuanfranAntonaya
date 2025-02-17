<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::with('user','post')->get()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment_content' => 'required|min:5|max:255',
            'post_id' => 'required',
            'user_id' => 'required'
        ]);

        $com = Comment::create($request->all());
        return $com;
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment_content' => 'required|min:5|max:255',
            'post_id' => 'required',
            'user_id' => 'required'
        ]);

        $comment->update($request->all());

        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'Comentario eliminado'
        ])->setStatusCode(204);
    }
}
