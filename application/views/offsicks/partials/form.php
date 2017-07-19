
    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" 
        value="<?=$this->security->get_csrf_hash();?>" />

    <div class="row form-group" >
        <div class="col-md-6" >
            <label>Nombre</label>
            <input type="text" class="form-control" name="name" value="" />
        </div>

        <div class="col-md-6" >
            <label>Apellidos</label>
            <input type="text" class="form-control" name="surname" value="" />
        </div>

    </div>

    <div class="row" >
        <div class="col-md-3 form-group" >
            <label for="injury" >Lesión</label>
            <select class="form-control" name="injury" id="injury" >
                <option value="0">-- Lesión --</option>
                <?php foreach ($injuries as $id => $injury): ?>
                <option value="<?php echo $id;?>"><?php echo $injury;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="col-md-3" >
            <label for="stage" >Fase</label>
            <select class="form-control" name="stage" id="stage">
                <option value="0">-- Fase --</option>
                <?php foreach ($stages as $id => $stage): ?>
                <option value="<?php echo $id;?>"><?php echo $stage;?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-3" >
            <label for="position" >Posición</label>
            <select class="form-control" name="position" id="position" >
                <option value="0">-- Posición --</option>
                <?php foreach ($positions as $id => $position): ?>
                <option value="<?php echo $id;?>"><?php echo $position;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="col-md-3" >
            <label for="team" >Equipo</label>
            <select class="form-control" name="team" id="team" >
                <option value="0">-- Equipo --</option>
                <?php foreach ($teams as $id => $team): ?>
                <option value="<?php echo $id;?>"><?php echo $team;?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row form-group" >
        <div class="col-md-2" >
            <label for="days-ko" >Días de baja</label>
            <input type="number" class="form-control" name="days_off" 
                id="days-ko" min="1" max="999" />
        </div>

        <div class="col-md-4" >
            <label for="injury-date" >Fecha lesión</label>
                <div class="input-group date">
                    <input type="text" class="form-control" 
                        placeholder="dd/mm/yyyy"
                        id="injury-date" name="date_off" />
                    <span class="input-group-addon">
                        <i class="fa fa-calendar" aria-hidden="true" ></i>
                    </span>
                </div>
        </div>
    </div>

    <div class="row" >
        <div class="col-md-12 form-group" >
            <?php //$this->load->view('patients/partials/editor'); ?>
            <label for="diagnosis" >Diagnóstico</label>
            
            <textarea name="diagnosis" id="diagnosis" class="form-control" ></textarea>
        </div>
    </div>

