<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="mr-3">
                            <p id="products_shippings" class="header__menu"> 商品/出荷先</p>
                            <div id="products_shippings_list" class="d-none header__menu__list">
                                <i class="fas fa-window-close menu__close"></i>
                                <p><a href="/items">商品一覧</a></p>
                                <p><a href="/item/create">商品登録</a></p>
                                <p><a href="/shippings">出荷先一覧</a></p>
                                <p><a href="/shipping/create">出荷先登録</a></p>
                            </div>
                        </li>
                        <li class="mr-3">
                            <p id="mypage_inquiry" class="header__menu">マイページ/お問い合わせ</p>
                            <div id="mypage_inquiry_list" class="d-none header__menu__list">
                                <i class="fas fa-window-close menu__close"></i>
                                <p><a href="/mypage">マイページ</a></p>
                                <p><a href="/inquiry">お問い合わせ</a></p>
                            </div>
                         </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        function headerMenu() {
            $(document).on('click',function(event){
                if ($(event.target).closest('#mypage_inquiry').length) {
                    $("#mypage_inquiry_list").removeClass("d-none");                    
                } else{
                    $("#mypage_inquiry_list").addClass("d-none");                    

                }
                if ($(event.target).closest('#products_shippings').length) {
                    $("#products_shippings_list").removeClass("d-none");
                }else{
                    $("#products_shippings_list").addClass("d-none");                    
                }
            });
            $(".menu__close").click(function (e) { 
                $(this).parent().addClass('d-none');
                
            });

        }

    </script>
</body>
</html>
