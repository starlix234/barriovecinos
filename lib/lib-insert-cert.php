<?php
require_once("lib-conexion.php");

// Función para insertar una solicitud de certificado
function insertarSolicitudCertificado($id_usuario, $id_certificado, $motivo, $id_estado = 1) {
    global $conexion;

    $sql = "INSERT INTO solicitud_certificado (id_us, id_certi, id_estado, motivo)
            VALUES (?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        die("❌ Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("iiis", $id_usuario, $id_certificado, $id_estado, $motivo);

    if ($stmt->execute()) {
        return true;
    } else {
        error_log("❌ Error al insertar solicitud: " . $stmt->error);
        return false;
    }
}

// PROCESAR POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario     = $_POST['id_usuario'] ?? null;
    $id_certificado = $_POST['id_certificado'] ?? null;
    $motivo         = $_POST['motivo'] ?? '';
    $id_estado      = 1; // Siempre parte como "Pendiente"

    if ($id_usuario && $id_certificado && !empty($motivo)) {
        $resultado = insertarSolicitudCertificado($id_usuario, $id_certificado, $motivo, $id_estado);

        if ($resultado) {
            header("Location: ../solicitudes.php?msg=cert_solicitada");
            exit();
        } else {
            echo "❌ Ocurrió un error al guardar la solicitud.";
        }
    } else {
        echo "⚠️ Faltan campos obligatorios.";
    }
}
?>
