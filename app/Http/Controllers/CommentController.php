<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only('post_id', 'user_id', 'comment_content');

        $validations = [
            'post_id' => 'required',
            'user_id' => 'required',
            'comment_content' => 'required|min:5|max:255'
        ];

        $messages = [
            'required' => 'El campo :attribute es obligatorio',
            'min' => 'El campo :attribute debe tener al menos :min caracteres',
            'max' => 'El campo :attribute no debe superar los :max caracteres'
        ];

        $validator = Validator::make($data, $validations, $messages);

        Comment::create($data);

        return redirect()->route('posts.show', $data['post_id']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $comment = Comment::find($id);
        return view('comment.editcomment', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validations = [
            'comment_content' => 'required|min:5|max:255'
        ];

        $messages = [
            'required' => 'El campo :attribute es obligatorio',
            'min' => 'El campo :attribute debe tener al menos :min caracteres',
            'max' => 'El campo :attribute no debe superar los :max caracteres'
        ];

        $validator = Validator::make($request->all(), $validations, $messages);

        $comment = Comment::find($id);
        $comment->update($request->only('comment_content'));
        return redirect()->route('posts.show', $comment->post_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('posts.show', $comment->post_id);
    }
}
