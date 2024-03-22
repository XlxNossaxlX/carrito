<?php 
    include "./conexion.php";

    if(isset($_POST['nombre']) && isset($_POST['telefono']) && isset($_POST['email']) &&
    isset($_POST['password'])){
        $password = $_POST['password'];
        $carpeta = "../images/users/";
        $nombre = $_FILES['imagen']['name'];
        $temp = explode(".", $nombre);
        $extension = end($temp);
        $nombreFinal = time() . "." . $extension;
        if($extension == "jpg" || $extension == "png" || $extension == "jpeg"){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta . $nombreFinal)){
                $conexion->query("INSERT INTO usuario
                (nombre, telefono, email, password, img_perfil, nivel) 
                VALUES (
                    '".$_POST['nombre']." ".$_POST['apellido']."',
                    '".$_POST['telefono']."',
                    '".$_POST['email']."',
                    '".sha1($password)."',
                    '".$nombreFinal."',
                    'cliente'
                )") or die($conexion->error);
                header("Location: ../login.php");
            } else {
                header("Location: ../login.php?Error=No se pudo subir la imagen");    
            }
        } else {
            header("Location: ../login.php?Error=Favor subir una imagen válida");
        }
    } else {
        header("Location: ../login.php?Error=Favor llenar todos los campos");
    }
?>
