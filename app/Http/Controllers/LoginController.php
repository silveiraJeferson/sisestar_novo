<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;
use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use sisestar\MsgResposta;
use Illuminate\Support\Facades\DB;
use sisestar\Login;
use sisestar\Events\NovoLogin;
use sisestar\Logon;

class LoginController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        //
    }

    public function postLogin(Request $request) {
        if ($request['tipo_login'] === 'movel') {
            $pag = 'loginmovel';
        } else {
            $pag = 'login';
        }

        $obj = DB::table('logins')->where('login', $request->login)->get();
        if (!$obj) {
            $resp = new MsgResposta();
            $resp->status = false;
            $resp->msg = "Login ou senha incorreto!";
            return view("public.$pag", compact('resp'));
        } else {
            $senhaTeste = $obj[0]->func . $request->senha;
            $senhaInformada = sha1($senhaTeste);
            if ($senhaInformada === $obj[0]->senha) {
                session(['logado'=>true]);
                //$resp = 'certo';
                $funcionario = DB::table('funcionarios')->where('id', $obj[0]->func)->get();
                session(['id_funcionario' => $funcionario[0]->id]);
                session(['matricula' => $funcionario[0]->matricula]);
                
                $resp = $funcionario;
                
                //----obs: id agente=1, adm=2, master=3;
                DB::table('logons')->where('id_funcionario', $funcionario[0]->id)
                        ->update(['logado' => true]);
                switch ($funcionario[0]->id_cargo) {
                    case 1:
                        return view('notificacao.select_setor');
                        break;
                    case 2:
                        return redirect('/notificacao/data');
                        break;
                    case 3:
                        return redirect('/master');
                        break;
                    default:
                        return redirect('/');
                        break;
                }
            } else {
                //$resp = 'errado';
                $resp = new MsgResposta();
                $resp->status = false;
                $resp->msg = "Login ou senha incorreto!";
            }
            return view("public.$pag", compact('resp'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }
    
    public function getSelect_setor(){
        return view('notificacao.select_setor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request) {

        $flag = false;



        //validar senhas iguais
        $dadosLogin = $request->all();
        $flag = DB::table('logins')->where('func', $dadosLogin['id_func'])->get();



        $senha = sha1($dadosLogin['id_func'] . $dadosLogin['senha']);
        $dadosLogin['senha'] = $senha;
        $dadosLogin['func'] = $dadosLogin['id_func'];
        $login = new Login($dadosLogin);


        //-----------------------------adiciono usuario à tabela logon para saber seu status online
        $logon = new Logon();
        $logon->id_funcionario = $dadosLogin['id_func'];
        $logon->logado = false;

        $id = $dadosLogin['id_func'];

        if (!$flag) {
            $login->save();
            $logon->save();
        }
        return redirect("/funcionarios/show/$id");
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
    public function getEdit($id) {
        $funcionario = DB::table('funcionarios')->where('id', $id)->get();
        $login = DB::table('logins')->where('func', $id)->get();
        $token = $login[0]->senha;
        return view('funcionarios.modal_altera_senha', compact('funcionario', 'token'));
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

    public function getLogin($id) {
        $func = DB::table('funcionarios')->where('id', $id)->get();
        return view('gestao.cadastro_login', compact('func'));
    }

    public function getLogoff() {
        session()->flush();
        return redirect('/');
    }

    public function postConfirm(Request $request, $id) {
        $teste = sha1($id . $request['senha']);
        $consulta = DB::table('logins')->where('func', $id)->get();
        if ($teste == $consulta[0]->senha) {
            return view('funcionarios.altera_senha', compact($id));
        } else {
            $resp = new MsgResposta();
            $resp->status = false;
            $resp->msg = "A senha não confere";
            //------------------------------------------------------
            $consulta = DB::table('funcionarios')
                            ->join('cargos', 'cargos.id', '=', 'funcionarios.id_cargo')
                            ->where('funcionarios.id', $id)->get();
            $login = DB::table('logons')->where("id_funcionario", $id)->get();
            $consulta[0]->id = $id;
            $calcula_idade = new DataController($consulta[0]->data_nasc);
            $consulta[0]->idade = $calcula_idade->getIdade();

            $historico = DB::table('logons')->where('id_funcionario', $id)->get();

            return view('funcionarios.info_funcionario', compact('resp', 'consulta', 'login', 'historico'));
        }
        //---------------------parei aqui -----------redirecionar para inserir nova senha
        // 
    }

    public function postAltera_senha($id) {
        return view('funcionarios.alteraSenha');
    }
    
    public function getRegioes(){
        $regioes = DB::table('regiaos')->orderBy('regiao')->get();
        return view('notificacao.select_setor', compact('regioes'));
    }
    public function getSetores($id){
        $setores = DB::table('setors')->where('regiao',$id)->orderBy('numero')->get();
        return view('notificacao.select_setor', compact('setores'));
    }
    
    public function getDefineSetor(Request $request){
        if(DB::table('setors')->where('numero',$request['setor'])->get()){
            session(['id_setor' => $request['setor']]);
            return redirect('/notificacao/notificar');
        }else{
            $msg = "Setor inválido, por favor digite um setor válido";
            return view('notificacao.select_setor', compact('msg'));
        }
        
        
    }

}
