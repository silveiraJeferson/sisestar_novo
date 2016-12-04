<nav class="navbar navbar-default navbar_setores">
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{url('/regiao')}}">Regiões</a></li>
                <li><a href="{{url('/setores/todos-os-setores')}}">Setores</a></li>                
                <li><a href="{{url('/logradouros')}}">Logradouros</a></li>
                <li ><a class="bg-info " href="{{url('/regiao/create')}}">Criar nova Região</a></li>
                @if(@$setores)
                <li class="bg-info"><a href="{{url('/setores/create-setor-regiao/'.$setores->id_regiao)}}" >Cadastrar um novo Setor</a></li>
                @endif
                @if(@$edit)
                   
                    @if(@$ativo)                
                    <li ><a class="bg-danger " href="{{url('/regiao/destroy/'.$setores->id_regiao)}}">Excluir Região</a></li>
                    @else
                    <li ><a class="bg-success " href="{{url('/regiao/ativar/'.$setores->id_regiao)}}">Ativar Região</a></li>
                    @endif
                @endif
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<form method="post" action="{{url('/regiao/buscar')}}" id="form_busca" class="navbar-form">
    <div class="form-group">
        <input type="text" name="param_busca" size="50"class="form-control" placeholder="Buscar Região">
    </div>
    <input  type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-default">Buscar</button>
</form>  


