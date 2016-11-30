@extends('layout.layoutGestao')
@section('content')
<br/>
@include('setores.navbar_setores')
<div class="div_index">
   

    <!--    Formulario para busca de logradouro-->
    <form method="post" action="{{url('/setores/buscar')}}" id="form_busca" class="navbar-form">
        <div class="form-group">
            <input type="text" name="param_busca" size="50"class="form-control" placeholder="Buscar Setor">
        </div>
        <input  type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-default">Buscar</button>
    </form>  
    <!--    Fim do formulário de busca-->

    <h1 class="text-info">Setores Cadastrados: <span class="text-danger">{!! $setores->total() !!}</span></h1>
    <div class="overflow">
        <table class="table">
            <tr>
                <th>Setor Nº</th>
                <th>Região</th>
                <th>Logradouro de Referência</th>
                <th></th>
            </tr>
            @forelse($setores as $setor)
            <tr>
                <td >{{$setor->numero}}</td>
                <td >{{$setor->regiao}}</td>
                <td >{{$setor->referencia}}</td>
                <td><a class="glyphicon glyphicon-eye-open" href="{{url('/setores/show/'.$setor->id)}}"</td>
            </tr>

            @empty
            <h1 class="text-danger">Nenhum Setor Cadastrado</h1>
            @endforelse
        </table>
    </div>


</div>
<div class="text-center paginate">
    {!! $setores->render() !!}
</div>

@endsection