<!----------------------------------------------------------------------botão notificação----------------------------------->

            <button id="btnSuperiorBar" class="btn btn-default dropdown hidden-xs btnSuperiorBar">
                <a class="dropdown-toggle glyphicon glyphicon-copy" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                    Notificações <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('/notificacao/todas')}}">Listar todas as Notificações</a></li>
                    <li><a href="{{url('/notificacao/data')}}">Listar Notificações por Data</a></li>
                   
                </ul>
            </button>
            <!----------------------------------------------------------------------botão regularização----------------------------------->
            <button id="btnSuperiorBar" class="btn btn-default dropdown hidden-xs btnSuperiorBar">
                <a class="dropdown-toggle glyphicon glyphicon-ok-sign" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                    Regularização <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('/notificacao/placa')}}">Buscar por Placa</a></li>
                    <li><a href="{{url('/notificacao/codigo')}}">Buscar por Código</a></li>

                </ul>
            </button>
            <!----------------------------------------------------------------------botões para gestão de funcionários----------------------------------->

                
            
<!--            botão de logoff-->
            <button id="btnLogin" class="btn btn-warning btnSuperiorBar ">
                <a class="glyphicon glyphicon-off hidden-xs" href="{{url('/autenticar/logoff')}}"></a>
            </button>



            <button id="btnLogin" class="btn btn-default btnSuperiorBar hidden-xs">
                <a class="glyphicon glyphicon-user" href="{{url('/login')}}">Login</a>
            </button>
            <button id="btnLogin" class="btn btn-default btnSuperiorBar visible-xs">
                <a class="glyphicon glyphicon-user" href="{{url('/loginmovel')}}"></a>
            </button>


        </div>

        <!----------------------------------------------------------------------botões para dispositivos pequenos----------------------------------->
        <div id="btnTelaPequena"class=" center-block text-center">
            <button id="btnSuperiorBar" class="btn btn-default dropdown visible-xs-inline-block btnSuperiorBar">
                <a class="dropdown-toggle glyphicon glyphicon-copy" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('/notificacao/todas')}}">Listar todas asNotificações</a></li>
                    <li><a href="{{url('/notificacao/data')}}">Listar Notificações por Data</a></li>
                    
                </ul>
            </button>

            <button id="btnSuperiorBar" class="btn btn-default dropdown visible-xs-inline-block btnSuperiorBar">
                <a class="dropdown-toggle glyphicon glyphicon-ok-sign" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('/notificacao/placa')}}">Buscar por Placa</a></li>
                    <li><a href="{{url('/notificacao/codigo')}}">Buscar por Código</a></li>
                </ul>
            </button>

        </div>