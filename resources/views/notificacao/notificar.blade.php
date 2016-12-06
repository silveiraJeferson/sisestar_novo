@extends('layout.movel')
@section('content')

<div class="div_index">
    <form method="post" action="/notificacao/notificar">
        <span class="h4 center-block text-center">Notificação de Irregularidade</span>
        <i>Data: {{date("d/m/Y")}}</i>
        <hr/>
        <i class="center-block text-center text-primary">Dados do Veículo</i>
        <table class=" notificar">
            <tr >
                <th class="col-xs-6 col-md-4 text-center">Placa</th>
                <th class="col-xs-6 col-md-4 text-center">País</th>

            </tr>
            <tr>
                <td class=""><input class="inputNotificar form-control" type="text" name="placa" placeholder="..."/></td>
                <td class="text-center"><input class="inputNotificar form-control" type="text" name="pais" placeholder="..."/></td>

            </tr>

        </table>
        <!----------------------------------------inline marca/ modelo--------------------------------------------------->
        <br/>
        <p>
            Marca: <input class="inputNotificarInteiro form-control" type="text" name="marca" placeholder="Marca..."/>
        </p>
        <p>

            Modelo <input class="inputNotificarInteiro form-control" type="text" name="modelo" placeholder="Modelo..."/>
        </p>
        <div class="text-center"></div>


        <!--------------------------------------------------------------------------------------------------->
        <hr/>
        <!----------------------------------------inline numero--------------------------------------------------->
        <i class="center-block text-center text-primary">Endereço</i>
        <i>Logradouro</i>

        @include('notificacao.select_logradouros')
        <i>Número</i>
        <div class="col-md-4"><input class=" form-control col-md-4" type="number" name="numero" placeholder="..."/></div>
        <hr/>


        Número do Cartão, se houver
        <input class="inputNotificarInteiro form-control" type="number" value="0" name="num_cartao" placeholder="..."/>
        <hr/>









        <!------------------------------------------inline numero--------------------------------------------------------->


        <!-------------------------------------------usar dados do banco de dados---------------->
        <i class="center-block text-center text-primary">Irregularidade</i><br/>

        @foreach($obj->irregularidades as $irregularidade)
        <input type="radio" name="irregularidade" value="{{$irregularidade->codigo}}"/>{{$irregularidade->nome}}<br/><br/>
        @endforeach
        <textarea  class="col-xs-12 col-md-3" name="observacao"></textarea>

        <!------------------------------------------------------------------------------------------>
        <table class=" notificar">
            <tr class="notificar-tr-th">
                <th class="col-xs-4 col-md-4 text-center">Regularizar até</th>

                @foreach($obj->agencias as $agencia)
                <th class="col-xs-4 col-md-4 text-center">Valor {{$agencia->nome}}</th>        
                @endforeach

            </tr>
            <?php $timestamp = strtotime("+15 days"); ?>
            <tr>
                <td class="text-center"><span class="">{{date('d/m/Y', $timestamp)}}</span></td>
                @foreach($obj->agencias as $agencia)
                <td class="text-center"><span class="">R$ {{$agencia->valor}},00</span></td>

                @endforeach

            </tr>
        </table>
        <!------------------------------------------------------------------------------------------>
        <table class=" notificar">
            <tr class="notificar-tr-th">
                <th class="col-xs-4 col-md-4 text-center">Rubrica do Agente</th>
                <th class="col-xs-4 col-md-4 text-center">Matricula</th>
                <th class="col-xs-4 col-md-4 text-center">Setor</th>
            </tr>
            <br/>
            <tr>
                <td class="text-center"><span >_____________</span></td>
                <td class="text-center"><span class="text-center">{{session('matricula')}}</span></td>
                <td class="text-center"><span class="">{{session('id_setor')}}</span></td>
            </tr>
        </table>
        <br/>

        <input type="hidden" name="data" value="{{date("d/m/Y")}}"/>
        <input type="hidden" name="hora" value="{{date("H:i:s")}}"/>
        <input type="hidden" name="data_lim_regularizacao" value="{{date('d/m/Y', $timestamp)}}"/>
        <input type="hidden" name="valor_amtt" value="20"/>
        <input type="hidden" name="valor_detran" value="159"/>
        <input type="hidden" name="num_agente" value="{{session('matricula')}}"/>
        <input type="hidden" name="setor" value="{{session('id_setor')}}"/>
        <input type="hidden" name="status" value="1"/>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">


        <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm">Notificar</button>

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <span class="h3 text-center center-block">Emitir notificação?</span>
                    <div class="">
                        <input style="margin-left: 20%;" type="submit" value="Sim" class="btn btn-primary"/>        
                        <button style="float: right; margin-right: 20%;" type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                    </div>

                </div>
            </div>
        </div>

    </form>


</div>

<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


@endsection

