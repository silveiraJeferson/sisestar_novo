<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;
use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use sisestar\Funcionario;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use sisestar\MsgResposta;

class FuncionariosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        $funcionarios = DB::table('funcionarios')->orderBy('sobrenome')->where('visible', true)->paginate(7);
        $info = "Total de funcionários cadastrados: ";
        return view('funcionarios.index', compact('funcionarios', 'info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //------------------------------------------chamo o formulário para criação de um novo funcionario--------------
    public function getCreate() {
        $obj = new MsgResposta();
        $cargos = DB::table('cargos')->orderBy('id', 'desc')->get();

        if (!$cargos) {
            $obj->status = false;
            $obj->msg = 'Ainda não existe nenhum cargo cadastrado. Favor cadastrar.';
        } else {
            $obj->status = true;
            $obj->valor['cargos'] = $cargos;
        }
        $obj->valor['issetFuncionario'] = false;
        return view('funcionarios.cadastro_funcionario', compact('obj'));
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
        $obj = new MsgResposta();

        //-------------------------------------------------------------------------------------------
        $consulta = DB::table('funcionarios')
                        ->join('cargos', 'cargos.id', '=', 'funcionarios.id_cargo')
                        ->where('funcionarios.id', $id)->get();

        $consulta[0]->id = $id;
        $calcula_idade = new DataController($consulta[0]->data_nasc);
        $consulta[0]->idade = $calcula_idade->getIdade();
        //----------------------------------------------------------------------------------------------    


        $login = DB::table('logons')->where("id_funcionario", $id)->get();
        if ($login) {
            $consulta[0]->login = $login;
            $obj->valor['login'] = true;
        } else {
            $obj->valor['login'] = false;
        }

        //-----------------------------------------------------------------------------------------------    

        $historico = DB::table('logons')->where('id_funcionario', $id)->get();

        //-----------------------------------------------------------------------------------------------
        $obj->valor['funcionario'] = $consulta;
        $obj->valor['historico'] = $historico;


        return view('funcionarios.info_funcionario', compact('obj'));
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
    public function getEdit($id) {
        //-------------------------------------------------------------------------------------------
        $consulta = DB::table('funcionarios')
                        ->join('cargos', 'cargos.id', '=', 'funcionarios.id_cargo')
                        ->where('funcionarios.id', $id)->get();

        $consulta[0]->id = $id;
        $calcula_idade = new DataController($consulta[0]->data_nasc);
        $consulta[0]->idade = $calcula_idade->getIdade();
        //----------------------------------------------------------------------------------------------    


        $login = DB::table('logons')->where("id_funcionario", $id)->get();
        if ($login) {
            $consulta[0]->login = $login;
            $obj->valor['login'] = true;
        } else {
            $obj->valor['login'] = false;
        }

        //-----------------------------------------------------------------------------------------------    

        $historico = DB::table('logons')->where('id_funcionario', $id)->get();
        $cargos = DB::table('cargos')->orderBy('id', 'desc')->get();

        //-----------------------------------------------------------------------------------------------
        $obj->status = true;
        $obj->valor['funcionario'] = $consulta;
        $obj->valor['historico'] = $historico;
        $obj->valor['cargos'] = $cargos;

        $obj->valor['issetFuncionario'] = true;
        
        return view('funcionarios.cadastro_funcionario', compact('obj'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, $id) {
        DB::table('funcionarios')->where('id', $id)
                ->update(['nome'=>$request->nome,'sobrenome'=>$request->sobrenome,'cpf'=> $request->cpf, 'matricula'=>$request->matricula, 'data_nasc'=>$request->data_nasc]);
        return redirect('/funcionarios/show/'.$id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDestroy($id) {
        DB::table('funcionarios')->where('id',$id)->update(['visible'=> false ]);
        return redirect('/funcionarios');
    }
    public function getUp($id) {
        DB::table('funcionarios')->where('id',$id)->update(['visible'=> true ]);
        return redirect('/funcionarios');
    }

    // funcao para alteração de foto do perfil

    public function postFoto(Request $request) {

        $id = $request['id'];
        $funcionario = DB::table('funcionarios')->where('id', $id)->get();


        $file = $request->file('arquivo');
        if ($request->hasFile('arquivo') && $file->isValid()) {
            if ($file->getClientMimeType() == "image/jpeg") {

                $dadosFormulario = $request->all();
                $foto = $funcionario[0]->matricula . $funcionario[0]->cpf . ".jpg";

                $file->move('app/public', $foto);
                DB::table('funcionarios')->where('id', $id)->update(['foto' => $foto]);
            }
        }
        return redirect("/funcionarios/show/$id");
    }
    
    public function getInativos(){
         $funcionarios = DB::table('funcionarios')->orderBy('sobrenome')->where('visible', false)->paginate(7);
        $info = "Total de funcionários excluídos: ";
        return view('funcionarios.index', compact('funcionarios', 'info'));
    }
    

}
