<?php
require('lib-conexion.php');
if (!isset($_SESSION)) session_start();

// ADVERTENCIA: Este código es vulnerable a Inyección SQL.
if ((isset($_POST['rut']) && $_POST['rut'] != "") && (isset($_POST['clave']) && $_POST['clave'] != "")) {
    
    // Obtenemos los datos (¡de forma insegura!)
    $rut = $_POST['rut'];
    $clave = $_POST['clave'];

    // Creamos la consulta vulnerable original
    $query = "SELECT * FROM usuarios WHERE rut='$rut' AND clave='$clave'";
    
    $resource = $conexion->query($query);
    
    if ($resource && $resource->num_rows == 1) {
        // ¡Usuario encontrado!
        $row = $resource->fetch_assoc();
        $_SESSION['id_us'] = $row['id_us'];
        $_SESSION["id_rol"] = $row['id_rol'];
        
        // Redirigir al index.php
        header('Location: ../index.php');
        exit;

    } else {
        // Error: RUT o clave incorrecta
        header('Location: ../login.php?error=1');
        exit;
    }
} else {
    // Error: Campos vacíos
    header('Location: ../login.php?error=2');
    exit;
}
?>