<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet"> 
	<link rel="stylesheet" href="css/estilos.css">
	<script defer src="fontawesome/all.js"></script>
    <title>Registrate</title>
</head>
<body>
    <div class="contenedor">
        <header>
            <h1>Registrate</h1>
        </header>
        <hr>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login">
            <input type="text" name="usuario" class="usuario" placeholder="Usuario">
            <input type="password" name="password" class="password" placeholder="Contraseña">
            <input type="password" name="password2" class="password_btn" placeholder="Repetir Contraseña">
            <button type="button" class="btn" onclick="login.submit()">Siguiente</button>
        </form>
        <?php if(!empty($errores)): ?>
            <div class="error error_box active">
                <ul>
                    <?php echo $errores ?>
                </ul>
            </div>
        <?php endif; ?>
        <p class="text-registrate">
            ¿Ya tienes cuenta?
            <a href="login.php">Iniciar Sesión</a>
        </p>
    </div>
</body>
</html>