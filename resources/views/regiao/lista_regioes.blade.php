@extends('layout.layoutGestao')
@section('content')
<br/>
<?php
//if (@$ativo) {
//    $background = 'btn btn-primary';
//} else {
//    $background = 'btn btn-danger';
//}
//?>
@include('regiao.navbar_regioes')
<div class="div_index">





    <h1 class="h1 text-info">Selecione a Região</h1>

    <div class="overflow">
        @forelse($regioes as $regiao)
<?php
if ($regiao->ativo) {
    $background = 'btn btn-primary';
} else {
    $background = 'btn btn-danger';
}
?>


        <br/>

        <a href='{{url('/regiao/show/'.$regiao->id)}}' class="{{$background}} btn-regioes col-10">{{$regiao->regiao}}</a>

        <br/>
        @empty
        <span class="h4 text-danger ">Nenhuma região cadastrada</span>
        @endforelse
    </div>


    <div class="text-center paginate"> {!! $regioes->render() !!} </div>
</div>
@endsection