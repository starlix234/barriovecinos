<?php require('lib-conexion.php');?>
<?php if(!isset($_SESSION))session_start();?>
<?php
	if((isset($_POST['rut']) && $_POST['rut']<>"") && (isset($_POST['clave']) && $_POST['clave']<>"") ){
	    $query="SELECT * FROM usuarios WHERE 1 AND rut='$_POST[rut]' AND clave='$_POST[clave]'";
		$resource=$conexion->query($query);
		if($t=$resource->num_rows){
		$row=$resource->fetch_assoc();
        $_SESSION['id_us']=$row['id_us'];
	    $_SESSION["id_rol"]=$row['id_rol'];        
        header('Location:../index.php');
        
       
		
	}else  { 
        $error="Usuario/Clave no registrados";
        echo "<span class='error'>".$error."</span>";
        //header('Location:../vista/.php?wrong='.$error);
		
	}
}
?>