@extends('layouts.app')

@section('content')
    <div class="row front">
        <div class="col-4">
            @if ($store->logo)
            <img src="{{asset('storage/'.$store->logo)}}" alt="Logo da Loja {{$store->name}}" class="img-fluid">
            @else
            <img src="https://via.placeholder.com/250x100.png?text=logo" alt="Loja sem Logo" class="img-fluid">
            @endif
        </div>
        <div class="col-8">
            <h2>{{$store->name}}</h2>
            <p>{{$store->description}}</p>
            <p>
                <strong>Contatos:</strong>
                <span>{{$store->phone}}</span> | <span>{{$store->mobile_phone}}</span>
            </p>
        </div>

        <div class="col-12">
            <hr>
            <h3 class="mb-5">Produtos:</h3>
        </div>
            @forelse($store->products as $key => $product )
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
            @empty
                <div class="col-12">
                    <h3 class="alert alert-warning">
                        Nenhum produto encontrando para: {{$store->name}}
                    </h3>
                </div>
            @endforelse
    </div>

@endsection
