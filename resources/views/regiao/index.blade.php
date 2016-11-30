@extends('layout.layoutGestao')
@section('content')
<br/>

@include('regiao.navbar_regioes')
<div class="div_index">
    <a class="bg-primary div_navegacao_index glyphicon glyphicon-align-justify"href="{{url('/regiao/todas-as-regioes')}}"> Ver Regiões</a>
    
    <a class="bg-primary div_navegacao_index glyphicon glyphicon-align-justify"href="{{url('/regiao/create')}}"> Adicionar uma Região</a>
    


</div>





@endsection