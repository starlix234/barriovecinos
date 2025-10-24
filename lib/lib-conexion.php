<?php
//declarar varaibles 
$servidor="localhost";
$usuario="root"; 
$password="";
$database="barrio";

$conexion= new mysqli($servidor,$usuario,$password,$database);

if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

// Buena práctica: añadir esto para tildes y eñes
$conexion->set_charset("utf8"); 

?>