<?php 
include "conexion.php";

if(isset($_POST['nombre']) && isset($_POST['telefono']) && isset($_POST['email']) && isset($_POST['nivel']) && isset($_POST['id'])){
    $conexion->query("update usuario set 
    nombre='".$_POST['nombre']."',
    telefono='".$_POST['telefono']."',
    email='".$_POST['email']."',
    nivel='".$_POST['nivel']."'
    WHERE id=".$_POST['id']);    

    header("Location: ../admin/usuarios.php?success");
    
}

?>
