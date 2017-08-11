<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Cambiar contraseña</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="noindex,nofollow"/>
        <meta name="<?= $this->security->get_csrf_token_name(); ?>" content="<?= $this->security->get_csrf_hash(); ?>"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
              integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url('/assets/lib/font-awesome-4.7.0/css/font-awesome.css'); ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('/assets/css/common.css'); ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('/assets/css/auth/password_reset.css'); ?>"/>

    </head>
    <body>

        <div class="container">

            <form id="password-reset-form"
                  action="<?php echo base_url('auth/password_reset'); ?>" method="post" >

                <h2 class="form-signin-heading text-center">Cambiar contraseña</h2>

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

                <div class="alert alert-danger" id="front-errors-container" style="display: none;"></div>

                <?php $this->load->view('partials/csrf'); ?>

                <input placeholder="Contraseña actual"
                       type="password" class="form-control" name="current_password" required />
                <input placeholder="Nueva contraseña"
                       type="password" class="form-control" name="new_password" required />
                <input placeholder="Confirmación contraseña"
                       type="password" class="form-control" name="password_confirmation" required />

                <button class="btn btn-lg btn-primary btn-block" type="submit">Cambiar</button>
                <?php $this->load->view('partials/button_back'); ?>
            </form>

        </div>


        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
                integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
                crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
                integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
                crossorigin="anonymous"></script>

        <script src="<?php echo base_url('assets/js/auth/password_reset.js'); ?>" ></script>
    </body>
</html>