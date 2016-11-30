<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;
use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use sisestar\Logradouro;
class LogradouroController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        $lista = DB::table('logradouro_setors')
                ->join('setors', 'logradouro_setors.id_setor', '=', 'setors.id')
                ->join('logradouros', 'logradouro_setors.id_logradouro', '=', 'logradouros.id')
                ->join('regiaos', 'setors.regiao', '=', 'regiaos.id')
                ->orderBy('logradouros.nome')
                ->paginate(20);



        return view('logradouros.lista_todos', compact('lista'));
    }

    public function postBuscar(Request $request) {
        $param_busca = $request['param_busca'];
        
        $lista = DB::table('logradouro_setors')
                ->join('setors', 'logradouro_setors.id_setor', '=', 'setors.id')
                ->join('logradouros', 'logradouro_setors.id_logradouro', '=', 'logradouros.id')
                ->join('regiaos', 'setors.regiao', '=', 'regiaos.id')
                ->where('logradouros.nome', 'ilike', '%'. $param_busca .'%')
                ->orWhere('regiaos.regiao', 'ilike', '%'. $param_busca .'%')
                ->orWhere('setors.referencia', 'ilike', '%'. $param_busca .'%')
                ->orderBy('logradouros.nome')
                ->paginate(20);
        
        if($request->param_busca === ""){
            return redirect('/logradouros');
        }

        
        return view('logradouros.lista_todos', compact('lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate() {
        return view('logradouros.createLogradouro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request) {
        $dadosForm = $request->all();
        $novoLogradouro = new Logradouro($dadosForm);
        $novoLogradouro->save();
        $logradouro = DB::table('logradouros')->where('nome',$dadosForm['nome'])->limit(1)->get();
        $id = $logradouro[0]->id;
        
        return redirect('logradouros/edit/'.$id);
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

    public function getTodosOsLogradouros() {
        $lista = DB::table('logradouros')->paginate(10);
        return view('logradouros.lista_todos', compact('lista'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id) {
        $logradouros = DB::table('logradouros')->where('id',$id)->limit(1)->get();
        return view('logradouros.createLogradouro', compact('logradouros'));
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
