<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;
use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use sisestar\MsgResposta;
use sisestar\Logradouro;
use sisestar\Setor;
use sisestar\Logradouro_setor;

class SetorController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        $setores = DB::table('setors')
                ->where('ativo',true)
                ->paginate(20);
        return view('setores.index', compact('setores'));
    }

    public function getTodosOsSetores() {
        
        $setores = DB::table('setors')
                ->join('regiaos', 'regiaos.id', '=', 'setors.regiao')
                ->orderBy('regiaos.regiao')
                ->where('setors.ativo',true)
                ->paginate(20);
        
        return view('setores.lista_setores', compact('setores'));
        
    }

    public function postBuscar(Request $request) {
        if (!is_numeric($request->param_busca)) {
            $setores = DB::table('setors')
                    ->join('regiaos', 'regiaos.id', '=', 'setors.regiao')
                    ->where('regiaos.regiao', 'ilike', '%' . $request->param_busca . '%')
                    ->orWhere('setors.referencia', 'ilike', '%' . $request->param_busca . '%')
                    ->paginate(1000);
        } else {
            $setores = DB::table('setors')
                    ->join('regiaos', 'regiaos.id', '=', 'setors.regiao')
                    ->where('setors.id',  $request->param_busca)
                    ->paginate(1000);
        }
        if($request->param_busca === ""){
            return redirect('/setores/todos-os-setores');
        }




        return view('setores.lista_setores', compact('setores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate() {
        $regioes = DB::table('regiaos')->get();
        $numero = DB::table('setors')->max('numero');
        if ($numero == 0) {
            $numero = 1;
        } else {
            $numero++;
        }
        return view('setores.createSetor', compact('regioes', 'numero'));
    }

    // --------criacao de um setor quando já estiver dentro da região -------------------
    public function getCreateSetorRegiao($id) {
        $regiao = DB::table('setors')->where('id', $id);
        $numero = DB::table('setors')->max('numero');
        if ($numero == 0) {
            $numero = 1;
        } else {
            $numero++;
        }
        $id_regiao = $id;
        return view('setores.createSetor', compact('numero', 'id_regiao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request) {
        
        //-----------cadastro o logradouro  com a referencia informada
        $logradouro['tipo'] = $request['tipo'];
        $logradouro['nome'] = $request['referencia'];
        $logradouro['ativo'] = true;       
        $id_logradouro = Logradouro::create($logradouro)->id;
        
        //-----------------cadastro o novo setor----------------------
        $dadosForm = $request->all();       
        $id_setor  = Setor::create($dadosForm)->id;
        
        // --------------relaciono o logradouro informado com o novo setor
        $log_setor['id_setor'] = $id_setor;
        $log_setor['id_logradouro'] = $id_logradouro;
        $nova_relacao = new Logradouro_setor($log_setor);
        $nova_relacao->save();
        
        
        
        
        
        
        return redirect('/setores/show/' . $id_setor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow($id) {
        $setor = new \stdClass();
        $lista = DB::table('logradouros')
                        ->join('logradouro_setors', 'logradouro_setors.id_logradouro', '=', 'logradouros.id')
                        ->join('setors', 'setors.id', '=', 'logradouro_setors.id_setor')
                        ->where('setors.id', $id)
                        
                        ->orderBy('logradouros.nome')
                        ->get();
        $id_regiao = $lista[0]->regiao;
        $num_setor = $lista[0]->numero;
        $referencia = $lista[0]->referencia;
        $regiao = DB::table('regiaos')->where('id', $id_regiao)->get();
        $regiao = $regiao[0]->regiao;
        //-----------------------------insiro dados de setor e regiao no objeto------------------------
        $setor->id_regiao = $id_regiao;
        $setor->regiao = $regiao;
        $setor->numero = $num_setor;
       
        $setor->referencia = $referencia;

        //-----------------------------------------------------
        

        return view('setores.logradouros_do_setor', compact('setor','lista'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id) {
        $setor = new \stdClass();
        $lista = DB::table('logradouros')
                        ->join('logradouro_setors', 'logradouro_setors.id_logradouro', '=', 'logradouros.id')
                        ->join('setors', 'setors.id', '=', 'logradouro_setors.id_setor')
                        ->where('setors.id', $id)->get();
        
        $setor->setor = DB::table('setors')->where('id', $id)->get();
        $setor->regiaoId = $setor->setor[0]->regiao;

        $setor->nomeRegiao = DB::table('regiaos')->where('id', $setor->regiaoId)->get();




        $setor->numero = $setor->setor[0]->numero;
        $setor->referencia = $setor->setor[0]->referencia;
        $setor->logradouros = $lista;
        return view('setores.editSetor', compact('setor'));
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
