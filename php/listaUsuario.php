<?php

error_reporting(0);
header('Content-Type: application/json; charset=UTF-8');

$conexion = new mysqli('localhost', 'root', '', 'login');

if ($conexion->connect_errno) {
    $respuesta = [
        'error' => true
    ];
} else {
    $conexion->set_charset('utf8');
    $statement = $conexion->prepare("SELECT * FROM usuarios WHERE activo = 1");
    $statement->execute();
    $resultados = $statement->get_result();

    $respuesta = [];

    // Crea los arreglos para cada usuario
    while ($fila = $resultados->fetch_assoc()) {
        $usuario = [
            'id' => $fila['id'],
            'nombre' => $fila['nombre'],
            'edad' => $fila['edad'],
            'pais' => $fila['pais'],
            'correo' => $fila['correo']
        ];
        array_push($respuesta, $usuario);
    }
}

echo json_encode($respuesta);