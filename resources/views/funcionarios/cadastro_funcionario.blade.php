@extends('layout.layoutGestao')
@section('content')
<h1>Cadastro Funcionario</h1>

{!! Form::open(['url' => '/funcionarios/store','method'=>'POST', 'files'=>true]) !!}
<p>Cargo:   
    <br/>
    @foreach($cargos as $cargo)
    <input type="radio" checked="checked" name="id_cargo" value="{{$cargo->id}}"/>   {{$cargo->cargo}}
    @endforeach
</p> 
<p>{!! Form::text('nome','',array('placeholder' => 'Nome')) !!}</p>
<p>{!! Form::text('sobrenome','',array('placeholder' => 'Sobrenomeome')) !!}</p>
<p>{!! Form::number('cpf','',array('placeholder' => 'CPF')) !!}</p>
<p>{!! Form::number('matricula','',array('placeholder' => 'Matricula')) !!}</p>
<p>{!! Form::date('data_nasc','',array('placeholder' => 'Data de Nascimento')) !!}</p>
<p>{!! Form::file('arquivo') !!}</p>
<p>{!! Form::submit('Enviar')!!}</p>
{!! Form::hidden('foto')!!}






{!! Form::close() !!}
@endsection