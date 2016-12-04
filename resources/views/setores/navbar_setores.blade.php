<nav class="navbar navbar-default navbar_setores">
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="{{url('/regiao')}}">Regiões</a></li>
                <li class="active"><a href="{{url('/setores/todos-os-setores')}}">Setores</a></li>                
                <li><a href="{{url('/logradouros')}}">Logradouros</a></li>

                <li><a  class="bg-success" href="{{url('/setores/create')}}">Criar novo Setor</a></li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<form method="post" action="{{url('/setores/buscar')}}" id="form_busca" class="navbar-form">
    <div class="form-group">
        <input type="text" name="param_busca" size="50"class="form-control" placeholder="Buscar Setor">
    </div>
    <input  type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn btn-default">Buscar</button>
</form>  
