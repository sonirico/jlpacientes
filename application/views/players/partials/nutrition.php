<?php

?>

<div class="row">
    <div class="col-md-12 form-container" id="nutrition-form-container" style="display:none">
        <form id="nutrition-form"
              action="<?php echo base_url('/api/nutrition/store/'); ?>"
              method="POST">

            <input type="hidden" name="player" value="<?php echo $id; ?>" />

            <div class="row">
                <div class="col-md-4" >
                    <label for="nutrition-diet-keen">Cumple dieta</label>
                    <div>
                        <input type="checkbox" id="nutrition-diet-keen" name="diet_keen" />
                    </div>
                </div>
                <div class="col-md-4 form-group">
                    <label for="nutrition-imc">IMC</label>
                    <input type="number" min="10" max="60" step="1"
                           class="form-control" id="nutrition-imc" name="imc"
                           value="" />
                </div>
                <div class="col-md-4 form-group">
                    <label for="nutrition-waist-hip">Perímetro cintura-cadera (cm)</label>
                    <select class="form-control" id="nutrition-waist-hip" name="hip_waist_perimeter" >
                        <option value="-1">-- Ninguno --</option>
                        <?php for ($i = 20; $i < 150; $i++): ?>
                            <option value="<?php echo $i;?>" ><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-4 form-group">
                    <label for="nutrition-weight">Masa (Kg)</label>
                    <select class="form-control" id="nutrition-weight" name="weight" >
                    <option value="-1">-- Ninguna --</option>
                    <?php for ($i = 5; $i < 150; $i++): ?>
                        <option value="<?php echo $i;?>" ><?php echo $i; ?></option>
                    <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="nutrition-height">Altura (cm)</label>
                    <select class="form-control" id="nutrition-height" name="height">
                        <option value="-1">-- Ninguno --</option>
                        <?php for ($i = 50; $i < 250; $i++): ?>
                        <option value="<?php echo $i;?>" ><?php echo $i; ?>cm</option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="nutrition-folds">Pliegues</label>
                    <select class="form-control" id="nutrition-folds" name="folds" >
                        <option value="0">-- Ninguno --</option>
                        <?php foreach (config_item('folds') as $fold): ?>
                        <option value="<?php echo $fold;?>" ><?php echo $fold; ?></option>
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
                    <button type="button" class="btn btn-primary send" >Enviar</button>
                    <button type="button" class="btn btn-warning cancel" >Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="nutrition-table-container" >
        <!-- <h2 class="text-center">Evolución</h2> -->
        <div class="row" >
            <div class="col-md-12" >
                <div class="form-group clearfix global-actions text-right" >

                    <button class="btn btn-primary" id="new-nutrition-button" >
                        <i class="fa fa-plus" >&nbsp;</i>
                        Nuevo estado nutricional
                    </button>

                    <a href="<?php echo base_url("players/{$id}/nutrition/pdf/"); ?>"
                       target="_blank" role="button"
                       class="btn btn-default" id="export-nutrition-button" >
                        Exportar
                        <i class="fa fa-file-pdf-o" aria-hidden="true" ></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col-md-12" >
                <table id="player-nutrition-history" class="table" width="100%" >
                    <tr>
                        <td class="text-center" >Cargando historial...</td>
                    </tr>
                </table>
            </div>
        </div>


    </div>
</div>

<div class="template nutrition-buttons-container" id="nutrition-buttons-container" >
    <button title="Editar"
            class="btn btn-default btn-sm btn-action btn-edit" data-action="edit" >
        <i class="fa fa-pencil" aria-hidden="true" ></i>
    </button>
    <button title="Eliminar"
            class="btn btn-danger btn-sm btn-action btn-delete" data-action="delete" >
        <i class="fa fa-trash" aria-hidden="true" ></i>
    </button>
</div>

<!-- Modal delete nutrition -->
<div class="modal fade" id="nutrition-deletion-modal" tabindex="-1" role="dialog"
     aria-labelledby="delete-nutrition-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-nutrition-title">Borrar entrada del historial</h5>
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

                <p>¿Desea continuar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="delete-nutrition-button">Borrar</button>
            </div>
        </div>
    </div>
</div>
