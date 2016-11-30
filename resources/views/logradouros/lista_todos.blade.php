
@extends('layout.layoutGestao')
@section('content')
<br/>

@include('logradouros.navbar_logradouros')
<div class="div_index">
    <div class="h1">Logradouros Cadastrados: 
        <span class="text-danger">{!!$lista->total()!!}</span>
    </div>

    <!--    Formulario para busca de logradouro-->
    <form method="post" action="{{url('/logradouros/buscar')}}" id="form_busca" class="navbar-form">
        <div class="form-group">
            <input type="text" name="param_busca" size="50"class="form-control" placeholder="Buscar Logradouro">
        </div>
         <input  type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-default">Buscar</button>
    </form>  
    <!--    Fim do formulário de busca-->



    <div class="overflow">
        <table class="table">
            <tr class="bg-info">
                <th>Tipo</th>
                <th>Nome</th>
                <th>Setor</th>
                <th>Região</th>
                <th>Referência</th>
            </tr>

            @forelse($lista as $logradouro)

            <tr>
                <td>{{$logradouro->tipo}}</td>
                <td>{{$logradouro->nome}}</td>
                <td>{{@$logradouro->id_setor}}</td>
                <td>{{@$logradouro->regiao}}</td>
                <td>{{@$logradouro->referencia}}</td>
            </tr>
            @empty
            <h1 class="text-danger">Nenhum Logradouro Cadastrado</h1>
            @endforelse

        </table>
    </div>
    <div class="text-center paginate">
        {!! $lista->render() !!}
    </div>

</div>
@endsection
