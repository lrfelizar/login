<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
	<link rel="stylesheet" href="css/estilos.css">
    <link rel="shortcut icon" href="img/icon.png">
</head>
<body>
    <div class="contenedor">
        <header>
            <h1>Iniciar Sesión</h1>
        </header>
        <hr>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login">
            <input type="text" name="usuario" class="usuario" placeholder="Usuario">
            <input type="password" name="password" class="password_btn" placeholder="Contraseña">
            <button type="button" class="btn" onclick="login.submit()">Siguiente</button>            
        </form>
        <?php if(!empty($errores)): ?>
            <div class="error error_box active">
                <ul>
                    <?php echo $errores ?>
                </ul>
            </div>
        <?php endif; ?>
        <br>
        <p class="text-registrate">
            ¿Aún no tienes cuenta?
            <a href="registrate.php">Registrate</a>
        </p>
    </div>
</body>
</html>