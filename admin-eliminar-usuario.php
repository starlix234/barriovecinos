<?php
//Cargar la sesión y la conexión
require_once("lib/lib-sesion-datos.php");

//Verificar que sea Rol 
if (!$usuario || $usuario['id_rol'] != 1) {
    header("Location: index.php");
    exit();
}

//Obtener el ID del usuario a eliminar (desde la URL)
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: Panel-admin.php?error=no_id");
    exit();
}
$id_usuario_a_eliminar = $_GET['id'];

//Un Admin no puede eliminar a otro Admin (Rol 1)
//(Aunque ya los filtramos, esta es una defensa extra)
$stmt_check = $conexion->prepare("SELECT id_rol FROM usuarios WHERE id_us = ?");
$stmt_check->bind_param("i", $id_usuario_a_eliminar);
$stmt_check->execute();
$res_check = $stmt_check->get_result();
$user_check = $res_check->fetch_assoc();

if (!$user_check || $user_check['id_rol'] == 1) {
    header("Location: Panel-admin.php?error=permiso_eliminar");
    exit();
}
$stmt_check->close();


//Lógica de borrado (¡IMPORTANTE!)
//Debemos borrar las solicitudes del usuario PRIMERO,
//debido a la 'Foreign Key' en la tabla 'solicitudes'.

try {
    // Iniciar una transacción (si algo falla, no se hace nada)
    $conexion->begin_transaction();

    $sql_solicitudes = "DELETE FROM solicitudes WHERE id_usuario_solicita = ?";
    $stmt_sol = $conexion->prepare($sql_solicitudes);
    $stmt_sol->bind_param("i", $id_usuario_a_eliminar);
    $stmt_sol->execute();
    $stmt_sol->close();

    $sql_usuario = "DELETE FROM usuarios WHERE id_us = ?";
    $stmt_us = $conexion->prepare($sql_usuario);
    $stmt_us->bind_param("i", $id_usuario_a_eliminar);
    $stmt_us->execute();
    $stmt_us->close();

    $conexion->commit();

    header("Location: Panel-admin.php?status=eliminado");

} catch (mysqli_sql_exception $exception) {
    $conexion->rollback();
    
    header("Location: Panel-admin.php?error=sql_eliminar");
}

$conexion->close();
?>