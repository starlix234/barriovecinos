<?php 
//llamar base de datos 
require_once("lib-conexion.php");
//consultar a la base datos 
$sql = "Select id_pais,nombre from pais";
$consulta=$conexion->query($sql);
$fila=$consulta->num_rows;

//consultar provincia
$sql2="select * from provincia";
$consulta2=$conexion->query($sql2); 
$fila2=$consulta2->num_rows;

//consultar comuna
// 1. Definición de la consulta
$sql3 = "SELECT * FROM comuna";
$consulta3= $conexion->query($sql3); 
$fila3 = $consulta3->num_rows;

//consultar region 
//1.Definicion de la consulta de region 
$sql4 = "SELECT * FROM region";
$consulta4= $conexion->query($sql4); 
$fila4 = $consulta4->num_rows;


?>