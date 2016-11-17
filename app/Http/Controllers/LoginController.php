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

        $obj = DB::table('logins')->where('login', $request->login)->get();
        $senhaTeste = $obj[0]->func . $request->senha;
        $senhaInformada = sha1($senhaTeste);
        if ($senhaInformada === $obj[0]->senha) {
            //$resp = 'certo';
            $funcionario = DB::table('funcionarios')->where('id', $obj[0]->func)->get();
            $resp = $funcionario;
            //----obs: id agente=1, adm=2, master=3;
            DB::table('logons')->where('id_funcionario', $funcionario[0]->id)
                    ->update(['logado' => true]);
            switch ($funcionario[0]->id_cargo) {
                case 1:
                    return redirect('/notificacao/notificar');
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


        return view('public.teste', compact('resp'));
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
    public function postStore(Request $request) {

        //validar senhas iguais
        $dadosLogin = $request->all();

        $senha = sha1($dadosLogin['id_func'] . $dadosLogin['senha']);
        $dadosLogin['senha'] = $senha;
        $dadosLogin['func'] = $dadosLogin['id_func'];
        $login = new Login($dadosLogin);
        $login->save();

        //-----------------------------adiciono usuario à tabela logon para saber seu status online
        $logon = new Logon();
        $logon->id_funcionario = $dadosLogin['id_func'];
        $logon->logado = false;
        $logon->save();
        $id = $dadosLogin['id_func'];
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

    public function getLogin($id) {
        $func = DB::table('funcionarios')->where('id', $id)->get();
        return view('gestao.cadastro_login', compact('func'));
    }
    
    public function getLogoff(){
        return view('public.construcao');
    }

}
