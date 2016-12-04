@extends('layout.layoutGestao')
@section('content')
<br/>
@include('setores.navbar_setores')
<div class="div_index">
   

    
    
    

    <h1 class="text-info">Setores Cadastrados: <span class="text-danger">{!! $setores->total() !!}</span></h1>
    <div class="overflow">
        <table class="table">
            <tr>
                <th>Setor Nº</th>
                <th>Região</th>
                <th>Logradouro de Referência</th>
                <th></th>
            </tr>
            @forelse($setores as $setor)
            <tr>
                <td >{{$setor->numero}}</td>
                <td >{{$setor->regiao}}</td>
                <td >{{$setor->referencia}}</td>
                <td><a class="glyphicon glyphicon-eye-open" href="{{url('/setores/show/'.$setor->numero)}}"</td>
            </tr>

            @empty
            <h1 class="text-danger">Nenhum Setor Cadastrado</h1>
            @endforelse
        </table>
    </div>


</div>
<div class="text-center paginate">
    {!! $setores->render() !!}
</div>

@endsection