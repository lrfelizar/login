<?php
include __DIR__.'\config.php';

error_reporting(0);
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = (int)$_POST['id'];
    $nombre = $_POST['nombre'];
    $edad = (int)$_POST['edad'];
    $pais = $_POST['pais'];
    $correo = $_POST['correo'];

    // Limpia los datos
    $id = trim(filter_var(($id), FILTER_SANITIZE_NUMBER_INT));
    $nombre = trim(filter_var(($nombre), FILTER_SANITIZE_STRING));
    $edad = trim(filter_var(($edad), FILTER_SANITIZE_NUMBER_INT));
    $pais = trim(filter_var(($pais), FILTER_SANITIZE_STRING));
    $correo = trim(filter_var(($correo), FILTER_SANITIZE_EMAIL));

    if (

        (!empty($id) &&!empty($nombre) && !empty($edad) && !empty($pais) && !empty($correo))
        &&
        (strlen($id) <= 11 && strlen($nombre) <= 120 && strlen($pais) <= 50 && strlen($correo) <= 120 && strlen($edad) <= 3)

    ) {
        $conexion = new mysqli(DB_ENVIROMENT, DB_USER, DB_PASS, DB_NAME);

        if ($conexion->connect_errno) {

            $respuesta = [
                'error' => true
            ];

        } else {

            $conexion->set_charset('utf8');
            $statement = $conexion->prepare(
                "UPDATE usuarios 
                SET nombre = ?, edad = ?, pais = ?, correo = ? 
                WHERE id = ?"
            );
            $statement->bind_param("sissi", $nombre, $edad, $pais, $correo, $id);
            $statement->execute();

            if ( $conexion->affected_rows <= 0 ) {

                $respuesta = ['error' => true];

            }

            $respuesta = [];
            
        }

    } else {

        $respuesta = ['error' => true];

    }

    echo json_encode($respuesta);

} else {

    $respuesta = ['error' => true];

}
