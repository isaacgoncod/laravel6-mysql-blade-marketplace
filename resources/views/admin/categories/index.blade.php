@extends('layouts.app')

@section('content')
<div class="container-fluid bg-light p-3 rounded-top">
    <ul>
        <li><a href="{{route('admin.categories.create')}}" class="btn btn-success" title="Nova Categoria">Novo</a></li>
        <li id="table-title">Consulta de Categorias</li>
        <li id="table-date">{{date('d/m/Y')}}</li>
    </ul>
</div>
@if($categories->count())
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        <a href="{{route('admin.categories.edit', ['category' => $category->id])}}" class="btn btn-sm btn-primary" title="Editar Categoria"><ion-icon name="create"></ion-icon>
                        </a>
                        <form action="{{route('admin.categories.destroy', ['category' => $category->id])}}" method="post" class="d-inline-block" id="form-delete" title="Excluir Categoria">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><ion-icon name="trash-outline" ></ion-icon></button>
                        </form>
                    </td>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container mt-2" title="Navegar Entre Categorias">{{$categories->links()}}</div>
@endif
@endsection
