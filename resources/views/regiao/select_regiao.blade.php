<select name="regiao" id="regiao" class="form-control">
    <option value="">Selecione...</option>
    @foreach($regioes as $regiao)
        <option value="{{$regiao->id}}">{{$regiao->regiao}}</option>
    @endforeach
</select>