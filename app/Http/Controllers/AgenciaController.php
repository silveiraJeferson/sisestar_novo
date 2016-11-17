<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;
use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use sisestar\Agencia;

class AgenciaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        $lista = DB::table('agencias')->paginate(10);
        return view('agencias.index', compact('lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate() {
        return view('agencias.createAgencia');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request) {
        $dadosForm = $request->all();
        $novaAgencia = new Agencia($dadosForm);
        $novaAgencia->save();
        return redirect('/valores');
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
        $agencia = DB::table('agencias')->where('id', $id)->get();
        return view('agencias.createAgencia', compact('agencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, $id) {
        DB::table('agencias')->where('id', $id)->update(['nome' => $request['nome'],'valor' => $request['valor']]);
         return redirect('/valores');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDestroy($id) {
         DB::table('agencias')->where('id',$id)->delete();
         //salvar json em uma tabela de agencias excluidas
        return redirect('/valores');
    }

}
