<nav class="navbar navbar-default navbar_setores">
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="{{url('/regiao')}}">Regiões</a></li>
                <li ><a href="{{url('/setores/todos-os-setores')}}">Setores</a></li>                
                <li class="active"><a href="{{url('/logradouros/index')}}">Logradouros</a></li>
                
                
                
                <li class="bg-success "><a href="{{url('/logradouros/create')}}">Cadastrar Logradouro</a></li>
                <li class="bg-success"><a href="{{url('/logradouros/todos-os-logradouros')}}">Todos os Logradouros</a></li>
                <li class="bg-danger "><a href="{{url('/logradouros/inativos')}}">Ver log. inativos</a></li>

            </ul>
                     
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
 <form  action="{{url('/logradouros/buscar')}}" id="form_busca" class="navbar-form">
        <div class="form-group">
            <input type="text" name="param_busca" size="50"class="form-control" placeholder="Buscar Logradouro">
        </div>
         <input  type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-default">Buscar</button>
    </form>  