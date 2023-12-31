@extends('layouts.app')

@section('content')
<div class="container-fluid bg-light p-3 rounded-top">
    <ul>
        @if (!$store)
            <li><a href="{{route('admin.stores.create')}}" class="btn btn-success" title="Nova Loja">Novo</a></li>
        @endif
        <li id="table-title">Consulta de Loja</li>
        <li id="table-date">{{date('d/m/Y')}}</li>
    </ul>
</div>
@if ($store)
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>Loja</th>
                    <th>Total de Produtos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="{{route('admin.stores.edit', ['store' => $store->id])}}" class="btn btn-sm btn-primary"><ion-icon name="create" title="Editar Loja"></ion-icon>
                        </a>
                        <form action="{{route('admin.stores.destroy', ['store' => $store->id])}}" method="post" class="d-inline-block" title="Excluir Loja">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><ion-icon name="trash-outline"></ion-icon></button>
                        </form>
                    </td>
                    <td>{{$store->id}}</td>
                    <td>{{$store->name}}</td>
                    <td>{{$store->products->count()}}</td>
                </tr>
            </tbody>
        </table>
@endif
@endsection
