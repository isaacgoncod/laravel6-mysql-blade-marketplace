@extends('layouts.app')

@section('content')
     <div class="d-flex justify-content-between align-items-center">
        <h1>Nova Loja</h1>
        <div>
            <button type="button" class="btn btn-success" id="btn-back" onclick="pageBackStores()">
                Voltar
            </button>
        </div>
    </div>
    <form action="{{route('admin.stores.store')}}" method="POST" enctype="multipart/form-data" id="form-create-store">
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
            <label for="phone">Telefone</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone')is-invalid @enderror" value="{{old('phone')}}">

            @error('phone')
                <div class="invalid-feedback">
                    <span>{{str_replace('phone', 'Telefone', $message)}}</span>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="mobile_phone">Celular</label>
            <input type="text" name="mobile_phone" id="mobile_phone" class="form-control @error('mobile_phone')is-invalid @enderror" value="{{old('mobile_phone')}}">

            @error('mobile_phone')
                <div class="invalid-feedback">
                    <span>{{str_replace('mobile phone', 'Celular', $message)}}</span>
                </div>
            @enderror
        </div>
          <div class="form-group">
            <label for="logo">Imagem</label>
            <input type="file" name="logo" class="form-control @error('logo')
                is-invalid
            @enderror">

             @error('logo')
                <div class="invalid-feedback">{{str_replace(['logo', 'Logo'], 'Imagem', $message)}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>
        <div class="d-flex justify-content-between align-items-center mt-5">
            <button type="submit" class="btn btn-success">
                Incluir
            </button>
            <button type="button" class="btn btn-success" id="btn-back" onclick="pageBackStores()">
                Voltar
            </button>
        </div>
    </form>
    <script>
        $(document).ready(function(){
             $('#phone').mask('(00) 0000-0000');
             $('#mobile_phone').mask('(00) 00000-0000');
        });
    </script>
@endsection
