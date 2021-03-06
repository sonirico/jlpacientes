<?php


?>

<div class="row">
    <div class="col-md-12 form-container" id="injuries-form-container" style="display: none;">
        <form id="injury-form"
              action="<?php echo base_url('/api/injuries/store/'); ?>"
              method="POST">

            <input type="hidden" name="player" value="<?php echo $id; ?>" />

            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="injury-category">Tipo de lesión</label>
                    <select class="form-control" id="injury-category" name="type">
                        <option value="0" selected>-- Selecciona una categoría de lesión --</option>
                        <?php foreach ((config_item('injuries')['types']) as $it_id => $it_name): ?>
                            <option value="<?php echo $it_id; ?>">
                                <?php echo $it_name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="injury-cause">Causa</label>
                    <select class="form-control" id="injury-cause" name="cause">
                        <option value="0" selected>-- Selecciona una causa --</option>
                        <?php foreach ((config_item('injuries')['causes']) as $it_id => $it_name): ?>
                            <option value="<?php echo $it_id; ?>">
                                <?php echo $it_name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="injury-circumstance">Circunstancia</label>
                    <select class="form-control" id="injury-circumstance" name="circumstance">
                        <option value="0" selected>-- Selecciona una circunstancia --</option>
                        <?php foreach ((config_item('injuries')['circumstances']) as $it_id => $it_name): ?>
                            <option value="<?php echo $it_id; ?>">
                                <?php echo $it_name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="injury-happened-at">Fecha de la lesión</label>
                    <div class="input-group date">
                        <input type="text" class="form-control"
                               placeholder="dd/mm/yyyy"
                               id="injury-happened-at" name="happened_at"
                               value=""/>
                        <span class="input-group-addon">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-3 form-group">
                    <label for="injury-recover-days">Días de recuperación</label>

                    <input type="number" min="1" max="365" value="1" class="form-control"
                           id="injury-recover-days" name="days_off"/>

                </div>
                <div class="col-md-3 form-group">
                    <label for="injury-procedures">Nº Intervenciones</label>

                    <input type="number" min="1" max="99" value="1" class="form-control"
                           id="injury-recover-days" name="procedures"/>

                </div>
            </div>
            <div class="row offsick-container" >
                <div class="col-md-4" >
                    <div class="checkbox" >
                        <label>
                            <input type="checkbox" name="offsick" >
                            Dar de baja
                        </label>
                    </div>
                    <div class="form-group" style="display: none" id="offsick-stage-container" >
                        <select class="form-control" name="current_stage" id="current_stage" >
                            <option value="0" >-- Selecciona fase actual --</option>
                            <?php foreach (config_item('stages') as $stage_id => $stage_desc): ?>
                            <option value="<?php echo $stage_id; ?>" >
                                <?php echo $stage_desc; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12 form-group" >
                    <textarea class="form-control" name="description"
                              id="injury-description"></textarea>
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
    <div class="col-md-12" id="injuries-table-container" >
        <div class="row" >
            <div class="col-md-12" >
                <div class="form-group clearfix global-actions" >
                    <a href="<?php echo base_url("players/{$id}/history/pdf/"); ?>"
                       target="_blank" role="button"
                       class="btn btn-secondary pull-right" id="export-injury-button" >
                        Exportar
                        <i class="fa fa-file-pdf-o" aria-hidden="true" ></i>
                    </a>

                    <button type="button" class="btn btn-primary pull-right" id="new-injury-button" >
                        Nueva lesión
                        <i class="fa fa-plus" aria-hidden="true" ></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col-md-12" >
                <table id="player-history" class="table">
                    <tr>
                        <td class="text-center" >Cargando historial...</td>
                    </tr>
                </table>
            </div>
        </div>


    </div>
</div>

<div class="template injury-buttons-container" id="injury-buttons-container" >
    <button title="Editar"
            class="btn btn-default btn-sm btn-action btn-edit" data-action="edit" >
        <i class="fa fa-pencil" aria-hidden="true" ></i>
    </button>
    <button title="Eliminar"
            class="btn btn-danger btn-sm btn-action btn-delete" data-action="delete" >
        <i class="fa fa-trash" aria-hidden="true" ></i>
    </button>
</div>

<!-- Modal delete player -->
<div class="modal fade" id="injury-deletion-modal" tabindex="-1" role="dialog"
     aria-labelledby="delete-injury-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-injury-title">Borrar entrada del historial de lesiones</h5>
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

                <div class="injury-data" >
                    <p><strong>Lesión: </strong><span class="type"></span></p>
                    <p><strong>Ocurrió en: </strong><span class="happened_at"></span></p>
                    <p><strong>Recuperación (días): </strong><span class="days_off"></span></p>
                    <p><strong>Description: </strong><span class="description"></span></p>
                </div>

                <hr/>

                <p>¿Desea continuar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="delete-injury-button">Borrar</button>
            </div>
        </div>
    </div>
</div>
