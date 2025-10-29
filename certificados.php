<?php
require_once("lib/lib-conexion.php");
require_once("lib/lib-sesion-datos.php");

$id_usuario_actual = $_SESSION['id_us'];

// Obtener lista de certificados
$certificados = $conexion->query("SELECT id_certi, nombre_certificado FROM tipo_certificado");

// Consultar las solicitudes del usuario actual
$solicitudes = $conexion->query("
  SELECT s.id_solicitud, t.nombre_certificado, e.tipo_estado, s.motivo, s.fecha_solicitud
  FROM solicitud_certificado s
  INNER JOIN tipo_certificado t ON s.id_certi = t.id_certi
  INNER JOIN estados e ON s.id_estado = e.id_estado
  WHERE s.id_us = $id_usuario_actual
  ORDER BY s.fecha_solicitud DESC
");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/estilo-index.css" rel="stylesheet">

  <title>Certificados - MiBarrioAp</title>
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">

  <div class="row g-5">
    <!-- FORMULARIO -->
    <div class="col-lg-6">
      <h1 class="display-5 mb-3">Solicitar un Certificado</h1>
      <p class="lead fs-4 mb-4">Selecciona un tipo de certificado y explica brevemente el motivo.</p>

      <form action="lib/lib-insert-cert.php" method="POST" class="seccion-anuncios">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario_actual; ?>">

        <div class="mb-4">
          <label class="form-label fs-5">Tipo de Certificado</label>
          <select class="form-select form-select-lg" name="id_certificado" required>
            <option value="" disabled selected>Selecciona un tipo...</option>
            <?php while($row = $certificados->fetch_assoc()): ?>
              <option value="<?php echo $row['id_certi']; ?>">
                <?php echo htmlspecialchars($row['nombre_certificado']); ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="mb-4">
          <label class="form-label fs-5">Motivo</label>
          <textarea name="motivo" class="form-control form-control-lg" rows="6" placeholder="¿Para qué necesitas este certificado?" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100 fs-4">Enviar Solicitud</button>
      </form>
    </div>

    <!-- HISTORIAL -->
    <div class="col-lg-6">
      <h2 class="display-6 mb-3">Mis Solicitudes de Certificados</h2>

      <div class="list-group">
        <?php if ($solicitudes && $solicitudes->num_rows > 0): ?>
          <?php while ($row = $solicitudes->fetch_assoc()): ?>
            <?php
              $color_estado = 'secondary';
              switch (strtolower($row['tipo_estado'])) {
                case 'pendiente': $color_estado = 'secondary'; break;
                case 'en revisión': $color_estado = 'warning text-dark'; break;
                case 'aprobado': $color_estado = 'success'; break;
                case 'rechazado': $color_estado = 'danger'; break;
                case 'completado': $color_estado = 'primary'; break;
                case 'cancelado': $color_estado = 'dark'; break;
              }
            ?>
            <div class="list-group-item list-group-item-action flex-column align-items-start mb-3 shadow-sm" style="border-radius: 10px; border-width: 2px;">
              <div class="d-flex w-100 justify-content-between">
                <h4 class="mb-1"><?php echo htmlspecialchars($row['nombre_certificado']); ?></h4>
                <small class="text-muted"><?php echo date('d-m-Y', strtotime($row['fecha_solicitud'])); ?></small>
              </div>
              <p class="mb-1 fs-5"><strong>Motivo:</strong> <?php echo htmlspecialchars($row['motivo']); ?></p>
              <span class="badge bg-<?php echo $color_estado; ?> fs-6"><?php echo htmlspecialchars($row['tipo_estado']); ?></span>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="fs-5 text-muted">Aún no has solicitado certificados.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
