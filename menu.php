<?php
require_once("lib/lib-sesion-datos.php");

$current_page = basename($_SERVER['PHP_SELF']);

$panel = panelPorRol($usuario['id_rol'] ?? null);
$es_panel_admin = ($panel && $current_page == 'Panel-admin.php');

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">MiBarrioAp</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'proyectos.php' || $current_page == 'crear-proyecto.php') ? 'active' : ''; ?>" href="proyectos.php">Proyectos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'certificados.php') ? 'active' : ''; ?>" href="certificados.php">Certificados</a>
        </li>
        <?php
        if ($usuario && $usuario['id_rol'] != 1):
        ?>
            <li class="nav-item">
              <a class="nav-link <?= ($current_page == 'solicitudes.php') ? 'active' : ''; ?>" href="solicitudes.php">Solicitudes</a>
            </li>
        <?php endif; ?>

        <?php
        if ($panel):
        ?>
            <li class="nav-item">
              <a class="nav-link <?= ($es_panel_admin ) ? 'active' : ''; ?>" href="<?= htmlspecialchars($panel[0]); ?>">
                <?= htmlspecialchars($panel[1]); ?>
              </a>
            </li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if ($usuario): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user me-1"></i> <?= htmlspecialchars($usuario['nombre_completo']); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
              <li><a class="dropdown-item" href="perfil.php">Mi Perfil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'login.php') ? 'active' : ''; ?>" href="login.php">Iniciar sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'registrarse.php') ? 'active' : ''; ?>" href="registrarse.php">Registrarse</a>
          </li>
        <?php endif; ?>
      </ul>

    </div> </div> </nav>

<style>
.navbar-nav .nav-link.active {
  font-weight: bold;
  color: #0d6efd !important; 
}
</style>