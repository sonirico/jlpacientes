<?php $this->load->view('partials/head', ['extra_css' => [
    'assets/css/offsicks/index.css',
    '/assets/lib/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css'
]]); ?>

<?php $this->load->view('partials/navbar'); ?>

<div class="container-fluid" id="offsicks-container" >
    <form class="filter-form" id="offsicks-form-filter">
        <div class="row" >
            <div class="col-md-4" >
                <div class="form-group" >
                    <div class="checkbox" >
                        <label>
                            <input type="checkbox" name="offsicks-filter-show-ups" >
                            Mostrar altas
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group" >
                    <div class='input-group date' id='datetimepicker9'>
                        <span class="input-group-addon">
                            Desde
                        </span>
                        <input type='text' name="offsicks-filter-date-from" class="form-control" />
                        <span class="input-group-addon">
                            Hasta
                        </span>
                        <input type='text' name="offsicks-filter-date-to" class="form-control" />

                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group text-right" >
                    <a target="_blank" class="btn btn-default" role="button"
                       href="<?php echo base_url('/offsicks/export'); ?>" >
                        <i class="fa fa-file-pdf-o" >&nbsp;</i>
                        Exportar
                    </a>
                </div>
            </div>
        </div>
    </form>
    <div class="row" >
        <div class="col-lg-12" >
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
    '/assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
    '/assets/lib/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js',
    'assets/lib/momentjs/moment.js',
    'assets/js/offsicks/index.js'
]]); ?>