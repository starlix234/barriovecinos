
<?php
// Asegura que las variables del usuario estén disponibles
require_once("lib/lib-sesion-datos.php");
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">MiBarrioAp</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Secciones comunes -->
        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="proyectos.php">Proyectos</a></li>
        <li class="nav-item"><a class="nav-link" href="certificados.php">Certificados</a></li>
        <li class="nav-item"><a class="nav-link" href="solicitudes.php">Solicitudes</a></li>
        <!-- Solo si hay sesión iniciada -->
        <?php if ($usuario): ?>       

          <!-- Panel según rol -->
          <?php if ($panel): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= htmlspecialchars($panel[0], ENT_QUOTES, 'UTF-8'); ?>">
                <?= htmlspecialchars($panel[1], ENT_QUOTES, 'UTF-8'); ?>
              </a>
              <a class="nav-link" href="logout.php">Cerrar Sesion</a>
            </li>
          <?php endif; ?>

        <?php endif; ?>
      </ul>
      <ul class="navbar-nav">
        <?php if ($usuario): ?>
          <!-- Navbar cuando el usuario está logueado -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-bs-toggle="dropdown">
              <?= htmlspecialchars($usuario['nombre_completo'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usuarioDropdown">
              <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
            </ul>
          </li>
        <?php else: ?>
          <!-- Navbar cuando NO hay sesión -->
          <li class="nav-item"><a class="nav-link" href="login.php">Iniciar sesión</a></li>
          <li class="nav-item"><a class="nav-link" href="registro.php">Registrarse</a></li>
        <?php endif; ?>
      </ul>

    </div>
  </div>
</nav>
