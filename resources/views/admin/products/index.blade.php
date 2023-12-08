@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <ul>
            <li><a href="{{route('admin.products.create')}}" class="btn btn-success">Novo</a></li>
            <li id="table-title">Consulta de Produtos</li>
            <li id="table-date">{{date('d/m/Y')}}</li>
        </ul>
    </div>
@if($userStore && $products->count())
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Loja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <a href="{{route('admin.products.edit', ['product' => $product->id])}}" class="btn btn-sm btn-primary"><ion-icon name="create"></ion-icon>
                            </a>
                            <form action="{{route('admin.products.destroy', ['product' => $product->id])}}" method="post" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><ion-icon name="trash-outline"></ion-icon></button>
                            </form>
                        </td>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>R$ {{number_format($product->price, 2, ',', '.')}}</td>
                        <td>{{$product->store->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container mt-2">{{$products->links()}}</div>
    @endif
@endsection
