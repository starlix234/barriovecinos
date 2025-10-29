<?php
session_start();
require_once("lib-conexion.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../admin-aprobar-proyectos.php");
    exit;
}

if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_POST['id_proyecto']) || !isset($_POST['nuevo_estado'])) {
    header("Location: ../admin-aprobar-proyectos.php?error=faltan_datos");
    exit;
}
$id_proyecto = $_POST['id_proyecto'];
$nuevo_estado = $_POST['nuevo_estado'];

if ($nuevo_estado != 'Aprobado' && $nuevo_estado != 'Rechazado') {
    header("Location: ../admin-aprobar-proyectos.php?error=estado_invalido");
    exit;
}

$sql = "UPDATE proyectos SET estado_proyecto = ? WHERE id_proyecto = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    header("Location: ../admin-aprobar-proyectos.php?error=sql_prepare");
    exit();
}

$stmt->bind_param("si", $nuevo_estado, $id_proyecto);

if ($stmt->execute()) {
    header("Location: ../admin-aprobar-proyectos.php?status=ok");
} else {
    header("Location: ../admin-aprobar-proyectos.php?error=sql_execute");
}

$stmt->close();
$conexion->close();
?>