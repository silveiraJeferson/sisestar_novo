@extends('layout.layoutGestao')
@section('content')
<br/>
@include('regiao.navbar_regioes')


<div class="div_index">
    <a href="{{url('/regiao/todas-as-regioes')}}" class="btn btn-info">Voltar</a>
    <a href="{{url('/setores/create-setor-regiao/'.$setores->id_regiao)}}" class="btn btn-info">Cadastrar um novo Setor</a>
    <h1 class="text-info">Regiao: {{$setores->regiao}}</h1>
    @forelse($setores as $setor)
    <a href="{{url('/setores/show/'.$setor->id)}}" class="btn-setor  btn btn-success">Setor: {{$setor->numero}}<br/> Ref: {{$setor->referencia}}</a>
    @empty
    <span class="h4 text-danger">Nenhum setor cadastrado</span>
    @endforelse



</div>

@endsection