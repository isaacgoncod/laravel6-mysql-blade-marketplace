@extends('layouts.app');

@section('content')

    <h2 class="alert alert-success">
        Muito obrigado por sua compra!
    </h2>
    <h3>
        Seu Pedido foi processado, código do pedido: {{request()->get('order')}}
    </h3>
@endsection
