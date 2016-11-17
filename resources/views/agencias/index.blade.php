@extends('layout.layoutGestao')
@section('content')
<br/>
<a href="{{url('/valores')}}" class="btn btn-primary glyphicon glyphicon-arrow-left"></a>
<a href="{{url('/agencia/create')}}" class="btn btn-success">Adicionar Agência</a>
<hr/>
<h1>Agencias cadastradas: {{$lista->total()}}</h1>
<hr/>
<table class="table table-responsive">
    <tr>
        <th>Órgão</th>
        <th></th>
    </tr>
    
    
    
    
    
</table>













@forelse($lista as $agencia)

<li>{{$agencia->nome}}<a href="#" class="glyphicon glyphicon-pencil"></a></li><hr/>
@empty
<h3 class="text-danger">Nenhuma agência cadastrada</h3>
@endforelse

@endsection