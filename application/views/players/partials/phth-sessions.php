<?php


?>

<div class="row">
    <div class="col-md-12 form-container" id="sessions-form-container" style="display: none;">
        <form id="sessions-form"
              action="<?php echo base_url('/api/sessions/'); ?>"
              method="post">

            <input type="hidden" name="player" value="<?php echo $id; ?>" />

            <div class="row" >
                <div class="col-md-3 form-group">
                    <label for="session-happened-at">Fecha de la sesión</label>
                    <div class="input-group date">
                        <input type="text" class="form-control"
                               placeholder="dd/mm/yyyy"
                               id="session-happened-at" name="happened_at"
                               value="" />
                        <span class="input-group-addon">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12 form-group" >
                    <label for="session-comments" >Comentarios</label>
                    <textarea class="form-control" name="comments"
                              id="session-comments"></textarea>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12" >
                    <button type="submit" class="btn btn-primary send" >Enviar</button>
                    <button type="button" class="btn btn-warning cancel" >Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="sessions-table-container" >
        <div class="row" >
            <div class="col-md-12" >
                <div class="form-group clearfix global-actions" >

                    <button type="button" class="btn btn-primary pull-right" id="new-session-button" >
                        Nueva sesión
                        <i class="fa fa-plus" aria-hidden="true" ></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col-md-12" >
                <table id="player-session-history" class="table" width="100%">
                    <tr>
                        <td class="text-center" >Cargando historial...</td>
                    </tr>
                </table>
            </div>
        </div>


    </div>
</div>

<div class="template session-buttons-container" id="session-buttons-container" >
    <button title="Editar"
            class="btn btn-default btn-sm btn-action btn-edit" data-action="edit" >
        <i class="fa fa-pencil" aria-hidden="true" ></i>
    </button>
    <button title="Eliminar"
            class="btn btn-danger btn-sm btn-action btn-delete" data-action="delete" >
        <i class="fa fa-trash" aria-hidden="true" ></i>
    </button>
</div>

<!-- Modal delete session -->
<div class="modal fade" id="session-deletion-modal" tabindex="-1" role="dialog"
     aria-labelledby="delete-session-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-session-title">
                    Borrar entrada del historial de sesiones
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    Estás a punto de borrar una entrada del historial de
                    <strong><?php echo $name . ' ' . $surname; ?></strong>
                </div>

                <hr/>

                <div class="session-data" >
                    <p><strong>Tuvo lugar en: </strong><span class="happened_at"></span></p>
                    <p><strong>Comentarios: </strong><span class="comments"></span></p>
                </div>

                <hr/>

                <p>¿Desea continuar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="delete-session-button">Borrar</button>
            </div>
        </div>
    </div>
</div>
