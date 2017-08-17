<?php

$nut_state['diet_keen'] = '1';
$nut_state['imc'] = 25;

?>

<div class="row">
    <div class="col-md-12 form-container" id="nutrition-form-container">
        <form id="nutrition-form"
              action="<?php echo base_url('/api/nutrition/store/'); ?>"
              method="POST">

            <input type="hidden" name="player" value="<?php echo $id; ?>" />

            <div class="row">
                <div class="col-md-4" >
                    <label for="nutrition-diet-keen">Cumple dieta</label>
                    <div>
                        <input type="checkbox"
                           id="nutrition-diet-keen" name="diet_keen"
                           value="<?php boolval($nut_state['diet_keen']) ? 1 : 0; ?>"
                           checked="<?php boolval($nut_state['diet_keen']) ? 'true' : 'false'; ?>" />
                    </div>
                </div>
                <div class="col-md-4 form-group">
                    <label for="nutrition-imc">IMC</label>
                    <input type="number" min="10" max="60" step="1"
                           class="form-control" id="nutrition-imc" name="imc"
                           value="<?php echo $nut_state['imc']; ?>" />
                </div>
                <div class="col-md-4 form-group">
                    <label for="nutrition-waist-hip">Perímetro cintura-cadera (cm)</label>
                    <select class="form-control" id="nutrition-waist-hip" >
                        <option val="-1">-- Ninguno --</option>
                        <?php $current_value = intval(@$nut_state['hip_waist_perimeter']); ?>
                        <?php for ($i = 20; $i < 150; $i++): ?>
                            <?php if ($current_value === $i): ?>
                                <option val="<? echo $i;?>" selected>
                            <?php else: ?>
                                <option val="<? echo $i;?>" >
                            <?php endif; ?>
                            <?php echo $i; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-4 form-group">
                    <label for="nutrition-weight">Masa (Kg)</label>
                    <select class="form-control" id="nutrition-weight" >
                        <option val="0">-- Ninguna --</option>
                        <?php $current_value = intval(@$nut_state['weight']); ?>
                        <?php for ($i = 5; $i < 150; $i++): ?>
                            <?php if ($current_value === $i): ?>
                                <option val="<? echo $i;?>" selected>
                            <?php else: ?>
                                <option val="<? echo $i;?>" >
                            <?php endif; ?>
                            <?php echo $i; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="nutrition-height">Altura (cm)</label>
                    <select class="form-control" id="nutrition-height" >
                        <option val="-1">-- Ninguno --</option>
                        <?php $current_value = intval(@$nut_state['height']); ?>
                        <?php for ($i = 50; $i < 250; $i++): ?>
                            <?php if ($current_value === $i): ?>
                                <option val="<? echo $i;?>" selected>
                            <?php else: ?>
                                <option val="<? echo $i;?>" >
                            <?php endif; ?>
                            <?php echo $i; ?>cm
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="nutrition-folds">Pliegues</label>
                    <select class="form-control" id="nutrition-folds" >
                        <option val="-1">-- Ninguno --</option>
                        <?php $current_value = intval(@$nut_state['folds']); ?>
                        <?php foreach (config_item('folds') as $fold): ?>
                            <?php if ($current_value === $fold): ?>
                                <option val="<? echo $fold;?>" selected>
                            <?php else: ?>
                                <option val="<? echo $fold;?>" >
                            <?php endif; ?>
                            <?php echo $fold; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12 form-group" >
                    <label>Comentarios</label>
                    <textarea class="form-control" name="description"
                              id="nutrition-comments"></textarea>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12" >
                    <button type="submit" class="btn btn-primary send" >Actualizar</button>
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
                    <a href="<?php echo base_url("players/{$id}/nutrition/pdf/"); ?>"
                       target="_blank" role="button"
                       class="btn btn-secondary pull-right" id="export-injury-button" >
                        Exportar
                        <i class="fa fa-file-pdf-o" aria-hidden="true" ></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col-md-12" >
                <table id="player-nutrition-history" class="table">
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
                <h5 class="modal-title" id="delete-injury-title">Borrar entrada del historial</h5>
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
