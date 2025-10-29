<?php
require_once("lib/lib-sesion-datos.php");

if (!$usuario) {
    header("Location: login.php");
    exit;
}

$id_usuario_actual = $usuario['id_us'];
$rol_usuario_actual = $usuario['id_rol'];

// 🔹 Solo muestra proyectos con estado aprobado (id_estado = 2)
$sql_proyectos = "SELECT 
    p.titulo,
    p.descripcion,
    DATE_FORMAT(p.fecha_publicacion, '%d/%m/%Y') AS fecha_publicacion,
    DATE_FORMAT(p.fecha_inicio, '%d/%m/%Y') AS fecha_inicio,
    DATE_FORMAT(p.fecha_fin, '%d/%m/%Y') AS fecha_fin,
    u.nombre_completo AS creador_nombre,
    e.tipo_estado AS estado,
    DATE_FORMAT(p.fecha_creacion, '%d/%m/%Y %H:%i') AS fecha_creacion
FROM proyectos p
JOIN usuarios u ON p.id_usuario_creador = u.id_us
JOIN estados e ON p.id_estado = e.id_estado
WHERE p.id_estado = 3
ORDER BY p.fecha_creacion DESC";

$resultado_proyectos = $conexion->query($sql_proyectos);

if (!$resultado_proyectos) {
    die("Error al consultar proyectos: " . $conexion->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos Publicados - MiBarrioAp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo-index.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<?php include("menu.php"); ?>

<div class="container mt-5 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5">📢 Proyectos Publicados</h1>
        <?php if ($rol_usuario_actual == 1 || $rol_usuario_actual == 2): ?>
            <a href="crear-proyecto.php" class="btn btn-primary btn-lg shadow-sm">
                <i class="fas fa-plus"></i> Crear Nuevo Proyecto
            </a>
        <?php endif; ?>
    </div>

    <hr class="mb-4">

    <?php if ($resultado_proyectos->num_rows > 0): ?>
        <?php while ($proyecto = $resultado_proyectos->fetch_assoc()): ?>
            <?php
                $titulo = isset($proyecto['titulo']) ? htmlspecialchars($proyecto['titulo']) : 'Sin título';
                $descripcion = isset($proyecto['descripcion']) ? nl2br(htmlspecialchars($proyecto['descripcion'])) : 'Sin descripción';
                $creador = isset($proyecto['creador_nombre']) ? htmlspecialchars($proyecto['creador_nombre']) : 'Desconocido';
                $fecha_inicio = !empty($proyecto['fecha_inicio']) ? $proyecto['fecha_inicio'] : 'No definida';
                $fecha_fin = !empty($proyecto['fecha_fin']) ? $proyecto['fecha_fin'] : 'No definida';
                $estado = isset($proyecto['estado']) ? htmlspecialchars($proyecto['estado']) : 'Publicado';
            ?>
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <span class="badge bg-success mb-2 px-3 py-2 shadow-sm"><?= $estado; ?></span>
                    <h3 class="card-title mb-2 text-primary">
                        <i class="fa-solid fa-bullhorn"></i> <?= $titulo; ?>
                    </h3>
                    <p class="text-muted small mb-3">
                        Publicado por <strong><?= $creador; ?></strong> |
                        Inicio: <?= $fecha_inicio; ?> | Fin: <?= $fecha_fin; ?>
                    </p>
                    <p class="card-text fs-5 text-dark"><?= $descripcion; ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="alert alert-info text-center mt-5 shadow-sm">
            <i class="fas fa-info-circle"></i> No hay proyectos publicados aún.
        </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
