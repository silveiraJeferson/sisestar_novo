<?php

use Illuminate\Support\Facades\DB;

$logados = DB::table('funcionarios_logados')->orderBy('logado', true)->orderBy('nome')->get();
?>
<br/><br/>  
<div class="thumbnail funcionariosLogados hidden-xs h6">
    @foreach($logados as $func)
    <table class="table-condensed bg-default">                <tr >

            <td style="width: 90%">
                <img id="imgFuncLogado" src="{{url('/imagem/arquivo/'.$func->foto)}}"/> {{substr($func->nome, 0, 8)}}...

            </td>
            <td style="margin-right: 0">
                @if($func->logado)
                <div style="color: #64e554; margin-right: 0; font-size: 25px;">•</div>
                @else
                <div style="color: #f4ced2; margin-right: 0; font-size: 25px;">•</div>
                @endif
            </td>
        </tr>               
    </table>
    @endforeach

</div>