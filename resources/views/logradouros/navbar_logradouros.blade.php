<nav class="navbar navbar-default navbar_setores">
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="{{url('/regiao')}}">Regiões</a></li>
                <li ><a href="{{url('/setores')}}">Setores</a></li>                
                <li class="active"><a href="{{url('/logradouros/todos-os-logradouros')}}">Logradouros</a></li>
                <li class="bg-success"><a href="{{url('/logradouros/create')}}">Cadastrar Logradouro</a></li>

            </ul>
                     
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>