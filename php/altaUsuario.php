<?php
include __DIR__.'\config.php';

error_reporting(0);
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $edad = (int)$_POST['edad'];
    $pais = $_POST['pais'];
    $correo = $_POST['correo'];

    
        $nombre = trim(filter_var(($nombre), FILTER_SANITIZE_STRING));
        $edad = trim(filter_var(($edad), FILTER_SANITIZE_NUMBER_INT));
        $pais = trim(filter_var(($pais), FILTER_SANITIZE_STRING));
        $correo = trim(filter_var(($correo), FILTER_SANITIZE_EMAIL)); 
        
        if (
            ( !empty($nombre) && !empty($edad) && !empty($pais) && !empty($correo) ) 
            &&
            ( strlen($nombre) <= 120 && strlen($pais) <= 50 && strlen($correo) <= 120 && strlen($edad) <= 3)
        ){

            $conexion = new mysqli(DB_ENVIROMENT, DB_USER, DB_PASS, DB_NAME);
        
            if ($conexion->connect_errno) {
                $respuesta = [ 'error' => true ];
            } else {
                $conexion->set_charset('utf8');
                $statement = $conexion->prepare("INSERT INTO usuarios(nombre, edad, pais, correo) VALUES(?,?,?,?)");
                $statement->bind_param("siss", $nombre, $edad, $pais, $correo);
                $statement->execute();
        
                if ($conexion->affected_rows <= 0) {
                    $respuesta = ['error' => true];
                }
        
                $respuesta = [];
            }

        } else {
            $respuesta = ['error' => true];
        }

    //true si hay error o null si es correcto
    echo json_encode($respuesta);

} else {

    $respuesta = ['error' => true];

}
