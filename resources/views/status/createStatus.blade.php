@extends('layout.layoutGestao')
@section('content')
<br/>
<a href="{{url('/status')}}" class="btn btn-primary glyphicon glyphicon-arrow-left">Voltar</a>
<?php

    if(@$status){
        $value = $status[0]->status;
        $id = $status[0]->id;
    }else{
        $value = "";
    }
?>
<br/>


@if(@!$status)
<form method="post" action="{{url('/status/store')}}">
    <h1>Nome do novo status</h1>
@else
<form method="post" action="{{url('/status/update/'.$id)}}">
    <h1>Alterar nome do status</h1>
@endif

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" name="status"placeholder="Status" value="{{$value}}"><br/><br/>
    <input type="submit" value="Gravar" class="btn btn-success" />
</form>



@endsection