<?php $this->load->view('partials/head', ['extra_css' => [
    '/assets/css/players/show.css',
    '/assets/lib/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css'
]]); ?>

<?php $this->load->view('partials/navbar'); ?>

    <div class="container-fluid" >
        <div class="row" id="player-profile" >
            <div class="col-lg-8 offset-lg-2" >
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#history" role="tab">Histórico lesiones</a>
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
                    <div class="tab-pane" id="history" role="tabpanel">
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

<?php $this->load->view('partials/footer', ['extra_js' => [
    '/assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
    '/assets/lib/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js',
    '/assets/js/players/show.js'
]]); ?>