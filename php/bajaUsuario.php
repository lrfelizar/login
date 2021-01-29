<?php

error_reporting(0);
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $conexion = new mysqli('localhost', 'root', '', 'login');

    if ( $conexion->connect_errno ) {

        $respuesta = [ 'error' => true ];

    } else {

        $conexion->set_charset('utf8');
        $statement = $conexion->prepare("UPDATE usuarios SET activo = 0 WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();

        if ( $conexion->affected_rows <= 0 ) {

            $respuesta = ['error' => true];

        }

        $respuesta = [];
    }

    echo json_encode($respuesta);

} else {

    $respuesta = ['error' => true];

}