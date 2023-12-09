@extends('layouts.app')

@section('content')
     <div class="d-flex justify-content-between align-items-center">
        <h1>Editar Produto</h1>
        <div>
            <button type="button" class="btn btn-success" id="btn-back" onclick="pageBackProducts()">
                Voltar
            </button>
        </div>
    </div>
    <form action="{{route('admin.products.update', ['product' => $product->id])}}" method="POST" enctype="multipart/form-data" id="form-edit-product">
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
            <input type="price" name="price" class="form-control  @error('price')
                is-invalid
            @enderror col-3" id="price" value="{{$product->price}}">

            @error('price')
                <div class="invalid-feedback">{{str_replace(['Price', 'price'], 'Preço',$message)}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="categories[]">Categorias</label>
            <select name="categories[]" id="categories" class="form-control @error('categories')
                is-invalid
            @enderror col-3" multiple>
                @foreach ($categories as $category )
                    <option value="{{$category->id}}" @if($product->categories->contains($category)) selected @endif>{{$category->name}}
                    </option>
                @endforeach
            </select>
             @error('categories')
                <div class="invalid-feedback">{{str_replace(['Categories', 'categories'], 'Categoria(s)',$message)}}</div>
            @enderror
        </div>

         <div class="form-group">
            <label for="images[]">Imagens</label>
            <input type="file" name="images[]" class="form-control @error('images.*')
                is-invalid
            @enderror col-5" multiple>

            @error('images')
                <div class="invalid-feedback">{{str_replace(['Images', 'images'], 'Imagens',$message)}}</div>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-success">
                Atualizar
            </button>
        </div>
    </form>

    <hr>

    <div class="container">
        <h1>Imagens:</h1>
    </div>

    <div class="row" id="card-product-img">
        @foreach ($product->images as $image)
            <div class="col-4 text-center">
                <img src="{{asset('storage/'.$image->image)}}" alt="Product Images" class="img-fluid">
                <form action="{{route('admin.image.remove', ['imageName' => $image->image])}}" method="POST">
                @csrf
                <input type="hidden" name="imageName" value="{{$image->image}}">
                <button type="submit" class="btn btn-danger col"><ion-icon name="trash-outline"></ion-icon></button>
                </form>
            </div>
        @endforeach
    </div>
    <script>
        $(document).ready(function(){
            $('#price').mask('000.000,00', {reverse: true});
        });
    </script>
@endsection
