<?php
//declarar varaibles 
$servidor="localhost";
$usuario="vecino2"; 
$password="1234";
$database="barrio";

$conexion= new mysqli($servidor,$usuario,$password,$database);

if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}


?>