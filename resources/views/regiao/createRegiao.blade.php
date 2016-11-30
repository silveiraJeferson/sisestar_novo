@extends('layout.layoutGestao')
@section('content')
<br/>
@include('regiao.navbar_regioes')



<div class="div_index">
    <a href="{{url('/regiao/todas-as-regioes')}}" class="btn btn-info">Voltar</a>
    @if(!@$regiao)
    <form method="post" action="{{url('/regiao/store')}}">    
        @else
        <form method="post" action="{{url('/regiao/update/'.$regiao->id)}}">
            @endif
            <h4>Nome da regiao:</h4>
            <input class="form-control" type="text" name="regiao" value="{{@$regiao->regiao}}" placeholder="Nome da Região" />
            <input  type="hidden" name="_token" value="{{ csrf_token() }}">
            <br/>
            <input class="btn btn-success" type="submit" value="Salvar"/>
        </form>


</div>


@endsection
