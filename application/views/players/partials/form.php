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

<div class="row" >
    <div class="col-md-6 form-group" >
        <label for="player-name" >Nombre</label>
        <?php if (isset($name)): ?>
            <input type="text" class="form-control" name="name" 
                id="player-name" value="<?php echo $name; ?>" required />
            <?php else: ?>
            <input type="text" class="form-control" name="name" 
                id="player-name" value="<?php echo set_value('name'); ?>" required />
        <?php endif; ?>
    </div>
    <div class="col-md-6 form-group" >
        <label for="player-surname" >Apellidos</label>
        <?php if (isset($surname)): ?>
            <input type="text" class="form-control" name="surname" 
                id="player-surname" value="<?php echo $surname; ?>" required />
            <?php else: ?>
            <input type="text" class="form-control" name="surname" 
                id="player-surname" value="<?php echo set_value('surname');?>" required />
        <?php endif; ?>
    </div>
</div>

<div class="row" >
    <div class="col-md-6 form-group" >
        <label for="player-nif" >NIF</label>
        <?php if (isset($nif)) : ?>
            <input type="text" class="form-control" name="nif" id="team-nif"
                value="<?php echo $nif; ?>" /> 
        <?php else: ?>
            <input type="text" class="form-control" name="nif" id="team-nif"
                value="<?php echo set_value('nif'); ?>" />
        <?php endif; ?>
    </div>
    <div class="col-md-6 form-group" >
        <label for="player-birthday" >Fecha de nacimiento</label>
        <div class="input-group date">
            <?php 
                $this->load->helper('date');
                if (isset($birthday)) : ?>
                <input type="text" class="form-control" 
                    placeholder="dd/mm/yyyy"
                    id="player-birthday" name="birthday"
                    value="<?php echo date('d/m/Y', $birthday); ?>" required />
            <?php else: ?>
                <input type="text" class="form-control" 
                    placeholder="dd/mm/yyyy"
                    id="player-birthday" name="birthday" 
                    value="<?php echo set_value('birthday'); ?>" required />
            <?php endif; ?>
            <span class="input-group-addon">
                <i class="fa fa-calendar" aria-hidden="true" ></i>
            </span>
        </div>
    </div>
</div>

<div class="row" >
    <div class="col-md-6 form-group" >
        <label for="player-team" >Equipo</label>
        <select name="team" id="player-team" class="form-control" required >
            <option value="0" >-- Selecciona un equipo --</option>
        <?php $team_value = isset($team) ? $team : 
            (set_value('team') ? set_value('team') : false); ?>
        
        <?php foreach ($teams as $t) : ?>
            <?php $selected = ($team_value && $team_value == $t['id']) ? 'selected' : ''; ?>
            <option value="<?php echo $t['id']; ?>" <?php echo $selected ;?>>
                <?php echo $t['name']; ?>
            </option>
        <?php endforeach ;?>
        
        </select>
    </div>
    <div class="col-md-6 form-group" >
        <label for="player-position" >Posición</label>
        <select name="position" id="player-position" class="form-control" required >
            <option value="0" >-- Selecciona una posición --</option>
        <?php $position_value = isset($position) ? $position : 
            (set_value('position') ? set_value('position') : false); ?>
        
        <?php foreach ($this->config->item('positions') as $pos_id => $pos_name) : ?>
            <?php $selected = ($position_value && $position_value == $pos_id) ? 'selected' : ''; ?>
            <option value="<?php echo $pos_id ?>" <?php echo $selected ;?>>
                <?php echo $pos_name; ?>
            </option>
        <?php endforeach ;?>
        
        </select>
    </div>
</div>

<div class="row" >
    <div class="col-md-8" >
        <div class="form-group" >
            <label for="player-address" >Dirección</label>

            <?php if (isset($address)) : ?>
                <input type="text" class="form-control" name="address" id="team-address"
                    value="<?php echo $address; ?>" /> 
            <?php else: ?>
                <input type="text" class="form-control" name="address" id="team-address"
                    value="<?php echo set_value('address'); ?>" />
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-4" >
        <div class="form-group" >
            <label for="player-contact" >Contacto</label>

            <?php if (isset($contact)) : ?>
                <input type="text" class="form-control" name="contact" id="team-contact"
                    value="<?php echo $contact; ?>" /> 
            <?php else: ?>
                <input type="text" class="form-control" name="contact" id="team-contact"
                    value="<?php echo set_value('contact'); ?>" />
            <?php endif; ?>
        </div>
    </div>
</div>


<div class="form-group" >
    <button type="submit" class="btn btn-primary" id="team-create">
        Enviar
    </button>
    <?php $referrer = $this->agent->is_referral() ? $this->agent->referrer() : base_url('/players/');  ?>
    <a href="<?php echo $referrer; ?>" role="button" class="btn btn-warning"  >
        Volver
    </a>
</div>