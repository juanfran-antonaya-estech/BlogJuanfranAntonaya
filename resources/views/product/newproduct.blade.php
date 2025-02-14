@extends('layouts.app')

@section('content')
    <div class="container col-5">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Auth::user()->role < 3)
                <select name="seller_id" id="seller_id" class="form-control form-select">
                    <option value="">Selecciona un vendedor</option>
                    @foreach ($sellers as $seller)
                        <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                    @endforeach
                </select>
            @else
                <input type="hidden" name="seller_id" value="{{ Auth::user()->id }}">
            @endif

            <div class="row">
                <div class="col-9">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? "is-invalid" : "" }}" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                             <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                </div>
                <div class="col-3">
                    <label for="name">Precio</label>
                    <input type="number" name="quantity" id="quantity" class="form-control {{ $errors->has('quantity') ? "is-invalid" : "" }}" value="{{ old('quantity') }}">
                    @if ($errors->has('quantity'))
                        <div class="invalid-feedback">
                            {{ $errors->first('quantity') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="name">Descripción</label>
                    <textarea name="description" id="description" class="form-control form-text {{ $errors->has('description') ? "is-invalid" : "" }}" placeholder="Introduce tu descripción" rows="3">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control form-select">
                        <option value="1" selected>En stock</option>
                        <option value="0">No disponible</option>
                    </select>
                </div>
                <div class="col-9">
                    <label for="image">Imagen</label>
                    <input type="file" name="image" id="image" class="form-control {{ $errors->has('image') ? "is-invalid" : "" }}" value="{{ old('image') }}" accept="image/*">
                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
