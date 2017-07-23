<?php $this->load->view('partials/head', ['extra_css' => [
    '/assets/css/players/edit.css'
]]); ?>

<?php $this->load->view('partials/navbar'); ?>

<div class="container-fluid" >
    <div class="row" id="players-container" >
        <div class="col-lg-8 offset-lg-2" >
            <h3 class="text-center" >Actualizar jugador</h3>
            <form action="/players/<?php echo $id; ?>/update/" method="POST" 
                enctype="multipart/form-data" >

                <?php $this->load->view('partials/status'); ?>

                <?php $this->load->view('players/partials/form'); ?>
                
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('partials/footer', ['extra_js' => [
    '/assets/js/players/edit.js'    
]]); ?>