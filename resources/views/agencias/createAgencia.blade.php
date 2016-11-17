@extends('layout.layoutGestao')
@section('content')
<?php
    if(@$agencia){
        $id = $agencia[0]->id;
    }


?>

<br/>
<a href="{{url('/valores')}}" class="btn btn-primary glyphicon glyphicon-arrow-left">Voltar</a>


@if(@!$agencia)
<form method="post" action="{{url('/agencia/store')}}">
    <h1>Cadastro de Agência:</h1>
@else
<form method="post" action="{{url('/agencia/update/'.$id)}}">
    <h1>Alterar a Agência</h1>
@endif

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" name="nome"placeholder="Nome da Agencia" value="{{@$agencia[0]->nome}}"><br/><br/>    
    <input type="text" name="valor"placeholder="Valor da infração" value="{{@$agencia[0]->valor}}"><br/><br/>
    
    
    
    <input type="submit" value="Gravar" class="btn btn-success" />
</form>


@endsection