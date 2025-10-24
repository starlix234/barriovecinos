<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once("lib-conexion.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../solicitudes.php"); 
    exit;
}

if (!isset($_SESSION['id_us']) || !isset($_SESSION['id_rol'])) {
    header("Location: ../login.php"); 
    exit;
}

if ($_SESSION['id_rol'] == 1) {
    header("Location: ../index.php"); 
    exit;
}

$id_usuario_solicita = $_POST['id_usuario_solicita'];
$tipo_solicitud = trim($_POST['tipo_solicitud']);
$asunto = trim($_POST['asunto']);
$descripcion = trim($_POST['descripcion']);

if ($id_usuario_solicita != $_SESSION['id_us']) {
    header("Location: ../solicitudes.php?status=error_permiso");
    exit;
}

$sql = "INSERT INTO solicitudes 
            (id_usuario_solicita, tipo_solicitud, asunto, descripcion, estado) 
        VALUES 
            (?, ?, ?, ?, 'Pendiente')";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("isss", $id_usuario_solicita, $tipo_solicitud, $asunto, $descripcion);

if ($stmt->execute()) {
    header("Location: ../solicitudes.php?status=ok");
} else {
    header("Location: ../solicitudes.php?status=error_sql");
}

$stmt->close();
$conexion->close();
?>