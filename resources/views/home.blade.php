@extends('layouts.app')

@section('content')
    <div class="row front">
            @foreach ($products as $key => $product )
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        @if ($product->images->count())
                            <img src="{{asset('storage/'.$product->images->first()->image)}}" alt="{{$product->name}}" class="card-img-top">
                        @else
                            <img src="{{asset('images/default.png')}}" alt="{{$product->name}}" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h2 class="card-title">{{$product->name}}</h2>
                            <p class="card-text">{{$product->description}}</p>
                            <h3>R$ {{$product->price}}</h3>
                            <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success">Ver Produto</a>
                        </div>
                    </div>
                </div>
            @if (($key +1 ) % 3 === 0)
                </div><div class="row front">
            @endif
        @endforeach
    </div>

    <div class="row">
        @foreach ($stores as $store)

        <div class="col-12">
            <h2>Lojas Destaque:</h2>
            <hr>
        </div>
        <div class="col-4">
            @if ($store->logo)
            <img src="{{asset('storage/'.$store->logo)}}" alt="Logo da Loja {{$store->name}}" class="img-fluid">
            @else
            <img src="https://via.placeholder.com/250x100.png?text=logo" alt="Loja sem Logo" class="img-fluid">
            @endif
            <h3>{{$store->name}}</h3>
            <p>{{$store->description}}</p>
            <a href="{{route('store.single', ['slug' => $store->slug])}}" class="btn btn-sm btn-success">Ver Loja</a>
        </div>
    </div>
        @endforeach
@endsection
