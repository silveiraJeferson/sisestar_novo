@extends('layout.movel')
@section('content')
<br/>
<h3 >Informe o número do Setor</h3>
<form action="{{url('/autenticar/define-setor')}}">
    <input type="number" name="setor" value="0" class='form-control' placeholder="Número do Setor..."/><br/>
    <input type="submit" class="btn btn-success" value="Selecionar" />
    @if(@$msg)
    <span class="bg-danger">{{$msg}}</span>
    @endif
</form>
<h2 class="center-block text-center">Ou</h2>
<h3 ><a href="{{url('/autenticar/regioes')}}" class="btn btn-info center-block">Buscar por Região</a></h3>

@if(@$regioes)
    @include('notificacao.lista_regioes')
@endif
@if(@$setores)
    @include('notificacao.lista_setores')
@endif

@endsection