@extends('layout.layoutGestao')
@section('content')



<br/>
@forelse($setores as $setor)
<a href="{{url('/setores/show/'.$setor->id)}}" class="btn-setor  btn btn-success">Setor: {{$setor->numero}}<br/> Ref: {{$setor->referencia}}</a>
@empty
<span class="h4 text-danger">Nenhum setor cadastrado</span>
@endforelse


@endsection
