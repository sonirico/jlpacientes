<?php $this->load->view('partials/head', ['extra_css' => [
    '/assets/css/teams/index.css'
]]); ?>

<?php $this->load->view('partials/navbar'); ?>

<div class="container-fluid" >
    <div class="row" id="teams-container" >
        <div class="col-lg-12" >
            <div class="form-group text-right" >
                <a href="/teams/create/" class="btn btn-primary" 
                    role="button" >Nuevo equipo</a>
            </div>

            <?php $this->load->view('partials/status'); ?>

            <div class="table-responsive" >
                <table id="teams-table" class="table table-bordered"  >
                    <tbody>
                        <tr>
                            <td>Cargando equipos...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="delete-team-modal" tabindex="-1" role="dialog" 
    aria-labelledby="delete-team-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete-team-title">Borrar equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
        Estás a punto de borrar el equipo <em class="deletion-team-name" ></em>. Esta
        acción <strong>no</strong> borrará los jugadores pertenecientes a él.
        </p>
        
        <p>¿Desea continuar?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger delete-team-button">Borrar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" >
    var IMG_BASE_URL = "<?php echo base_url('assets/img/teams/'); ?>";
</script>

<?php $this->load->view('partials/footer', ['extra_js' => [
    '/assets/js/teams/index.js'    
]]); ?>