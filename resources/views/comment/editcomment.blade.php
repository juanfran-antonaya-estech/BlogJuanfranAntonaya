@extends('layouts.app')

@section('content')
    <div class="container col-5">
        <h1>Editando comentario "{{$comment->comment_content}}"</h1>
        <h2>En el post {{ $comment->post->title }}</h2>
        <form action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="btn-group d-flex justify-content-center">
                <input type="text" class="form-control" name="comment_content" value="{{ $comment->comment_content }}">
                <button class="btn btn-outline-primary" type="submit">guardar</button>
            </div>
        </form>
    </div>
@endsection
