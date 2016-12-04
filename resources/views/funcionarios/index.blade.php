@extends('layout.layoutGestao')
@section('content')
<br/>
@include('funcionarios.navbar_funcionarios')
<div class="div_index">
    
    
    <table class="table table-responsive table-striped table-hover">
        <h1>Listagem dos funcionarios</h1>
        <tr>

        <p class="bg-info">{{$info}}<span class="text-danger h5">{!! $funcionarios->total() !!}</span></p>    




        </tr>
        <tr>
            <th>#</th>
            <th>Sobrenome</th>
            <th>Nome</th>
            <th>Matrícula</th>
            <th></th>
        </tr>

        @foreach($funcionarios as $funcionario)
        <tr>
            <td><a href="/funcionarios/show/{{$funcionario->id}}">

                    <img class="img-circle" style="width: 20px; height: 20px;"src="{{url('imagem/arquivo/'.$funcionario->foto)}}" alt="" /></a>
            </td>
            <td class="text-uppercase">{{$funcionario->sobrenome}}</td>
            <td>{{$funcionario->nome}}</td>
            <td>{{$funcionario->matricula}}</td>
            <td><a class="glyphicon glyphicon-eye-open" href="/funcionarios/show/{{$funcionario->id}}"></a></td>
            <td><a class=" glyphicon glyphicon-pencil text-primary"href="{{url("funcionarios/edit/".$funcionario->id)}}" ></a> </td>
            @if($funcionario->visible)
            <td><a class=" glyphicon glyphicon-remove text-danger"href="{{url("funcionarios/destroy/".$funcionario->id)}}" ></a> </td>
            @else
            <td><a class=" glyphicon glyphicon-plus text-success"href="{{url("funcionarios/up/".$funcionario->id)}}" ></a> </td>
            @endif

        </tr>
        @endforeach
    </table>


    <div class="center-block text-center">
        {!! $funcionarios->render() !!}
    </div>
</div>
@endsection












<!--    @foreach($funcionarios as $funcionario)
    <img class="img-circle" style="width: 30px; height: 30px;"src="{{url('imagem/arquivo/'.$funcionario->foto)}}" alt="" />
    {{$funcionario->nome}}<br/>
    @endforeach-->