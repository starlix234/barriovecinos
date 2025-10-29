<?php
require_once("lib/lib-sesion-datos.php");
require_once("lib/lib-datos-usuario.php");

if (!$usuario || $usuario['id_rol'] != 1) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Panel de administrador</title>
</head>
<body>
<?php include("menu.php"); ?>
<div class="container mt-4">
    <h2>Panel de Administración</h2>
    <p>Bienvenido, <?= htmlspecialchars($usuario['nombre_completo']); ?>.</p>

    <div class="mb-4">
        <a href="panel-admin-agregar-usuario.php" class="btn btn-success btn-lg me-2">
            <i class="fas fa-user-plus"></i> Agregar Usuario
        </a>
        <a href="admin-ver-postulaciones.php" class="btn btn-info btn-lg me-2"> <i class="fas fa-users"></i> Ver Postulaciones
        </a>
        <a href="admin-aprobar-proyectos.php" class="btn btn-warning btn-lg">
            <i class="fas fa-clipboard-check"></i> Aprobar Proyectos
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">

            <h4>Gestión de Usuarios</h4>
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>RUT</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ( $result->num_rows > 0) {
                        while ($user = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= $user['id_us']; ?></td>
                                <td><?= htmlspecialchars($user['nombre_completo']); ?></td>
                                <td><?= htmlspecialchars($user['rut']); ?></td>
                                <td><?= htmlspecialchars($user['email']); ?></td>
                                <td><?= htmlspecialchars($user['rol']); ?></td>
                                <td>
                                    <a href="admin-editar-usuario.php?id=<?= $user['id_us']; ?>" class="btn btn-sm btn-primary">Editar</a>
                                    <a href="admin-eliminar-usuario.php?id=<?= $user['id_us']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar a este usuario? Esta acción no se puede deshacer.');">Eliminar</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No hay usuarios registrados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div> </div> </div> <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>