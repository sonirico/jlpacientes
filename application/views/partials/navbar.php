<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed"
        data-toggle="collapse"
        data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Teamanager</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="/players/"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Jugadores
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" >
            <li class="nav-item" >
              <a class="dropdown-item" href="/players/" >Listado jugadores</a>
            </li>
            <li class="nav-item" >
              <a class="dropdown-item" href="/players/create/">Alta jugador</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/offsicks/" >
            Bajas
            <!-- <span class="caret"></span> -->
          </a>
          <!-- <ul class="dropdown-menu" >
            <li class="nav-item" >
              <a class="dropdown-item" href="/offsicks/create/" >Nueva baja</a>
            </li>
          </ul> -->
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="/teams/"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Equipos
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" >
            <li class="nav-item" >
              <a class="dropdown-item" href="/teams/" >Listado equipos</a>
            </li>
            <li class="nav-item" >
              <a class="dropdown-item" href="/teams/create/" >Nuevo equipo</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right" >
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
            aria-haspopup="true" aria-expanded="false">
            <?php echo current_user()['username']; ?>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="<?php echo base_url('auth/password_reset'); ?>" >
                Cambiar contraseña
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">
                  Cerrar sesión
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
