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
        <link href="css/estilo.css" rel="stylesheet">
    </head> 	
    <body>
        <h2>Registro de usuario</h2>
        <form>
            <div class="formulario">
                
                <label for="nombre_completo">Nombre completo</label>
                <input type="text" id="nombre_completo" name="nombre_completo" required>
                
                <label for="rut">rut</label>
                <input type="text" id="rut" name="rut" required>
                
                <label for="email">email</label>
                <input type="text" id="email" name="email" required>
                
                <label for="nombre_calle">calle</label>
                <input type="text" id="nombre_calle" name="nombre_calle" required>
                
                <label for="numero_casa">numero_casa</label>
                <input type="text" id="numero_casa" name="numero_casa" required> 	
                
                <label for="id_pais">País</label>
                <select name="id_pais" id="id_pais" required>
                    <option value="" disabled selected>Seleccione un país...</option> 	 	
                    <?php 
                    if (isset($consulta) && $consulta->num_rows > 0) { 	 	
                        while ($fila = $consulta->fetch_assoc()) {
                            ?>
                            <option value="<?php echo htmlspecialchars($fila['id_pais']); ?>">
                                <?php echo htmlspecialchars($fila['nombre']); ?>
                            </option>
                            <?php
                        } 
                    } else {
                        ?>
                        <option value="" disabled>No se encontraron países</option>
                        <?php
                    }
                    ?>
                </select>

                <label for="select_provincia">Provincia</label>
                <select name="id_provincia" id="select_provincia" required>
                    <option value="" disabled selected>-- Elija una Provincia --</option> 	 	
                    <?php
                    if (isset($consulta2) && $consulta2->num_rows > 0) {
                        while ($row = $consulta2->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['id_provincia']; ?>">
                                <?php echo $row['nom_provincia']; ?>
                            </option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="" disabled>No hay datos disponibles</option>
                        <?php
                    }
                    ?>
                </select>
                
                <label for="select_comuna">Comuna</label>
                <select name="id_comuna" id="select_comuna" required>
                    <option value="" disabled selected>Elige la comuna</option>
                    
                    <?php 
                    if (isset($consulta3) && $consulta3->num_rows > 0) {
                        while ($row = $consulta3->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['id_comuna']; ?>">
                                <?php echo $row['comuna']; ?>
                            </option>
                            <?php
                        } 
                    } else {
                        ?>
                        <option value="" disabled>No hay comunas disponibles</option>
                        <?php
                    }
                    ?>
                </select>

                <label for="clave">clave</label>
                <input type="password" id="clave" name="clave" required>
                
                <label for="fecha_nacimiento">Fecha nacimiento</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                
                <label for="telefono">telefono</label>
                <input type="text" id="telefono" name="telefono" required> 	 	 	 
                
                <input type="submit" id="registrarse" name="registrarse" 	value="Registrarse" required>
            </div>
        </form>
        
        <?php
        // Liberación de recursos
        if (isset($consulta)) { $consulta->free(); }
        if (isset($consulta2)) { $consulta2->free(); }
        if (isset($consulta3)) { $consulta3->free(); }
        ?>
    </body>
</html>