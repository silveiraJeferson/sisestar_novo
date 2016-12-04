@extends('layout.layoutGestao')
@section('content')
<br/>
@include('logradouros.navbar_logradouros')



<div class="div_index">
    <span class="h1 ">Adicionar Logradouro no setor: {{$request->setor}}</span>
    <h4 class="bg-danger">Região: {{$request['nome_regiao']}}</h4>
    <form method="post" action="{{url('/logradouros/incluir-logradouro-no-setor')}}">


        @include('logradouros.select_tipo')
        <br/>   
        <input  type="hidden" name="regiao" value="{{ $request['regiao'] }}">
        <input  type="hidden" name="id_setor" value="{{ $request->setor }}">

        <input class="form-control" type="text" name="nome"   placeholder="Nome do Logradouro"/>
        <br/>
        <input  type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-success"value="Enviar"/>
    </form>




    <div class="listaLogradourosDoSetor">
        <h3 class="text-info">Logradouros cadastrado para este setor:</h3>
        @forelse($logradouros as $logradouro)
        <p><i>{{$logradouro->tipo}} {{$logradouro->nome}}</i></p>
        @empty
        <h1 class="text-danger">Nenhum logradouro cadastrado para este setor</h1>
        @endforelse
    </div>

</div>

@endsection