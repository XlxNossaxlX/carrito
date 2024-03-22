<?php 
    include "./conexion.php";

    if(isset($_POST['nombre']) && isset($_POST['telefono']) && isset($_POST['email']) 
    && isset($_POST['password']) && isset($_POST['nivel']) && isset($_FILES['imagen'])){

        $password = $_POST['password'];
        $carpeta ="../images/users/";
        $nombreImagen = $_FILES['imagen']['name'];

        $temp= explode('.', $nombreImagen);
        $extension = end($temp);

        $nombreFinal = time().'.'.$extension;

        if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)){                
                $conexion->query("insert into usuario
                    (nombre, telefono, email, password, img_perfil, nivel) values
                    (
                        '".$_POST['nombre']."',
                        '".$_POST['telefono']."',
                        '".$_POST['email']."',
                        '".sha1($password)."',
                        '".$nombreFinal."',
                        '".$_POST['nivel']."'
                    )
                ")or die ($conexion -> error);
                header("Location: ../admin/usuarios.php?success");
            }else{
                header("Location: ../admin/usuarios.php?error=No se pudo subir la imagen");
            }
        }else{
            header("Location: ../admin/usuarios.php?error=Por favor de subir una imagen valida");
        }
    }else{
        header("Location: ../admin/usuarios.php?error=Por favor de llenar todos los campos");
    }
?>
