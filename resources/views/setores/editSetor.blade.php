@extends('layout.layoutGestao')
@section('content')
<br/>
<!--<ul class="nav nav-tabs nav-justified">
    <li> <a href="{{url('/setores')}}" class="">Home</a></li>
    <li> <a href="{{url('/setores')}}" class="">Cadastrar Logradouros</a></li>
    <li> <a href="{{url('/setores')}}" class="">Ver Regiões</a></li>
    <li> <a href="{{url('/setores')}}" class="">Ver Regiões</a></li>
</ul>-->
@include('setores.navbar_setores')

<div class="div_index">

    <a class="btn btn-info" href="{{url('/setores')}}">Voltar</a>
    <a class="right-bar btn btn-info" href="{{url('/logradouros/create')}}">Cadastrar Logradouro</a>

    <h1 class="text-info">Região: {{($setor->nomeRegiao[0]->regiao)}}</h1>
    <h3>Setor Nº: {{$setor->numero}}</h3>
    <h4 class="text-primary">Referencia: {{$setor->referencia}}</h4>

    <table class="table table-striped">
        @forelse($setor->logradouros as $logradouro)
        <tr>
            <td>{{$logradouro->tipo}}</td><td>{{$logradouro->nome}}</td>
        </tr>
        @empty
        <span class="h3 text-danger">Nenhum logradouro cadastrado</span>
        @endforelse
    </table>
</div>


@endsection