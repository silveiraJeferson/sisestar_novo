@extends('layout.layoutGestao')
@section('content')
<?php
if (@$obj->valor['issetFuncionario']) {
    $id = $obj->valor['funcionario'][0]->id;
} else {
    $id = 1;
}
?>
<br/>
<!--Para cadastrar um funcionario no sistema é necessário que exista um cargo cadastrado-->

<a class="btn btn-info" href="{{url('/funcionarios')}}">Início</a>
<a class="btn btn-info" href="{{url('/funcionarios/show/'.$id)}}">Voltar</a>




@if(!$obj->valor['issetFuncionario'])
<?php $dataNasc = '<input type="date" name="data_nasc" placeholder="Data de Nascimento" value="">' ?>

<h1>Cadastro Funcionario</h1>
@if(!$obj->status)
<span class="h3 text-danger">{{$obj->msg}}</span>
@endif

<!-------------------------------------------------------- se for criar um novo funcionario uso o metodo store-->
{!! Form::open(['url' => '/funcionarios/store','method'=>'POST', 'files'=>true]) !!}
<p>Cargo:   
    <br/>
    @foreach($obj->valor['cargos'] as $cargo)
    <input type="radio" checked="checked" name="id_cargo" value="{{$cargo->id}}"/>   {{$cargo->cargo}}
    @endforeach
</p> 
@else
<?php
$funcionario = $obj->valor['funcionario'][0];
$id = $funcionario->id;



$dataNasc = '<input type="text" name="data_nasc" placeholder="Data de Nascimento" value="' . $funcionario->data_nasc . '">'
?>
<div class="h1">Editar dados do Funcionario
    <img class="right-bar thumb thumbnail text-warning"src="{{url('/imagem/arquivo/'.$funcionario->foto)}}" width="100px"/>
</div>


<!-------------------------------------------------------- se for criar um novo funcionario uso o metodo update-->
<form method="post" action="{{url('/funcionarios/update/'.$id)}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">


    @endif

    <input type="hidden" name="visible" value="true">
    <table class="left table">
        <tr>
            <th>Nome </th>
            <td><input type="text" name="nome" placeholder="Nome" value="{{@$funcionario->nome}}"></td>
        </tr>
        <tr>
            <th>Sobrenome </th>
            <td><input type="text" name="sobrenome" placeholder="Sobreome" value="{{@$funcionario->sobrenome}}"></td>
        </tr>
        <tr>
            <th>CPF</th>
            <td><input type="number" name="cpf" placeholder="CPF" value="{{@$funcionario->cpf}}"></td>
        </tr>
        <tr>
            <th>Matricula</th>
            <td><input type="number" name="matricula" placeholder="Matricula" value="{{@$funcionario->matricula}}"></td>
        </tr>
        <tr>
            <th>Data de Nascimento</th>
            <td>{!! $dataNasc !!}</td>
        </tr>
        <input type="hidden" name="foto" value="{{@$funcionario->foto}}"/>


    </table>







    @if(!$obj->valor['issetFuncionario'])
    <p>{!! Form::file('arquivo') !!}</p>
    {!! Form::hidden('foto')!!}
    @endif

    <p>{!! Form::submit('Enviar')!!}</p>
    {!! Form::close() !!}












    @endsection