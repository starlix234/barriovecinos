<?php
// 1. Iniciar sesión y cargar conexión
session_start();
require_once("lib-conexion.php");

// 2. Verificar que se envió por POST
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../proyectos.php");
    exit;
}

// 3. Verificar que el usuario esté logueado y sea Vecino (Rol 3)
if (!isset($_SESSION['id_us']) || !isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 3) {
    // Si no es Rol 3, lo sacamos (solo ellos pueden postular)
    header("Location: ../proyectos.php?error=no_permiso_postular");
    exit;
}

// 4. Obtener datos del formulario (ID del proyecto y del usuario)
if (!isset($_POST['id_proyecto']) || !isset($_POST['id_usuario'])) {
    header("Location: ../proyectos.php?error=faltan_datos");
    exit;
}
$id_proyecto = $_POST['id_proyecto'];
$id_usuario_postulante = $_POST['id_usuario'];

// 5. Seguridad: Verificar que el usuario que postula sea el mismo de la sesión
if ($id_usuario_postulante != $_SESSION['id_us']) {
    header("Location: ../proyectos.php?error=usuario_invalido");
    exit;
}

// 6. Preparar la consulta SQL para insertar en la tabla 'postulaciones'
//    La tabla tiene una restricción UNIQUE para evitar duplicados
//    (id_proyecto, id_usuario_postulante)
$sql = "INSERT INTO postulaciones (id_proyecto, id_usuario_postulante) VALUES (?, ?)";

$stmt = $conexion->prepare($sql);

// "ii" -> Integer, Integer
$stmt->bind_param("ii", $id_proyecto, $id_usuario_postulante);

// 7. Ejecutar y redirigir
if ($stmt->execute()) {
    // Éxito: Volver a la lista de proyectos con mensaje
    header("Location: ../proyectos.php?status=postulado");
} else {
    // Error: Probablemente intentó postular dos veces (error de UNIQUE key)
    // O podría ser otro error SQL
    if ($conexion->errno == 1062) { // Código de error para entrada duplicada
        header("Location: ../proyectos.php?error=ya_postulado");
    } else {
        header("Location: ../proyectos.php?error=sql_postular");
    }
}

// 8. Cerrar
$stmt->close();
$conexion->close();
?>