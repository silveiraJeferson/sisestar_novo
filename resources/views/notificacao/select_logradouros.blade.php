<div class="col-md-8">
    <select class="form-control col-md-8" name="local" id="local" >
        <option value="{{session('logradouro')}}">{{session('logradouro')}}</option>
        @foreach($obj->logradouros as $logradouro)
        <option value="{{$logradouro->nome}}">{{$logradouro->nome}}</option>
        @endforeach
    </select>
</div>