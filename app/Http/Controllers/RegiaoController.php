<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;
use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use sisestar\Regiao;

class RegiaoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        return redirect('/regiao/todas-as-regioes');
    }
    
    
    public function getTodasAsRegioes(){
        $regioes = DB::table('regiaos')->where('ativo', true)->paginate(7);
        $ativo = true;
        return view('regiao.lista_regioes', compact('regioes','ativo'));
    }
    public function getInativas(){
        $regioes = DB::table('regiaos')->where('ativo', false)->paginate(7);
        $ativo = false;
        return view('regiao.lista_regioes', compact('regioes','ativo'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate() {
        return view('regiao.createRegiao');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request) {
        $dadosForm = $request->all();        
        $id = Regiao::create($dadosForm)->id;       
        return redirect('/regiao/show/'.$id);
        
        
    }
    
    public function postBuscar(Request $request){
        $param_busca = $request['param_busca'];
        
        $regioes = DB::table('regiaos')->where('regiao', 'ilike', "%$param_busca%")->paginate(7);
       
        return view('regiao.lista_regioes', compact('regioes'));
        
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow($id) {
        $regiao = DB::table('regiaos')->where('id',$id)->get();
        
        $setores = DB::table('setors')->where('regiao',$id)->paginate(10);
        $setores->regiao = $regiao[0]->regiao;
        $setores->id_regiao = $regiao[0]->id;
        $ativo = $regiao[0]->ativo; 
        $edit = true;
        return view('regiao.regiao_setores',  compact('setores','ativo','edit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id) {
       $regiao = DB::table('regiaos')->where('id',$id)->get();
       $regiao = $regiao[0];
       return view('regiao.createRegiao', compact('regiao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, $id) {
        
        DB::table('regiaos')->where('id',$id)->update(['regiao'=>$request['regiao']]);
        return redirect('/regiao');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDestroy($id) {
        DB::table('regiaos')->where('id',$id)->update(['ativo'=>false]);
        return redirect('/regiao');
    }
    public function getAtivar($id) {
        DB::table('regiaos')->where('id',$id)->update(['ativo'=>true]);
        return redirect('/regiao');
    }

}
