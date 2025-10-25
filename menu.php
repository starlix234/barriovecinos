<?php
// Asegura que las variables del usuario estén disponibles
require_once("lib/lib-sesion-datos.php");

// Detectar la página actual
$current_page = basename($_SERVER['PHP_SELF']);
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
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'index.php') ? 'active fw-bold text-primary' : ''; ?>" href="index.php">Inicio</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'proyectos.php') ? 'active fw-bold text-primary' : ''; ?>" href="">Proyectos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'certificados.php') ? 'active fw-bold text-primary' : ''; ?>" href="certificados.php">Certificados</a>
        </li>

        <?php 
        // Mostramos "Solicitudes" SOLO si el usuario NO es Admin (Rol 1)
        if ($usuario && $usuario['id_rol'] != 1): 
        ?>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'solicitudes.php') ? 'active fw-bold text-primary' : ''; ?>" href="solicitudes.php">Solicitudes</a>
          </li>
        <?php endif; ?>

        <!-- Solo si hay sesión iniciada -->
        <?php if ($usuario): ?>       

          <!-- Panel según rol -->
          <?php if ($panel): ?>
            <li class="nav-item">
              <a class="nav-link <?= ($current_page == basename($panel[0])) ? 'active fw-bold text-primary' : ''; ?>" 
                 href="<?= htmlspecialchars($panel[0], ENT_QUOTES, 'UTF-8'); ?>">
                <?= htmlspecialchars($panel[1], ENT_QUOTES, 'UTF-8'); ?>
              </a>
            </li>             

            <li class="nav-item">
              <a class="nav-link <?= ($current_page == '') ? 'active fw-bold text-primary' : ''; ?>" href="perfil.php">
                <?= htmlspecialchars($usuario['nombre_completo'], ENT_QUOTES, 'UTF-8'); ?>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="logout.php">Cerrar Sesión</a>
            </li>

          <?php endif; ?>

        <?php endif; ?>
      </ul>

      <ul class="navbar-nav">
        <?php if ($usuario): ?>
          <!-- Navbar cuando el usuario está logueado -->
          <li class="nav-item dropdown">
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usuarioDropdown">
              <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
            </ul>
          </li>
        <?php else: ?>
          <!-- Navbar cuando NO hay sesión -->
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'login.php') ? 'active fw-bold text-primary' : ''; ?>" href="login.php">Iniciar sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'registrarse.php') ? 'active fw-bold text-primary' : ''; ?>" href="registrarse.php">Registrarse</a>
          </li>
        <?php endif; ?>
      </ul>

    </div>
  </div>
</nav>

<style>
/* 💅 Estilo elegante para resaltar la página activa */
.nav-link.active {
  border-bottom: 2px solid #a788ff;
  color: #a788ff !important;
  transition: all 0.3s ease-in-out;
}

/* Pequeño efecto al pasar el mouse */
.nav-link:hover {
  color: #c2a5ff !important;
  transform: translateY(-1px);
}
</style>
