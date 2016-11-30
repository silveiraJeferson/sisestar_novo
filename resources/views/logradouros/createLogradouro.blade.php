@extends('layout.layoutGestao')
@section('content')
<br/>
@include('logradouros.navbar_logradouros')


<div class="div_index">
    <form method="post" action="{{url('/logradouros/store')}}">
        <span class="h1">Cadastrar novo Logradouro</span>
        <!--    Criar select de tipo de logradouro-->
        <input  type="hidden" name="_token" value="{{ csrf_token() }}">
       
        @include('logradouros.select_tipo')
        <br/>
         <input class="form-control" type="text" name="nome" placeholder="Nome do Logradouro"/>
        <br/>
        <input type="submit" class="btn btn-success"value="Enviar"/>


    </form>

</div>

@endsection