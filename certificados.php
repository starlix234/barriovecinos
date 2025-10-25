
<?php
require_once("lib/lib-conexion.php");

require_once("lib/lib-sesion-datos.php");

// Suponiendo que tienes el ID del usuario logueado
$id_usuario_actual = $_SESSION['id_us']; // ajusta esto si usas otro nombre de sesión

// Obtener lista de certificados disponibles
$certificados = $conexion->query("SELECT id_certi, nombre_certificado FROM tipo_certificado");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <?php include("menu.php")?>
    
    <div class="container mt-5 mb-5">
  <div class="row g-5">
  
    <!-- FORMULARIO: Solicitar Certificado -->
    <div class="col-lg-6">
      <h1 class="display-5 mb-3">Solicitar un Certificado</h1>
      <p class="lead fs-4 mb-4">Selecciona un tipo de certificado y entrega una breve justificación.</p>

      <form action="lib/lib-insert-cert.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario_actual; ?>">

        <div class="mb-3">
          <label class="form-label">Tipo de Certificado</label>
          <select class="form-select" name="id_certificado" required>
            <option value="">Selecciona un tipo...</option>
            <?php while($row = $certificados->fetch_assoc()): ?>
              <option value="<?php echo $row['id_certi']; ?>">
                <?php echo $row['nombre_certificado']; ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Motivo</label>
          <textarea name="motivo" class="form-control" rows="4" placeholder="¿Para qué necesitas este certificado?" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
      </form>
    </div>

    <!-- LATERAL: Historial de solicitudes -->
    <div class="col-lg-6">
      <h2 class="mb-3">Mis Solicitudes de Certificado</h2>
      <p class="text-muted">Aún no has solicitado certificados.</p>
      <!-- Aquí puedes mostrar una tabla si ya hay registros -->
    </div>

  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>