<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Iniciar sesión</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="noindex,nofollow"/>
        <meta name="<?= $this->security->get_csrf_token_name(); ?>" content="<?= $this->security->get_csrf_hash(); ?>"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
              integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url('/assets/lib/font-awesome-4.7.0/css/font-awesome.css'); ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('/assets/css/common.css'); ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('/assets/css/auth/login.css'); ?>"/>

    </head>
    <body>

        <div class="container">



            <form class="form-signin"
                  action="<?php echo base_url('auth/login'); ?>" method="post" >
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

                <label for="email" class="sr-only">Email o usuario</label>

                <?php if (isset($username)): ?>
                    <input placeholder="Usuario o email"
                           type="text" class="form-control" name="username"
                           value="<?php echo $username; ?>" required />
                <?php else: ?>
                    <input placeholder="Usuario o email"
                           type="text" class="form-control" name="username"
                           value="<?php echo set_value('username');?>" required />
                <?php endif; ?>

                <?php if (isset($password)): ?>
                    <input placeholder="Contraseña"
                           type="password" class="form-control" name="password"
                           value="<?php echo $password; ?>" required />
                <?php else: ?>
                    <input placeholder="Contraseña"
                           type="password" class="form-control" name="password"
                           value="<?php echo set_value('password');?>" required />
                <?php endif; ?>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember-me" value="1" >
                        Recordarme
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>
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

        <script>

            $(function () {
                $('[name="username"]').focus();
            });

        </script>
    </body>
</html>