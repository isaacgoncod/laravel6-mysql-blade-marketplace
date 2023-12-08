@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Novo Produto</h1>
        <div>
            <button type="button" class="btn btn-success" id="btn-back" onclick="pageBackProducts()">
                Voltar
            </button>
        </div>
    </div>
    <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data" id="form-create-product">
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
            <input type="price" name="price" id="price" class="form-control @error('price')is-invalid @enderror" value="{{old('price')}}">

            @error('price')
                <div class="invalid-feedback">
                    <span>{{str_replace(['price', 'Price'], 'Preço', $message)}}</span>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="categories[]">Categorias</label>
            <select name="categories[]" id="categories" class="form-control @error('categories')
                is-invalid
            @enderror" multiple>
                @foreach ($categories as $category )
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
              @error('categories')
                <div class="invalid-feedback">{{str_replace(['Categories', 'categories'], 'Categoria',$message)}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="images[]">Imagens</label>
            <input type="file" name="images[]" class="form-control @error('images.*')
            is-invalid
            @enderror" multiple>

            @error('images')
                <div class="invalid-feedback">{{str_replace(['Images', 'Images'], 'Imagens', $message)}}</div>
            @enderror
        </div>
        <div class="d-flex justify-content-between align-items-center mt-5">
            <button type="submit" class="btn btn-success">
                Incluir
            </button>
            <button type="button" class="btn btn-success" id="btn-back" onclick="pageBackProducts()">
                Voltar
            </button>
        </div>
    </form>
@endsection

