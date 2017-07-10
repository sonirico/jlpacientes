<?php $this->load->view('head', [
    'extra_css' => [
        // 'assets/css/patients.css'
    ]
]); ?>

<div class="container-fluid" >
    <div class="row" >
        <div class="col-md-8 offset-md-2" >
            <div class="jumbotron" >
                <?php $this->load->view('patients/partials/form'); ?>
            </div>
        </div>
    </div>

    <div class="row" >
        <div class="col-md-8 offset-md-2" >
            <div class="table-responsive" >
                <table id="patients-table" class="table table-borderder table-responsive" width="100%">
                    <tbody>
                        <tr>
                            <td>Cargando pacientes...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('footer', ['extra_js' => [
    '/assets/js/lib/jquery-1.11.2.min.js',
    '/assets/js/lib/dataTable.min.js',
    '/assets/js/patients.js'
]]); ?>