@foreach($setores as $setor)
<div class="select_setor">
    <input type="radio" name="id_setor" value="{{$setor->numero}}"/><br/>
    <span class="center-block text-center">
        Setor: {{$setor->numero}}<br/>
        Ref: {{$setor->referencia}}
    </span>
</div>

@endforeach