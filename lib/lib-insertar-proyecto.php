<?php
session_start();
require_once("lib-conexion.php");

// Evita accesos directos
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../proyectos.php");
    exit;
}

// Verifica permisos (solo admin o moderador)
if (!isset($_SESSION['id_us']) || !isset($_SESSION['id_rol']) || 
    ($_SESSION['id_rol'] != 1 && $_SESSION['id_rol'] != 2)) {
    header("Location: ../proyectos.php?error=no_permiso");
    exit;
}

// Captura de datos del formulario
$id_usuario_creador = intval($_POST['id_usuario_creador']);
$titulo = trim($_POST['titulo']);
$descripcion = trim($_POST['descripcion']);
$fecha_inicio = !empty($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : date('Y-m-d'); 
$fecha_fin = !empty($_POST['fecha_fin']) ? $_POST['fecha_fin'] : NULL;

// Estado inicial por defecto: 1 = "Pendiente"
$id_estado = 1;

// Validación de seguridad
if ($id_usuario_creador != $_SESSION['id_us']) {
    header("Location: ../proyectos.php?error=creador_invalido");
    exit;
}

// Inserta en la base de datos
$sql = "INSERT INTO proyectos 
        (titulo, descripcion, fecha_inicio, fecha_fin, id_usuario_creador, id_estado)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssii", 
    $titulo, 
    $descripcion, 
    $fecha_inicio, 
    $fecha_fin, 
    $id_usuario_creador, 
    $id_estado
);

// Ejecuta y verifica
if ($stmt->execute()) {
    header("Location: ../proyectos.php?status=creado");
} else {
    error_log("Error SQL: " . $stmt->error);
    header("Location: ../proyectos.php?error=sql_insertar");
}

// Limpieza
$stmt->close();
$conexion->close();
?>
