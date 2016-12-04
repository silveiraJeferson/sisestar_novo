<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;
use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use sisestar\Logradouro;
use sisestar\Logradouro_setor;

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
                ->where('logradouros.ativo', true)
                ->orderBy('regiaos.regiao')
                ->orderBy('logradouros.nome')
                ->paginate(20);



        return view('logradouros.lista_todos', compact('lista'));
    }

    public function getBuscar(Request $request) {
        $param_busca = $request['param_busca'];

        $lista = DB::table('logradouro_setors')
                ->join('setors', 'logradouro_setors.id_setor', '=', 'setors.id')
                ->join('logradouros', 'logradouro_setors.id_logradouro', '=', 'logradouros.id')
                ->join('regiaos', 'setors.regiao', '=', 'regiaos.id')
                ->where('logradouros.nome', 'ilike', '%' . $param_busca . '%')
                ->orWhere('regiaos.regiao', 'ilike', '%' . $param_busca . '%')
                ->orWhere('setors.referencia', 'ilike', '%' . $param_busca . '%')
                ->orderBy('regiaos.regiao')
                ->orderBy('logradouros.nome')
                ->paginate(1000);




        return view('logradouros.lista_todos', compact('lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate() {
        $novo = true;
        return view('logradouros.createLogradouro', compact('novo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request) {
        $dadosForm = $request->all();
        $dadosForm['ativo'] = false;
        $novoLogradouro = new Logradouro($dadosForm);
        $novoLogradouro->save();
        $logradouros = DB::table('logradouros')->where('nome', $dadosForm['nome'])->limit(1)->get();
        $nome = $request['nome'];
        $lista = DB::table('logradouros')
                ->where('nome', 'ilike', '%' . $nome . '%')
                ->get();
        $regioes = DB::table('regiaos')->orderBy('regiao')->get();
        $addRegiao = true;
        return view('logradouros.createLogradouro', compact('logradouros', 'addRegiao', 'regioes'));
    }

    public function postAddRegiao(Request $request) {
        $setores = DB::table('setors')->where('regiao', $request['regiao'])->get();
        $regiao = DB::table('regiaos')->where('id', $request['regiao'])->get();
        $request['nomeRegiao'] = $regiao[0]->regiao;
        $addSetor = true;
        return view('logradouros.createLogradouro', compact('addSetor', 'request', 'setores'));
    }

    public function postAddSetor(Request $request) {
        $dadosForm = $request->all();
        $dados = new Logradouro_setor($dadosForm);
        $dados->save();
        return redirect('setores/show/' . $request['id_setor']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow($id) {
        
    }

    public function getTodosOsLogradouros() {
        $lista = DB::table('logradouros')->orderBy('nome')->paginate(10);
        $flag = true;
        return view('logradouros.lista_todos', compact('lista', 'flag'));
    }

    public function getInativos() {
        $lista = DB::table('logradouros')->orderBy('nome')->where('ativo', false)->paginate(10);
        $flag = true;
        return view('logradouros.lista_todos', compact('lista', 'flag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id) {
        $logradouros = DB::table('logradouros')->where('id', $id)->limit(1)->get();
        $editar = true;

        return view('logradouros.createLogradouro', compact('logradouros', 'editar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, $id) {

        DB::table('logradouros')->where('id', $id)->update(['tipo' => $request['tipo'], 'nome' => $request['nome']]);
        $flag = true;
        $nome = $request['nome'];
        $lista = DB::table('logradouros')
                        ->where('nome', 'ilike', '%' . $nome . '%')
                        ->orderBy('nome')->paginate(20);


        return view('logradouros.lista_todos', compact('lista', 'flag'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    
    
    public function getAtivar($id){
        $consulta = DB::table('logradouro_setors')->where('id_logradouro',$id)->get();
        
        DB::table('logradouros')->where('id',$id)->update(['ativo' => true]);
        
        $id_setor = $consulta[0]->id_setor;
        return redirect('/setores/show/'.$id_setor);
        
       
    }
    public function getDestroy($id){
        DB::table('logradouros')->where('nome', $id)->update(['ativo'=>false]);
        $consulta = DB::table('logradouro_setors')->where('id_logradouro',$id)->get();
        $id_setor =  $consulta[0]->id_setor;
        return redirect('/setores/show/'.$id_setor);
        
       
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function postAddLogradouroNoSetor(Request $request) {
        $nomeRegiao = DB::table('regiaos')->where('id', $request['regiao'])->get();
        $request['nome_regiao'] = $nomeRegiao[0]->regiao;
        $logradouros = DB::table('logradouro_setors')
                ->join('logradouros', 'logradouro_setors.id_logradouro', '=', 'logradouros.id')
                ->where('id_setor', $request['setor'])
                ->get();

        return view('logradouros.addLogradouroNoSetor', compact('request', 'logradouros'));
    }

    public function postIncluirLogradouroNoSetor(Request $request) {
        $dadosLogradouro = $request->all();
        $dadosLogradouro['ativo'] = true;
        $id_logradouro = Logradouro::create($dadosLogradouro)->id;

        $log_setor['id_setor'] = $request['id_setor'];
        $log_setor['id_logradouro'] = $id_logradouro;

        $logradouro_setors = new Logradouro_setor($log_setor);
        $logradouro_setors->save();

        return redirect('/setores/show/' . $request['id_setor']);
    }

}
