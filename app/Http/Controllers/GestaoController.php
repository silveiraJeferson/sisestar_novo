<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;
use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use sisestar\Funcionario as Funcionario;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class GestaoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        return redirect('/setores/todos-os-setores');
    }

    //--------------------------------------listagem de todos os funcionarios----------
    public function getFuncionarios() {
       //
    }

    //---------------------------------------listagem do perfil do funcionário-----------
    public function getFuncionarioInfo($id) {

        //
    }

    //---------------------------------------retorno a view de busca de funcionarios
    public function getBuscar() {
        return view('gestao.buscar_funcionario');
    }

    //---------------------------------------retorno o input radio de cargos para cadastro de funcionarios
    public function getCadastrar() {
        $cargos = DB::table('cargos')->orderBy('id', 'desc')->get();
        return view('gestao.cadastro_funcionario', compact('cargos'));
    }

    //------------------------------------------------rotas methodos post----------
    //-------------------------------------------------cadastro de funcionarios---------------
    public function postCadastrar(Request $request) {

        $file = $request->file('arquivo');
        if ($request->hasFile('arquivo') && $file->isValid()) {
            if ($file->getClientMimeType() == "image/jpeg") {


                $dadosFormulario = $request->all();
                $dadosFormulario['data_nasc'] = date('d/m/Y', strtotime($dadosFormulario['data_nasc']));
                $dadosFormulario["foto"] = $dadosFormulario["matricula"] . $dadosFormulario["cpf"] . ".jpg";


                $cadastro = new Funcionario($dadosFormulario);
                $file->move('app/public', $dadosFormulario["foto"]);
                $cadastro->save();
            }
        }


        $id = DB::table('funcionarios')->max('id');
        
        return redirect("gestao/funcionario-info/$id");
        // quando cadastrado um novo usuario, redirecionar para pagina de cadastro de login e senha
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
    
    
    
    public function getNotificacoes(){
        $consulta = DB::table('notificacaos')->orderBy('data','desc')->orderBy('hora','desc')->where('status',1)->paginate(15);
        return view('gestao.listar_notificacoes',  compact('consulta'));
    }

}
