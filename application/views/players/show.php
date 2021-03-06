<?php $this->load->view('partials/head', ['extra_css' => [
    '/assets/css/players/show.css',
    '/assets/lib/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css'
]]); ?>

<?php $this->load->view('partials/navbar'); ?>

    <div class="container-fluid" >
        <div class="row" id="player-profile" >
            <div class="col-lg-10 col-lg-offset-1" >
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">

                    <li class="nav-item active">
                        <a class="nav-link" data-toggle="tab" href="#history" role="tab">Histórico lesiones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#nutrition" role="tab">Estado nutricional</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sessions" role="tab">Sesiones fisio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#offsicks" role="tab">Bajas</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active in" id="history" role="tabpanel">
                        <?php $this->load->view('players/partials/history'); ?>
                    </div>
                    <div class="tab-pane" id="nutrition" role="tabpanel">
                        <?php $this->load->view('players/partials/nutrition'); ?>
                    </div>
                    <div class="tab-pane" id="sessions" role="tabpanel">
                        <?php $this->load->view('players/partials/phth-sessions'); ?>
                    </div>
                    <div class="tab-pane" id="offsicks" role="tabpanel">
                        <?php $this->load->view('players/partials/offsicks'); ?>
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
    var NUTRITION_CREATE = '<?php echo base_url('/api/nutrition/store/'); ?>';
    var NUTRITION_UPDATE = '<?php echo base_url('/api/nutrition/<nutrition_id>/update/'); ?>';
    var NUTRITION_DELETE = '<?php echo base_url('/api/nutrition/<nutrition_id>/delete/'); ?>';

    var OFFSICKS_URL = '<?php echo base_url('/api/players/' . $id . '/offsicks/'); ?>';

    var SESSIONS_URL_INDEX = '<?php echo base_url('/api/sessions/' . $id . '/'); ?>';
    var SESSIONS_URL_CREATE = '<?php echo base_url('/api/sessions/post'); ?>';
    var SESSIONS_URL_UPDATE = '<?php echo base_url('/api/sessions/<id>/put'); ?>';
    var SESSIONS_URL_DELETE = '<?php echo base_url('/api/sessions/<id>/delete'); ?>';

    var stages = <?php echo json_encode(config_item('stages')); ?>;
    var injuries = <?php echo json_encode(config_item('injuries')); ?>;

</script>

<?php $this->load->view('partials/footer', ['extra_js' => [
    '/assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
    '/assets/lib/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js',
    '/assets/lib/momentjs/moment.js',
    '/assets/js/players/show.js'
]]); ?>