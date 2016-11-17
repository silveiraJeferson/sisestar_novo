@extends('layout.layoutGestao')
@section('content')
<br/>
<a href="{{url('/cargos')}}" class="btn btn-primary glyphicon glyphicon-arrow-left">Voltar</a>
<?php

    if(@$cargo){
        $value = $cargo[0]->cargo;
        $id = $cargo[0]->id;
    }else{
        $value = "";
    }
?>
<br/>


@if(@!$cargo)
<form method="post" action="{{url('/cargos/store')}}">
    <h1>Nome do novo cargos</h1>
@else
<form method="post" action="{{url('/cargos/update/'.$id)}}">
    <h1>Alterar nome do cargo</h1>
@endif

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" name="cargo"placeholder="Status" value="{{$value}}"><br/><br/>
    <input type="submit" value="Gravar" class="btn btn-success" />
</form>



@endsection