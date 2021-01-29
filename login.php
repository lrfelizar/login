<?php session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
} 

$errores = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario   = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    $password  = $_POST['password'];
    $password = hash('sha512', $password);

    try {
        $conexion = new PDO('mysql:host=localhost;dbname=login', 'root', '');
    } catch (PDPException $e) {
        echo "Error: " . $e->getMessage();
    }

    $statement = $conexion->prepare('SELECT * FROM sesiones WHERE usuario = :usuario AND contrasena = :contrasena');
    $statement->execute(array(':usuario' => $usuario, ':contrasena' => $password));
    $resultado = $statement->fetch(); // va a devolver el registro del usuario o false si no existe

    if ($resultado !== false) {
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php');
    } else {
        $errores .= '<li>Datos incorrectos</li>';
    }
    
}

require 'views/login.view.php';

?>