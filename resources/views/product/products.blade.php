@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Productos</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Crear producto</a>
        <div class="container col-9 d-flex flex-wrap justify-content-center gap-3">
            @foreach($products as $product)
                <div class="card col-3">
                    @if($product->seller->id == Auth::user()->id || Auth::user()->role < 3)
                    <div class="card-header d-flex justify-content-between">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary">Editar</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                        </form>
                    </div>
                    @endif
                    <img class="card-img-top" src="{{ $product->image != null ? asset($product->image) : "https://media.licdn.com/dms/image/v2/C5112AQEw1fXuabCTyQ/article-inline_image-shrink_1500_2232/article-inline_image-shrink_1500_2232/0/1581099611064?e=1744243200&v=beta&t=qapZnm3J1Pv9I7eqdUm9w5hHtLO0WqLmh2E1wG5iNIo" }}" alt="Card image cap" />
                    <div class="card-header">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Vendedor: {{ $product->seller->name }}</p>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Precio: {{ $product->quantity }}€
                        </p>
                        @if($product->status)
                            <span class="badge bg-success">Disponible</span>
                        @else
                            <span class="badge bg-danger">Agotado</span>
                        @endif
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Ver</a>
                        @if($product->status)
                            <a href="" class="btn btn-success">Comprar</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
