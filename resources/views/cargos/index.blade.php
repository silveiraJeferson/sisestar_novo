@extends('layout.layoutGestao')
@section('content')

<br/>
<a href="{{url('/cargos')}}" class="btn btn-primary glyphicon glyphicon-arrow-left">Voltar</a>
<a href="{{url('/cargos/create')}}" class="btn btn-success glyphicon glyphicon-plus">Cargos</a>
<h1>Cargos cadastrados:</h1>


<table class="table">
    <tr>           
        <th>Cargo</th>
        <th>Editar</th>
        <th>Excluir</th>
    </tr>
    @forelse($lista as $cargo)
    <tr>  
        @if($cargo->cargo != 'Master')
        <td>{{$cargo->cargo}}</td>
        <td><a href="{{url('/cargos/edit/'.$cargo->id)}}" class="text-primary glyphicon glyphicon-pencil"></a></td>


        <td> <a href="{{url('/cargos/destroy/'.$cargo->id)}}" class="glyphicon glyphicon-trash text-danger"></a></td>
        @endif
    </tr>
    @empty
    <h3 class="text-danger">Nenhum Cargo cadastrado</h3>
    @endforelse
</table>






@endsection