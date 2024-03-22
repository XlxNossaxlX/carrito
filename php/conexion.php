<?php 
    $servidor = "localhost";
    $nombreBd = "carrito";
    $usuario = "root";
    $pass="";
    $conexion = new mysqli($servidor, $usuario, $pass, $nombreBd);
    if($conexion->connect_error){
        die("No se pudo conertar");
    }
    // $servidor = "carrito.database.windows.net";
    // $nombreBd = "carrito";
    // $usuario = "SQLadmin";
    // $pass="Admin1234";
    // $conexion = new mysqli($servidor, $usuario, $pass, $nombreBd);
    // if($conexion->connect_error){
    //     die("No se pudo conertar");
    // }
?>