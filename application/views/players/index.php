<?php $this->load->view('partials/head', ['extra_css' => [
    '/assets/css/players/index.css'
]]); ?>

<?php $this->load->view('partials/navbar'); ?>

<div class="container-fluid" >
    <div class="row" id="players-container" >
        <div class="col-lg-12" >
            <div class="form-group text-right" >
                <a href="/players/create/" class="btn btn-primary"
                    role="button" >Alta jugador</a>
            </div>

            <?php $this->load->view('partials/status'); ?>

            <div>
                <table id="players-table" class="table"  >
                    <tbody>
                        <tr>
                            <td>Cargando jugadores...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Templates -->
<div class="template" id="player-buttons-container" >
    <button title="Editar"
            class="btn btn-default btn-sm btn-action btn-edit" data-action="edit" >
        <i class="fa fa-pencil" aria-hidden="true" ></i>
    </button>
    <button title="Cursar baja"
            class="btn btn-default btn-sm btn-action btn-offsick" data-action="offsick" >
        <i class="fa fa-thumbs-o-down" aria-hidden="true" ></i>
    </button>
    <button title="Cursar alta"
            class="btn btn-success btn-sm btn-action btn-upsick" data-action="upsick" >
        <i class="fa fa-thumbs-o-up" aria-hidden="true" ></i>
    </button>
    <button title="Eliminar"
            class="btn btn-danger btn-sm btn-action btn-delete" data-action="delete" >
        <i class="fa fa-trash" aria-hidden="true" ></i>
    </button>
</div>

<!-- Modal delete player -->
<div class="modal fade" id="delete-player-modal" tabindex="-1" role="dialog"
    aria-labelledby="delete-player-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete-player-title">Borrar jugador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
        Estás a punto de borrar a <em class="deletion-player-name" ></em>. Esta
        acción es irreversible.
        </p>

        <p>¿Desea continuar?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger delete-player-button">Borrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal offsick player -->
<div class="modal fade" id="offsick-player-modal" tabindex="-1" role="dialog"
     aria-labelledby="offsick-player-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="offsick-player-title">Cursar baja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Estás a punto de dar de baja a <em class="offsick-player-name" ></em>.
                </p>

                <p>¿Desea continuar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-warning offsick-player-button">Cursar baja</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" >
    var positions = <?php echo json_encode($this->config->item('positions')); ?>;
</script>

<?php $this->load->view('partials/footer', ['extra_js' => [
    '/assets/lib/momentjs/moment.js',
    '/assets/js/players/index.js'
]]); ?>