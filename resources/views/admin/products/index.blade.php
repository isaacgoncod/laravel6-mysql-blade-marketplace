@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-light p-3 rounded-top">
        <ul>
            <li><a href="{{route('admin.products.create')}}" class="btn btn-success" title="Novo Produto">Novo</a></li>
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
                            <a href="{{route('admin.products.edit', ['product' => $product->id])}}" class="btn btn-sm btn-primary" title="Editar Produto"><ion-icon name="create"></ion-icon>
                            </a>
                            <form action="{{route('admin.products.destroy', ['product' => $product->id])}}" method="post" class="d-inline-block" title="Excluir Produto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><ion-icon name="trash-outline"></ion-icon></button>
                            </form>
                        </td>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>R$ {{$product->price}}</td>
                        <td>{{$product->store->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container mt-2" title="Navegar Entre Produtos">{{$products->links()}}</div>
    @endif
@endsection
