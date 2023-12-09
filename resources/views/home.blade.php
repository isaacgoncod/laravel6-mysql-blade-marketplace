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
@endsection
