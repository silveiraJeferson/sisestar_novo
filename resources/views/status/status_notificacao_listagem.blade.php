@extends('layout.layoutGestao')
@section('content')
<br/>
<a href="{{url('/status')}}" class="btn btn-primary glyphicon glyphicon-arrow-left">Voltar</a>
<a href="{{url('/status/create')}}" class="btn btn-success glyphicon glyphicon-plus">Status</a>
<h1>Status de notificações cadastrados:</h1>

<table class="table">
    <tr>
        <th>Código</th>    
        <th>Nome</th>
        <th>Editar</th>
        <th>Excluir</th>
    </tr>
    @foreach($lista as $status)
    <tr>
        <td>{{$status->id}}</td>
        <td>{{$status->status}}</td>
        <td><a href="{{url('/status/edit/'.$status->id)}}" class="text-primary glyphicon glyphicon-pencil"></a></td>
        <td> <a href="{{url('/status/destroy/'.$status->id)}}" class="glyphicon glyphicon-trash text-danger"></a></td>

    </tr>

    @endforeach
</table>



@endsection