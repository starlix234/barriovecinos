<?php 

require_once("lib/lib-sesion-datos.php"); 


if (!$usuario) {
    header("Location: login.php");
    exit;
}

if ($usuario['id_rol'] == 1) {
    header("Location: Panel-admin.php");
    exit;
}



$mensaje = "";
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'ok') {
        $mensaje = "<div class='alert alert-success fs-5'>¡Solicitud enviada con éxito!</div>";
    } else {
        $mensaje = "<div class='alert alert-danger fs-5'>Hubo un error al enviar tu solicitud.</div>";
    }
}

$id_us_actual = $usuario['id_us'];
$sql_historial = "SELECT asunto, tipo_solicitud, estado, fecha_creacion 
                  FROM solicitudes 
                  WHERE id_usuario_solicita = ? 
                  ORDER BY fecha_creacion DESC";

$stmt_historial = $conexion->prepare($sql_historial);
$stmt_historial->bind_param("i", $id_us_actual);
$stmt_historial->execute();
$resultado_historial = $stmt_historial->get_result();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo-index.css" rel="stylesheet"> <title>Solicitudes - MiBarrioAp</title>
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">

    <div class="row g-5">
    
        <div class="col-lg-6">
            <h1 class="display-5 mb-3">Enviar una Solicitud</h1>
            <p class="lead fs-4 mb-4">Reporta un problema, envía una sugerencia o realiza una consulta a la directiva.</p>
            
            <?php echo $mensaje; ?>

            <form action="lib/lib-insertar-solicitud.php" method="POST" class="seccion-anuncios">
                
                <input type="hidden" name="id_usuario_solicita" value="<?php echo $usuario['id_us']; ?>">

                <div class="mb-4">
                    <label for="tipo_solicitud" class="form-label fs-5">Tipo de Solicitud</label>
                    <select class="form-select form-select-lg" id="tipo_solicitud" name="tipo_solicitud" required>
                        <option value="" disabled selected>Selecciona una categoría...</option>
                        <option value="Problema">Reportar un Problema (Ej: Luz quemada, fuga de agua)</option>
                        <option value="Sugerencia">Enviar una Sugerencia (Ej: Poner una banca)</option>
                        <option value="Consulta">Consulta General (Ej: Próxima reunión)</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="asunto" class="form-label fs-5">Asunto</label>
                    <input type="text" class="form-control form-control-lg" id="asunto" name="asunto" placeholder="Un resumen breve de tu solicitud" required>
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="form-label fs-5">Descripción Detallada</label>
                    <textarea class="form-control form-control-lg" id="descripcion" name="descripcion" rows="6" placeholder="Por favor, entrega todos los detalles aquí..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 fs-4">Enviar Solicitud</button>
            </form>
        </div>

        <div class="col-lg-6">
            <h2 class="display-6 mb-3">Mis Solicitudes Anteriores</h2>
            
            <div class="list-group">
                <?php if ($resultado_historial->num_rows > 0): ?>
                    <?php while($solicitud = $resultado_historial->fetch_assoc()): ?>
                        <div class="list-group-item list-group-item-action flex-column align-items-start mb-3 shadow-sm" style="border-radius: 10px; border-width: 2px;">
                            <div class="d-flex w-100 justify-content-between">
                                <h4 class="mb-1"><?php echo htmlspecialchars($solicitud['asunto']); ?></h4>
                                <small class="text-muted"><?php echo date('d-m-Y', strtotime($solicitud['fecha_creacion'])); ?></small>
                            </div>
                            <p class="mb-1 fs-5"><strong>Categoría:</strong> <?php echo htmlspecialchars($solicitud['tipo_solicitud']); ?></p>
                            
                            <?php 
                                $color_estado = 'secondary'; 
                                if ($solicitud['estado'] == 'Resuelta') $color_estado = 'success';
                                if ($solicitud['estado'] == 'En Progreso') $color_estado = 'warning text-dark';
                            ?>
                            <span class="badge bg-<?php echo $color_estado; ?> fs-6"><?php echo $solicitud['estado']; ?></span>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="fs-5 text-muted">Aún no has enviado ninguna solicitud.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>