<?php $this->load->view('partials/head', ['extra_css' => [
    '/assets/css/players/show.css',
    '/assets/lib/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css'
]]); ?>

<?php $this->load->view('partials/navbar'); ?>

    <div class="container-fluid" >
        <div class="row" id="player-profile" >
            <div class="col-lg-10 offset-lg-1" >
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#history" role="tab">Histórico lesiones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#nutrition" role="tab">Estado nutricional</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sessions" role="tab">Sesiones fisio</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="history" role="tabpanel">
                        <?php $this->load->view('players/partials/history'); ?>
                    </div>
                    <div class="tab-pane" id="nutrition" role="tabpanel">
                        <?php $this->load->view('players/partials/nutrition'); ?>
                    </div>
                    <div class="tab-pane" id="sessions" role="tabpanel">
                        <?php $this->load->view('players/partials/phth-sessions'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var HISTORY_URL = '<?php echo base_url('/api/players/' . $id . '/history/'); ?>';
    var INJURY_CREATE = '<?php echo base_url('/api/injuries/store/'); ?>';
    var INJURY_UPDATE = '<?php echo base_url('/api/injuries/<injury_id>/update/'); ?>';
    var INJURY_DELETE = '<?php echo base_url('/api/injuries/<injury_id>/delete/'); ?>';

    var NUTRITION_URL = '<?php echo base_url('/api/players/' . $id . '/nutrition/'); ?>';
    var INJURY_CREATE = '<?php echo base_url('/api/injuries/store/'); ?>';
    var INJURY_UPDATE = '<?php echo base_url('/api/injuries/<injury_id>/update/'); ?>';
    var INJURY_DELETE = '<?php echo base_url('/api/injuries/<injury_id>/delete/'); ?>';
</script>

<?php $this->load->view('partials/footer', ['extra_js' => [
    '/assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
    '/assets/lib/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js',
    '/assets/lib/momentjs/moment.js',
    '/assets/js/players/show.js'
]]); ?>