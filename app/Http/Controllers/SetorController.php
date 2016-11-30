<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;
use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use sisestar\MsgResposta;
use sisestar\Logradouro;
use sisestar\Setor;

class SetorController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        $setores = DB::table('setors')->paginate(20);
        return view('setores.index', compact('setores'));
    }

    public function getTodosOsSetores() {
        $setores = DB::table('setors')
                ->join('regiaos', 'regiaos.id', '=', 'setors.regiao')
                ->paginate(20);


        return view('setores.lista_setores', compact('setores'));
    }

    public function postBuscar(Request $request) {
        if (!is_numeric($request->param_busca)) {
            $setores = DB::table('setors')
                    ->join('regiaos', 'regiaos.id', '=', 'setors.regiao')
                    ->where('regiaos.regiao', 'ilike', '%' . $request->param_busca . '%')
                    ->paginate(20);
        } else {
            $setores = DB::table('setors')
                    ->join('regiaos', 'regiaos.id', '=', 'setors.regiao')
                    ->where('setors.id',  $request->param_busca)
                    ->paginate(20);
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
        $dadosForm = $request->all();
        $id = $dadosForm['numero'];
        $novoSetor = new Setor($dadosForm);
        $novoSetor->save();
        return redirect('/setores/edit/' . $id);
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
                        ->where('setors.id', $id)->get();
        $id_regiao = $lista[0]->regiao;
        $num_setor = $lista[0]->numero;
        $referencia = $lista[0]->referencia;
        $regiao = DB::table('regiaos')->where('id', $id_regiao)->get();
        $regiao = $regiao[0]->regiao;
        //-----------------------------insiro dados de setor e regiao no objeto------------------------
        $setor->regiao = $regiao;
        $setor->numero = $num_setor;
        $setor->logradouros = $lista;
        $setor->referencia = $referencia;

        //-----------------------------------------------------


        return view('setores.logradouros_do_setor', compact('setor'));
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
