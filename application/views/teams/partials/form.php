<?php if ($errors = validation_errors()): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" >
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
    <label for="team-name" >Logo</label>
    <input type="file" accept=".png" 
        class="form-control" name="team-name" id="team-name" />
</div>
<div class="form-group" >
    <button type="submit" class="btn btn-primary" id="team-create">
        Enviar
    </button>
    <?php $this->load->view('partials/button_back', [
            'back_uri' => 'teams/'
    ]); ?>
</div>