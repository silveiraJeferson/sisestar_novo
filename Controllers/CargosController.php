<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;

use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use sisestar\Cargo;
use Validator;

class CargosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $lista = DB::table('cargos')->orderBy('cargo')->paginate(10);
        return view('cargos.index', compact('lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {        
        return view('cargos.createCargos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $dadosForm = $request->all();
        //validar---------------------------------
        $rules = [
            'cargo' => 'required',
        ];
        $validation = Validation::make($dadosForm, $rules);
        if($validation->fails()){
            return redirect('/cargos/create')->withErrors($validation)->withInput();
        }
        $novoCargo = new Cargo($dadosForm);
        $novoCargo->save();
        return redirect('/cargos');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $cargo = DB::table('cargos')->where('id',$id)->get();
        return view('cargos.createCargos', compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, $id)
    {
         DB::table('cargos')->where('id',$id)->update(['cargo'=>$request['cargo']]);
          return redirect('/cargos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDestroy($id)
    {
        DB::table('cargos')->where('id',$id)->delete();
        return redirect('/cargos');
    }
}
