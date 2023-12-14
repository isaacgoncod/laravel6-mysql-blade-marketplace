@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Carrinho de Compras</h2>
            <hr>
        </div>
        <div class="col-12">
           @if ($cart)
             <table class="table">
                <thead>
                    <tr class="bg-light">
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($cart as $c)
                        <tr>
                            <td>{{$c['name']}}</td>
                            <td>{{$c['price']}}</td>
                            <td>{{$c['amount']}}</td>
                            @php
                                // $subtotal = ( app('App\Http\Controllers\CartController')->getCartPriceAttribute($c['price']) * $c['amount']);
                                $subtotal = (($c['price']) * $c['amount']);
                                $total += $subtotal;
                            @endphp
                            <td>R$ {{number_format($subtotal, 2, ',', '.')}}</td>
                            <td><a href="{{route('cart.remove', ['slug' => $c['slug']])}}" class="btn btn-sm btn-danger d-flex align-items-center" style="width:30px;height:30px"><ion-icon name="trash-outline"></ion-icon></a></td>
                        </tr>
                    @endforeach
                    <tr class="bg-light">
                        <td>Total:</td>
                        <td ></td>
                        <td ></td>
                        <td>R$ {{number_format($total, 2, ',', '.')}}</td>
                        <td ></td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <div class="col-md-12">
                <a href="{{route('cart.cancel')}}" class="btn btn-lg btn-danger float-left d-flex align-items-center"><ion-icon name="trash-outline"></ion-icon></a>
                <a href="{{route('checkout.index')}}" class="btn btn-lg btn-success float-right d-flex align-items-center"><ion-icon name="chevron-forward-outline"></ion-icon></a>
            </div>
            @else
                <div class="alert alert-warning text-align-center">Carrinho vazio :(</div>
           @endif
        </div>
    </div>

@endsection
