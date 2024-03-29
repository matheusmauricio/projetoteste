<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    <li><a class="nav-link" href="home">{{ __('Home') }}</a></li>
                        <li><a class="nav-link" href="mostrarArquivos">{{ __('Arquivos') }}</a></li>
                        <li><p id="trocaIngles">English</p></li>
                        <li><p id="trocaPortugues">Português</p></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar-se') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>

    <script src="/plugins/jQueryCookie/jquery.cookie.js"></script>

    <script>
        
        //verifica se o link contém a string avisando que a página está em inglês
        if (window.location.href.indexOf("?english=on") != "-1"){
            criaCookie();
            mudaTexto();
        }
        
        //Se o cookie estiver setado como "on" e não ter o "english=on" na url, a página recarrega com o pedaço da url que estava faltando ("english=on")
        if ($.cookie('english') == "on" && window.location.href.indexOf("?english=on") == "-1"){
            mudaTexto();
            window.location.assign(window.location.href + "?english=on");
        }

        $("#trocaIngles").click(function(){
            //se a página já estiver em inglês, então quando clicar no botão não vai acontecer nada
            if (window.location.href.indexOf("?english=on") == "-1"){
                //cria o cookie english com o valor "on" e recarrega a página
                criaCookie();
                window.location.assign(window.location.href + "?english=on");
                //location.reload();     
            }
        });

        $("#trocaPortugues").click(function(){
            //se a página já estiver em português, então quando clicar no botão não vai acontecer nada
            if (window.location.href.indexOf("?english=on") != "-1"){
                //apaga o cookie e recarrega a página, removendo a parte da url que falava que a página estava em inglês ("english=on")
                var aux = window.location.href.indexOf("?english=on");
                var resultado = window.location.href.substring(aux, 5);
                $.removeCookie('english');
                window.location.assign(resultado);
            }
        });

        function mudaTexto(){
            $('#abc').html($('#abc').attr("english"));
            $('#ab').html($('#ab').attr("english"));
            $('#abcd').html($('#abcd').attr("english"));
        }

        function criaCookie(){
            var data = new Date();
            data.setTime(data.getTime() + (60 * 60 * 1000)); // setando o cookie para permanecer por 1 hora
            //cria o cookie de nome "english" e valor "on" e com tempo de expiração de 1 hora
            $.cookie("english", "on", { expires: data });
        }

    </script>
    
</body>
</html>
