@extends('layouts.app')

@section('content')
     <div class="d-flex justify-content-between align-items-center">
        <h1>Editar Loja</h1>
        <div>
            <button type="button" class="btn btn-success" id="btn-back" onclick="pageBackStores()">
                Voltar
            </button>
        </div>
    </div>
    <form action="{{route('admin.stores.update', ['store' => $store->id])}}" method="POST" enctype="multipart/form-data" id="form-edit-store">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="name">Nome Loja</label>
            <input type="text" name="name" class="form-control" value="{{$store->name}}">
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <input type="text" name="description" class="form-control" value="{{$store->description}}">
        </div>
        <div class="form-group">
            <label for="phone">Telefone</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{$store->phone}}">
        </div>
        <div class="form-group">
            <label for="mobile_phone">Celular</label>
            <input type="text" name="mobile_phone" class="form-control" value="{{$store->mobile_phone}}" id="mobile_phone">
        </div>
          <div class="form-group">
            <p>
                <img src="{{asset('storage/'.$store->logo)}}" alt="Logo Loja" width="15%" height="15%" >
            </p>
            <label for="logo">Imagem</label>
            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">

            @error('logo')
                <div class="invalid-feedback">{{str_replace(['Logo', 'logo'], 'Imagem',$message)}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$store->slug}}">
        </div>
        <div>
            <button type="submit" class="btn btn-success">
                Atualizar
            </button>
        </div>
    </form>
    <script>
        $(document).ready(function(){
             $('#phone').mask('(00) 0000-0000');
             $('#mobile_phone').mask('(00) 00000-0000');
        });
        $('#form-edit-store').submit(function(event) {
            $('#phone').unmask();
            $('#mobile_phone').unmask();
        });
    </script>
@endsection
