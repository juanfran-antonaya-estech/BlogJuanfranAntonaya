@extends('layouts.app')

@section('content')
    <div class="container col-5 bg-light p-5 rounded shadow">
        <form action="{{ route('posts.store') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="status" value="0">
            <label for="title">Título</label>
            @if ($errors->has('title'))
                <p class="text-danger">{{ $errors->first('title') }}</p>
            @endif
            <input type="text" name="title" id="title" class="form-control">
            <button type="submit" class="btn btn-primary mt-3">Subir</button>
        </form>
    </div>
@endsection
