@extends('layouts.app')

@section('content')
    <h1>Editar Produto</h1>
    <form action="{{route('admin.products.update', ['product' => $product->id])}}" method="POST" id="form-create">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="name">Produto</label>
            <input type="text" name="name" class="form-control" value="{{$product->name}}">
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <input type="text" name="description" class="form-control" value="{{$product->description}}">
        </div>
        <div class="form-group">
            <label for="body">Conteúdo</label>
            <textarea name="body" id="body" class="form-control">{{$product->body}}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Preço</label>
            <input type="price" name="price" class="form-control" value="{{$product->price}}">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$product->slug}}">
        </div>
        <div>
            <button type="submit" class="btn btn-lg btn-success">
                Editar Produto
            </button>
        </div>
    </form>
@endsection
