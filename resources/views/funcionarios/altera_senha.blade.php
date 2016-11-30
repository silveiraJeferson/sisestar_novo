<!--<div class="modal fade modal_altera_senha" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alteração de Senha</h4>
            </div>
-->

<!--            -------------------------------------------------------------------------->
@extends('layout.layoutGestao')
@section('content')

<br/><br/>
<h1>Alterar Senha de acesso</h1>



<br/>
<form class="form-horizontal" method="post" action="">





    <input type="hidden" name="_token" value="{{ csrf_token() }}">


    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Senha Atual</label>
        <div class=" col-sm-10">
            <input class='col-10' type="text" onblur="testeSenha()" id="senhaAtual" name="senhaAtual" class="form-control" id="inputEmail3" placeholder="Senha Atual...">
            <span class="text-danger" id="spanSenhaAtual">*</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Nova Senha</label>
        <div class=" col-sm-10">
            <input type="password" id="novaSenha" name="novaSenha"  class="form-control" id="inputPassword3" placeholder="Senha">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Repita a nova Senha</label>
        <div class=" col-sm-10">
            <input type="password" novaSenhaRpt name="novaSenhaRpt" class="form-control" id="inputPassword3" placeholder="Repita a Senha">
        </div>
    </div>

    <div class="modal-footer form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button  type="submit" class="btn btn-default">Alterar</button>
            <button  class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    
</form>

@endsection
