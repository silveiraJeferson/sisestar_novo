<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>SisEstaR | Project</title>

        <!-- Bootstrap -->
        <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('bootstrap/css/sisestar.css')}}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div id="superior-bar " class="blueMovel  ">
                <a href="{{url('/')}}"><img class="imgLogo"src="{{url('/imagem/arquivo/icon-estacionamento-infra_2.png')}}"/>
                    <span id="sisestarTituloSite">SisEstaR</span>
                </a>

                @if(session('logado'))
                <button id="btnLogin" class="btn btn-warning btnSuperiorBar ">
                    <a class="glyphicon glyphicon-off" href="{{url('/autenticar/logoff')}}"></a>
                </button>
                @endif
            </div>

            @yield('content')
        </div>

    </body>
</html>