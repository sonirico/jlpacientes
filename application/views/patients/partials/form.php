<form action="<?php ?>" method="POST" id="patient-crud-form" >
    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" 
        value="<?=$this->security->get_csrf_hash();?>" />

    <div class="row form-group" >
        <div class="col-md-4" >
            <label>Nombre</label>
            <input type="text" class="form-control" name="name" value="" />
        </div>

        <div class="col-md-4" >
            <label>Apellidos</label>
            <input type="text" class="form-control" name="surname" value="" />
        </div>
        
        <div class="col-md-2" >
            <label>Fase</label>
            <select class="form-control" name="fase" >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <div class="col-md-2" >
            <label>Posición</label>
            <select class="form-control" name="position" >
                <option value="1">Portero</option>
                <option value="2">Zaga</option>
                <option value="3">Punta</option>
                <option value="4">Liberto</option>
            </select>
        </div>
    </div>

    <div class="row" >
        <div class="col-xs-12" >
            <?php //$this->load->view('patients/partials/editor'); ?>
            <label for="" ></label>
            <textarea name="diagnosis" ></textarea>
        </div>
    </div>

    <div class="row" >
        <div class="col-xs-12" >
            <button type="button" class="btn btn-warning" id="cancel" >
                Cancelar
            </button>
            <button type="button" class="btn btn-primary" id="submit" >
                Guardar
            </button>
        </div>
    </div>
</form>
