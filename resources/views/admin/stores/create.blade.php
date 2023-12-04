@extends('layouts.app')

@section('content')
    <h1>Criar Loja</h1>
    <form action="{{route('admin.stores.store')}}" method="POST" id="form-create">
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
            <input type="text" name="phone" class="form-control @error('phone')is-invalid @enderror" value="{{old('phone')}}">

            @error('phone')
                <div class="invalid-feedback">
                    <span>{{str_replace('phone', 'Telefone', $message)}}</span>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="mobile_phone">Celular</label>
            <input type="text" name="mobile_phone" class="form-control @error('mobile_phone')is-invalid @enderror" value="{{old('mobile_phone')}}">

            @error('mobile_phone')
                <div class="invalid-feedback">
                    <span>{{str_replace('mobile phone', 'Celular', $message)}}</span>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>
        {{-- <div class="form-group">
            <label for="user">Usuário</label>
            <select name="user" id="user" class="form-control" required>
                <option value="0">Selecione...</option>
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div> --}}
        <div>
            <button type="submit" class="btn btn-lg btn-success">
                Criar Loja
            </button>
        </div>
    </form>
     {{-- <script>
        document.addEventListener("DOMContentLoaded",       function () {
            var form = document.getElementById("form-create");
            var user = document.getElementById("user");

            form.addEventListener("submit", function (event) {
                if(user.value == 0){
                    alert('Selecione um usuário!');
                    event.preventDefault();
                }
            });
        });
    </script> --}}
@endsection
