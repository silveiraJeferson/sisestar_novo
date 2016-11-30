@extends('layout.layoutGestao')
@section('content')
<br/>
@include('setores.navbar_setores')
<div class="div_index">

    <a class="btn btn-info" href="{{url('/setores')}}">Inicio</a>
    <a class="btn btn-info" href="{{url('/setores/todos-os-setores')}}">Listar Setores</a>
    <a class="btn btn-info right-bar" href="{{url('/logradouros/create')}}">Adicionar logradouro</a>

    <h1>Setor Nº: {{$setor->numero}}, <span class="right-bar">Ref: {{$setor->referencia}}</span></h1>
    <h3 class="text-info">Região: {{($setor->regiao)}}</h3>


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