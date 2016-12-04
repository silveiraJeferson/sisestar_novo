<nav class="navbar navbar-default navbar_setores">
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="bg-info"><a href="{{url('/funcionarios/index')}}" class="glyphicon glyphicon-menu-left"></a></li>
                <li ><a href="{{url('/funcionarios/index')}}">Ver funcionários</a></li>
                <li class="bg-success"><a href="{{url('/funcionarios/create')}}">Adicionar</a></li>                
                <li class="bg-danger" ><a href="{{url('/funcionarios/inativos')}}">Ver Inativos</a></li>

                @if(@$funcionario)
                <li> <a href='{{url("funcionarios/edit/".$funcionario->id)}}' class="">Editar dados</a></li>
                @endif
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<form method="post" action="{{url('/funcionarios/busca')}}" id="form_busca" class="navbar-form">
    <div class="form-group">
        <input type="text" name="param_busca" size="50"class="form-control" placeholder="Buscar Funcionario">
    </div>
    <input  type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-default">Buscar</button>
</form>  
