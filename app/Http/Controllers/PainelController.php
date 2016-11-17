<?php

namespace sisestar\Http\Controllers;

use Illuminate\Http\Request;
use sisestar\Http\Requests;
use sisestar\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PainelController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        $logados = DB::table('funcionarios_logados')->get();
        
        return view('layout.master',  compact('logados'));
    }

    public function getLogin() {
        return view('public.login');
    }

    public function getLoginmovel() {
        return view('public.loginmovel');
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
    
    
    
    public function getConstrucao(){
        return view('public.construcao');
    }

}
