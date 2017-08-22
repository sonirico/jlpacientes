<?php $this->load->view('partials/head', ['extra_css' => [
    'assets/css/offsicks/index.css'
]]); ?>

<?php $this->load->view('partials/navbar'); ?>

<div class="container-fluid" id="offsicks-container" >
    <div class="row" >
        <div class="col-lg-12" >
            <div class="form-group text-right" >
                <a target="_blank" class="btn btn-default" role="button"
                    href="<?php echo base_url('/offsicks/export'); ?>" >
                    <i class="fa fa-file-pdf-o" >&nbsp;</i>
                    Exportar
                </a>
            </div>
            <div class="table-responsive" >
                <table id="offsicks-table" class="table table-bordered"  >
                    <tbody>
                        <tr>
                            <td>Cargando bajas...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php //$this->load->view('offsicks/partials/templates'); ?>

<script type="text/javascript" >
    var OFFSICKS_URL = '<?php echo base_url('/api/offsicks/all/'); ?>';
    var stages = <?php echo json_encode(config_item('stages')); ?>;
    var injuries = <?php echo json_encode(config_item('injuries')); ?>;
</script>

<?php $this->load->view('partials/footer', ['extra_js' => [
    'assets/js/offsicks/index.js'
]]); ?>