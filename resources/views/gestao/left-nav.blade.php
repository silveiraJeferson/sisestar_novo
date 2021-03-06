

<div class="menu-gestao" style="width: 15%; height: 800px; background-color: black">
        <br/>
<!--        botões do menu lateral esquerdo da gestao-->
        <a class="btn btn-warning btn-menu-gestao" role="button" data-toggle="collapse" href="#Funcionarios" aria-expanded="false" aria-controls="collapseExample">
            Funcionarios
        </a>
        <div class="collapse" id="Funcionarios">
            <div class="well">
                <table class="table">
                    <tr>
                        <td>
                            <a href="{{url('/funcionarios')}}">Listar</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{url('/funcionarios/create')}}">Cadastrar</a>
                        </td>
                    </tr>                   
                    <tr>
                        <td>
                            <a href="{{url('/funcionarios/inativos')}}">Inativos</a>
                        </td>
                    </tr>                   
                    
                </table>
            </div>
        </div>
<!--fim do botão-->
<!--        botões do menu lateral esquerdo da gestao-->
        <a class="btn btn-warning btn-menu-gestao" role="button" data-toggle="collapse" href="#notificacoes" aria-expanded="false" aria-controls="collapseExample">
             Notificações
        </a>
        <div class="collapse" id="notificacoes">
            <div class="well">
                <table class="table">
                    <tr>
                        <td>
                            <a href="{{url('/notificacao/index')}}">Listar</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{url('/status')}}">Status</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{url('/valores')}}">Valores</a>
                        </td>
                    </tr>
                    
                </table>
                
            </div>
        </div>
<!--fim do botão-->
<!--        botões do menu lateral esquerdo da gestao-->
        <a class="btn btn-warning btn-menu-gestao" role="button" data-toggle="collapse" href="#cargos" aria-expanded="false" aria-controls="collapseExample">
            Cargos
        </a>
        <div class="collapse" id="cargos">
            <div class="well">
                <table class="table">
                    <tr>
                        <td>
                            <a href="{{url('/cargos')}}">Listar</a>
                        </td>
                    </tr>                   
                </table>
            </div>
        </div>
        <a class="btn btn-warning btn-menu-gestao" role="button" data-toggle="collapse" href="#setores" aria-expanded="false" aria-controls="collapseExample">
            Setores
        </a>
        <div class="collapse" id="setores">
            <div class="well">
                <table class="table">
                    <tr>
                        <td>
                            <a href="{{url('/setores/todos-os-setores')}}">Listar</a>
                        </td>
                    </tr>                   
                </table>
            </div>
        </div>
        <a class="btn btn-warning btn-menu-gestao" role="button" data-toggle="collapse" href="#regiao" aria-expanded="false" aria-controls="collapseExample">
            Regiões
        </a>
        <div class="collapse" id="regiao">
            <div class="well">
                <table class="table">
                    <tr>
                        <td>
                            <a href="{{url('/regiao')}}">Ver Regiões</a>
                        </td>
                    </tr>                   
                    <tr>
                        <td>
                            <a href="{{url('/regiao/inativas')}}">Ver Inativas</a>
                        </td>
                    </tr>                   
                </table>
            </div>
        </div>
<!--fim do botão-->




    </div>