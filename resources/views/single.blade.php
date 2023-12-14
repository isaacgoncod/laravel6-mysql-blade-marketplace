@extends('layouts.app')

@section('content')

    <div class="row">
        @if ($product->images->count())
        <div class="col-6">
            <img src="{{asset('storage/'.$product->images->first()->image)}}" alt="{{$product->name}}" class="img-fluid">
            <div class="row mt-4">
                @foreach ($product->images as $image )
                <div class="col-4">
                    <img src="{{asset('storage/'.$image->image)}}" alt="{{$image->name}}" class="img-fluid">
                </div>
                @endforeach
            </div>
        </div>
        @else
           <img src="{{asset('images/default.png')}}" alt="{{$product->name}}" class="card-img-top">
        @endif
            <div class="col-6">
                <div class="col-md-12">
                    <h2>{{$product->name}}</h2>
                    <p>{{$product->description}}</p>
                    <h3>R$ {{$product->price}}</h3>
                    <span>Loja: {{$product->store->name}}</span>
                </div>
                <div class="product-add col-md-12">
                <hr>
                <form action="{{route('cart.add')}}" method="POST">
                @csrf
                    <input type="hidden" name="product[name]" value="{{$product->name}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">
                    <input type="hidden" name="product[slug]" value="{{$product->slug}}">
                    <div class="form-group">
                        <label for="product[amount]">Quantidade</label>
                        <input type="number"
                        name="product[amount]" class="form-control col-md-2" value="1" min="1">
                    </div>
                    <button class="btn btn-lg btn-danger d-flex align-items-center" title="Adicionar ao Carrinho"><ion-icon name="cart-outline" style="font-size: 20px;"></ion-icon><ion-icon name="add-circle-outline"></ion-icon></button>
                </form>
            </div>
            </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr>
            {{$product->body}}
        </div>
    </div>
@endsection
