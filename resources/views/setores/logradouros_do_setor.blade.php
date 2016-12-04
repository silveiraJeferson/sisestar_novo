@extends('layout.layoutGestao')
@section('content')
<br/>
@include('setores.navbar_setores')
<div class="div_index">






    <h1>Setor Nº: {{$setor->numero}}, <span class="right-bar">Ref: {{$setor->referencia}}</span></h1>
    <h3 class="text-info">Região: {{($setor->regiao)}}</h3>


    <table class="table table-striped">
        @forelse($lista as $logradouro)
        <tr>
           
            <td>{{$logradouro->tipo}}</td>
            <td>{{$logradouro->nome}}</td>
            
           
        </tr>
        @empty
        <span class="h3 text-danger">Nenhum logradouro cadastrado</span>
        @endforelse
    </table>

</div>
<form action="{{url('/logradouros/add-logradouro-no-setor')}}" method="post">
    <input type="hidden" name="setor" value="{{$setor->numero}}"/>        
    <input type="hidden" name="regiao" value="{{$setor->id_regiao}}"/>      
    <input type="submit" class="btn btn-info right-bar" value="Adicionar logradouro"/>
    <input  type="hidden" name="_token" value="{{ csrf_token() }}">
</form>

@endsection
