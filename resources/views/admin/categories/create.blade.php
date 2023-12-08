@extends('layouts.app')

@section('content')
     <div class="d-flex justify-content-between align-items-center">
        <h1>Nova Categoria</h1>
        <div>
            <button type="button" class="btn btn-success" id="btn-back" onclick="pageBackCategories()">
                Voltar
            </button>
        </div>
    </div>
    <form action="{{route('admin.categories.store')}}" method="POST" id="form-create">
    @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" value="{{old('name')}}">

            @error('name')
                <div class="invalid-feedback">
                    <span>{{str_replace('name', 'Nome', $message)}}</span>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <input type="text" name="description" class="form-control @error('description')is-invalid @enderror" value="{{old('description')}}">

            @error('description')
                <div class="invalid-feedback">
                    <span>{{str_replace(['description', 'Description'], 'Descrição', $message)}}</span>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" >
        </div>
        <div class="d-flex justify-content-between align-items-center mt-5">
            <button type="submit" class="btn btn-success">
                Incluir
            </button>
        </div>
    </form>
@endsection

