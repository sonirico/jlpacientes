<?php $this->load->view('partials/head', ['extra_css' => [
    '/assets/css/players/create.css',
    '/assets/lib/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css'
]]); ?>

<?php $this->load->view('partials/navbar'); ?>

<div class="container-fluid" >
    <div class="row" id="players-container" >
        <div class="col-lg-8 offset-lg-2" >
            <h3 class="text-center" >Alta jugador</h3>
            <form action="/players/store/" method="POST" enctype="multipart/form-data" >

                <?php $this->load->view('players/partials/form'); ?>
                
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('partials/footer', ['extra_js' => [
    '/assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
    '/assets/lib/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js',
    '/assets/js/players/create.js'    
]]); ?>