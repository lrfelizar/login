<?php
include __DIR__.'\config.php';

error_reporting(0);
header('Content-Type: application/json; charset=UTF-8');

$id = $_POST['id'];
$conexion = new mysqli(DB_ENVIROMENT, DB_USER, DB_PASS, DB_NAME);

if ( $conexion->connect_errno ) {

    $respuesta = [
        'error' => true
    ];

} else {
    
    $conexion->set_charset('utf8');
    $statement = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
    $statement->bind_param("i", $id);
    $statement->execute();
    $resultados = $statement->get_result(); // va a devolver el registro del usuario o false si no existe

    // Crea los arreglos para cada usuario
    $fila = $resultados->fetch_assoc();
    $usuario = [
        'id' => $fila['id'],
        'nombre' => $fila['nombre'],
        'edad' => $fila['edad'],
        'pais' => $fila['pais'],
        'correo' => $fila['correo']
    ];
    $respuesta = $usuario;
    
}

echo json_encode($respuesta);