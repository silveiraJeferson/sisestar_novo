<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;
use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use sisestar\Funcionario;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FuncionariosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        $funcionarios = DB::table('funcionarios')->orderBy('sobrenome')->paginate(7);
        $info = "Total de funcionários cadastrados: ";
        return view('funcionarios.index', compact('funcionarios', 'info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate() {
        $cargos = DB::table('cargos')->orderBy('id', 'desc')->get();
        return view('funcionarios.cadastro_funcionario', compact('cargos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request) {
        $file = $request->file('arquivo');
        if ($request->hasFile('arquivo') && $file->isValid()) {
            if ($file->getClientMimeType() == "image/jpeg") {


                $dadosFormulario = $request->all();
                $dadosFormulario['data_nasc'] = date('d/m/Y', strtotime($dadosFormulario['data_nasc']));
                $dadosFormulario["foto"] = $dadosFormulario["matricula"] . $dadosFormulario["cpf"] . ".jpg";


                $cadastro = new Funcionario($dadosFormulario);
                $file->move('app/public', $dadosFormulario["foto"]);
                $cadastro->save();

                $id = DB::table('funcionarios')->max('id');
            }
        }




        return redirect("/funcionarios/show/$id");
        // quando cadastrado um novo usuario, redirecionar para pagina de cadastro de login e senha
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow($id) {
        $consulta = DB::table('funcionarios')
                        ->join('cargos', 'cargos.id', '=', 'funcionarios.id_cargo')
                        ->where('funcionarios.id', $id)->get();
        $login = DB::table('logons')->where("id_funcionario", $id)->get();
        $consulta[0]->id = $id;
        $calcula_idade = new DataController($consulta[0]->data_nasc);
        $consulta[0]->idade = $calcula_idade->getIdade();

        $historico = DB::table('logons')->where('id_funcionario', $id)->get();

        return view('funcionarios.info_funcionario', compact('consulta', 'login', 'historico'));
    }

    public function postBusca(Request $request) {
        if ($request->param == "") {
            return $this->getFuncionarios();
        }
        $funcionarios = DB::table('funcionarios')->where('nome', 'ilike', "%$request->param%")
                ->orWhere('sobrenome', 'ilike', "%$request->param%")
                ->orWhere('matricula', 'ilike', "%$request->param%")
                ->orderBy('sobrenome')
                ->paginate(7);
        $info = "Resultado para a busca ($request->param) : ";
        return view('funcionarios.index', compact('funcionarios', 'info'));
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

    // funcao para alteração de foto do perfil

    public function postFoto(Request $request) {
        
        $id = $request['id'];
        $funcionario = DB::table('funcionarios')->where('id',$id)->get();
        
        
        $file = $request->file('arquivo');
        if ($request->hasFile('arquivo') && $file->isValid()) {
            if ($file->getClientMimeType() == "image/jpeg") {

                $dadosFormulario = $request->all();
                $foto = $funcionario[0]->matricula . $funcionario[0]->cpf . ".jpg";
                
                $file->move('app/public', $foto);
                DB::table('funcionarios')->where('id',$id)->update(['foto' => $foto]);
                
            }
        }
        return redirect("/funcionarios/show/$id");
    }

}
