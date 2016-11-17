@extends('layout.layoutGestao')
@section('content')
<br/>
<a href="{{url('/valores')}}" class="btn btn-primary glyphicon glyphicon-arrow-left">Voltar</a>

<a href="{{url('/agencia/create')}}" class="btn btn-success glyphicon glyphicon-plus">Adicionar</a>
<hr/>
<h1>Listagem de agencias com seus valores</h1>

<table class="table table-hover">
    <tr>
        <th>Nome do Órgão</th>
        <th>Valor da infração</th>
        <th>Editar</th>
        <th>Excluir</th>
    </tr>

    @forelse($lista as $agencia)

    <tr>
        <td>{{$agencia->nome}}</td>
        <td>R$ {{$agencia->valor}},00</td>
        <td><a href="{{url('/agencia/edit/'.$agencia->id)}}" class="glyphicon glyphicon-pencil"></a></td>
        <td><a href="{{url('/agencia/destroy/'.$agencia->id)}}" class="glyphicon glyphicon-trash text-danger"></a></td>
    </tr>
    @empty

    <h3 class="text-danger">Nenhuma Agência cadastrada</h3>
    @endforelse

</table>




@endsection
