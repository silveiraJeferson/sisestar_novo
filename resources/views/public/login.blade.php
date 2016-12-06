@extends('layout.master')
@section('content')
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo sha1("lklklklkklkl");
}
?>
<form method="post" action="/autenticar/login">
    <div id="formLogin"class="thumbnail center-block">
        <h4 class="text-center">Login</h4>
        <p id="pIdLogin"class="bg-info text-danger text-center">Informe login e senha</p>
        <div class="input-group">
            <div class="input-group-addon glyphicon glyphicon-user"></div>
            <input type="text" class="form-control" id="exampleInputAmount"  name="login"   placeholder="Login">
        </div>        
        <br/>
        <div class="input-group">
            <div class="input-group-addon glyphicon glyphicon-asterisk"></div>
            <input type="password" class="form-control" id="exampleInputAmount" name="senha" placeholder="Senha">
        </div>
        <br/>
        <input type="hidden" name="tipo_login" value="desk">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if(@$resp)
        <span class="text-danger bg-danger center-block text-center">
            {{$resp->msg}}
        </span>
        @endif
        <button type="submit" class="btn btn-success center-block">Login</button>  


    </div>

</form>




@endsection