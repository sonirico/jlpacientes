<?php $this->load->view('partials/head', ['extra_css' => [
    '/assets/css/offsicks/create.css',
    '/assets/lib/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css'
]]); ?>

<?php $this->load->view('partials/navbar'); ?>

<div class="container-fluid" >
    <div class="row text-center" >
        <div class="col-md-12" >
            <h3 class="section-title" >Nueva baja</h3>
        </div>
    </div>

    <div class="row" id="offsick-container" >
        <div class="col-md-8 offset-md-2 form-group" >
            <form action="/offsicks/store/" method="POST" >

                <?php $this->load->view('offsicks/partials/form.php'); ?>

                <div class="row" >
                    <div class="col-md-12" >
                        <a role="button" href="/" class="btn btn-warning" id="cancel" >
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary" id="submit" >
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $this->load->view('partials/footer', ['extra_js' => [
    '/assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
    '/assets/lib/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js',
    '/assets/js/offsicks/create.js'
]]); ?>