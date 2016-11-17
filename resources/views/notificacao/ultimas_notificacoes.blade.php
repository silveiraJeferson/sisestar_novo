<div id="ultimasNotificacoes" class="thumbnail hidden-xs overflow">
    <div class="bg-primary fixed-top">
        <p class="h4 text-center text-bold">Notificações de Hoje<br/>{{date("d/m/Y")}}</p>
    </div>
    <table  class="table table-hover    ">
        <tr>
            <th class="col-xs-6 col-sm-4">Placa</th>
            <th class="col-xs-6 col-sm-4 hidden-xs">Modelo</th>
            <th class="col-md-1"></th>
            <th class="col-md-1"></th>
        </tr>
        @forelse($lista as $notificacao)

        <tr>
            <td class="text-uppercase h6">{{$notificacao->placa}}</td>
            <td class="visible-lg h6">{{$notificacao->modelo}}</td>
            <td><a href="/notificacao/ver/{{$notificacao->id}}" href="#"class="glyphicon glyphicon-list-alt"></a></td>
            @if($notificacao->status == 'pendente')
            <td class="bg-danger text-danger"><span class="h4 ">P</span></td>
            @else
            <td class="bg-success text-success"><span class="h4">R</span></td>
            @endif
        </tr>
        @empty
        <span class="text-danger">Nenhuma notificação</span>
        @endforelse

    </table>
    <div class="text-center">
        {!! $lista->render() !!}
    </div>
</div>
<!--Apenas visivel em telas pequenas------------------------------------------------->
<div id="ultimasNotificacoesMovel" class="thumbnail visible-xs center-block">
    <div class="bg-primary">
        <p class="h4 text-center text-bold">Notificações de Hoje<br/>{{date("d/m/Y")}}</p>
    </div>
    <table class="table table-hover">
        <tr>
            <th class="col-xs-6 col-sm-4">Placa</th>
            <th class="col-xs-6 col-sm-4 visible-lg">Modelo</th>
            <th class="col-xs-6 col-sm-4"></th>
        </tr>
        @forelse($lista as $notificacao)
        <tr>
            <td class="text-uppercase h6">{{$notificacao->placa}}</td>
            <td class=" h6">{{$notificacao->modelo}}</td>
            <td><a href="/notificacao/ver/{{$notificacao->id}}"class="glyphicon glyphicon-list-alt"></a></td>
        </tr>
        @empty
        <span class="text-danger">Nenhuma notificação</span>
        @endforelse
    </table>
    <div class="text-center">
        {!! $lista->render() !!}
    </div>
</div>