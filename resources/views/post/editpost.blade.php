@extends('layouts.app')

@section('content')
<div class="container col-3 bg-light p-3 rounded shadow">
    <h1>Editando {{ $post->title }}</h1>
    <form action="{{ route('posts.update', $post->id) }}" method="post">
        @csrf
        @method('PUT')
        <input class="form-control" type="text" name="title" id="title" value="{{ $post->title }}">
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-select" name="status" id="status">
                <option value="1" {{ $post->status ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$post->status ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-outline-primary mt-2">Guardar</button>
    </form>
</div>
@endsection
