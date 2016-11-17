@extends('layout.master')
@section('content')
<br/><br/>
<!--Listo as ultimas notificações do dia-->
@include('notificacao.ultimas_notificacoes')
<!--Input de busca-------------------------------------------------------------------------->
<form id="busca" >
    <input id="filtroBusca" class="form-control center-block" type="date" name="data_notificacao"/>
    <br/>
    <button  class="btn btn-success center-block"><a href="/notificacao/result">Buscar</a></button>
</form>







@endsection