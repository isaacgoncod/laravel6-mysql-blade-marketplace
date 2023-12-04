@extends('layouts.app')

@section('content')
    <h1>Novo Produto</h1>
    <form action="{{route('admin.products.store')}}" method="POST" id="form-create">
    @csrf
        <div class="form-group">
            <label for="name">Produto</label>
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
            <label for="body">Conteúdo</label>
            <textarea name="body" id="body" class="form-control form-control @error('body')is-invalid @enderror">{{old('body')}}</textarea>

            @error('body')
                <div class="invalid-feedback">
                    <span>{{str_replace(['body', 'Body'], 'Conteúdo', $message)}}</span>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Preço</label>
            <input type="price" name="price" class="form-control @error('price')is-invalid @enderror" value="{{old('price')}}">


            @error('price')
                <div class="invalid-feedback">
                    <span>{{str_replace(['price', 'Price'], 'Preço', $message)}}</span>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" >
        </div>
        <div>
            <button type="submit" class="btn btn-lg btn-success">
                Novo Produto
            </button>
        </div>
    </form>
@endsection
