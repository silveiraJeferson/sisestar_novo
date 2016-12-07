<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;
use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use sisestar\Notificacao;
use sisestar\Events\NotificacaoFoiCadastrada;

class NotificacaoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        $consulta = DB::table('notificacaos')->orderBy('data', 'desc')->orderBy('hora', 'desc')->where('status', 1)->paginate(15);
        return view('notificacao.index', compact('consulta'));
    }

    public function getTodas() {
        $consulta = DB::table('notificacaos')->orderBy('data', 'desc')->orderBy('hora', 'desc')->where('status', 1)->paginate(15);
        return view('notificacao.todas', compact('consulta'));
    }

    public function getData() {
        $lista = Notificacao::where('data', date("d/m/Y"))
                        ->join('status_notificacaos', 'notificacaos.status', '=', 'status_notificacaos.id')
                        ->orderBy('hora', 'desc')->paginate(25);
        return view('notificacao.lista_por_data', compact('lista'));
    }

    //-------------------------------listar todas as notificações------------------
    //---------------------------------ver detalhes da notificação------------------------------
    public function getVer($id) {
        $consulta = DB::table('notificacaos')->where('id', $id)->get();
        foreach ($consulta as $item) {
            $id_status = $item->status;
        }
        $sql = DB::table('status_notificacaos')->where('id', $id_status)->get();
        foreach ($sql as $item) {
            $status = $item->status;
        }

        return view('notificacao.ver_notificacao', compact('consulta', 'status'));
    }

    //-----------------------------------chamado da view para notificar um veiculo---------------------------------------
    public function getNotificar() {
        
        $irregularidades = DB::table('irregularidades')->get();
        $agencias = DB::table('agencias')->orderBy('nome')->get();
        $logradouros = DB::table('logradouro_setors')
                ->join('logradouros', 'logradouro_setors.id_logradouro', '=', 'logradouros.id')
                ->where('logradouro_setors.id_setor',session('id_setor'))
                ->get();
        $notificacao_num = DB::table('notificacaos')->max('id');
        
        
        $obj = new \stdClass();
        
        $obj->irregularidades = $irregularidades;
        $obj->agencias = $agencias;
        $obj->logradouros = $logradouros;
               
        return view('notificacao.notificar', compact('obj'));
    }

//-----------------------------------chamado da view para regularização de um veiculo---------------------------------------

    public function getRegularizar($id) {
        $notificacao = DB::table('notificacaos')->where('id', $id)->get();
        foreach ($notificacao as $item) {
            $id_status = $item->status;
        }
        $status = DB::table('status_notificacaos')->where('id', $id_status);
        return view('notificacao.regularizacao', compact('notificacao', 'status'));
    }

//-----------------------------------chamado da view para deletar uma notificação---------------------------------------

    public function getDelete($id) {
        DB::table('notificacaos')->delete($id);
    }

    //------------------------------------------metodos posts -------------------------
    //------------------------------------------------notificando um veiculo--------------------------
    public function postNotificar(Request $request) {
        session(['logradouro'=> $request['local']]);
        $dadosDoFormulario = $request->all();
        $num_notifi = DB::table('notificacaos')->max('id');
        $dadosDoFormulario['num_notificacao'] = $num_notifi;
        
        $notificacao = new Notificacao($dadosDoFormulario);
        $notificacao->save();
        //nesse ponto gerar arquivo txt para impressão
        $id = DB::table('notificacaos')->max('id');
        $consulta = DB::table('notificacaos')->where('id', $id)->get();
        $sql = DB::table('status_notificacaos')->where('id', $request->status)->get();
        $status = $sql[0]->status;
        //$res = \Event::fire(new NotificacaoFoiCadastrada());        
        return view('notificacao.ver_notificacao', compact('consulta', 'status'));
    }

    //----------------------------------lista dos status das notificacoes
    public function getLista_status() {

        $lista = DB::table('status_notificacaos')->get();
        return view('notificacao.status_notificacao_listagem', compact('lista'));
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

}
