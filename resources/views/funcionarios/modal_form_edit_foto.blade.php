<div class="modal fade modalMeu text-center" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center center-block">
            <h1>Alteração de Foto</h1>
            {!! Form::open(['url' => '/funcionarios/foto','method'=>'POST', 'files'=>true]) !!}

            <input type="hidden" name="id" value="{{$funcionario->id}}"/>
            {!! Form::file('arquivo') !!}

            {!! Form::hidden('foto')!!}
            <div class="thumbnail">
                <img class="thumb thumbnail"src="{{url('/imagem/arquivo/'.$funcionario->foto)}}"/>
                <span class="h1 text-info">{{$funcionario->foto}}</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" value="Salvar" class="btn btn-primary"/>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>