
@extends('layout.layoutGestao')
@section('content')
<br/>

@include('logradouros.navbar_logradouros')
<div class="div_index">
    <div class="h1">Logradouros Cadastrados: 
        <span class="text-danger">{!!$lista->total()!!}</span>
    </div>

    <!--    Formulario para busca de logradouro-->
   
    <!--    Fim do formulário de busca-->



    <div class="overflow">
        <table class="table">
            <tr class="bg-info">
                <th>Tipo</th>
                <th>Nome</th>
                @if(!@$flag)
                <th>Setor</th>
                <th>Região</th>
                <th>Referência</th>
                @else
                <th></th>
                <th>Editar</th>
                <th></th>
                @endif
            </tr>

            @forelse($lista as $logradouro)
            
            <tr>
                <td>{{$logradouro->tipo}}</td>
                <td><a href="{{url('/setores/show/'.@$logradouro->id_setor)}}">{{$logradouro->nome}}</a>
                    
                    @if(!$logradouro->ativo)
                    <i class="bg-danger text-danger ">Inativo</i>
                    @endif
                </td>
                @if(!@$flag)
                <td>{{@$logradouro->id_setor}}</td>
                <td>{{@$logradouro->regiao}}</td>
                <td>{{@$logradouro->referencia}}</td>
                @else
                <td></td>
                <td><a href="{{url('logradouros/edit/'.$logradouro->id)}}" class="glyphicon glyphicon-pencil"></a></td>
                    @if(!$logradouro->ativo)
                        <td><a href="{{url('logradouros/ativar/'.$logradouro->id)}}" class="glyphicon glyphicon-ok text-success" data-toggle="tooltip" data-placement="top" title="Ativar"></a></td>
                        @else
                            <td>                            
                               <a href="{{url('logradouros/destroy/'.$logradouro->id)}}" class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Excluir"></a>
                            </td>
                        @endif
                    @endif
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
