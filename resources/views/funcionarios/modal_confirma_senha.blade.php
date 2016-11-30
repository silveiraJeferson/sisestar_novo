
<div class="modal fade confirma_senha" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmação da senha</h4>
            </div>
            <form method="post" action="{{url('/autenticar/confirm/'.$funcionario->id)}}">
                <div class="form-group-sm">
                    <input  class="center-block" placeholder="Digite a senha atual..." type="password" name="senha"/>
                </div>
                <div class="modal-footer form-group">
                    <div class="center-block">

                        <input type="submit" class="btn btn-success" value="OK"/>
                        <button  class="btn btn-danger">Cancelar</button>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>


        </div>
    </div>
</div>