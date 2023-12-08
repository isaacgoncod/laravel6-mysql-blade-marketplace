@extends('layouts.app')

@section('content')
     <div class="d-flex justify-content-between align-items-center">
        <h1>Editar Categoria</h1>
        <div>
            <button type="button" class="btn btn-success" id="btn-back" onclick="pageBackCategories()">
                Voltar
            </button>
        </div>
    </div>
    <form action="{{route('admin.categories.update', ['category' => $category->id])}}" method="POST" id="form-create">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="name">Categoria</label>
            <input type="text" name="name" class="form-control" value="{{$category->name}}">
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <input type="text" name="description" class="form-control" value="{{$category->description}}">
        </div>
        <div>
            <button type="submit" class="btn btn-success">
                Atualizar
            </button>
        </div>
    </form>
@endsection
