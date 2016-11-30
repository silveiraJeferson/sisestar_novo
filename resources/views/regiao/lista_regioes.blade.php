@extends('layout.layoutGestao')
@section('content')
<br/>
@include('regiao.navbar_regioes')
<div class="div_index">





    <h1 class="h1 text-info">Selecione a Região</h1>

    <div class="overflow">
        @forelse($regioes as $regiao)

        <br/>

        <a href='{{url('/regiao/show/'.$regiao->id)}}' class="btn btn-primary btn-regioes">{{$regiao->regiao}}</a>
        <br/>
        @empty
        <span class="h4 text-danger ">Nenhuma região cadastrada</span>
        @endforelse
    </div>


    <div class="text-center paginate"> {!! $regioes->render() !!} </div>
</div>
@endsection