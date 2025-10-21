
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>


  <div class="login-container">
    <div class="login-card">
      <div class="avatar">
        <i class="fa fa-user"></i>
      </div>

      <form action="lib/lib-login.php" method="POST">
        <div class="input-group">
          <i class="fa fa-envelope"></i>
          <input type="text" name="rut" placeholder="Rut" required>
        </div>

        <div class="input-group">
          <i class="fa fa-lock"></i>
          <input type="password" name="clave" placeholder="Password" required>
        </div>

        <div class="options">
          <label>
            <input type="checkbox"> Remember me
          </label>
          <a href="#">Forgot Password?</a>
        </div>

        <button type="submit" class="btn-login">LOGIN</button>

        <?php if (isset($_GET['error'])): ?>
          <p class="error-msg"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
      </form>
    </div>
  </div>

</body>
</html>
