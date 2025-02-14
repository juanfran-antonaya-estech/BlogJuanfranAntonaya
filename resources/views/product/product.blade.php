@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                @if(!$product->status)
                <div class="alert alert-danger" role="alert">
                    Este producto no se encuentra disponible.
                </div>
                @endif
                <h1>{{ $product->name }}</h1>
                <img class="card-img-top" src="{{ $product->image ? asset($product->image) : "https://media.licdn.com/dms/image/v2/C5112AQEw1fXuabCTyQ/article-inline_image-shrink_1500_2232/article-inline_image-shrink_1500_2232/0/1581099611064?e=1744243200&v=beta&t=qapZnm3J1Pv9I7eqdUm9w5hHtLO0WqLmh2E1wG5iNIo" }}" alt="Imagen" width="100" />
            </div>
            <div class="card-body">
                <h5 class="card-title">Nombre del producto: {{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p class="card-text">Precio: {{ $product->quantity }}€</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Volver</a>
            </div>
            @if($product->seller->id == Auth::user()->id || Auth::user()->role < 3)
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary">Editar</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
