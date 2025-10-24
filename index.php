<?php 
require_once("lib/lib-sesion-datos.php"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="css/estilo-index.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <title>Bienvenido - MiBarrioAp</title>
</head>
<body>
<?php 
include("menu.php"); 
?>

<div class="container mt-5 mb-5">

    <div class="row mb-4">
        <div class="col-12 text-center">
            <?php if ($usuario): ?>
                <h1 class="display-4">¡Bienbenida/o, <?php echo htmlspecialchars(explode(' ', $usuario['nombre_completo'])[0]); ?>!</h1>
                <p class="lead fs-3">Bienvenido a este nuevo portal de la junta de vecinos de la cumuna "nom-comuna"</p>
            <?php else: ?>
                <h1 class="display-4">Bienvenido a MiBarrioAp</h1>
                <p class="lead fs-3">El portal digital de tu junta de vecinos. Por favor Inicie sesión para comenzar su nueva experiencia en tu junta de vecinos.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($usuario):  ?>

    <div class="row g-4 mb-5">
        
        <div class="col-lg-4 col-md-6">
            <a href="proyectos.php" class="card card-portal text-center shadow-sm">
                <div class="card-body p-4">
                    <i class="fas fa-tools"></i>
                    <h2 class="card-title">Proyectos</h2>
                    <p class="card-text">Revisa los proyectos y mejoras que se están realizando actualmente en tu comuna.</p>
                </div>
            </a>
        </div>

        <div class="col-lg-4 col-md-6">
            <a href="certificados.php" class="card card-portal text-center shadow-sm">
                <div class="card-body p-4">
                    <i class="fas fa-file-alt"></i>
                    <h2 class="card-title">Certificados</h2>
                    <p class="card-text">Solicita tu certificado de residencia y otros documentos aquí.</p>
                </div>
            </a>
        </div>
        
        <div class="col-lg-4 col-md-12"> <a href="solicitudes.php" class="card card-portal text-center shadow-sm">
                <div class="card-body p-4">
                    <i class="fas fa-bullhorn"></i>
                    <h2 class="card-title">Solicitudes</h2>
                    <p class="card-text">Reporta problemas, envía sugerencias o realiza solicitudes a la directiva.</p>
                </div>
            </a>
        </div>

    </div> <div class="row">
        <div class="col-12">
            <div class="seccion-anuncios">
                <h2 class="text-center mb-4"><i class="fas fa-bell"></i> Anuncios Importantes</h2>
                
                <div class="alert alert-info fs-5" role="alert">
                    <strong>Próxima Reunión:</strong> No olvides la asamblea de vecinos este <strong>Sábado 25 de Octubre a las 18:00 hrs</strong> en la sede.
                </div>
                
                <div class="alert alert-warning fs-5" role="alert">
                    <strong>Corte de Agua Programado:</strong> Se realizará un corte de agua por mantención el <strong>Lunes 27 de Octubre de 09:00 a 14:00 hrs</strong>.
                </div>

            </div>
        </div>
    </div> <?php endif;  ?>

</div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>