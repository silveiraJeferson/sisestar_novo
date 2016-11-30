@extends('layout.layoutGestao')
@section('content')
<br/>
@include('setores.navbar_setores')
<div class="div_index">
    <a class="bg-primary div_navegacao_index glyphicon glyphicon-align-justify"href="{{url('/setores/todos-os-setores')}}"> Ver Setores</a>
    
    <a class="bg-primary div_navegacao_index glyphicon glyphicon-align-justify"href="{{url('/setores/create')}}"> Adicionar um Setor</a>
    
    
    
</div>









@endsection