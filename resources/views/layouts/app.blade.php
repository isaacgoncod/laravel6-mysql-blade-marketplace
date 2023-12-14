<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MarketPlace L6</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    @yield('stylesheets')

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js" integrity="sha512-KwKOj1sfIsT/2Gqam136/onXPaKsdoRKdJD92HnbpLHbafKVSVFIiBq5CUd1X9Pr2hZUG+3nvTVJoPcCwV6Pqg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.1.0"></script>
    <script src="/js/script.js"></script>

</head>
<body>
     <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item>
                            <a href="{{route('home')}}" class="navbar-brand nav-link">
                                <img src="/images/logo-32.png" alt="Logo" title="Home">
                            </a>
                        </li>
                        @auth
                            <li class="nav-item" id="nav-username">
                                <span class="nav-link">Bem Vindo! {{auth()->user()->name}}</span>
                            </li>
                        @endauth

                        @foreach ($categories as $category)
                            <li class="nav-item @if(request()->is('category/' . $category->slug)) active @endif">
                                <a class="nav-link" href="{{route('category.single', ['slug' => $category->slug])}}">{{$category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="navbar-nav">
                        @if (session()->has('cart'))
                            <li class="nav-item" title="Carrinho">
                                <a href="{{ route('cart.index') }}" class="nav-link btn btn-danger text-white d-flex align-items-center"> <ion-icon name="cart-outline" style="font-size: 20px;"></ion-icon>
                                <span class="badge badge-warning text-white">{{count(session()->get('cart'))}}</span></a>
                            </li>
                        @else
                            <li class="nav-item" title="Carrinho">
                                <a href="{{ route('cart.index') }}" class="nav-link btn btn-danger text-white d-flex align-items-center"> <ion-icon name="cart-outline" style="font-size: 20px;"></ion-icon></a>
                            </li>
                        @endif

                        <li class="nav-item"  title="Home">
                            <a href="{{ route('home') }}" class="nav-link">Home</a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                            <li class="nav-item @if(request()->is('admin/stores*')) active @endif"  title="Consulta de Lojas">
                                <a href="{{route('admin.stores.index')}}" class="nav-link">Lojas</a>
                            </li>
                            <li class="nav-item @if(request()->is('admin/products*')) active @endif" title="Consulta de Produtos">
                                <a href="{{route('admin.products.index')}}" class="nav-link">Produtos</a>
                            </li>
                            <li class="nav-item @if(request()->is('admin/categories*')) active @endif" title="Consulta de Categorias">
                                <a href="{{route('admin.categories.index')}}" class="nav-link">Categorias</a>
                            </li>
                            <li class="nav-item" title="Sair da Sessão">
                                <a href="#" class="nav-link" onclick="event.preventDefault();document.querySelector('form.logout').submit();">Sair</a>
                                <form action="{{route('logout')}}" class="logout" method="POST">
                                @csrf
                                </form>
                            </li>
                        @else
                            <li class="nav-item" title="Login">
                                <a href="{{ route('login') }}" class="nav-link">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item" title="Registro">
                                    <a href="{{ route('register') }}" class="nav-link">Registro</a>
                                </li>
                            @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </nav>
        </header>
    <main>
        <div class="container">
            @include('flash::message')
            @yield('content')
        </div>
    </main>
    @yield('scripts')
</body>
</html>
