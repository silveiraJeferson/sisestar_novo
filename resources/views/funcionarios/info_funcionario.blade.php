@extends('layout.layoutGestao')
@section('content')
<br/>
<?php $funcionario = $obj->valor['funcionario'][0] ?>







<!--Botão para criar acesso do funcionário ao sistema-->
<div class=" bg-info">
    @if(!$obj->valor['login'])
    <button style="margin-left:  80%" type="button" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-lg">Criar acesso ao Sistema</button>
    @endif
</div>




<!--Div foto do perfil com botões de alteração de imagem e senha-->
<div id="imgPerfil" class="thumbnail" >     
    <button type="button"  class="thumbnail" data-toggle="modal" data-target="#myModal">
        <img class="thumb thumbnail text-warning"src="{{url('/imagem/arquivo/'.$funcionario->foto)}}"/>
        @if(!$funcionario->visible)
        <span class="h5 text-danger">Funcionario Inativo</span>
        @else
        <span class="h5 text-primary">Ativo</span>
        @endif
    </button>
    @if(!$funcionario->visible)
    <a href="{{url("funcionarios/up/".$funcionario->id)}}" class="center-block text-center btnDentroImg  btn-success " >Ativar</a>
    @endif
    <!-- -------------------mudar foto perfil -->
    <button  data-toggle="modal" data-target=".modalMeu" class="center-block text-center btn-primary btnDentroImg" >Editar foto</button>
    <!-- -------------------mudar senha -->

    <button  class="center-block text-center btn-default btnDentroImg" data-toggle="modal" data-target=".confirma_senha">Alterar Senha</button>  
    <span class="text-danger" id="msgErro"></span>

</div>


<!--
if($resp)

<input type="hidden" id="msg_resp" value="{$resp['msg']}"/>

<script>
        var msgErro = document.getElementById('msgErro');
        var msg_resp = document.getElementById('msg_resp');
        msgErro.innerHTML = msg_resp.value;
        
</script>
endif-->











<a href="{{url('/funcionarios')}}" class="btn btn-info">Inicio</a>
<a href='{{url("funcionarios/edit/".$funcionario->id)}}' class="btn btn-info">Editar dados</a>






<h1 class="text-capitalize">{{$funcionario->nome}}</h1>
<div class="h2 bg-success">
    Cargo: {{$funcionario->cargo}}


</div>

<table class="table">
    <tr>
        <th>Nome Completo:</th><td class="h3 text-capitalize">{{$funcionario->nome ." ". $funcionario->sobrenome}}</td>        
    </tr>
    <tr>
        <th>CPF:</th><td class="h3">{{$funcionario->cpf}}</td>
    </tr>
    <tr>
        <th>Matricula:</th><td class="h3">{{$funcionario->matricula}}</td>
    </tr>
    <tr>
        <th>Idade:</th><td class="h3">{{$funcionario->idade}} anos</td>
    </tr>
    <tr>
        <th>Data de Nascimento:</th><td class="h3">{{$funcionario->data_nasc}}</td>
    </tr>
</table>




<!-----------------------------------------------------------modais da pagina-->
@include('funcionarios.modal_confirma_senha')
@include('funcionarios.modal_form_edit_foto')
@include('funcionarios.modal_foto_ampliada')
@include('funcionarios.modal_criar_acesso_ao_sistema')


<h5>Histórico de login:</h5>
@foreach($obj->valor['historico'] as $login)
{{$login->created_at}}
@endforeach
@endsection


