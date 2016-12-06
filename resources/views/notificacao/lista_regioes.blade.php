<div class="listaRegioesLogin">
    @foreach($regioes as $regiao)
    <a href="{{url('/autenticar/setores/'.$regiao->id)}}" class="btn btn-primary center-block ">{{$regiao->regiao}}</a><br/>
    @endforeach
</div>