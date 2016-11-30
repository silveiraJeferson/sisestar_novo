@extends('layout.layoutGestao')
@section('content')
<br/>
<nav class="navbar navbar-default navbar_setores">
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="{{url('/regiao')}}">Regiões</a></li>
                <li ><a href="{{url('/setores')}}">Setores</a></li>                
                <li class="active"><a href="{{url('/logradouro')}}">Logradouros</a></li>

            </ul>
            <form class="navbar-form right-bar">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Buscar</button>
            </form>           
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@endsection