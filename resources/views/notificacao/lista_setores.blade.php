<div class="listaRegioesLogin">
    @foreach($setores as $setor)
    <form action="{{url('/autenticar/define-setor')}}">
        <input type="hidden" name="setor" value="{{$setor->numero}}" />
        <input type="submit" class="btn btn-success form-control text-left" value="Setor: {{$setor->numero}}  (Ref: {{$setor->referencia}})" />
    </form>
    @endforeach
</div>