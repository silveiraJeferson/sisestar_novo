@extends('layout.layoutGestao')
@section('content')
<br/>
@foreach($consulta as $funcionario)

<?php
//--------------------------------------calcular idade-----------------------
//background da info do cargo
?>
<!--Botão para criar acesso do funcionário ao sistema-->
<div class=" bg-info">
    @if(!$login)
    <button style="margin-left:  80%" type="button" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-lg">Criar acesso ao Sistema</button>
    @endif
</div>




<!--Div foto do perfil com botões de alteração de imagem e senha-->
<div id="imgPerfil" class="thumbnail" >     
    <button type="button"  class="thumbnail" data-toggle="modal" data-target="#myModal">
        <img class="thumb thumbnail text-warning"src="{{url('/imagem/arquivo/'.$funcionario->foto)}}"/>
    </button>
    <!-- -------------------mudar foto perfil -->
    <button  data-toggle="modal" data-target=".modalMeu" class="center-block text-center btn-primary btnDentroImg" >Editar foto</button>
    <!-- -------------------mudar senha -->
    <button  class="center-block text-center btn-default btnDentroImg" data-toggle="modal" data-target=".modal_altera_senha">Alterar Senha</button>   
</div>









<h1 class="text-capitalize">{{$funcionario->nome}}</h1>
<h2 class="bg-success">Cargo: {{$funcionario->cargo}}</h2>

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
@include('funcionarios.modal_altera_senha')
@include('funcionarios.modal_form_edit_foto')
@include('funcionarios.modal_foto_ampliada')
@include('funcionarios.modal_criar_acesso_ao_sistema')

@endforeach

<h5>Histórico de login:</h5>
@foreach($historico as $login)
{{$login->created_at}}
@endforeach
@endsection


