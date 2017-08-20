<?php $this->load->view('partials/status'); ?>

<?php if ($errors = validation_errors()): ?>
    <div class="alert alert-danger alert-dismissible show" role="alert" >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            <?php echo $errors; ?>
        </strong>
    </div>
<?php endif; ?>

<?php $this->load->view('partials/csrf'); ?>

<div class="form-group" >
    <label for="team-name" >Equipo</label>

    <?php if (isset($name)) : ?>
        <input type="text" class="form-control" name="name" id="team-name"
            value="<?php echo $name; ?>" />
    <?php else: ?>
        <input type="text" class="form-control" name="name" id="team-name"
            value="<?php echo set_value('name'); ?>" />
    <?php endif; ?>
</div>
<div class="form-group" >
    <div class="row" >
        <div class="col-md-6 logo-left" >
        <label for="team-name" >Logo</label>
        <input type="file" accept=".png" name="logo" id="team-logo" />
        <div class="logo-requirements" >
            <ul>
                <li>La imagen cuanto más cuadrada, mejor</li>
                <li>Ni el ancho ni el alto deben superar los 768 pixeles</li>
                <li>El tamaño máximo permitido son 500Kb</li>
            </ul>
        </div>
        </div>
        <div class="col-md-6 logo-right" >
            <?php if (isset($logo)): ?>
            <img class="img img-responsive img-rounded"
                width="128"
                alt="<?php echo $name; ?>"
                src="<?php echo base_url('assets/img/teams/' . $logo); ?>" />
            <?php endif; ?>
        </div>
    </div>

</div>
<div class="form-group" >
    <button type="submit" class="btn btn-primary" id="team-create">
        Enviar
    </button>
    <?php $this->load->view('partials/button_back', [
            'back_uri' => 'teams/'
    ]); ?>
</div>