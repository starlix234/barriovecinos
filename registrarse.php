<?php
// llamando librerias
include("lib/lib-datos-consulta-direccion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registrar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/login.css" rel="stylesheet">
</head>
<body>
    <form action="lib/lib-insertar-usuario.php" method="POST">
        <div class="formulario">
                <h2>Registro de usuario</h2>            
            <label for="nombre_completo">Nombre completo</label>
            <input type="text" id="nombre_completo" name="nombre_completo" required>
            
            <label for="rut">RUT</label>
            <input type="text" id="rut" name="rut" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="nombre_calle">Calle</label>
            <input type="text" id="nombre_calle" name="nombre_calle" required>
            
            <label for="numero_casa">Número de casa</label>
            <input type="text" id="numero_casa" name="numero_casa" required> 	

            <!-- País -->
            <label for="id_pais">País</label>
            <select name="id_pais" id="id_pais" required>
                <option value="" disabled selected>Seleccione un país...</option> 	 	
                <?php 
                if (isset($consulta) && $consulta->num_rows > 0) { 	 	
                    while ($fila = $consulta->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($fila['id_pais']); ?>">
                            <?php echo htmlspecialchars($fila['nombre']); ?>
                        </option>
                    <?php }
                } else { ?>
                    <option value="" disabled>No se encontraron países</option>
                <?php } ?>
            </select>

            <!-- Región -->
            <label for="id_region">Región</label>
            <select name="id_region" id="id_region" required>
                <option value="" disabled selected>Seleccione una región...</option>
                <?php
                if (isset($consulta4) && $consulta4->num_rows > 0) {
                    while ($row = $consulta4->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id_region']; ?>">
                            <?php echo $row['nombre_region']; ?>
                        </option>
                    <?php }
                } else { ?>
                    <option value="" disabled>No hay regiones disponibles</option>
                <?php } ?>
            </select>

            <!-- Provincia -->
            <label for="id_provincia">Provincia</label>
            <select name="id_provincia" id="id_provincia" required>
                <option value="" disabled selected>-- Elija una provincia --</option> 	 	
                <?php
                if (isset($consulta2) && $consulta2->num_rows > 0) {
                    while ($row = $consulta2->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id_provincia']; ?>">
                            <?php echo $row['nom_provincia']; ?>
                        </option>
                    <?php }
                } else { ?>
                    <option value="" disabled>No hay provincias disponibles</option>
                <?php } ?>
            </select>

            <!-- Comuna -->
            <label for="id_comuna">Comuna</label>
            <select name="id_comuna" id="id_comuna" required>
                <option value="" disabled selected>Elija una comuna...</option>
                <?php 
                if (isset($consulta3) && $consulta3->num_rows > 0) {
                    while ($row = $consulta3->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id_comuna']; ?>">
                            <?php echo $row['comuna']; ?>
                        </option>
                    <?php }
                } else { ?>
                    <option value="" disabled>No hay comunas disponibles</option>
                <?php } ?>
            </select>

            <label for="clave">Clave</label>
            <input type="password" id="clave" name="clave" required>
            
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" required> 	 	 	 

            <input type="submit" id="registrarse" name="registrarse" value="Registrarse">
        </div>
    </form>

    <?php
    if (isset($consulta)) $consulta->free();
    if (isset($consulta2)) $consulta2->free();
    if (isset($consulta3)) $consulta3->free();
    if (isset($consulta4)) $consulta4->free();
    ?>
</body>
</html>
