<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" 
    data-toggle="collapse" data-target="#navbarNavDropdown" 
    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    
  <a class="navbar-brand" href="/">JLPacientes</a>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="/players/" 
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Jugadores
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
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="/offsicks/" 
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Bajas
        </a>
        <ul class="dropdown-menu" >
          <li class="nav-item" >
            <a class="dropdown-item" href="/offsicks/create/" >Nueva baja</a>
          </li>          
        </ul>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="/teams/" 
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Equipos
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
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" 
          id="user-actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo current_user()['username']; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-actions">
          <a class="dropdown-item" href="#">Cambiar contraseña</a>
          <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">
              Cerrar sesión
          </a>
        </div>
      </li>
    </ul>
  </div>
</nav>