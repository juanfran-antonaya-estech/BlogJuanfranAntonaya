@extends('layouts.app')

@section('content')

    <div class="container col-5">
        @csrf
        <h1>{{ $post->title }}</h1>
        @if($post->status)
            <div class="alert alert-success">Status positivo</div>
        @else
            <div class="alert alert-danger">Status negativo</div>
        @endif
        <h2>Comentarios:</h2>
        @if($post->user->id == Auth::user()->id || Auth::user()->role < 3)
            <div class="d-flex justify-content-between">
                <a class="btn btn-outline-primary" href="{{ route('posts.edit', $post->id) }}">Editar post</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger" type="submit">Eliminar post</button>
                </form>
            </div>
        @endif
        <form action="{{route('comments.store')}}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <div class="form-group mt-3">
                <div class="btn-group">
                <input type="text" class="form-control" id="comment_content" name="comment_content" placeholder="Escribe tu comentario" required>
                <button class="btn btn-primary" type="submit">Enviar</button>

                </div>
            </div>
        </form>

        @foreach($post->comments as $comment)
            <div class="card my-2">
                <div class="card-header">
                    <p>{{ $comment->comment_content }}</p>
                    <div class="d-flex justify-content-between">
                        <p>Por {{$comment->user->name}}</p>
                        <p class="text-muted">El {{ $comment->created_at->isoFormat("dddd, d MMMM, YYYY") }}</p>
                    </div>
                    @if($comment->user_id == Auth::user()->id || Auth::user()->role < 3)
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@endsection
