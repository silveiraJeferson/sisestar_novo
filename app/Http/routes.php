<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//
//Route::get('/', function () {
//    return view('layouts.index');
//});

Route::controller('/notificacao','NotificacaoController');
Route::controller('/regularizacao', 'RegularizacaoController');
Route::controller('/gestao', 'GestaoController');
Route::controller('/master', 'MasterController');
Route::controller('/status', 'StatusController');
Route::controller('/valores', 'ValoresController');
Route::controller('/agencia', 'AgenciaController');
Route::controller('/cargos', 'CargosController');
Route::controller('/funcionarios', 'FuncionariosController');
Route::controller('/setores', 'SetorController');
Route::controller('/regiao', 'RegiaoController');
Route::controller('/logradouros', 'LogradouroController');


Route::controller('/autenticar', 'LoginController');

//Route::controller('/imagem','ImagemController');

Route::get('imagem/arquivo/{nome}', [
    'as' => 'imagem.file',
    'uses' => 'ImagemController@getImagemFile'
]);

 
   






Route::controller('/', 'PainelController');


