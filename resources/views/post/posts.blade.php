@extends('layouts.app')

@section('content')
    <div class="container-sm">
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Crear nuevo post</a>
    @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">
                    @if($post->status)
                        <span class="badge bg-success">Status positivo</span>
                    @else
                        <span class="badge bg-danger">Status negativo</span>
                    @endif
                </p>
                @if($post->user->id == Auth::user()->id || Auth::user()->role < 3)
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                @endif
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Ver post y otros {{ count($post->comments) }} comentarios</a>
                <p class="card-text"><small class="text-muted">Creado en {{ $post->created_at->isoFormat('ddd DD, MMM, YYYY') }} por {{ $post->user->name }}</small>
                </p>
            </div>
        </div>
    @endforeach
    </div>
@endsection

