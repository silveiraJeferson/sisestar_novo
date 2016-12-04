@extends('layout.layoutGestao')
@section('content')
<br/>
@include('logradouros.navbar_logradouros')




<div class="div_index">



    <!--    Criar select de tipo de logradouro-->
    @if(@$novo )

                <form method="post" action="{{url('/logradouros/store')}}">
                <span class="h1">Cadastrar novo Logradouro</span>
                <br/>
                <br/>
                @include('logradouros.select_tipo')
                <br/>
                <input class="form-control" type="text" name="nome"  value="{{@$logradouro->nome}}" placeholder="Nome do Logradouro"/>
                <br/>
    @endif
    @if(@$editar)  
                <?php $logradouro = $logradouros[0]; ?>
                <form method="post" action="{{url('/logradouros/update/'.$logradouro->id)}}">
                <span class="h1">Alterar Logradouro</span>
                <br/>        
                <input class="form-control" type="text" name="tipo"  value="{{@$logradouro->tipo}}" placeholder="Nome do Logradouro"/>
                <br/>   
                
                <input class="form-control" type="text" name="nome"  value="{{@$logradouro->nome}}" placeholder="Nome do Logradouro"/>
                <br/>
    @endif
    @if(@$addRegiao)
                <?php $logradouro = $logradouros[0]; ?>
                <form method="post" action="{{url('/logradouros/add-regiao')}}">
                <span class="h1">Cadastrar a Região</span>
                <h3 class="bg-info">Selecione a Região</h3>
                @include('regiao.select_regiao')
                <br/>
                <br/> 
                <input class="form-control" type="text" name="tipo"  value="{{@$logradouro->tipo}}" placeholder="Tipo do Logradouro"/>
                <br/>   
                <input type="hidden" name="id_logradouro" value="{{@$logradouro->id}}"/>
                <input class="form-control" type="text" name="nome"  value="{{@$logradouro->nome}}" placeholder="Nome do Logradouro"/>
                <br/>
    @endif
    @if(@$addSetor)               
                <form method="post" action="{{url('/logradouros/add-setor')}}">
                <span class="h1 ">Cadastrar o Logradouro em um Setor</span>
                <h4 class="bg-danger">Região: {{$request['nomeRegiao']}}</h4>
                <input type="hidden" name="id_logradouro" value="{{$request['id_logradouro']}}"/>
                @include('logradouros.select_setor')
                <input class="form-control" type="text" name="tipo"  value="{{$request['tipo']}}" placeholder="Tipo do Logradouro"/>
                <br/>   
                 <input  type="hidden" name="regiao" value="{{ $request['regiao'] }}">
            
            <input class="form-control" type="text" name="nome"  value="{{$request['nome']}}" placeholder="Nome do Logradouro"/>
            <br/>
    @endif
            
                
                
                



            <input  type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn btn-success"value="Enviar"/>
        </form>

</div>

@endsection