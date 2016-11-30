@extends('layout.layoutGestao')
@section('content')
<br/>
@include('setores.navbar_setores')

<div class="div_index">
    <a class="btn btn-info" href="{{url('/setores')}}">Inicio</a>
    <a class="btn btn-info right-bar" href="{{url('/setores/create')}}">Criar novo Setor</a>



    @if(!@$setor)
    <h1>Cadastro de setor</h1>
    <form method="post" action="{{url('/setores/store')}}">


        @else
        <h1>Editar o setor</h1>
        <form method="post" action="{{url('/setores/update')}}">
            @endif


            @if(@$regioes)        
            @include('regiao.select_regiao')<br/>
            @else  
            <!--        Se for adicionar um setor quando já estiver dentro de uma regiao-->
            <input type="hidden" name="regiao" value="{{ $id_regiao }}">
            @endif

            <input class="form-control" type="text" name="referencia"  size="100" placeholder="Digite um logradouro como referência"/>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="numero" value="{{ $numero }}">
            <br/>
            <input class="btn btn-success"type="submit" value="Salvar"/>

            </div>
            @endsection
