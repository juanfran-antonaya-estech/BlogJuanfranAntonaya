<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all()->sortByDesc('created_at');
        return view('post.posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.newpost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valids = [
            'title' => 'required|min:5|max:255'
        ];

        //definir mensajes para valids
        $mensajes = [
            'title.required' => 'Se requiere introducir un título',
            'min' => 'Debes introducir al menos :min caracteres',
            'max' => 'El texto es demasiado largo, no debe superar los :max caracteres'

        ];

        $request->validate($valids, $mensajes);

        Post::create($request->only('title', 'user_id', 'status'));

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return view('post.post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $post = Post::find($id);
        return view('post.editpost', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $post = Post::find($id);
        $post->update($request->only('title', 'status'));
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
