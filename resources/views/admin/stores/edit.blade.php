@extends('layouts.app')

@section('content')
    <h1>Editar Loja</h1>
    <form action="{{route('admin.stores.update', ['store' => $store->id])}}" method="POST">
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
            <input type="text" name="phone" class="form-control" value="{{$store->phone}}">
        </div>
        <div class="form-group">
            <label for="mobile_phone">Celular</label>
            <input type="text" name="mobile_phone" class="form-control" value="{{$store->mobile_phone}}">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$store->slug}}">
        </div>
        <div>
            <button type="submit" class="btn btn-lg btn-success">
                Editar Loja
            </button>
        </div>
    </form>
@endsection