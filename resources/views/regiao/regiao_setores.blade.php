@extends('layout.layoutGestao')
@section('content')
<br/>

@include('regiao.navbar_regioes')
<?php
if($ativo){
    $bg = '';
}else{
    $bg = 'bg-danger';
}
?>

<div class="div_index">
    
    
    <h1 class="text-info {{$bg}}">Regiao: {{$setores->regiao}} </h1>
    @forelse($setores as $setor)
    <a href="{{url('/setores/show/'.$setor->id)}}" class="btn-setor col-xs-6 col-sm-3  btn btn-success">Setor: {{$setor->numero}}<br/> Ref: {{$setor->referencia}}</a>
   
    @empty
    <span class="h4 text-danger">Nenhum setor cadastrado</span>
    @endforelse

    

</div>

@endsection