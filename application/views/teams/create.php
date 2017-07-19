<?php $this->load->view('partials/head', ['extra_css' => [
    '/assets/css/teams/create.css'
]]); ?>

<?php $this->load->view('partials/navbar'); ?>

<div class="container-fluid" >
    <div class="row" id="teams-container" >
        <div class="col-lg-8 offset-lg-2" >
            <form action="/teams/store/" method="POST" enctype="multipart/form-data" >

                <?php $this->load->view('teams/partials/form'); ?>
                
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('partials/footer', ['extra_js' => [
    '/assets/js/teams/create.js'    
]]); ?>